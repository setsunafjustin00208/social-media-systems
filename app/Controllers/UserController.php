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
    }
    public function index()
    {
        $data = Array (
            'title' => 'Login',
            'description' => 'Login to your account',
            'keywords' => 'login, user, account',
            'styles' => Array (
                'dist/css/components/footer.min.css',
                'dist/css/components/navbar.min.css',
                'dist/css/pages/login.min.css',
            ),
            'scripts' => Array(
                'dist/js/components/footer.min.js',
                'dist/js/components/navbar.min.js',
                'dist/js/pages/login.min.js',
            ),
        );
        $data['session'] = $this->session->get();

        if (isset($data['session']['is_logged_in'])) {
            return redirect()->to('/roleplay/home');
        }

        // Check if the user is already logged in
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

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/account/login');
    }
}
