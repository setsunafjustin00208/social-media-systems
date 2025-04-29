<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserPageController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'User Page',
            'description' => 'User page description',
            'keywords' => 'user, page, keywords',
            'styles' => [
                'dist/vendor/css/sweetalert2.min.css',
                'dist/css/default.css',
                'dist/css/global.css',
                'dist/css/components/sidebar.css',
                'dist/css/components/footer.css',
                'dist/css/components/navbar.css',
                'dist/css/pages/user-page.css',
                'dist/css/pages/index.css',
            ],
            'scripts' => [
                'dist/vendor/js/cdn.min.js',
                'dist/vendor/js/jquery.min.js',
                'dist/vendor/js/floating-ui.dom.umd.min.js',
                'dist/vendor/js/sweetalert2.all.min.js',
                'dist/js/default.js',
                'dist/js/global.js',
                'dist/js/components/footer.js',
                'dist/js/components/navbar.js',
                'dist/js/pages/user-page.js',
            ],
        ];

        return view('pages/userHomePage', $data);
    }
}
