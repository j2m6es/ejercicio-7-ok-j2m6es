<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class NotaRepository extends EntityRepository
{

    /*
    Mostrar la última nota de cada asignatura de un alumno. 
    */
    public function obtenerNotas($id)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT max(nota.nota) notaAsignatura, alumno.nombre, alumno.apellidos, asignatura.nombre nombreAsignatura, max(nota.nConvocatoria)
                 FROM App:nota nota
                 JOIN nota.alumno alumno
                 JOIN nota.asignatura asignatura
                 WHERE alumno.id = :id
                 GROUP BY asignatura.id'
            )->setParameter('id', $id);

        try{
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e){
            return null;
        }
    }

}