<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'session')]
    public function index(SessionInterface $session): Response
    {
        $message="bienvenue chez nous";
        if(!$session->has('user')  ){
            $message="bienvenue chez nous";
            $this->addFlash('welcome',$message);
            $session->set('user','newUser');

        }
        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }
}
