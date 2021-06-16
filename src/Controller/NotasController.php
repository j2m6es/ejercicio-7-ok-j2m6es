<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class NotasController extends AbstractController
{
    public function obtener($id, ManagerRegistry $doctrine): Response
    {
        $sumaNotas = 0;
        $numNotas = 0;
        $alumno = '';
        
        $notasAsignaturas = $doctrine->getManager()->getRepository("App:Nota")->obtenerNotas($id);
        foreach($notasAsignaturas as $na)
        {
            $numNotas++;
            $sumaNotas += $na["notaAsignatura"];
            $alumno = $na["nombre"]." ".$na["apellidos"];
        }

        return $this->render('notas/obtener.html.twig', [
            'NOTAS_ASIGNATURA' => $notasAsignaturas,
            'MEDIA_NOTA' => $sumaNotas/$numNotas,
            'ALUMNO' => $alumno,
        ]);
    }
}
