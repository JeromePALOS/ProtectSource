<?php

namespace PS\FilesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PSFilesBundle:Default:index.html.twig');
    }
}
