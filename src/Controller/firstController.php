<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
class firstController extends AbstractController
{

    /**
     * @Route("/first",name="first")
     */

    public function first(){
        return new Response("<h1>hello GL2 2021</h1>");
    }
    /**
     * @Route ("",name="home")
     */
    public function index()
    {
        return $this->redirectToRoute('first');
    }
}