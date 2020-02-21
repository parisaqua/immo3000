<?php

namespace App\Controller\Admin;

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
}