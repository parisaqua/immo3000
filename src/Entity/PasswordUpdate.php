<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class PasswordUpdate
{
    
    /**
     *
     * @var [type]
     */
    private $oldPassword;

    
    /**
     * @Assert\Length(
     *      min = 6,
     *      max = 650,
     *      minMessage = "Votre mot de passe doit contenir au moins {{ limit }} charactères.",
     *      maxMessage = "Votre mot de passe ne peut pas dépasser {{ limit }} charactères."
     * )
     */
    private $newPassword;
    
    /**
     * @Assert\EqualTo(propertyPath="newPassword", message="Les mots de passe ne correspondent pas !")
     */
    private $confirmPassword;


    public function getOldPassword(): ?string
    {
        return $this->oldPassword;
    }

    public function setOldPassword(string $oldPassword): self
    {
        $this->oldPassword = $oldPassword;

        return $this;
    }

    public function getNewPassword(): ?string
    {
        return $this->newPassword;
    }

    public function setNewPassword(string $newPassword): self
    {
        $this->newPassword = $newPassword;

        return $this;
    }

    public function getConfirmPassword(): ?string
    {
        return $this->confirmPassword;
    }

    public function setConfirmPassword(string $confirmPassword): self
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }
}
