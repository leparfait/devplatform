<?php

namespace App\Controller\Admin;

use App\Entity\Annonce;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnnonceController extends AbstractController
{
    /**
     * @Route("/annonce", name="annonce")
     */
    public function index()
    {
        return $this->render('annonce/index.html.twig', [
            'controller_name' => 'Listes des annonces',
        ]);
    }

    /**
     * @Route("/annonce/create",name="annonce_create")
     * @Route("/annonce/{id}/edit", name="annonce_edit")
     */
    public function create(Annonce $annonce = null, Request $request , ObjectManager $em){

      if(!$annonce){
          $annonce = new Annonce();
      }

      $form = $this.createForm(AnnonceType::class,$annonce);

      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){
        $em->persist($annonce);
        $em->flush();

        return $this->redirectToRoute('annonce_create');
      }

    return $this->render('admin/annonce/create.html.twig',[
        'formAnnoce' => $form->createView() ,
        'editMode' => $annonce->getId() !== null
    ]);
 }
 
}
