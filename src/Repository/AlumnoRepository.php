<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class AlumnoRepository extends EntityRepository
{

    public function listadoAlumnos()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT alumno.id, alumno.nExpediente, alumno.nombre, alumno.apellidos
                 FROM App:alumno alumno'
            );

        try{
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e){
            return null;
        }
    }

}