<?php
namespace App\Services;

use Symfony\Component\HttpFoundation\Response;

class Download
{
    public function download(string $filename , string $path = null)
    {
    $response = new Response();
    $response->setContent(file_get_contents($path.$filename));
    $response->headers->set('Content-Type', 'application/force-download'); // modification du content-type pour forcer le téléchargement (sinon le navigateur internet essaie d'afficher le document)
    $response->headers->set('Content-disposition', 'filename='. $filename);
            
    return $response;
    }
}