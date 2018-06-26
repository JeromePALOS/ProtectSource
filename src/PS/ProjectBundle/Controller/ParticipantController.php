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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ParticipantController extends Controller
{

	
	public function addParticipantAction(Request $request, $keyproject, $idproject){
		$em = $this->getDoctrine()->getManager();
		
		
		$project = $em->getRepository('PSProjectBundle:Project')->findOneBy(array('keyProject' => $keyproject, 'id' => $idproject));
		
        if (null === $project) {
		  throw new NotFoundHttpException("Project unknow");
		}
        
        
        
		//permission
		$participation = $em->getRepository('PSProjectBundle:Participant')->findOneBy(array('user' => $this->getUser()->getId(), 'project' => $project));

		if($project->getUser()->getId() !== $this->getUser()->getId() and ($participation === null or $project->getVisibility() == 0 or $participation->getPermissionParticipantAdd() == 0)){
			throw new AccessDeniedException('You don\'t have permission.');
		}
        
		
		
		
		$participant = new Participant();
		$form = $this->get('form.factory')->create(ParticipantType::class, $participant);
		
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			

				
				
			$participant->setProject($project);
			
			$data = $form->getData();
			$userX = $em->getRepository('PSUserBundle:User')->findOneByUsername($form->get("UserX")->getData());
			
			if($em->getRepository('PSProjectBundle:Participant')->findOneBy(array('user' => $userX, 'project' => $project) )){
				$request->getSession()->getFlashBag()->add('error', 'User already add');
				return $this->redirectToRoute('ps_project_add_participant', array('keyproject' => $keyproject, 'idproject' => $idproject ));
				
            }elseif($userX === $this->getUser()){  
				$request->getSession()->getFlashBag()->add('error', 'Impossible');
				return $this->redirectToRoute('ps_project_add_participant', array('keyproject' => $keyproject, 'idproject' => $idproject ));
				
			}elseif($userX !== null){
				$participant->setUser($userX);
				
			}else{
				$request->getSession()->getFlashBag()->add('error', 'User unknow');
				return $this->redirectToRoute('ps_project_add_participant', array('keyproject' => $keyproject, 'idproject' => $idproject ));
			}
			

			
			
			
			$em->persist($participant);
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'Participant add');

			return $this->redirectToRoute('ps_project_view_project', array('keyproject' => $keyproject, 'idproject' => $idproject ));
		}

        return $this->render('@PSProject\Participant\addParticipant.html.twig', array(
			'form' => $form->createView(),
            'project' => $project
		));
    }
	
	

	
	
	public function deleteParticipantAction(Request $request, $idparticipant, $keyproject, $idproject){

		$em = $this->getDoctrine()->getManager();

		$participant = $em->getRepository('PSProjectBundle:Participant')->find($idparticipant);
		
		
		
		$project = $em->getRepository('PSProjectBundle:Project')->findOneBy(array('keyProject' => $keyproject, 'id' => $idproject));
		//permission
		$participation = $em->getRepository('PSProjectBundle:Participant')->findOneBy(array('user' => $this->getUser()->getId(), 'project' => $project));

		if($project->getUser()->getId() !== $this->getUser()->getId() and ($participation === null or $project->getVisibility() == 0 or $participation->getPermissionParticipantDelete() == 0)){
			throw new AccessDeniedException('You don\'t have permission.');
		}
		
		
		
		$em->remove($participant);
		$em->flush();

		$request->getSession()->getFlashBag()->add('notice', "Participant delete");
			
		
		return $this->redirectToRoute('ps_project_view_project', array('keyproject' => $keyproject, 'idproject' => $idproject ));
	}
	
	
	
	public function viewParticipantAction($keyproject, $idproject){
		$em = $this->getDoctrine()->getManager();
		
		$project = $em->getRepository('PSProjectBundle:Project')->findOneBy(array('keyProject' => $keyproject, 'id' => $idproject));
		$user = $em->getRepository('PSUserBundle:User')->find($this->getUser()->getId());
		
		
		//permission
		$participation = $em->getRepository('PSProjectBundle:Participant')->findOneBy(array('user' => $this->getUser()->getId(), 'project' => $project));

		if($project->getUser()->getId() !== $this->getUser()->getId() and ($participation === null or $project->getVisibility() == 0) ){
			throw new AccessDeniedException('You don\'t have permission.');
		}
		
		$listParticipant = $em->getRepository('PSProjectBundle:Participant')->findByProject($project);
		
       
	   return $this->render('@PSProject\Participant\viewParticipant.html.twig', array(
			'project' => $project,
			'listParticipant' => $listParticipant,

		));
	}
			
	public function editParticipantAction($idproject, $keyproject, Request $request, $idparticipant){
		
		$em = $this->getDoctrine()->getManager();

		$project = $em->getRepository('PSProjectBundle:Project')->findOneBy(array('keyProject' => $keyproject, 'id' => $idproject));
				
		if (null === $project) {
		  throw new NotFoundHttpException("Project unknow");
		}
		
        
        $participant = $em->getRepository('PSProjectBundle:Participant')->findOneBy(array('id' => $idparticipant, 'project' => $project));
        
        
		//permission
		$participation = $em->getRepository('PSProjectBundle:Participant')->findOneBy(array('user' => $this->getUser()->getId(), 'project' => $project));

        if($project->getUser()->getId() !== $this->getUser()->getId() and ($participation === null or $project->getVisibility() == 0 or $participation->getPermissionParticipantPermission() == 0)){
			throw new AccessDeniedException('You don\'t have permission.');
		}
        
        //if same people
        if($participant->getUser() === $this->getUser()){
			throw new AccessDeniedException('You don\'t have permission.');
		}
        
        
        

		
		
		$form = $this->get('form.factory')->create(ParticipantEditType::class, $participant);
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {	
			
			
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'Participant update.');

			return $this->redirectToRoute('ps_project_view_project', array('idproject' => $idproject, 'keyproject' => $project->getKeyProject()));
		}

		return $this->render('@PSProject\Participant\editParticipant.html.twig', array(
			'project' => $project,
			'participant' => $participant,
			'form'   	=> $form->createView(),
		));
	
	}
    
  public function editParticipantAdminAction($idproject, $keyproject, Request $request, $idparticipant){
        if ($this->getUser()->hasRole('ROLE_USER')){
              $em = $this->getDoctrine()->getManager();

		      $project = $em->getRepository('PSProjectBundle:Project')->findOneBy(array('keyProject' => $keyproject, 'id' => $idproject));
                $participant = $em->getRepository('PSProjectBundle:Participant')->findOneBy(array('id' => $idparticipant, 'project' => $project));

            
            
            		
            $form = $this->get('form.factory')->create(ParticipantEditType::class, $participant);
            if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {	


                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Participant update.');

                return $this->redirectToRoute('ps_project_view_project_admin');
            }

            
            
            

            return $this->render('@PSProject\Participant\editParticipant.html.twig', array(
                'project' => $project,
                'participant' => $participant,
                'form'   	=> $form->createView(),
            ));
            
        }else{
			throw new AccessDeniedException('You don\'t have permission.');
		}

	}
	
}
