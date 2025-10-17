<?php

namespace App\Controllers;

class Auth extends BaseController
{
    protected $session;
    protected $validation;
    protected $db;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->db = \Config\Database::connect();
    }

    // Registration
  public function login()
{
    // Start session
    $session = session();

    // Load the user model
    $model = new \App\Models\UserModel(); // Make sure namespace is correct

    // Get email and password from login form
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    // Find user by email
    $user = $model->where('email', $email)->first();

    // Verify user exists and password is correct
    if($user && password_verify($password, $user['password'])) {

        // Set session data
        $session->set([
            'user_id'   => $user['id'],
            'role'      => $user['role'],
            'isLoggedIn'=> true
        ]);

        // Redirect based on user role
        switch ($user['role']) {
            case 'student':
                return redirect()->to('/announcements');
            case 'teacher':
                return redirect()->to('/teacher/dashboard');
            case 'admin':
                return redirect()->to('/admin/dashboard');
            default:
                return redirect()->to('/');
        }
    } else {
        // Invalid login attempt
        $session->setFlashdata('error', 'Invalid credentials.');
        return redirect()->back();
    }
}


    // Logout
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('login'));
    }

    // Dashboard
    public function dashboard()
    {
        if ($this->session->get('isLoggedIn') !== true) {
            $this->session->setFlashdata('error', 'Please login to access the dashboard.');
            return redirect()->to(base_url('login'));
        }

        $userData = [
            'userID' => $this->session->get('userID'),
            'name'   => $this->session->get('name'),
            'email'  => $this->session->get('email'),
            'role'   => $this->session->get('role')
        ];

        return view('auth/dashboard', [
            'user'  => $userData,
            'title' => 'WebSystem- Parcon Enterprises'
        ]);
    }
}
