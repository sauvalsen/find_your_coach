<?php

namespace App\Controller;
use App\Entity\Calendrier;
use App\Entity\User;
use App\Form\EditUserType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CompteController extends AbstractController
{
    /**
     * @Route("/compte", name="compte_show")
     */
    public function index(): Response
    {
        return $this->render('compte/index.html.twig', [
    
        ]);
    }

    /**
     * @Route("/edit", name="compte_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserRepository $user): Response
    {
        $user=$this->getUser();
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */

            $files2 = $form['avatar2']->getData();

            if (!empty($files2))
            {
                //$file = $user->getAvatar2();
                $file = $form->get('avatar2')->getData();
                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
                try {
                    $file->move(
                        $this->getParameter('avatars_directory'),
                        $fileName
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $user->setAvatar($fileName);
            } else {

                $user->setAvatar($user->getAvatar());
            }


            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('compte_show', [
                'id' => $user->getId(),
            ]);
        }

        return $this->render('compte/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

}
