<?php


namespace App\Repository;


use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class BaseRepository extends ServiceEntityRepository
{

    abstract public function getAlias(): string;

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

}