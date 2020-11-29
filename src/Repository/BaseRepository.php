<?php


namespace App\Repository;


use App\Repository\Services\ServiceRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

abstract class BaseRepository extends ServiceEntityRepository
{
    /**
     * @var ServiceRepositoryInterface
     */
    protected $serviceRepository;

    public function __construct(ManagerRegistry $registry, $entityClass, ServiceRepositoryInterface $serviceRepository)
    {
        parent::__construct($registry, $entityClass);
        $this->serviceRepository = $serviceRepository;
    }

    abstract public function getAlias(): string;
    abstract public function getTableName(): string;
    abstract public function searchableFields(): array;

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

    public function paginate(Request $request, $query = null, $limitPerPage = 15): PaginationInterface
    {
        if (is_null($query)) {
            $query = $this->createQueryBuilder($this->getAlias())
                ->select()
                ->getQuery();
        }

        return $this->serviceRepository->getPaginator()->paginate($query, $request->query->getInt('page', 1), $limitPerPage);
    }

    public function searchByFieldQuery(string $field, string $value)
    {
        if (!$this->validSearchableField($field)) {
            $field = '';
        }

        return $this->createQueryBuilder($this->getAlias())
            ->where($this->getAlias() . ".$field" . ' LIKE :value')
            ->setParameter('value', '%' . $value . '%')
            ->getQuery();
    }

    public function searchByField(string $field, string $value)
    {
        return $this->searchByFieldQuery($field, $value)->getResult();
    }

    protected function validSearchableField(string $field): bool
    {
        return in_array($field, $this->searchableFields());
    }

}