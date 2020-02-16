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
        
        $properties = $repository->findAllVisible();
       

        return $this->render('property/properties_index.html.twig', [
            'current_menu' => 'properties',
            'properties' => $properties
        ]);
    }



}