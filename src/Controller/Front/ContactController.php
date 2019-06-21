<?php
namespace App\Controller\Front;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer, Environment $renderer)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()){

            $this->renderer = $renderer;
            $message = (new \Swift_Message())
                ->setSubject('Demande client')
                ->setFrom($form['email']->getData())
                ->setTo('findyourcoach@gmail.com')
                ->setBody(
                    $this->renderer->render('front/contact/mail_client.html.twig', [
                    'contact' => $contact
                    ]),
                    'text/html'
                );
            $mailer->send($message);

            $this->addFlash('success', 'Votre email à bien été envoyé.');
            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('front/contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
