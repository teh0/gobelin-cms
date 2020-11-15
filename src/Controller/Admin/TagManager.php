<?php


namespace App\Controller\Admin;


use App\Controller\BaseController;
use App\Utils\Constants\Path;
use Symfony\Component\HttpFoundation\Response;

class TagManager extends BaseController
{
    /**
     * Homepage  category
     */
    public function index(): Response
    {
        return $this->render(Path::ADMIN_PAGES . '/managers/tag/list.html.twig');
    }
    public function create(): Response
    {
        return $this->render(Path::ADMIN_PAGES . '/managers/tag/create.html.twig');
    }

    public function read(): Response
    {
        return $this->render(Path::ADMIN_PAGES . '/managers/tag/read.html.twig');
    }

    public function update(): Response
    {
        return $this->render(Path::ADMIN_PAGES . '/managers/tag/update.html.twig');
    }

    public function delete()
    {

    }
}
