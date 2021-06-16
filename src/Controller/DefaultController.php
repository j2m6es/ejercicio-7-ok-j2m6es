<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $listadoAlumnos = $doctrine->getManager()->getRepository("App:Alumno")->listadoAlumnos();

        return $this->render('default/index.html.twig', [
            'ALUMNOS' => $listadoAlumnos,
        ]);
    }
}
