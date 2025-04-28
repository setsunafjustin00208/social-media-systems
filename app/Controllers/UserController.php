<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use CodeIgniter\Session\Session;


class UserController extends BaseController
{
    protected $userModel;
    protected $username;
    protected $email;
    protected $password;
    protected $confirmPassword;
    protected $userId;
    protected $userData;
    protected $userDataArray;
    protected $privileges;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();

        // $this->username = null !== $this->request->getPost('username') ? $this->request->getPost('username') : null;
        // $this->email = null !== $this->request->getPost('email') ? $this->request->getPost('email') : null;
        // $this->password = null !== $this->request->getPost('password') ? $this->request->getPost('password') : null;
        // $this->confirmPassword = null !== $this->request->getPost('confirm_password') ? $this->request->getPost('confirm_password') : null;
        // $this->userId = null !== $this->request->getPost('user_id') ? $this->request->getPost('user_id') : null;
        // $this->userData = null !== $this->request->getPost('user_data') ? $this->request->getPost('user_data') : null;
        // $this->userDataArray = json_decode($this->userData, true);
        
        // if (is_null($this->userDataArray)) {
        //     $this->userDataArray = [];
        // }
        
        // $this->privileges = null !== $this->request->getPost('privileges') ? $this->request->getPost('privileges') : null;
        // if (is_null($this->privileges)) {
        //     $this->privileges = [];
        // }

    }
    public function index()
    {
        $data = Array (
            'title' => 'Login',
            'description' => 'Login to your account',
            'keywords' => 'login, user, account',
            'styles' => Array (
                'dist/vendor/css/sweetalert2.min.css',
                'dist/css/default.css',
                'dist/css/global.css',
                'dist/css/components/footer.css',
                'dist/css/components/navbar.css',
                'dist/css/pages/login.css',
                'dist/css/pages/index.css',
            ),
            'scripts' => Array(
                'dist/vendor/js/cdn.min.js',
                'dist/vendor/js/jquery.min.js',
                'dist/vendor/js/floating-ui.dom.umd.min.js',
                'dist/js/default.js',
                'dist/js/global.js',
                'dist/js/components/footer.js',
                'dist/js/components/navbar.js',
                'dist/js/pages/login.js',
                'dist/js/pages/index.js',
            ),
        );
        echo view('pages/login', $data);
    }

    public function login()
    {
        $this->email = $this->request->getPost('email');
        $this->password = $this->request->getPost('password');
        
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST)
                ->setJSON(['status' => 'error', 'message' => 'Invalid email format']);
        }

        // Retrieve the user by email
        $user = $this->userModel->getUserByEmail($this->email);

        if ($user) {
            // Verify the password
            if (password_verify($this->password, $user[0]['password'])) {
                // Set session data or perform any other login actions
              $userData =  array(
                    'user_id' => $user[0]['_id'],
                    'username' => $user[0]['username'],
                    'email' => $user[0]['email'],
                    'role' => $user[0]['role'],
                    'is_logged_in' => true,
                );

                $this->session->set($userData);

                // Set user privileges
                
                $setUserPrivileges = $this->userModel->setaAccountPermissions($user[0]['_id'], $user[0]['role']);

                if (!$setUserPrivileges) {
                    return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                        ->setJSON(['status' => 'error', 'message' => 'Failed to set user privileges']);
                }
                
                return $this->response->setJSON(['status' => 'success', 'userData' => $userData, 'message' => 'Login successful']);

            } else {

                return $this->response->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED)
                        ->setJSON(['status' => 'error', 'message' => 'Invalid password']);
            }

        } else {
            return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                    ->setJSON(['status' => 'error', 'message' => 'User not found']);
        }
    }
    public function register()
    {
        if ($this->password !== $this->confirmPassword) {
            return $this->fail('Passwords do not match');
        }

        $data = [
            'username' => $this->username,
            'email' => $this->email,
            'password' => password_hash($this->password, PASSWORD_BCRYPT),
            'role' => 'reader', // Default role,
            'created_at' => date('Y-m-d H:i:s'),	
            'updated_at' => date('Y-m-d H:i:s'),	
            
        ];

        if ($this->userModel->insert($data)) {
            return $this->respond(['status' => 'success', 'message' => 'User registered successfully']);
        } else {
            return $this->fail('Failed to register user');
        }
    }
}
