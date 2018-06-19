<?php

namespace PS\ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Finder\Exception\AccessDeniedException;

use PS\ProjectBundle\Entity\Article;

use PS\ProjectBundle\Form\ArticleType;
use PS\ProjectBundle\Form\ArticleEditType;

class ArticleController extends Controller
{
	
	
	public function addArticleAction(Request $request, $idproject){
		$em = $this->getDoctrine()->getManager();
		$article = new Article();

		
		$form = $this->get('form.factory')->create(ArticleType::class, $article);
		
		
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
			
			$user = $em->getRepository('PSUserBundle:User')->findOneById($this->getUser()->getId());
			$project = $em->getRepository('PSProjectBundle:Project')->find($idproject);
			
			$article->setProject($project);
			$article->setUser($user);
			
			$em->persist($article);
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'Article created.');

			return $this->redirectToRoute('ps_project_edit_article', array('keyproject' => $project->getKeyProject(), 'idproject' => $project->getId(), 'idarticle' => $article->getId() ));
		}

        return $this->render('@PSProject\Article\addArticle.html.twig', array(
			'form' => $form->createView(),
		));
    }
	
	
	
	
	public function editArticleAction(Request $request, $keyproject, $idproject, $idarticle){
		$em = $this->getDoctrine()->getManager();
		
		$project = $em->getRepository('PSProjectBundle:Project')->findOneBy(array('keyProject' => $keyproject, 'id' => $idproject));
		$user = $em->getRepository('PSProjectBundle:Participant')->find($this->getUser()->getId());
		
		$listInformation = $em->getRepository('PSProjectBundle:Information')->findBy(array('project' => $project, 'statut' => 'Validate'));
		$article = $em->getRepository('PSProjectBundle:Article')->find($idarticle);
		
		$form = $this->get('form.factory')->create(ArticleEditType::class, $article);
		
		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
		  $em->flush();
		  $request->getSession()->getFlashBag()->add('notice', 'Article save.');

		}
		
		
		
        return $this->render('@PSProject\Article\editArticle.html.twig', array(
			'form'   	=> $form->createView(),
			'article' 	=> $article,
			'project' 	=> $project,
			'listInformation' => $listInformation,
		));
	}
	

	

	public function deleteArticleAction(Request $request, $keyproject, $idproject, $idarticle){
		$em = $this->getDoctrine()->getManager();

		$article = $em->getRepository('PSProjectBundle:Article')->find($idarticle);
		

		
		if (null === $article) {
			throw new NotFoundHttpException("Article unknow");
		}
		$form = $this->get('form.factory')->create();

		if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
		  
			$em->remove($article);
			$em->flush();

			$request->getSession()->getFlashBag()->add('notice', 'Article delete.');

			return $this->redirectToRoute('ps_project_view_project', array('keyproject' => $article->getProject()->getKeyProject(), 'idproject' => $article->getProject()->getId() ));
		}
		
		return $this->render('@PSProject\Article\deleteArticle.html.twig', array(
			'article' => $article,
			'form'   => $form->createView(),
		));
	}
	
	
	
	
	
	
	
	
}
