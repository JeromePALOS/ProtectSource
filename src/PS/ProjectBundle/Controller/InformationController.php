<?php

namespace PS\ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Finder\Exception\AccessDeniedException;

use PS\ProjectBundle\Entity\Information;

use PS\ProjectBundle\Form\InformationType;


class InformationController extends Controller
{
	
	public function addInformationAction(Request $request, $keyproject, $idproject){
		$em = $this->getDoctrine()->getManager();
		$information = new Information();

        $project = $em->getRepository('PSProjectBundle:Project')->findOneBy(array('keyProject' => $keyproject, 'id' => $idproject));
        
		$form = $this->get('form.factory')->create(InformationType::class, $information);
		
		
		if ($request->isMethod('POST')) {
			if ($form->handleRequest($request)->isValid()){
			
				$project = $em->getRepository('PSProjectBundle:Project')->findOneBy(array('keyProject' => $keyproject, 'id' => $idproject));
				$information->setKeyProject($keyproject);
				
				$em->persist($information);
				$em->flush();

				$request->getSession()->getFlashBag()->add('notice', 'Information added');

				return $this->redirectToRoute('ps_project_view_project', array('keyproject' => $keyproject, 'idproject' => $idproject ));
				
			}else{
				$validator = $this->get('validator');
				$listErrors = $validator->validate($information);

				// Si $listErrors n'est pas vide, on affiche les erreurs
				if(count($listErrors) > 0) {
					$request->getSession()->getFlashBag()->add('notice', (string) $listErrors);
				  // $listErrors est un objet, sa méthode __toString permet de lister joliement les erreurs
				 
				}
			}
				
				 
		}

        return $this->render('@PSProject\Information\addInformation.html.twig', array(
			'form' => $form->createView(),
            'project' =>$project,
		));
    }
	
	
	public function statutInformationAction(Request $request, $keyproject, $idproject, $idinformation, $statut){
		$em = $this->getDoctrine()->getManager();
		$information = $em->getRepository('PSProjectBundle:Information')->find($idinformation);
		
		
		
		$project = $em->getRepository('PSProjectBundle:Project')->findOneBy(array('keyProject' => $keyproject, 'id' => $idproject));
		//permission
		$participation = $em->getRepository('PSProjectBundle:Participant')->findOneBy(array('user' => $this->getUser()->getId(), 'project' => $project));

		if($project->getUser()->getId() !== $this->getUser()->getId() and ($participation === null or $project->getVisibility() == 0)){
			throw new AccessDeniedException('You don\'t have permission.');
		}
		
		
		
		if($statut != "Validate" and $statut != "Refuse"){
			throw new AccessDeniedException('Error status.');
		}
		if($information === null){
			throw new AccessDeniedException('Information unknow');
		}
		
        if(($participation->getPermissionParticipantAdd() == 0 and $statut == "Validate") or ($participation->getPermissionParticipantDelete() == 0 and $statut == "Refuse")){
            throw new AccessDeniedException('You don\'t have permission.');
        }
        
        
		
		$information->setStatut($statut);
		
		$em->persist($information);
		$em->flush();
		
		$request->getSession()->getFlashBag()->add('notice', 'Information update');
		return $this->redirectToRoute('ps_project_view_project', array('keyproject' => $keyproject, 'idproject' => $idproject ));
	}

	
	
	
	
	
	
	
	
}
