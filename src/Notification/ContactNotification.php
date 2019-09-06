<?php

namespace App\Notification;

use App\Entity\Contact;

Class ContactNotification
{
    /**
     * @var \Swift_Mailer 
     */
    private $mailer;

    // /**
    //  * @var Environment
    //  */
    // private $renderer;

   public function __construct(\Swift_Mailer $mailer /*,Environment $renderer*/)
   {
      $this->mailer = $mailer;
    //   $this->renderer = $renderer;
   }

   public function notify(Contact $contact)
   {
    //$mailer = new \Swift_Mailer(); 
    $message = (new \Swift_Message('Hello Email'))
                ->setFrom('noreply@firedev.com')
                ->setTo($contact->getEmail())
                ->setBody($contact->getMessage());
    //     $this->render('emails/contact.html.twig',
    //         ['contact' => $contact]
    //     ),
    //     'text/html'
    // );

    $mailer->send($message);

//     $message = (new \Swift_Message('Hello Email'))
//     ->setFrom('noreply@firedev.com')
//     ->setTo('support@firedev.com')
//     ->setReplyTo($contact->getEmail())
//     ->setBody(
//         $this->renderer->render(
//             // templates/emails/registration.html.twig
//             'emails/contact.html.twig',
//             ['contact' => $contact]
//         ),
//         'text/html'
//     )  ;

//     $this->mailer->send($message);

//    }
 }
} 
