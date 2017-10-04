<?php

namespace NovaTrainingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NovaTrainingBundle:Default:index.html.twig');
    }
}
