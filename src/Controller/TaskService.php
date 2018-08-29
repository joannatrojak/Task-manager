<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

/**
 * Description of TaskService
 *
 * @author joasi
 */
 final class TaskService {
    
    public function getTask($taskId){
        return $this->getDoctrine()->getRepository('App:Task')->findById($taskId);
    }
    public function getTasks(){
        return $this->getDoctrine()->getRepository('App:Task')->findAll(); 
    }
    public function postTask($name, $description, $date, $done){
        $task = new Task();
        $duedate = new \DateTime($date); 
        $task->setName($name);
        $task->setDescription($description); 
        $task->setDueDate($duedate); 
        $task->setDone($done);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();
        return $task; 
    }
    public function putTask($taskId, $name, $descriptio, $date, $done){
        
        $task = $this->getDoctrine()->getRepository('App:Task')->findById($taskId);
        if (!$task){
            return null; 
        }
        
        $task = new Task();
        $duedate = new \DateTime($date); 
        $task->setName($name);
        $task->setDescription($descriptio); 
        $task->setDueDate($duedate); 
        $task->setDone($done);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();
        return $task; 
    }
    public function deleteTask($taskId){
        $task = $this->getDoctrine()->getRepository('App:Task')->findById($taskId);  
        if ($task){
            $em = $this->getDoctrine()->getManager();
            $em->remove($task[0]); 
            $em->flush(); 
        }   
    }
}
