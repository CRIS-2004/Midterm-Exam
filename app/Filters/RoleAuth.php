<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleAuth implements FilterInterface
{
    /**
     * This method runs **before** the controller is executed.
     * It checks if the user has permission to access the requested route.
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Start session to access user data
        $session = session();

        // Get the user's role from session
        $role = $session->get('role');

        // Get the current URL path
        $uri = current_url(true)->getPath();

        // Check role-based access
        if ($role === 'admin' && str_starts_with($uri, 'admin')) {
            // Admin can access all /admin/* routes
            return; // allow
        } elseif ($role === 'teacher' && str_starts_with($uri, 'teacher')) {
            // Teacher can access all /teacher/* routes
            return; // allow
        } elseif ($role === 'student' && (str_starts_with($uri, 'student') || $uri === 'announcements')) {
            // Student can access /student/* and /announcements
            return; // allow
        } else {
            // User does not have permission
            $session->setFlashdata('error', 'Access Denied: Insufficient Permissions');

            // Redirect unauthorized users to announcements page
            return redirect()->to('/announcements');
        }
    }

    /**
     * This method runs **after** the controller has executed.
     * Not needed for this filter, so left empty.
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No post-processing needed
    }
}
