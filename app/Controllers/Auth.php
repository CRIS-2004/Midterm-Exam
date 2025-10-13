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

    // Login
    public function login()
    {
        // Redirect if already logged in
        if ($this->session->get('isLoggedIn') === true) {
            return redirect()->to(base_url('dashboard'));
        }

        if ($this->request->getMethod() === 'POST') {

            $login = $this->request->getPost('login');
            $password = $this->request->getPost('password');

            if (empty($login) || empty($password)) {
                $this->session->setFlashdata('error', 'Please enter both login and password.');
                return view('auth/login');
            }

            // Hardcoded admin login
            if ($login === 'admin' && $password === 'admin123') {
                $this->session->set([
                    'userID'     => 1,
                    'name'       => 'Admin',
                    'email'      => 'admin@rmmc.com',
                    'role'       => 'admin',
                    'isLoggedIn' => true
                ]);
                $this->session->setFlashdata('success', 'Welcome back, Administrator!');
                return redirect()->to(base_url('dashboard'));
            }

            // Check DB for user
            $builder = $this->db->table('users');
            $user = $builder->where('email', $login)
                            ->orWhere('name', $login)
                            ->get()
                            ->getRowArray();

            if ($user && password_verify($password, $user['password'])) {

                $this->session->set([
                    'userID'     => $user['id'],
                    'name'       => $user['name'],
                    'email'      => $user['email'],
                    'role'       => $user['role'],
                    'isLoggedIn' => true
                ]);

                // Role-based redirect
                switch ($user['role']) {
                    case 'admin':
                        return redirect()->to(base_url('admin/dashboard'));
                    case 'teacher':
                        return redirect()->to(base_url('teacher/dashboard'));
                    case 'student':
                        return redirect()->to(base_url('student/dashboard'));
                    default:
                        return redirect()->to(base_url('dashboard'));
                }

            } else {
                $this->session->setFlashdata('error', 'Invalid login credentials.');
            }
        }

        return view('auth/login');
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
            'title' => 'LMS - Dashboard'
        ]);
    }
}
