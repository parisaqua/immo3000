<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPropertyController extends AbstractController
{
    
    /**
     * @var PropertyRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(PropertyRepository $repository, EntityManagerInterface $em) {
        $this->repository = $repository;
        $this->em = $em;
    }
    
    /**
     * @Route("/admin/property", name="admin_property")
     */
    public function index()
    {
        $properties = $this->repository->findAll();
        
        return $this->render('admin/property/index.html.twig', [
            'current_menu' => 'admin',
            'properties' => $properties
        ]);
    }


    /**
     * Editier les biens
     *
     * @Route("/admin/property/{id}", name="admin_property_edit")
     * 
     */
    public function edit(Property $property) {
        return $this->render('admin/property/admin_property_edit.html.twig', [
            'property' => $property,
            'current_menu' => 'admin',
        ]);
    }


}