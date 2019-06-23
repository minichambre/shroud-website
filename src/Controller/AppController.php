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

      return $this->render('app/apply.html.twig', [
          'form' => $form->createView(),
          'controller_name' => 'AppController',
          'status' => $status
      ]);
    }

    /**
     * @Route("/apply", name="apply")
     */
    public function apply(Request $request)
    {
        $e = $this->getUser()->getUsername();
        $status = false;
        $application =  new Application();

        $form = $this->createFormBuilder($application)
          ->add('character_main', TextType::class)
          ->add('spec', TextType::class)
          ->add('character_alts', TextType::class)
          ->add('log_link', TextType::class)
          ->add('experience', TextareaType::class)
          ->add('attendance', ChoiceType::class , [
            'choices' => [
                "Can Attend" => true,
                "Cannot Attend" => false
              ],
            ])
          ->add('voice', ChoiceType::class , [
            'choices' => [
                "Mic & Headset" => true,
                "Just Headset" => true,
                "Neither" => false
              ],
            ])
          ->add('about', TextareaType::class)
          ->add('history', TextareaType::class)
          ->add('additional', TextareaType::class)
          ->add('battletag', TextType::class)
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
            'username' => $e,
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
}
