<?php

namespace App\Controller;

use App\Entity\Profil;
use App\Entity\Experience;
use App\Form\ExperienceType;
use App\Repository\ExperienceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/experience")
 */
class ExperienceController extends AbstractController
{
    /**
     * @Route("/", name="experience_index", methods="GET")
     */
    public function index(ExperienceRepository $experienceRepository): Response
    {
        return $this->render('experience/index.html.twig', ['experiences' => $experienceRepository->findAll()]);
    }

    /**
     * @Route("/{id}/new", name="experience_new", methods="GET|POST")
     */
    public function new(Profil $profil, Request $request): Response
    {
        $experience = new Experience();
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $experience->setCreatedAt(new \Date);
            $experience->setUtilisateur($profil);
            $em = $this->getDoctrine()->getManager();
            $em->persist($experience);
            $em->flush();

            return $this->redirectToRoute('show_profil');
        }

        return $this->render('profil/show.html.twig', [
            'experience' => $experience,
            'formExperience' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="experience_show", methods="GET")
     */
    public function show(Experience $experience): Response
    {
        return $this->render('experience/show.html.twig', ['experience' => $experience]);
    }

    /**
     * @Route("/{id}/edit", name="experience_edit", methods="GET|POST")
     */
    public function edit(Request $request, Experience $experience): Response
    {
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('experience_index', ['id' => $experience->getId()]);
        }

        return $this->render('experience/edit.html.twig', [
            'experience' => $experience,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="experience_delete", methods="DELETE")
     */
    public function delete(Request $request, Experience $experience): Response
    {
        if ($this->isCsrfTokenValid('delete'.$experience->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($experience);
            $em->flush();
        }

        return $this->redirectToRoute('experience_index');
    }
}
