<?php
// src/AppBundle/Repository/TagRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class TagRepository extends EntityRepository
{
    public function findBySearch($tag)
    {
    	$sql = "SELECT a.id as id, a.titre as titre, a.description as description, a.photo as photo,
    	        u.username as pseudo, SUM(m.prix) as prix, u.ville as ville
                FROM c9.ambiance a 
                LEFT JOIN c9.tag t ON t.ambiance = a.id
                LEFT JOIN c9.user u ON a.designer = u.id
                LEFT JOIN c9.meuble m ON m.annonce = a.id
                WHERE t.tag LIKE '%".$tag."%'
                OR a.titre LIKE '%".$tag."%'
                GROUP BY 1 ORDER BY a.date_creation DESC";
       
       $rsm = new ResultSetMapping();
       $rsm->addScalarResult('id', 'id');
       $rsm->addScalarResult('titre', 'titre');
       $rsm->addScalarResult('description', 'description');
       $rsm->addScalarResult('photo', 'photo');
       $rsm->addScalarResult('pseudo', 'pseudo');
       $rsm->addScalarResult('prix', 'prix');
       $rsm->addScalarResult('ville', 'ville');


        return $this->getEntityManager()
            ->createNativeQuery($sql, $rsm)
            ->getResult();
    }
}