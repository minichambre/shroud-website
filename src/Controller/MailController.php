<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    // /**
    //  * @Route("/email")
    //  */
    // public function sendEmail(MailerInterface $mailer)
    // {
    //     $email = (new Email())
    //         ->from('hello@example.com')
    //         ->to('you@example.com')
    //         //->cc('cc@example.com')
    //         //->bcc('bcc@example.com')
    //         //->replyTo('fabien@example.com')
    //         //->priority(Email::PRIORITY_HIGH)
    //         ->subject('Time for Symfony Mailer!')
    //         ->text('Sending emails is fun again!')
    //         ->html('<p>See Twig integration for better HTML integration!</p>');
    //
    //     $mailer->send($email);
    //
    //     // ...
    // }

      /**
       * @Route("/email")
       */
      public function sendVerificationEmail(MailerInterface $mailer, array $accountData)
      {
          $email = (new Email())
              ->from('noreply@shroud.com')
              ->to($accountData["email"])
              //->cc('cc@example.com')
              //->bcc('bcc@example.com')
              //->replyTo('fabien@example.com')
              //->priority(Email::PRIORITY_HIGH)
              ->subject('Verify your Shroud account.')
              ->text('Sending emails is fun again!')
              ->html('<p><a href="/verify?token=' . $accountData["verificationCode"] . '">Please click here</a> to verify your account.</p>');

          $mailer->send($email);
          return true;

          // ...
      }
}
