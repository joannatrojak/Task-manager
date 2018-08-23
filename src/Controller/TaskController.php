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
        $task->setName('name1');
        $task->setDescription('dadhsakdhsajh hdshdkashdkas'); 
        $task->setDueDate($date); 
        $task->setDone(1);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();
        
        return View::create($task, Response::HTTP_CREATED , []);   
    }
    /**
    * Retrieves an Article resource
    * @FOSRest\Get("api/task/{taskId}")
    */
    public function getTask($taskId):View
    {
        $task = $this->getDoctrine()->getRepository('App:Task')->findById($taskId);
        return View::create($task, Response::HTTP_OK);
    }
    /**
    * Retrieves a collection of Article resource
    * @FOSRest\Get("api/task")
    */
    public function getTasks():View
    {
        $tasks = $this->getDoctrine()->getRepository('App:Task')->findAll(); 
        return View::create($tasks, Response::HTTP_OK);
    }
    /**
    * Replaces Article resource
    * @FOSRest\Put("api/task/{taskId}")
    */
    public function putTask($taskId, Request $request)
    {
        
        $task = $this->getDoctrine()->getRepository('App:Task')->findById($taskId);
        
        $task = new Task();
        $date = new \DateTime("now"); 
        $task->setName('nameUpdated');
        $task->setDescription('dadhsakdhsajh hdshdkashdkas ddadsdasd sdadad sadasd'); 
        $task->setDueDate($date); 
        $task->setDone(1);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();
        
        return View::create($task, Response::HTTP_OK);
    }
    /**
    * Removes the Article resource
    * @FOSRest\Delete("api/task/{taskId}")
    */
    public function deleteTask($taskId)
    {
        $task = $this->getDoctrine()->getRepository('App:Task')->findById($taskId);     
        $em = $this->getDoctrine()->getManager();
        $em->remove($task[0]); 
        $em->flush(); 
        
        return View::create([], Response::HTTP_NO_CONTENT);
    }
}
