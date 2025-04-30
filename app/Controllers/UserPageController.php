<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;


class UserPageController extends BaseController
{
    protected $session;
    protected $userModel;

    public function __construct()
    {
        $this->session = session();
        $this->userModel = new \App\Models\UserModel();
     
    }
    public function index()
    {
        $data = [
            'title' => 'User Page',
            'description' => 'User page description',
            'keywords' => 'user, page, keywords',
            'styles' => [
                'dist/css/components/sidebar.min.css',
                'dist/css/components/sidebar-small.min.css',
                'dist/css/components/footer.min.css',
                'dist/css/components/navbar.min.css',
                'dist/css/components/chatsWidget.min.css',
                'dist/css/components/chat-component.min.css',
            ],
            'scripts' => [
                'dist/js/components/footer.min.js',
                'dist/js/components/navbar.min.js',
                'dist/js/components/chat-component.min.js',
            ],
        ];

        $data['session'] = $this->session->get();

        if (!isset($data['session']['is_logged_in'])) {
            return redirect()->to('/account/login');
        }

        return view('pages/userHomePage', $data);
    }
}
