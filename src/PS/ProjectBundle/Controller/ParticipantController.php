<?php

namespace PS\ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Finder\Exception\AccessDeniedException;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use PS\ProjectBundle\Entity\Participant;

use PS\ProjectBundle\Form\ParticipantType;
use PS\ProjectBundle\Form\ParticipantEditType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ParticipantController extends Controller
{

	
	public function addParticipantAction(Request $request, $keyproject, $idproject){
		$em = $this->getDoctrine()->getManager();
		$participant = new Participant();
		
		$project = $em->getRepository('PSProjectBundle:Project')->findOneBy(array('keyProject' => $keyproject, 'id' => $idproject));
		
		//permission
		$participant = $em->getRepository('PSProjectBundle:Participant')->findOneBy(array('user' => $this->getUser()->getId(), 'project' => $project));

		if($project->getUser()->getId() !== $this->getUser()->getId()){
			throw new AccessDeniedException('You don\'t have permission.');
		}
		
		$formBuilder = $this->createFormBuilder();

		$formBuilder->add('User', TextType::class, array('label'=> 'User'));
		$formBuilder->add('submit',SubmitType::class,array('label'=> 'Add'));
		
		$form = $formBuilder->getForm();
		
		
		
		
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			

			$participant->setProject($project);
			
			$data = $form->getData();
			if($user = $em->getRepository('PSUserBundle:User')->findOneByUsername($data['User'])){
				$participant->setUser($user);
			}else{
				$request->getSession()->getFlashBag()->add('notice', 'User unknow');
				return $this->redirectToRoute('ps_project_add_participant', array('keyproject' => $keyproject ));
			}
			

			
			
			
			$em->persist($participant);
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'Participant add');

			return $this->redirectToRoute('ps_project_view_project', array('keyproject' => $keyproject, 'idproject' => $idproject ));
		}

        return $this->render('@PSProject\Participant\addParticipant.html.twig', array(
			'form' => $form->createView(),
		));
    }
	
	

	
	
	public function deleteParticipantAction(Request $request, $idparticipant, $keyproject, $idproject){

		$em = $this->getDoctrine()->getManager();

		$participant = $em->getRepository('PSProjectBundle:Participant')->find($idparticipant);
		
		
		
		$project = $em->getRepository('PSProjectBundle:Project')->findOneBy(array('keyProject' => $keyproject, 'id' => $idproject));
		//permission
		$participant = $em->getRepository('PSProjectBundle:Participant')->findOneBy(array('user' => $this->getUser()->getId(), 'project' => $project));

		if($project->getUser()->getId() !== $this->getUser()->getId()){
			throw new AccessDeniedException('You don\'t have permission.');
		}
		
		
		
		$em->remove($participant);
		$em->flush();

		$request->getSession()->getFlashBag()->add('notice', "Participant delete");
			
		
		return $this->redirectToRoute('ps_project_view_project', array('keyproject' => $keyproject, 'idproject' => $idproject ));
	}
	
}
