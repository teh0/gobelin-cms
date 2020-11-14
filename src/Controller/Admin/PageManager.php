<?php


namespace App\Controller\Admin;


use App\Controller\BaseController;
use App\Utils\Constants\Path;
use Symfony\Component\HttpFoundation\Response;

class PageManager extends BaseController
{
    public function index(): Response
    {
        return $this->render(Path::ADMIN_PAGES . '/managers/page/list.html');
    }

    public function create(): Response
    {
        return $this->render(Path::ADMIN_PAGES . '/managers/page/create.html');
    }

    public function update(): Response
    {
        return $this->render(Path::ADMIN_PAGES . '/managers/page/update.html');
    }

    public function delete()
    {

    }
}