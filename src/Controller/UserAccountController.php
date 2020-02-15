<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserAccountType;
use App\Entity\PasswordUpdate;
use App\Form\RegistrationType;
use App\Form\PasswordUpdateType;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserAccountController extends AbstractController
{
    
    /**
     * Permet d'afficher le profil de l'utilisateur connecté
     *
     * @Route("/user/account/show", name="user_account_show")
     * @IsGranted("ROLE_USER")
     * 
     * @return Response
     */
    public function myAccount() {
        return $this->render('user_account/show.html.twig', [
            'user' => $this->getUser()
        ]);

    }
    
    
    /**
     * Permet d'afficher et de traiter le formulaire de modification du profil de l'utilisateur
     * 
     * @Route("/user/account/edit", name="user_account_edit")
     * @IsGranted("ROLE_USER")
     *
     * @return Response
     */
    public function userAccount(Request $request, EntityManagerInterface $manager){
        
        $user= $this->getUser();
        $form = $this->createForm(UserAccountType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "Les données ont été enregistrées avec succès !"
            );
            return $this->redirectToRoute('user_account_show');
        }

        return $this->render('user_account/user_account.html.twig', [
            'form' => $form->createView(),
            // 'controller_name' => 'UserAccountController'
        ]); 
    }

    /**
     * Permet de modifier le mot de pase de l'utilisateur
     *
     * @Route("/user/account/update-password", name="user_account_password_reset")
     * 
     * @return void
     */
    public function updatePassword(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $manager) {
        
        $passwordUpdate = new PasswordUpdate();

        $user = $this->getUser();

        $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            if(!password_verify($passwordUpdate->getOldPassword(), $user->getPassword())){
                // Gérer l'erreur
                $form->get('oldPassword')->addError(new FormError("Le mot de passe que vous avez tapé n'est pas votre mot de passe actuel"));
            }
            else{
                $newPassword = $passwordUpdate->getNewPassword();
                
                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $form->get('newPassword')->getData()
                    )
                );
    
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash(
                    'success',
                    "Votre mot de passe a bien été modifié"
                );

                return $this->redirectToRoute('home_page');
            }

            password_verify('password', '');
        }
        
        
        
        return $this->render('user_account/user_password_reset.htlm.twig', [
            'form' => $form->createView()
        ]);
    }

}