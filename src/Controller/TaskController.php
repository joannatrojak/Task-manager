<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Task; 

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;

class TaskController extends FOSRestController
{
        /**
     * Creates an Task resource
     * @FOSRest\Post("api/task")
     * @param Request $request
     * @return View
     */
    public function postTask(Request $request):View
    {
        $task = new Task();
        $date = new \DateTime("now"); 
        $task->setName('name');
        $task->setDescription('description description'); 
        $task->setDueDate($date); 
        $task->setDone(1);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();
        
        return View::create($task, Response::HTTP_CREATED , []);   
    }
}
