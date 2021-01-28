<?php
namespace App\Controller;

use App\Entity\Task;
use App\Form\Type\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;



class TaskController extends AbstractController
{
    /**
    *@Route("/forms",name="task_success")
     */
    public function new(Request $request)
    {
        $task=new Task();
        $form = $this->createForm(TaskType::class,$task);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            /*$task=new Task();
            $form = $this->createForm(TaskType::class,$task);
            return $this->render('task/new.html.twig',['form'=>$form->createView()]);*/
            $entitymanager=$this->getDoctrine()->getManager();
            $entitymanager->persist($task);
            $entitymanager->flush();
        }
        //return new Response($form);
        $repository=$this->getDoctrine()->getRepository(Task::class);
        $tasks=$repository->findAll();
        $task=new Task();
        $form = $this->createForm(TaskType::class,$task);
        return $this->render('task/new.html.twig',['form'=>$form->createView(),'task'=>$tasks]);
    }
}