<?php

namespace App\Controller;

use App\Entity\Document;
use App\Form\DocumentType;
use App\Services\Download;
use App\Repository\DocumentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/document")
 */
class DocumentController extends AbstractController
{
    /**
     * @Route("/", name="document_index", methods="GET")
     */
    public function index(DocumentRepository $documentRepository): Response
    {
        return $this->render('document/index.html.twig', ['documents' => $documentRepository->findAll()]);
    }

    /**
     * @Route("/new", name="document_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $document = new Document();
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();

            return $this->redirectToRoute('document_index');
        }

        return $this->render('document/new.html.twig', [
            'document' => $document,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="document_show", methods="GET")
     */
    public function show(Document $document): Response
    {
        return $this->render('document/show.html.twig', ['document' => $document]);
    }

    /**
     * @Route("/{id}/edit", name="document_edit", methods="GET|POST")
     */
    public function edit(Request $request, Document $document): Response
    {
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('document_index', ['id' => $document->getId()]);
        }

        return $this->render('document/edit.html.twig', [
            'document' => $document,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="document_delete", methods="DELETE")
     */
    public function delete(Request $request, Document $document): Response
    {
        if ($this->isCsrfTokenValid('delete'.$document->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($document);
            $em->flush();
        }

        return $this->redirectToRoute('document_index');
    }

     /**
     * @Route("/downloadfile/{id}", name="document_download")
     */
    public function download($id): Response
    {
        $path = 'document/';
        $file = $this->getDoctrine()
                     ->getRepository(Document::class)
                     ->find($id);
        $filename = $file->getNom();

        $download = new Download();
        $reponse = $download->download($filename,$path);
        // $response = new Response();
        // $response->setContent(file_get_contents($path.$filename));
        // $response->headers->set('Content-Type', 'application/force-download'); // modification du content-type pour forcer le téléchargement (sinon le navigateur internet essaie d'afficher le document)
        // $response->headers->set('Content-disposition', 'filename='. $filename);
         
         return $reponse;
        // dump($path.'/'.$filename);
        // die();

        // return $this->redirectToRoute('document_index');
    }
}
