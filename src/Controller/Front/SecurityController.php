<?php
namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('front/security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route("/logout", name="app_logout", methods={"GET"})
     */
    public function logout()
    {
        // controller can be blank: it will never be executed!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }

    /**
     * @Route("/forgotpassword", name="app_forgotpassword", methods={"GET", "POST"})
     */
    public function forgotpassword(Request $request, \Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator)
    {
        if($request->isMethod('POST')){
            $email = $request->request->get('email');
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->findOneByEmail($email);

            if($user === null){
                $this->addFlash('danger', 'Email inconnu');
                return $this->redirectToRoute('app_homepage');
            }

            $token = $tokenGenerator->generateToken();
            $user->setToken($token);
            $entityManager->flush();

            $url = $this->generateUrl('app_resetpassword',array(
                'token' => $token,
                'email' => $email
            ),
                UrlGeneratorInterface::ABSOLUTE_URL
            );

            $message = (new \Swift_Message())
                ->setSubject('Mot de passe oublié')
                ->setFrom('findyourcoach@gmail.com')
                ->setTo($user->getEmail())
                ->setBody(
                    'Cliquer ici pour modifier votre mot de passe: <a href="'.$url.'">Nouveau mot de passe</a>',
                    'text/html'
                );
            $mailer->send($message);

            $this->addFlash('success', 'Rendez vous sur votre boite mail.');

        }
        return $this->render('front/security/forgotpassword.html.twig');
    }

    /**
     * @Route("/resetpassword/{token}/{email}", name="app_resetpassword", methods={"GET", "POST"})
     */
    public function reset_password(Request $request,$token,$email, UserPasswordEncoderInterface $passwordEncoder)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findOneByEmail($email);

        if($user === null){
            $this->addFlash('danger','Email incorrecte');
            return $this->redirectToRoute('app_resetpassword');
        }

        if($user->getToken() != $token){
            $this->addFlash('danger','Error');
            return $this->redirectToRoute('app_homepage');
        }

        if($request->isMethod('POST')){

            $password = $request->request->get('password');
            $password2 = $request->request->get('password2');

            if(!empty($password) && !empty($password2)){
                if($password == $password2){
                    $user->setPassword($passwordEncoder->encodePassword($user,$password));
                    $user->setToken('');
                    $entityManager->flush();

                    return $this->redirectToRoute('app_login');
                }
            }
        }

        return $this->render('front/security/reset.html.twig');
    }
}
