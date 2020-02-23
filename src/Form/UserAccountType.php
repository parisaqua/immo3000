<?php

namespace App\Form;

use App\Entity\User;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserAccountType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $gender = ['M.' => 'Monsieur', 'Mme.' => 'Madame'];
        
        $builder
        ->add('email', EmailType::class, $this->getConfiguration("E-mail", "Votre adresse électronique ...", ['required'=>false ]) )
        ->add('gender', ChoiceType::class, ['choices' => $this->getChoices(),'label' => 'Civilité'])
        ->add('firstName', TextType:: class, $this->getConfiguration("Prénom", "Votre prénom ...", ['required'=>false])  )
        ->add('lastName', TextType:: class, $this->getConfiguration("Nom", "Votre nom ...", ['required'=>false]) )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'translation_domain' => "forms"
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
