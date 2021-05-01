<?php

namespace App\Controller;

//use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CvController extends AbstractController
{
    #[Route('/cv', name: 'cv')]
    public function index(Request $request): Response
    {
        $nom=$request->query->get('nom');
        $prenom=$request->query->get('prenom');
        $age=$request->query->get('age');
        $section=$request->query->get('section');

        return $this->render('cv/index.html.twig', [
            'controller_name' => 'CvController',
            'nom'=>$nom,'prenom'=>$prenom,'age'=>$age,'section'=>$section
        ]);
    }
}
