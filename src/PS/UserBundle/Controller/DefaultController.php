<?php

namespace PS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PSUserBundle:Default:index.html.twig');
    }
    
    
    
    public function listUserAction(){
        if ($this->getUser()->hasRole('ROLE_USER')){
            $em = $this->getDoctrine()->getManager();



            $listUser = $em->getRepository('PSUserBundle:User')->findAll();



            return $this->render('@PSUser\Default\viewUser.html.twig', array(
                'listUser' => $listUser,
            ));
        }else{
			throw new AccessDeniedException('You don\'t have permission.');
		}
	}
    
}
