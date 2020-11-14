<?php


namespace App\Controller\Admin;


use App\Controller\BaseController;
use App\Utils\Constants\Path;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends BaseController
{
    /**
     * Homepage
     */
    public function index(): Response
    {
        return $this->render(Path::ADMIN_PAGES . '/home.html.twig');
    }
}