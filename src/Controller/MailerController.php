<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
  private $mailer;

  public function __construct(MailerInterface $mailer)
  {
    $this->mailer = $mailer;
  }

  public function sendEmail(User $user, $data)
  {
    $email = (new Email())
      ->from('hello@events.com')
      ->to(new Address($user->getEmail(), $user->getFirstname()))
      ->subject($data['subject'])
      ->getHeaders()
      // this header tells auto-repliers ("email holiday mode") to not
      // reply to this message because it's an automated email
      ->addTextHeader('X-Auto-Response-Suppress', 'OOF, DR, RN, NRN, AutoReply')
      ->text($data['text']);
    // path of the Twig template to render new TemplatedEmail()
    //->htmlTemplate('emails/newsletter.html.twig');

    try {
      $this->mailer->send($email);
    } catch (TransportExceptionInterface $e) {
      // some error prevented the email sending; display an
      // error message or try to resend the message
    }
  }

  public function sendEmailToAll(Event $event, array $users, $data)
  {
    for ($i = 0; $i < count($users); $i++) {
      $email = (new Email())
        ->from('hello@events.com')
        ->to(new Address($users[$i]->getEmail(), $users[$i]->getFirstname()))
        ->subject($data['subject'])
        ->getHeaders()
        ->addTextHeader('X-Auto-Response-Suppress', 'OOF, DR, RN, NRN, AutoReply')
        ->text($data['text']);
      try {
        $this->mailer->send($email);
      } catch (TransportExceptionInterface $e) {

      }
    }
  }
}
