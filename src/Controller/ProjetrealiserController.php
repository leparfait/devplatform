<?php

namespace App\Controller;

use App\Entity\Projetrealiser;
use App\Form\ProjetrealiserType;
use App\Repository\ProjetrealiserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/projetrealiser")
 */
class ProjetrealiserController extends AbstractController
{
    /**
     * @Route("/", name="projetrealiser_index", methods="GET")
     */
    public function index(ProjetrealiserRepository $projetrealiserRepository): Response
    {
        return $this->render('projetrealiser/index.html.twig', ['projetrealisers' => $projetrealiserRepository->findAll()]);
    }

    /**
     * @Route("/new", name="projetrealiser_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $projetrealiser = new Projetrealiser();
        $form = $this->createForm(ProjetrealiserType::class, $projetrealiser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($projetrealiser);
            $em->flush();

            return $this->redirectToRoute('projetrealiser_index');
        }

        return $this->render('projetrealiser/new.html.twig', [
            'projetrealiser' => $projetrealiser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="projetrealiser_show", methods="GET")
     */
    public function show(Projetrealiser $projetrealiser): Response
    {
        return $this->render('projetrealiser/show.html.twig', ['projetrealiser' => $projetrealiser]);
    }

    /**
     * @Route("/{id}/edit", name="projetrealiser_edit", methods="GET|POST")
     */
    public function edit(Request $request, Projetrealiser $projetrealiser): Response
    {
        $form = $this->createForm(ProjetrealiserType::class, $projetrealiser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('projetrealiser_index', ['id' => $projetrealiser->getId()]);
        }

        return $this->render('projetrealiser/edit.html.twig', [
            'projetrealiser' => $projetrealiser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="projetrealiser_delete", methods="DELETE")
     */
    public function delete(Request $request, Projetrealiser $projetrealiser): Response
    {
        if ($this->isCsrfTokenValid('delete'.$projetrealiser->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projetrealiser);
            $em->flush();
        }

        return $this->redirectToRoute('projetrealiser_index');
    }
}
