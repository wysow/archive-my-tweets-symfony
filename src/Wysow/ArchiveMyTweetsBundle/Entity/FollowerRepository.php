<?php

namespace Wysow\ArchiveMyTweetsBundle\Entity;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

/**
 * FollowerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FollowerRepository extends EntityRepository
{
    public function findAllByCreatedAtDesc($favorited = false)
    {
        $qb = $this->createQueryBuilder('t')
            ->orderBy('t.createdAt', 'DESC');

        if($favorited) {
            $qb->where('t.favorited = 1');
        }

        return $qb->getQuery()->execute();
    }

    public function findAllByClient($client)
    {
        $rsm = $this->getRsm();

        $query = $this->getEntityManager()->createNativeQuery('SELECT * FROM tweets WHERE source REGEXP CONCAT("(<a.*>)?", ?, "(</a>)?") ORDER BY created_at DESC', $rsm)
            ->setParameter(1, $client);

        return $query->getResult();
    }

    public function getTweetsByMonths()
    {
        $this->addDoctrineExtensions();

        $qb = $this->createQueryBuilder('t')
            ->select('YEAR(t.createdAt) as y, MONTH(t.createdAt) as m, count(t.id) as total')
            ->groupBy('y,m')
            ->orderBy('t.createdAt', 'DESC');

        return $qb->getQuery()->execute();
    }

    public function getTotalClients()
    {
        $qb = $this->createQueryBuilder('t')
            ->select('count(distinct t.source) as total');

        $result = $qb->getQuery()->getSingleResult();

        return $result['total'];
    }

    public function getClients()
    {
        $qb = $this->createQueryBuilder('t')
            ->select('t.source, count(t.id) as total')
            ->groupBy('t.source')
            ->orderBy('total', 'DESC');

        return $qb->getQuery()->execute();
    }

    public function findByYearAndMonth($year, $month)
    {
        $this->addDoctrineExtensions();

        $qb = $this->createQueryBuilder('t')
            ->select('t')
            ->where('YEAR(t.createdAt) = :year')
            ->andWhere('MONTH(t.createdAt) = :month')
            ->orderBy('t.createdAt', 'DESC')
            ->setParameter('year', $year)
            ->setParameter('month', $month);

        return $qb->getQuery()->execute();
    }

    public function getSearchResults($searchTerm)
    {
        if (trim($searchTerm) == '') return false;

        $rsm = $this->getRsm();

        $sql  = 'SELECT * FROM tweets WHERE 1 ';

        // split out the quoted items
        // $phrases[0] is an array of full pattern matches (quotes intact)
        // $phrases[1] is an array of strings matched by the first parenthesized subpattern, and so on. (quotes stripped)
        // the .+? means match 1 or more characters, but don't be "greedy", i.e., match the smallest amount
        preg_match_all("/\"(.+?)\"/", $searchTerm, $phrases);
        $words = explode(' ', preg_replace('/".+?"/', '', $searchTerm));
        $wordList = array_merge($phrases[1], $words);

        // create the sql statement
        $sql .= 'AND (';
        $wordParams = array();
        $i = 1;
        foreach ($wordList as $word) {
            if (strlen($word)) {
                $key = ':word'.$i;
                $wordParams[$key] = '%' . str_replace(",", "", strtolower($word)) . '%';
                $sql .= "(tweet LIKE ".$key.") or ";
                $i++;
            }
        }
        $sql = rtrim($sql, " or "); // remove that dangling "or"
        $sql .= ') ORDER BY created_at DESC';

        // bind each search term
        $query = $this->getEntityManager()->createNativeQuery($sql, $rsm);
        foreach ($wordParams as $key => $param) {
            $query->setParameter($key, $param);
        }

        return $query->getResult();
    }

    private function addDoctrineExtensions()
    {
        $emConfig = $this->getEntityManager()->getConfiguration();
        $emConfig->addCustomDatetimeFunction('YEAR', 'DoctrineExtensions\Query\Mysql\Year');
        $emConfig->addCustomDatetimeFunction('MONTH', 'DoctrineExtensions\Query\Mysql\Month');
    }

    private function getRsm()
    {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addRootEntityFromClassMetadata('Wysow\ArchiveMyTweetsBundle\Entity\Tweet', 't');

        return $rsm;
    }
}