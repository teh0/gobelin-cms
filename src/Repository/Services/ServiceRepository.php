<?php


namespace App\Repository\Services;


use Knp\Component\Pager\PaginatorInterface;

class ServiceRepository implements ServiceRepositoryInterface
{
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    /**
     * ServiceRepository constructor.
     *
     * @param PaginatorInterface $paginator
     */
    public function __construct(PaginatorInterface $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * @return PaginatorInterface
     */
    public function getPaginator(): PaginatorInterface
    {
        return $this->paginator;
    }

}