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
		$user = $em->getRepository('PSUserBundle:User')->find($this->getUser()->getId());
		
		
		$listParticipant = $em->getRepository('PSProjectBundle:Participant')->findByProject($project);
		$listArticle = $em->getRepository('PSProjectBundle:Article')->findBy(array('project' => $project, 'user' => $user ));
		
		$listInformationAccept = $em->getRepository('PSProjectBundle:Information')->findBy(array('keyProject' => $project->getKeyProject(), 'statut' => "Validate"));
		$listInformationSubmit = $em->getRepository('PSProjectBundle:Information')->findBy(array('keyProject' => $keyproject, 'statut' => "Wait"));
       
	   return $this->render('@PSProject\Project\viewProject.html.twig', array(
			'listInformationAccept' => $listInformationAccept,
			'listInformationSubmit' => $listInformationSubmit,
			'project' => $project,
			'listParticipant' => $listParticipant,
			'listArticle' => $listArticle,
		));
	}
	

	
	//edit
	
	
	//delete
	
		
	public function editProjectAction($idproject, $keyproject, Request $request){
		
		$em = $this->getDoctrine()->getManager();

		$project = $em->getRepository('PSProjectBundle:Project')->findOneBy(array('keyProject' => $keyproject, 'id' => $idproject));
		$listInformation = $em->getRepository('PSProjectBundle:Information')->findBy(array('keyProject' => $keyproject));
		
		if (null === $project) {
		  throw new NotFoundHttpException("Project unknow");
		}

		
		$form = $this->get('form.factory')->create(ProjectEditType::class, $project);
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			
			$data = $form->getData();

			foreach($listInformation as $info){
				$info->setKeyProject($data->getKeyProject());
		
			}
			
			
			
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'Project update.');

			return $this->redirectToRoute('ps_project_view_project', array('idproject' => $idproject, 'keyproject' => $project->getKeyProject()));
		}

		return $this->render('@PSProject\Project\editProject.html.twig', array(
			'project' => $project,
			'form'   	=> $form->createView(),
		));
	
	}
	
	
			
	public function deleteProjectAction(Request $request, $idproject, $keyproject){
		$em = $this->getDoctrine()->getManager();

		$project = $em->getRepository('PSProjectBundle:Project')->findOneBy(array('keyProject' => $keyproject, 'id' => $idproject));
	
		$form = $this->get('form.factory')->create();

		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
		  
			$em->remove($project);
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'Project delete.');

			return $this->redirectToRoute('ps_project_homepage');
		}
		
		return $this->render('@PSProject\Project\deleteProject.html.twig', array(
			'project' => $project,
			'form'   => $form->createView(),
		));
	}

	
	
	
	
	
	
	
	
	
	
}
