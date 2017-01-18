<?php
// src/AppBundle/Repository/TagRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TagRepository extends EntityRepository
{
    public function findByTag($tags)
    {
    	$sql = "SELECT 
                FROM AppBundle:Ambiance a 
                LEFT JOIN AppBundle:Tag t ON t.ambiance = a.id
                WHERE TRUE"

        foreach ($tags as $tag) {
        		$sql .= " OR t.tag LIKE '%".$tag."'";
        }

       $sql .= "ORDER BY a.date_creation"

       return $sql;

        /*return $this->getEntityManager()
            ->createQuery($sql               
                 
            )
            ->getResult();*/
    }
}