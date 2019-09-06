<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LangprogController extends AbstractController
{
    /**
     * @Route("/langprog", name="langprog")
     */
    public function index()
    {
        return $this->render('langprog/index.html.twig', [
            'controller_name' => 'LangprogController',
        ]);
        
    }
}
