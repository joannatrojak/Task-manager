<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Task; 
use App\Controller\TaskService as TaskService;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;

class TaskController extends FOSRestController
{
    private $taskService; 
    public function __construct(TaskService $taskService) {
        $this->taskService = $taskService;
    }
    /**
     * Creates an Task resource
     * @FOSRest\Post("api/task")
     * @param Request $request
     * @return View
     */
    public function postTask(Request $request):View
    {
        $task = $this->taskService->postTask($request->get('name'), $request->get('description'), $request->get('duedate'), $request->get('done'));
        return View::create($task, Response::HTTP_CREATED , []);   
    }
    /**
    * Retrieves an Article resource
    * @FOSRest\Get("api/task/{taskId}")
    */
    public function getTask($taskId):View
    {
        $task = $this->taskService->getTask($taskId);
        return View::create($task, Response::HTTP_OK);
    }
    /**
    * Retrieves a collection of Article resource
    * @FOSRest\Get("api/task")
    */
    public function getTasks():View
    {
        $tasks = $this->taskService->getTasks();
        return View::create($tasks, Response::HTTP_OK);
    }
    /**
    * Replaces Article resource
    * @FOSRest\Put("api/task/{taskId}")
    */
    public function putTask($taskId, Request $request)
    {
        $task = $this->taskService->putTask($request->get('name'), $request->get('description'), $request->get('duedate'), $request->get('done'));
        return View::create($task, Response::HTTP_OK);
    }
    /**
    * Removes the Article resource
    * @FOSRest\Delete("api/task/{taskId}")
    */
    public function deleteTask($taskId)
    {
        $this->taskService->deleteTask($taskId);
        return View::create([], Response::HTTP_NO_CONTENT);
    }
}
