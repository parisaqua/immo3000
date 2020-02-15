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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $gender = ['M.' => 'Monsieur', 'Mme.' => 'Madame'];
        
        $builder
            ->add('email', EmailType::class, $this->getConfiguration("E-mail", "Votre adresse électronique ...", ['required'=>false ]) )
            ->add('gender', ChoiceType::class, ['choices' => $this->getChoices(),'label' => 'Civilité'])
            ->add('firstName', TextType:: class, $this->getConfiguration("Prénom", "Votre prénom ...", ['required'=>false])  )
            ->add('lastName', TextType:: class, $this->getConfiguration("Nom", "Votre nom ...", ['required'=>false]) )
            ->add('agreeTerms', CheckboxType::class, $this->getConfiguration("J'accepte les conditions générales", "", [
                'mapped' => false,
                'required'=>false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Veillez accepter les conditions générales.',
                    ]),
                ],
            ]))
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Renseignez un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mote de passe doit contenir {{ limit }} charactères minimum',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]
                ),], 
                'invalid_message' => 'Les mots de passe ne correspondent pas',
                'first_options'  => ['label' => 'Mot de passe (6 caractères minimum)'],
                'second_options' => ['label' => 'Confirmation du mot de passe'],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

    private function getChoices()
    {
        $choices = User::GENDER;
        $output = [];
        foreach($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output;
    }
}
