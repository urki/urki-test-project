<?php

namespace Vdc\Intranet\FeedbackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('FeedbackBundle:Default:index.html.twig', array('name' => $name));
    }
}
