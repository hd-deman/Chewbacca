<?php

namespace Chewbacca\UserBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;

class RegistrationController extends BaseController
{

    public function registerAction($layout = true)
    {
        $form = $this->container->get('fos_user.registration.form');
        $formHandler = $this->container->get('fos_user.registration.form.handler');
        $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');

        $process = $formHandler->process($confirmationEnabled);
        if ($process) {
            $user = $form->getData();

            $authUser = false;
            if ($confirmationEnabled) {
                $this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
                $route = 'fos_user_registration_check_email';
            } else {
                $authUser = true;
                $route = 'fos_user_registration_confirmed';
            }

            $this->setFlash('fos_user_success', 'registration.flash.user_created');
            if (($url = $this->container->get('session')->get('_security.main.target_path')) == false) {
                $url = $this->container->get('router')->generate($route);
            }

            $response = new RedirectResponse($url);

            if ($authUser) {
                $this->authenticateUser($user, $response);
            }

            $this->setFlash('fos_user_success', 'registration.flash.user_created');

            return $response;
        }

        if ($layout) {
            $tpl_name = 'FOSUserBundle:Registration:register';
        } else {
            $tpl_name = 'FOSUserBundle:Registration:register_content';
        }

        return $this->container->get('templating')->renderResponse($tpl_name.'.html.'.$this->getEngine(), array(
            'form' => $form->createView(),
        ));
    }
}
