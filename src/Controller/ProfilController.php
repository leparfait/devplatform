<?php

namespace App\Controller;

use App\Entity\Profil;
use App\Entity\Projet;
use App\Entity\Contact;
use App\Entity\Diplome;
use App\Form\ProfilType;
use App\Form\ProjetType;
use App\Form\ContactType;
use App\Form\DiplomeType;
use App\Entity\Experience;
use App\Entity\Meslanguage;
use App\Form\ExperienceType;
use Spipu\Html2Pdf\Html2Pdf;
use App\Form\MeslanguageType;
use App\Entity\Projetrealiser;
use App\Events\AlertProfilView;
use App\Form\ProjetrealiserType;
use App\Repository\ProfilRepository;
use App\Notification\ContactNotification;
use App\Repository\MeslanguageRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ProfilController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request,ProfilRepository $profilRepository): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

       if($form->isSubmitted() && $form->isValid()){
         // send mail
         //$notification->notify($contact) ContactNotification $notification;
     
         $this->addFlash('success','votre message a bien été envoyé ne vous repondrons le plus tot possible'); 
         //return $this->redirectToRoute('profil_show');
      }
        return $this->render('base.html.twig', [
            'profils' => $profilRepository->findAll(),
            'formContact' => $form->createView()
        ]);
    }

    /**
     * @Route("/profil", name="profil")
     */
    public function profilshowmany(ProfilRepository $profilRepository): Response
    {
        return $this->render('profil/show.html.twig', [
            'profils' => $profilRepository->findAll()]);
    }

    /**
     * Voir le profil d'un dévéloppeur
     * @Route("/profil/view/{id}", name="view_profil")
     */
    public function viewProfil(\Swift_Mailer $mailer,MeslanguageRepository $meslanguages,
                               ContactNotification $notification, Profil $profil ,Request $request ,
                               ObjectManager $manager, EventDispatcherInterface $eventDispatcher,
                               TokenStorageInterface $tokenStorage) : Response
     {   
        //get language by user
        $languages = $meslanguages->findByUser($profil);
        
        //alerter l'utilisateur que son pofil est consulter
        // $event = new AlertProfilView($profil->getUserId(),$tokenStorage->getToken()->getUser());
        // $eventDispatcher->dispatch(AlertProfilView::NAME,$event);

        // $formContact = App\Controller\supportEmail();
        $contact = new Contact();
        $formContact = $this->createForm(ContactType::class, $contact);
        $formContact->handleRequest($request);

       if($formContact->isSubmitted() && $formContact->isValid()){
         // send mail
        // $notification->notify($contact);
         $message = (new \Swift_Message('Hello Email'))
         ->setFrom($contact->getEmail())
         ->setTo('parfaitonana4@gmail.com')
         ->setBody($contact->getMessage());
 
         $mailer->send($message);
         $this->addFlash('success','votre message a bien été envoyé');

        //  $formContact = $form->createView();
        //  return $formContact;
      }

        return $this->render('profil/view.html.twig', [
                        'profil' => $profil,
                        'languages' => $languages,
                        'formContact' => $formContact->createView(),
                ]);
    }



    // consulter son propre profil
    /**
     * @Route("/profil/show/{id}", name="show_profil")
     */
    public function showProfil($id,TokenStorageInterface $tokenStorage, Request $request) : Response
    {
        $profil = $this ->getDoctrine()
                        ->getRepository(Profil::class)
                        ->findByUser($id);
        // check if the show profil is for the current user
        if($profil){
            if ($profil->getUserId() !== $tokenStorage->getToken()->getUser()) {
              return $this->render('error/erreur.html.twig', [
                                'message' => 'Erreur : Url inaccessible'
                            ]);
           } 
        }
       

        //language form
        $meslanguage = new Meslanguage();
        $formlang = $this->createForm(MeslanguageType::class, $meslanguage);
        $formlang->handleRequest($request);

        if ($formlang->isSubmitted() && $formlang->isValid()) {
            $meslanguage->setUtilisateur($profil);
            $em = $this->getDoctrine()->getManager();
            $em->persist($meslanguage);
            $em->flush();

            return $this->redirectToRoute('show_profil',['id'=>$id]);
        }

        // diplome form
        $diplome = new Diplome();
        $formDiplome = $this->createForm(DiplomeType::class, $diplome);
        $formDiplome->handleRequest($request);

        if ($formDiplome->isSubmitted() && $formDiplome->isValid()) {
            $diplome->setUtilisateur($profil);
            $em = $this->getDoctrine()->getManager();
            $em->persist($diplome);
            $em->flush();

            return $this->redirectToRoute('show_profil',['id'=>$id]);
        }
        
        // experience form
        $experience = new Experience();
        $formExperience = $this->createForm(ExperienceType::class, $experience);
        $formExperience->handleRequest($request);

        if ($formExperience->isSubmitted() && $formExperience->isValid()) {
            $experience->setCreatedAt(new \DateTime);
            $experience->setUtilisateur($profil);
            $em = $this->getDoctrine()->getManager();
            $em->persist($experience);
            $em->flush();

            return $this->redirectToRoute('show_profil',['id'=>$id]);
        }

        // projet realiser form
        $projetrealiser = new Projetrealiser();
        $formProjet = $this->createForm(ProjetrealiserType::class, $projetrealiser);
        $formProjet->handleRequest($request);

        if ($formProjet->isSubmitted() && $formProjet->isValid()) {
            $projetrealiser->setUtilisateur($profil);
            $em = $this->getDoctrine()->getManager();
            $em->persist($projetrealiser);
            $em->flush();

            return $this->redirectToRoute('show_profil',['id'=>$id]);
        }

         //projet form
         $projet = new Projet();
         $formp = $this->createForm(ProjetType::class, $projet);
         $formp->handleRequest($request);
 
         if ($formp->isSubmitted() && $formp->isValid()) {
             $projet->setIntiateur($profil);
             $em = $this->getDoctrine()->getManager();
             $em->persist($projet);
             $em->flush();
 
             return $this->redirectToRoute('show_profil',['id'=>$id]);
         }

      return $this->render('profil/show.html.twig',[
                           'profil'=>$profil,
                           'experience' => $experience,
                           'formExperience' => $formExperience->createView(),
                           'formProjetrealiser' => $formProjet->createView(),
                           'formDiplome' => $formDiplome->createView(),
                           'formLang'  => $formlang->createView(),
                           'formProjet'  => $formp->createView(),
                          ]);
    }

    /**
     * @Route("/profil/new", name="profil_create")
     * @Route("/profil/{id}/edit", name="profil_edit")
     */
    public function profilForm(TokenStorageInterface $tokenStorage ,Profil $profil = null , Request $request , ObjectManager $manager )
    {
       if(!$profil){
            $profil = new Profil();
            // \var_dump($tokenStorage->getToken()->getUser()->getId());
            $user = $tokenStorage->getToken()->getUser();
            $profil->setUserId($user);
            $profil->setCreatedAt(new \DateTime());
       }

       // check if the show profil is for the current user
       if ($profil->getUserId() !== $tokenStorage->getToken()->getUser()) {
            return $this->render('error/erreur.html.twig', [
                                'message' => 'Erruer : adresse inaccessible'
                                ]);
       }

        $form = $this->createForm(ProfilType::class, $profil);
        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $manager->persist($profil);
                $manager->flush();

                return $this->redirectToRoute('show_profil',[
                    'id' => $tokenStorage->getToken()->getUser()->getId(),
                ]);
            }

      return $this->render('profil/create.html.twig',[
            'formProfil' => $form->createView() ,
            'editMode' => $profil->getId() !== null
        ]);
    }

    /**
     * @Route("/profil/{id}", name="profil_show")
     */
    // public function profilShow(Profil $profil ,Request $request , ObjectManager $manager,ContactNotification $notification): Response
    // {
    //    $contact = new Contact();
    //    $contact->setUtilisateur($profil);
    //    $form = $this->createForm(ContactType::class, $contact);
    //    $form->handleRequest($request);

    //    if($form->isSubmitted() && $form->isValid()){
    //      // send mail
    //      $notification->notify($contact);
    //      $mailer->send($message);
     
    //      $this->addFlash('success','votre message a bien été envoyé'); 
    //      //return $this->redirectToRoute('profil_show');
    //   }
    //     return $this->render('profil/view.html.twig', [
    //                          'profil' => $profil,
    //                          'formContact' => $form->createView()
    //                         ]);
    // }

    /**
     * @Route("/profil/{id}/cv_pdf", name="cv_pdf")
     */
    public function impressionCV(Profil $profil)
    {
        $template = $this->renderView('profil/cv.html.twig', [
            'profil' => $profil,
          ]);
     
        $html2pdf = new Html2Pdf('P', 'A4', 'fr');
        $html2pdf->writeHTML($template);
        $nomFichier = $profil->getNom();
        return $html2pdf->output($nomFichier.'_cv.pdf','D');

        // $download = new Download();
        // $reponse = $download->download($filename,$path);
    }
}
