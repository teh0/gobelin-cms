<?php


namespace App\Repository;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

abstract class BaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, $entityClass)
    {
        parent::__construct($registry, $entityClass);
    }

    abstract public function getAlias(): string;
    abstract public function getTableName(): string;

    public function totalRows(string $field = 'id'): int
    {
        try {
            $count = $this->createQueryBuilder($this->getAlias())
                ->select('count(:field)')
                ->setParameter('field', $this->getAlias() . '.' . $field)
                ->getQuery()
                ->getSingleScalarResult();
        } catch (\Exception $e) {
            $count = 0;
        }

        return $count;
    }

    /**
     * @param int    $maxResults
     * @param string $field
     *
     * @return array
     */
    public function last(int $maxResults, string $field = 'createdAt')
    {
        return $this->createQueryBuilder($this->getAlias())
            ->orderBy($this->getAlias() . '.' . $field, 'ASC')
            ->setMaxResults($maxResults)
            ->getQuery()
            ->getResult();
    }

    public function paginate(Request $request, PaginatorInterface $paginator, $limitPerPage = 15): PaginationInterface
    {
        $query = $this->createQueryBuilder($this->getAlias())
            ->select()
            ->getQuery();

        return $paginator->paginate($query, $request->query->getInt('page', 1), $limitPerPage);
    }

}