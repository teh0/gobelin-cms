<?php


namespace App\Controller\Admin;


use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends BaseController
{
    const ADMIN_PATH_VIEW = 'pages/admin';
    /**
     * Homepage
     */
    public function index(): Response
    {
        return $this->render(self::ADMIN_PATH_VIEW . '/home.html.twig');
    }
}