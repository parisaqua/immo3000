<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertyController extends AbstractController {
    
    /**
     * Liste des biens immobiliers
     * @Route("/biens", name="properties_index") 
     * @IsGranted("ROLE_USER")
     * @return Response
     */
    public function index(PropertyRepository $repository): Response {
        
        return $this->render('property/properties_index.html.twig', [
            'current_menu' => 'properties',
            'properties' => $repository->findAllVisible()
        ]);
    }

    /**
     * Détail d'un bien
     * 
     * @Route("/biens/{slug}-{id}", name="property_show", requirements={"slug"= "[a-z0-9\-]*" }) 
     * 
     * @return Response
     */
    public function show(PropertyRepository $repository, Property $property): Response {
        
        return $this->render('property/property_show.html.twig', [
            'current_menu' => 'properties',
            'property' => $property

        ]);
    }





}