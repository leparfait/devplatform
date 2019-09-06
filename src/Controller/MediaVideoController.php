<?php

namespace App\Controller;

use App\Entity\MediaVideo;
use App\Form\MediaVideoType;
use App\Repository\MediaVideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/media/video")
 */
class MediaVideoController extends AbstractController
{
    /**
     * @Route("/", name="media_video_index", methods="GET")
     */
    public function index(MediaVideoRepository $mediaVideoRepository): Response
    {
        return $this->render('media_video/index.html.twig', ['media_videos' => $mediaVideoRepository->findAll()]);
    }

    /**
     * @Route("/new", name="media_video_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $mediaVideo = new MediaVideo();
        $mediaVideo->setDate(new \DateTime());
        $form = $this->createForm(MediaVideoType::class, $mediaVideo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mediaVideo);
            $em->flush();

            return $this->redirectToRoute('media_video_index');
        }

        return $this->render('media_video/new.html.twig', [
            'media_video' => $mediaVideo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="media_video_show", methods="GET")
     */
    public function show(MediaVideo $mediaVideo): Response
    {
        return $this->render('media_video/show.html.twig', ['media_video' => $mediaVideo]);
    }

    /**
     * @Route("/{id}/edit", name="media_video_edit", methods="GET|POST")
     */
    public function edit(Request $request, MediaVideo $mediaVideo): Response
    {
        $form = $this->createForm(MediaVideoType::class, $mediaVideo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('media_video_index', ['id' => $mediaVideo->getId()]);
        }

        return $this->render('media_video/edit.html.twig', [
            'media_video' => $mediaVideo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="media_video_delete", methods="DELETE")
     */
    public function delete(Request $request, MediaVideo $mediaVideo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mediaVideo->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($mediaVideo);
            $em->flush();
        }

        return $this->redirectToRoute('media_video_index');
    }
}
