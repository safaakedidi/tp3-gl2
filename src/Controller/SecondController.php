<?php

namespace App\Controller;

//use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecondController extends AbstractController
{
    #[Route('/second', name:'second')]
    public function index(Request $request): Response
    {
        $name=$request->query->get('name');
        dump(($request ));

        return $this->render('second/index.html.twig', [
            'controller_name' => 'SecondController',
            'esm'=>$name
        ]);
    }

    /**
     * @Route("/hello/{name}",name="hello")
     */
    public function hello($name){
 return $this->render('second/hello.index.html.twig',array(
     'name'=>$name
 ));

    }

    /**
     * @Route ("/cv/{name}/{firstneme}/{age}/{section}")
     */
    public function cv($name,$firstname,$age,$section){
        return $this->render('second/cv.index.html.twig',[
            'name'=>$name,
            'firstname'=>$firstname,
            'age'=>$age,
            'section'=>$section
        ]);
    }

    /**
     * @Route ("/hellohedil")
     */
    public function hellohedil(){
   return $this->forward('App\Controller\SecondController::hello',
   [
       'name'=>'hadil'

   ]);
    }
}
