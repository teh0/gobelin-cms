<?php


namespace App\Controller\Admin;


use App\Controller\BaseController;
use App\Utils\Constants\Path;
use Symfony\Component\HttpFoundation\Response;

class PageManager extends BaseController
{
    public function index(): Response
    {
        return $this->render(Path::ADMIN_PAGES . '/managers/page/list.html.twig');
    }

    public function create(): Response
    {
        return $this->render(Path::ADMIN_PAGES . '/managers/page/create.html.twig');
    }
    public function read(): Response
    {
        return $this->render(Path::ADMIN_PAGES . '/managers/page/read.html.twig');
    }
    public function update(): Response
    {
        return $this->render(Path::ADMIN_PAGES . '/managers/page/update.html.twig');
    }

    public function delete()
    {

    }
}
