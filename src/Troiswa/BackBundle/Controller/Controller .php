<?php

namespace Troiswa\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    public function DashBoardAction()
    {
        return $this->render('TroiswaBackBundle:Default:main.html.twig');
    }


}