<?php

namespace PS\ProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Finder\Exception\AccessDeniedException;


class ContactController extends Controller
{
    public function viewContactAction(){
		$em = $this->getDoctrine()->getManager();

		
        return $this->render('@PSProject\Contact\viewContact.html.twig', array(

		));
    }

}
