<?php

namespace PS\ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Finder\Exception\AccessDeniedException;

use PS\ProjectBundle\Entity\Project;

class ProjectController extends Controller
{
    public function viewListProjectAction()
    {
		$em = $this->getDoctrine()->getManager();
		
		
		
		$listproject = $em->getRepository('PSProjectBundle:Project')->findByUser($this->getUser()->getId());
		
		
		
		
		
		
		
		
		
		
        return $this->render('@PSProject\Project\viewListProject.html.twig', array(
			'listproject' => $listproject,
		));
    }
	
	
	
	
	
	public function addProjectAction(Request $request)
    {
		$em = $this->getDoctrine()->getManager();
		$project = new Project();
		
		$form = $this->get('form.factory')->create(ProjectType::class, $project);
		
		
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			$em = $this->getDoctrine()->getManager();
			
			$projet->setUser($this->getUser());
			
			
			$em->persist($project);
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'Project created.');

			return $this->redirectToRoute('ps_project_view_projet', array('id' => $project->getId() ));
		}

        return $this->render('@PSProject\Project\viewListProject.html.twig', array(
			'form' => $form->createView(),
		));
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
}
