<?php
namespace Chewbacca\UserBundle\Mailer;

use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Mailer\Mailer as BaseMailer;

class Mailer extends BaseMailer
{
    public function sendNewUserEmailMessage(UserInterface $user, $password)
    {
        $message = sprintf("new lacroco user\n username: %s email: %s pass: %s", $user->getUsername(), $user->getEmail(), $password);
        $this->sendEmailMessage($message, $user->getEmail(), 'hd.deman@gmail.com');
        $this->sendEmailMessage($message, $user->getEmail(), 'chief@lacroco.ru');
    }
}
