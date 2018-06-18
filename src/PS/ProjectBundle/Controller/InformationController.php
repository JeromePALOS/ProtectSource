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

		$form = $this->get('form.factory')->create(InformationType::class, $information);
		
		
		if ($request->isMethod('POST')) {
			if ($form->handleRequest($request)->isValid()){
			
				$project = $em->getRepository('PSProjectBundle:Project')->findOneBy(array('keyProject' => $keyproject, 'id' => $idproject));
				$information->setProject($project);
				
				$em->persist($information);
				$em->flush();

				$request->getSession()->getFlashBag()->add('notice', 'Information added');

				return $this->redirectToRoute('ps_project_view_project', array('keyproject' => $keyproject, 'idproject' => $idproject ));
				
			}else{
				$validator = $this->get('validator');
				$listErrors = $validator->validate($submit);

				// Si $listErrors n'est pas vide, on affiche les erreurs
				if(count($listErrors) > 0) {
					$request->getSession()->getFlashBag()->add('notice', (string) $listErrors);
				  // $listErrors est un objet, sa méthode __toString permet de lister joliement les erreurs
				 
				}
			}
				
				
		}

        return $this->render('@PSProject\Information\addInformation.html.twig', array(
			'form' => $form->createView(),
		));
    }
	

	
	
	
	
	
	
	
}
