<?php
namespace Chewbacca\UserBundle\Mailer;

use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Mailer\Mailer as BaseMailer;

class Mailer extends BaseMailer
{
    public function sendNewUserEmailMessage(UserInterface $user, $password)
    {
        $message = sprintf("new lacroco user registered\n username: %s email: %s pass: %s", $user->getUsername(), $user->getEmail(), $password);
        $this->sendEmailMessage($message, array('admin@lacroco.ru' => 'Lacroco Admin'), 'chief@lacroco.ru');
    }

    public function sendWelcomeMessage(UserInterface $user)
    {
        $rendered = $this->templating->render($template, array(
            'user' => $user,
        ));
        $this->sendEmailMessage($message, array('admin@lacroco.ru' => 'Lacroco Admin'), $user->getEmail());
    }
}
