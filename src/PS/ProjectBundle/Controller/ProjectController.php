<?php

namespace PS\ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Finder\Exception\AccessDeniedException;

use PS\ProjectBundle\Entity\Project;

use PS\ProjectBundle\Form\ProjectType;
use PS\ProjectBundle\Form\ProjectEditType;

class ProjectController extends Controller
{
    public function viewListProjectAction(){
		$em = $this->getDoctrine()->getManager();
		
		
		
		$listproject = $em->getRepository('PSProjectBundle:Project')->findByUser($this->getUser()->getId());
		
		
		
		
		
		
		
		
		
		
        return $this->render('@PSProject\Project\viewListProject.html.twig', array(
			'listproject' => $listproject,
		));
    }
	
	
	
	
	
	public function addProjectAction(Request $request){
		$em = $this->getDoctrine()->getManager();
		$project = new Project();

		
		$form = $this->get('form.factory')->create(ProjectType::class, $project);
		
		
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			
			$user = $em->getRepository('PSUserBundle:User')->findOneById($this->getUser()->getId());
			$project->setUser($user);
			
			
			$em->persist($project);
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'Project created.');

			return $this->redirectToRoute('ps_project_view_project', array('keyproject' => $project->getKeyProject(), 'idproject' => $project->getId() ));
		}

        return $this->render('@PSProject\Project\addProject.html.twig', array(
			'form' => $form->createView(),
		));
    }
	
	
	
	
	public function viewProjectAction($keyproject, $idproject){
		$em = $this->getDoctrine()->getManager();
		
		$project = $em->getRepository('PSProjectBundle:Project')->findOneBy(array('keyProject' => $keyproject, 'id' => $idproject));
		
		$listParticipant = $em->getRepository('PSProjectBundle:Participant')->findByProject($project);
		
		
        return $this->render('@PSProject\Project\viewProject.html.twig', array(
			'project' => $project,
			'listParticipant' => $listParticipant,
		));
	}
	

	
	//edit
	
	
	//delete
	
	
	
	
	
	
	
	
}
