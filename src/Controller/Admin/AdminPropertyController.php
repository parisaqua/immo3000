<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @Route("/admin/property", name="admin_property_index")
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        $properties = $paginator->paginate(
            $this->repository->findAllQuery(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/property/index.html.twig', [
            'current_menu' => 'admin',
            'properties' => $properties
        ]);
    }

    /**
     * Créer un biens
     *
     * @Route("/admin/property/new", name="admin_property_new")
     * 
     */
    public function create(Request $request) {
        
        $property = new Property();

        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($property);
            $this->em->flush();
            $this->addFlash('success', 'Bien créé avec succeès');
            return $this->redirectToRoute('admin_property_index');
        }

        return $this->render('admin/property/admin_property_new.html.twig', [
            'current_menu' => 'admin',
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
     * Editer un bien
     *
     * @Route("/admin/property/{id}", name="admin_property_edit", methods="POST|GET")
     * 
     */
    public function edit(Property $property, Request $request) {
        
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succeès');
            return $this->redirectToRoute('admin_property_index');
        }
        
        return $this->render('admin/property/admin_property_edit.html.twig', [
            'property' => $property,
            'current_menu' => 'admin',
            'form' => $form->createView()
        ]);
    }


    /**
     * Supprimer un bien
     *
     * @Route("/admin/property/{id}", name="admin_property_delete", methods={"DELETE"})
     * @param Property $property
     * 
     */
    public function delete(Property $property, Request $request) {
        
        if($this->isCsrfTokenValid('delete'.$property->getId(), $request->request->get('_token'))) {
            $this->em->remove($property);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succeès');
            // return new Response('Suppression');
        }

        return $this->redirectToRoute('admin_property_index');
    }


}