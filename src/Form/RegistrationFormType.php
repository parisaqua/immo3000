<?php

namespace App\Form;

use App\Entity\User;

use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, $this->getConfiguration("E-mail", "Votre adresse électronique ...", [
                'required'=>false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez rentrer une adresse e-mail valide',
                    ])
                ]   
            ]))
            ->add('firstName', TextType:: class, $this->getConfiguration("Prénom", "Votre prénom ...", ['required'=>false])  )
            ->add('lastName', TextType:: class, $this->getConfiguration("Nom", "Votre nom ...", ['required'=>false]) )
            ->add('agreeTerms', CheckboxType::class, $this->getConfiguration("J'accepte les conditions générales", "", [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Veillez accepter les conditions générales.',
                    ]),
                ],
            ]))
            ->add('plainPassword', PasswordType::class, $this->getConfiguration("Mot de passe", "Choisissez un mot de passe ..." , [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'required'=>false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Renseignez un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mote de passe doit contenir {{ limit }} charactères minimum',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
