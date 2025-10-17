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
 public function register()
    {
        // Redirect if already logged in
        if ($this->session->get('isLoggedIn') === true) {
            return redirect()->to(base_url('dashboard'));
        }

        if ($this->request->getMethod() === 'POST') {

            $rules = [
                'name'             => 'required|min_length[3]|max_length[100]',
                'email'            => 'required|valid_email|is_unique[users.email]',
                'password'         => 'required|min_length[6]',
                'password_confirm' => 'required|matches[password]',
                'role'             => 'required'
            ];

            $messages = [
                'name' => [
                    'required'   => 'Name is required.',
                    'min_length' => 'Name must be at least 3 characters.',
                    'max_length' => 'Name cannot exceed 100 characters.'
                ],
                'email' => [
                    'required'    => 'Email is required.',
                    'valid_email' => 'Invalid email.',
                    'is_unique'   => 'Email already exists.'
                ],
                'password' => [
                    'required'   => 'Password is required.',
                    'min_length' => 'Password must be at least 6 characters.'
                ],
                'password_confirm' => [
                    'required' => 'Password confirmation required.',
                    'matches'  => 'Passwords do not match.'
                ]
            ];

            if ($this->validate($rules, $messages)) {
                $hashedPassword = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

                $userData = [
                    'name'       => $this->request->getPost('name'),
                    'email'      => $this->request->getPost('email'),
                    'password'   => $hashedPassword,
                    'role'       => $this->request->getPost('role'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                try {
                    $builder = $this->db->table('users');
                    $builder->insert($userData);

                    $this->session->setFlashdata('success', 'Registration successful! Please login.');
                    return redirect()->to(base_url('login'));

                } catch (\Exception $e) {
                    $this->session->setFlashdata('error', 'Registration failed: ' . $e->getMessage());
                    return redirect()->back()->withInput();
                }

            } else {
                $this->session->setFlashdata('errors', $this->validation->getErrors());
                return redirect()->back()->withInput();
            }
        }

        return view('auth/register');
    }
        
  public function login()
{
    // Start session
    $session = session();

    // Connect to database (without using a model)
    $db = \Config\Database::connect();
   

    // Get email and password from login form
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    // Fetch user manually using query builder
    $user = $db->table('users')->where('email', $email)->get()->getRowArray();

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
