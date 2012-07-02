<?php

namespace Chewbacca\UserBundle\Controller;

use Symfony\Component\Security\Core\SecurityContext;
use FOS\UserBundle\Controller\SecurityController as BaseController;
class SecurityController extends BaseController
{
    public function loginAction($layout = true)
    {
        $request = $this->container->get('request');
        /* @var $request \Symfony\Component\HttpFoundation\Request */
        $session = $request->getSession();
        /* @var $session \Symfony\Component\HttpFoundation\Session */

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        if ($error) {
            // TODO: this is a potential security risk (see http://trac.symfony-project.org/ticket/9523)
            $error = $error->getMessage();
        }
        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);

        $csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');

        if ($request->attributes->has('login_position')) {
            $login_position = $request->attributes->get('login_position');
        } else {
            $login_position = 'right';
        }
        if ($layout) {
            $tpl_name = 'FOSUserBundle:Security:login_'.$login_position;
        } else {
            $tpl_name = 'FOSUserBundle:Security:login_content';
        }

        return $this->container->get('templating')->renderResponse($tpl_name.'.html.'.$this->container->getParameter('fos_user.template.engine'), array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'csrf_token' => $csrfToken,
            'login_position' => $login_position,
        ));
    }

    public function loginLogoutAction()
    {
        $response = $this->container->get('templating')->renderResponse('ChewbaccaUserBundle:Security:login_or_logout.html.'.$this->container->getParameter('fos_user.template.engine'));
        $response->setPrivate();
        $response->setETag(md5($response->getContent()));
        $response->isNotModified($this->container->get('request'));

        return $response;
    }
}
