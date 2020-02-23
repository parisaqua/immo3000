<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/biens")
 */
class PropertyController extends AbstractController {
    
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
     * Liste des biens immobiliers
     * @Route("/", name="properties_index") 
     * @IsGranted("ROLE_USER")
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response {
        
        $properties = $paginator->paginate(
            $this->repository->findAllVisibleQuery(),
            $request->query->getInt('page', 1),
            6
        );
        
        return $this->render('property/properties_index.html.twig', [
            'current_menu' => 'properties',
            'properties' => $properties
        ]);
    }

    /**
     * Détail d'un bien
     * 
     * @Route("/{slug}-{id}", name="property_show", requirements={"slug"= "[a-z0-9\-]*" }) 
     * 
     * @return Response
     */
    public function show(PropertyRepository $repository, Property $property, $id, $slug): Response {
        
        if($property->getSlug() !== $slug) {
            return $this->redirectToRoute('property_show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }
        
        return $this->render('property/property_show.html.twig', [
            'current_menu' => 'properties',
            'property' => $property

        ]);
    }





}