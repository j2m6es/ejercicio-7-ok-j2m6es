<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AsignaturasController extends AbstractController
{

    public function obtener($id, ManagerRegistry $doctrine): Response
    {
        $alumno = '';
        $id_alumno = '';
        $asignaturas = $doctrine->getManager()->getRepository("App:Asignatura")->obtenerAsignaturas($id);

        foreach($asignaturas as $asig)
        {
            $alumno = $asig->getAlumno()[0]->getNombre() . ' '.$asig->getAlumno()[0]->getApellidos();
            $id_alumno  = $asig->getAlumno()[0]->getId();
            break;
        }

        $todasasignaturas = $doctrine->getManager()->getRepository("App:Asignatura")->obtenerTodasAsignaturas();

        return $this->render('asignaturas/obtener.html.twig', [
            'ASIGNATURAS' => $asignaturas,
            'ALUMNO' => $alumno,
            'ID_ALUMNO' => $id_alumno,
            'TODAS_ASIGNATURAS' => $todasasignaturas,
        ]);
    }

    public function matricularse($idAlumno, $idAsignatura, ManagerRegistry $doctrine): Response
    {
        $alumno = $doctrine->getManager()->getRepository("App:Alumno")->find($idAlumno);
        $asignatura = $doctrine->getManager()->getRepository("App:Asignatura")->find($idAsignatura);
        $alumno->addAsignatura($asignatura);

        $doctrine->getManager()->persist($alumno);
        $doctrine->getManager()->flush();

        return $this->redirectToRoute('asignaturas_obtener', ['id' => $idAlumno]);
    }

    public function desmatricularse($idAlumno, $idAsignatura, ManagerRegistry $doctrine): Response
    {
        $alumno = $doctrine->getManager()->getRepository("App:Alumno")->find($idAlumno);
        $asignatura = $doctrine->getManager()->getRepository("App:Asignatura")->find($idAsignatura);
        $alumno->removeAsignatura($asignatura);

        $doctrine->getManager()->persist($alumno);
        $doctrine->getManager()->flush();
        
        return $this->redirectToRoute('asignaturas_obtener', ['id' => $idAlumno]);
    }
}
