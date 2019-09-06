<?php

namespace App\Events;

use App\Entity\User;
use Symfony\Component\EventDispatcher\Event;

class AlertProfilView extends Event
{
  const NAME = "alert.profil_view";
  
  private $user;
  private $visiteur;

  public function __construct(User $user, $visiteur = null)
  {
      $this->user = $user;
      $this->visiteur = $visiteur;
  }

  public function getUser()
  {
      return $this->user;
  }

  public function getVisiteur()
  {
      return $this->visiteur;
  }


}