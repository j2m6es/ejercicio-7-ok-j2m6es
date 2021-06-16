<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class AsignaturaRepository extends EntityRepository
{

    public function obtenerAsignaturas($id)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT asignatura, alumno
                 FROM App:asignatura asignatura
                 JOIN asignatura.alumno alumno
                 WHERE alumno.id = :id'
            )->setParameter('id', $id);

        try{
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e){
            return null;
        }
    }

    public function obtenerTodasAsignaturas()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT asignatura
                 FROM App:asignatura asignatura'
            );

        try{
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e){
            return null;
        }
    }

}