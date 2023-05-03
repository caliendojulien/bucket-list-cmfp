<?php

namespace App\Services;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class Alerte
{

    private $mailer;

    public function __construct(
        MailerInterface $mailer_interface
    )
    {
        $this->mailer = $mailer_interface;
    }

    public function envoiMail()
    {
        $email = (new Email())
            ->from('batman@afpa.fr')
            ->to('le_v@afpa.fr')
            ->subject('Convocation')
            ->text('Faire un cours avec ChatGPT');
        $this->mailer->send($email);
    }
}