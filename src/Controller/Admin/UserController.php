<?php
namespace App\Controller\Admin;

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

/**
 * @Route("/admin/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="admin_user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository, Request $request, PaginatorInterface $paginator): Response
    {
            $users = $paginator->paginate(
                $userRepository->findAll(),
                $request->query->getInt('page', 1),
                10
            );
        return $this->render('admin/user/index.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/new", name="admin_user_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */

            $files2 = $form['avatar2']->getData();
            $entityManager = $this->getDoctrine()->getManager();

            if (!empty($files2))
            {
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

                $user->setAvatar('default-avatar.png');
            }

            $password = $request->request->get('password');
            $user->setPassword($passwordEncoder->encodePassword($user,$password));
            $user->setRoles(array($form->get('roles2')->getData()));
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('admin/user/new.html.twig', [
            'user' => $user,
            'newUserForm' => $form->createView(),
        ]);
    }

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

    /**
     * @Route("/{id}", name="admin_user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {

        return $this->render('admin/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
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

            return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('admin/user/edit.html.twig', [
            'user' => $user,
            'editUserForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_user_index');
    }
}
