<?php

namespace App\Controller;
use App\Entity\Member;
use App\Entity\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;

class AppController extends AbstractController
{

    public function __construct(EntityManagerInterface $entityManager){
      $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('app/index.html.twig', [
        ]);
    }

    /**
     * @Route("/logoutRedirect", name="logoutRedirect")
     */
    public function logout()
    {
        return $this->render('app/index.html.twig', [
        ]);
    }

    /**
     * @Route("/signup", name="signUp")
     */
    public function signUp(UserPasswordEncoderInterface $encoder, Request $request){
      $status = false;
      $member =  new Member();

      $form = $this->createFormBuilder($member)
        ->add('username', TextType::class)
        ->add('firstname', TextType::class)
        ->add('lastname', TextType::class)
        ->add('save', SubmitType::class, ['label' => 'Sign Up'])
        ->getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $member = $form->getData();

            //$member->setStatus("pending");
            $plainPassword = "password";
            $encoded = $encoder->encodePassword($member, $plainPassword);
            $member->setPassword($encoded);
            $member->setLastEdited(time());
            $member->setLastLogin(time());
            $member->setRoles([]);
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($member);
            $entityManager->flush();

            $status="done";
            //return $this->redirectToRoute('task_success');
        }

      return $this->render('app/signup.html.twig', [
          'form' => $form->createView(),
          'status' => $status
      ]);
    }

    /**
     * @Route("/apply", name="apply")
     */
    public function apply(Request $request)
    {
        $status = false;
        $application =  new Application();

        $form = $this->createFormBuilder($application)
          ->add('character_main', TextType::class, ['label' => "What's the character name?"])
          ->add('spec', TextType::class, ['label' => "What class and spec are you applying as?"])
          ->add('character_alts', TextType::class, ['label' => "Any alts you're proud of? What are their character names?"])
          ->add('log_link', TextType::class, ['label' => "Link to a combat log"])
          ->add('experience', TextareaType::class, ['label' => "Tell us about your raiding experience"])
          ->add('attendance', ChoiceType::class , [
            'choices' => [
                "Can Attend" => true,
                "Cannot Attend" => false
              ],
              'label' => "Please confirm you can attend the posted raid days and times"
            ])
          ->add('voice', ChoiceType::class , [
            'choices' => [
                "Mic & Headset" => true,
                "Just Headset" => true,
                "Neither" => false
              ],
              'label' => "Voice Communication Setup"
            ])
          ->add('about', TextareaType::class, ['label' => "Tell us about you. Age/Hobbies etc"])
          ->add('history', TextareaType::class, ['label' => "What guilds have you been a part of? Why did you leave them?"])
          ->add('additional', TextareaType::class,['label' => "For anything you want to say that you haven't already."])
          ->add('battletag', TextType::class, ['label' => "Battletag which we can use to contact you"])
          ->add('save', SubmitType::class, ['label' => 'Send Application'])
          ->getForm();


          $form->handleRequest($request);

          if ($form->isSubmitted() && $form->isValid()) {
              // $form->getData() holds the submitted values
              // but, the original `$task` variable has also been updated
              $application = $form->getData();

              $application->setStatus("pending");
              $application->setDateCreated(time());
              // ... perform some action, such as saving the task to the database
              // for example, if Task is a Doctrine entity, save it!
              $entityManager = $this->getDoctrine()->getManager();
              $entityManager->persist($application);
              $entityManager->flush();

              $status="done";
              //return $this->redirectToRoute('task_success');
          }

        return $this->render('app/apply.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'AppController',
            'status' => $status
        ]);
    }

    /**
     * @Route("/applications", name="applications")
     * @Security("is_granted('ROLE_USER')")
     */
    public function applications(){
      $results =$this->getDoctrine()->getRepository(Application::class)->findByStatus("pending");
      return $this->render('app/applications.html.twig',[
        "applications" => $results
      ]);
    }
  /**
    * @Route("/api/applications/get", name="api/applications/get")
    * @Security("is_granted('ROLE_USER')")
    */
   public function getApplications(){
     $return = [];
     $results =$this->getDoctrine()->getRepository(Application::class)->getAllApplications();
    foreach ($results as $result){
      $return[] = (array) $result;
    }
     return new JsonResponse([
       "items" => $return
     ]);
   }
}
