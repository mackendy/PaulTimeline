<?php

namespace Paul\TimelineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PaulTimelineBundle:Default:list.html.twig', array('name' => $name));
    }
}
