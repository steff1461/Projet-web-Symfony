<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;


class MailerController extends AbstractController
{
    /**
     * @Route("/api/contact", methods={"POST"})
     * @param MailerInterface $mailer
     * @param Request $request
     * @throws TransportExceptionInterface
     */
    public function sendEmail(MailerInterface $mailer, Request $request)
    {
        $body = $request->getContent();
        $data = json_decode($body, true);

        $sender = $data['sender'];
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $message = $data['message'];

        $email = (new TemplatedEmail())
            ->from('steff121291@gmail.com')
            ->to('steffenwilliam24@gmail.com')
//            ->to('patrick.marthus@iepscf-namur.be')
            ->subject('New information request')
            ->htmlTemplate("emails/mail.html.twig")
            ->context([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'message' => $message,
                'sender' => $sender
            ]);

        $mailer->send($email);

        return new Response();
    }
}