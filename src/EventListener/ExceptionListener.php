<?php
namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        // You get the exception object from the received event
        $exception = $event->getException();
        $message = sprintf(
            'Une erreur est détecter: %s avec le code: %s',
            $exception->getMessage(),
            $exception->getCode()
        );

        // Customize your response object to display the exception details
        $response = new Response();
        $response->setContent($message);

        // HttpExceptionInterface is a special type of exception that
        // holds status code and header details
        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // sends the modified response object to the event
        $event->setResponse($response);

        //send emaill of exception to the administrator
        $transport = (new \Swift_SmtpTransport('127.0.0.1', 1025))
        ->setUsername('your username')
        ->setPassword('your password')
        ;
         $mailer = new \Swift_Mailer($transport);

        $mes = (new \Swift_Message('Firebase : Une exception detecté'))
         ->setFrom('firedevException@gmail.com')
         ->setTo('parfaitonana4@gmail.com')
         ->setBody($message);
 
         $mailer->send($mes);
    }
}