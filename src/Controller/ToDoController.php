<?php

namespace App\Controller;

use MongoDB\Driver\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TodoController
 * @package App\Controller
 * @Route("todo")
 */
class ToDoController extends AbstractController
{
    /**
     * @Route("/", name="todo")
     */
    public function index(SessionInterface $session): Response
    {
        if (!$session->has('todos')) {
            $todos = [
                'lundi' => 'HTML',
                'mardi' => 'CSS',
                'mercredi' => 'Js'
            ];
            $session->set('todos', $todos);
            $this->addFlash('info', "Bienvenu dans votre plateforme de gestion des todos");
        }
        return $this->render('todo/index.html.twig');
    }


    /**
     * @Route ("/add/{name}/{content}",name="addToDo")
     */
    public function addToDo($name, $content, SessionInterface $session)
    {
        if (!$session->has('todos')) {
            $this->addFlash('error', "la liste des todos n'est pas encore initialisé");
        } else {
            $todos = $session->get('todos');
            if (isset($todos[$name])) {
                $this->addFlash('error', "le todo $name existe déjà");

            } else {
                $todos[$name] = $content;
                $session->set('todos', $todos);
                $this->addFlash('success', "le todo $name a été ajouté avec succés ");

            }
        }
        return $this->redirectToRoute('todo');

    }

    /**
     * @Route ("/update/{name}/{newContent}",name="updateToDo")

     */
    public function updateToDo($name,$newContent,SessionInterface $session){
        if (!$session->has('todos')) {
            $this->addFlash('error', "la liste des todos n'est pas encore initialisé");
        } else {
            $todos = $session->get('todos');
            if (!isset($todos[$name])) {
                $this->addFlash('error', "le todo $name n'existe pas");

            } else{
                $todos[$name] = $newContent;
                $session->set('todos', $todos);
                $this->addFlash('success', "le todo $name a été mis à jour ");

            }
        }
        return $this->redirectToRoute('todo');

    }

    /**
     * @Route ("/supp/{name}",name="deleteFromToDo")
     */

    public function deleteFromToDo($name, SessionInterface $session)
    {
        if (!$session->has('todos')) {
            //ko => messsage erreur + redirection
            $this->addFlash('error', "La liste des todos n'est pas encore initialisée");
        } else {
            $todos = $session->get('todos');
            if (!isset($todos[$name])) {
                $this->addFlash('error', "le todo $name n'existe pas");
            } else {
                unset($todos[$name]);
                $session->set('todos', $todos);
                $this->addFlash('success', "le todo $name a été supprime");
            }
        }
        return $this->redirectToRoute('todo');
    }
    /**
* @Route ("/reset",name="reset")
*/
    public function resetToDo(SessionInterface $session){
        if (!$session->has('todos')) {

            $this->addFlash('error', "La liste des todos n'est pas encore initialisée");
        }else{
            foreach ($this as $key =>$value)
           $session->clear();
            $this->addFlash('success',"ToDos Reset effectué avec succés");
        }
        return $this->redirectToRoute('todo');
    }
}
