<?php

namespace App\Controller;

use App\Entity\Department;
use App\Form\DepartmentType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepartmentController extends AbstractController
{

    
    #[Route('/department/new' , name:'app_department_new')]
    public function newAction(Request $request): Response
    {
        $department=new Department();
        $form=$this->createForm(DepartmentType::class,$department);
        return  $this->renderForm('department/new.html.twig',[
            'departmentForm'=>$form,
        ]);
    }
}
