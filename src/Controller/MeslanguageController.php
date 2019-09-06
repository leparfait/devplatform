<?php

namespace App\Controller;

use App\Entity\Meslanguage;
use App\Form\MeslanguageType;
use App\Repository\MeslanguageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/meslanguage")
 */
class MeslanguageController extends AbstractController
{
    /**
     * @Route("/", name="meslanguage_index", methods="GET")
     */
    public function index(MeslanguageRepository $meslanguageRepository): Response
    {
        return $this->render('meslanguage/index.html.twig', ['meslanguages' => $meslanguageRepository->findAll()]);
    }

    /**
     * @Route("/new", name="meslanguage_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $meslanguage = new Meslanguage();
        $form = $this->createForm(MeslanguageType::class, $meslanguage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($meslanguage);
            $em->flush();

            return $this->redirectToRoute('meslanguage_index');
        }

        return $this->render('meslanguage/new.html.twig', [
            'meslanguage' => $meslanguage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="meslanguage_show", methods="GET")
     */
    public function show(Meslanguage $meslanguage): Response
    {
        return $this->render('meslanguage/show.html.twig', ['meslanguage' => $meslanguage]);
    }

    /**
     * @Route("/{id}/edit", name="meslanguage_edit", methods="GET|POST")
     */
    public function edit(Request $request, Meslanguage $meslanguage): Response
    {
        $form = $this->createForm(MeslanguageType::class, $meslanguage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('meslanguage_index', ['id' => $meslanguage->getId()]);
        }

        return $this->render('meslanguage/edit.html.twig', [
            'meslanguage' => $meslanguage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="meslanguage_delete", methods="DELETE")
     */
    public function delete(Request $request, Meslanguage $meslanguage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$meslanguage->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($meslanguage);
            $em->flush();
        }

        return $this->redirectToRoute('meslanguage_index');
    }
}
