<?php


namespace App\Controller\Admin;


use App\Controller\BaseController;
use App\Entity\SearchField;
use App\Entity\User;
use App\Form\SearchFieldType;
use App\Repository\UserRepository;
use App\Utils\Constants\Path;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserManagerController extends BaseController
{
    public function index(UserRepository $userRepository, Request $request): Response
    {
        $users = $userRepository->paginate($request);
        $search = new SearchField();
        $searchForm = $this->createForm(SearchFieldType::class, $search, [
            'choices' => SearchFieldType::userChoices(),
            'method'  => 'POST'
        ]);

        $searchForm->handleRequest($request);

        if ($this->validateAndSubmittedForm($searchForm)) {
            $query = $userRepository->searchByFieldQuery($search->getField(), $search->getValue());
            $users = $userRepository->paginate($request, $query);
        }

        return $this->render(Path::ADMIN_PAGES . '/managers/user/list.html.twig', [
            'users'      => $users,
            'searchForm' => $searchForm->createView()
        ]);
    }

    public function read(User $user): Response
    {
        return $this->render(Path::ADMIN_PAGES . '/managers/user/read.html.twig', [
            'user' => $user
        ]);
    }

}
