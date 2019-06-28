<?php
namespace App\Controller\Front;

use App\Entity\Calendrier;
use App\Form\EditUserType;
use App\Entity\User;
use App\Form\EditFrontUserType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Form\Type\FileType as CustomFileType;

class CompteController extends AbstractController
{
    /**
     * @Route("/compte", name="compte_show")
     */
    public function index(): Response
    {
        return $this->render('front/compte/index.html.twig', [
    
        ]);
    }
   /**
     * @Route("/profil={id}", name="profil_show", methods={"GET"})
     */
     public function show(User $user): Response
     {
        return $this->render('front/compte/profil.html.twig', [
            'user'=>$user
         ]);
     }

    /**
     * @Route("/compte/editmoncompte", name="compte_edit", methods={"GET","POST"})
     */
    public function edit(Request $request): Response
    { 
        $user = $this->getUser();
    $form = $this->createForm(EditFrontUserType::class, $user, [
        'upload_directory' => 'uploads/avatars/'
    ]);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid())
    {
        $file = $form['file']->getData();

        if (!empty($file))
        {
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

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('compte_show');
    }else{
        $fileName = $user->getAvatar();

        if (null !== $fileName && "" !== $fileName) {
            $file = $this->getParameter('avatars_directory').'/'.$fileName;
            if (file_exists($file)) {
                $user->setFile(new File($file));
            }
        }
    }

    return $this->render('front/compte/edit.html.twig', [
        'user' => $user,
        'form' => $form->createView(),
    
        ]);
   
}
        
/**
     * @Route("/effacercompte/", name="compte_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    { 
        $user = $this->getUser();
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_homepage');
    }

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

}
