<?php
namespace App\EventListener;

class ProfilConsultListener
{
    public function onAlertProfilView($event)
    {
        $user = $event->getUser();
        $visiteur = $event->getVisiteur();
        $date = new \Datetime();

        if($visiteur !== "anon."){

            $mes = (new \Swift_Message('Nouvelle consultation'))
            ->setFrom('Notification@firedev.com')
            ->setTo($user->getEmail())
            ->setBody("l'utilisateur ".$visiteur." consulte votre profil en ce moment");
    
       }else{
            $mes = (new \Swift_Message('Nouvelle consultation'))
            ->setFrom('Notification@firedev.com')
            ->setTo($user->getEmail())
            ->setBody("Un visiteur consulte votre profil en ce moment ");
        } 
       
         //send emaill of exception to the administrator
         $transport = (new \Swift_SmtpTransport('127.0.0.1', 1025))
         ->setUsername('your username')
         ->setPassword('your password') ;
         $mailer = new \Swift_Mailer($transport);

         $mailer->send($mes);

    }
} 
