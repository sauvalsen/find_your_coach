<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $message = (new \Swift_Message())
                ->setSubject('Demande client')
                ->setFrom($form['email']->getData())
                ->setTo('findyourcoach@gmail.com')
                ->setBody(
                    $form['message']->getData(),
                    'text/html'
                );
            $mailer->send($message);

            $this->addFlash('success', 'Votre email à bien été envoyé.');
//            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
