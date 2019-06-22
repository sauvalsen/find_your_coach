<?php
namespace App\Controller\Front;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, \Swift_Mailer $mailer, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator, TokenGeneratorInterface $tokenGenerator): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(array($form->get('roles2')->getData()));

            $token = $tokenGenerator->generateToken();
            $user->setToken($token);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $url = $this->generateUrl('confirm_mail',array(
                'token' => $token
            ),
                UrlGeneratorInterface::ABSOLUTE_URL
            );

            $message = (new \Swift_Message())
                ->setSubject('Confirmation du mot de passe')
                ->setFrom('findyourcoach@gmail.com')
                ->setTo($form['email']->getData())
                ->setBody(
                    'Cliquer ici pour valider votre compte: <a href="'.$url.'">Valider mon compte</a>',
                    'text/html'
                );
            $mailer->send($message);

            $this->addFlash('success', 'Rendez vous sur votre boite mail pour confirmer votre inscription.');

//            return $guardHandler->authenticateUserAndHandleSuccess(
//                $user,
//                $request,
//                $authenticator,
//                'main' // firewall name in security.yaml
//            );
            return $this->redirectToRoute('app_login');
        }

        return $this->render('front/registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/confirm-user/{token}", name="confirm_mail")
     */
    public function confirmMail($token)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findOneBy(array('token'=>$token));

        if($user === null){
            $this->addFlash('danger','Lien incorrecte');
            return $this->redirectToRoute('app_homepage');
        }

        if($user->getIsActive()){
            $this->addFlash('success','Utilisateur déjà actif');
            return $this->redirectToRoute('app_homepage');
        }

        $user->setIsActive(true);
        $user->setToken('');
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_login');
    }
}
