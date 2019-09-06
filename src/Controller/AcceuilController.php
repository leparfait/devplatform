<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AcceuilController extends AbstractController
{
    /**
     * @Route("/acceuil", name="acceuil")
     */
    public function index(Request $request): Response
    {
        return new Response('Hello World!');

        // return $this->render('acceuil/index.html.twig', [
        //     'controller_name' => 'AcceuilController',
        // ]);
    }
}
