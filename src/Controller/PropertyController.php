<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{


    /**
     * @var PropertyRepository
     */
    private $repository;

    public function __construct(PropertyRepository $repository)
    {

        $this->repository = $repository;
    }


    /**
     * @Route("/properties",name ="property.index")
     * @return Response
     */
    public function index():Response
    {

        // Other methode to get repository
        //$repo = $this->getDoctrine()->getRepository(Property::class);


        $property = $this->repository->findAllVisible();
        dump($property);
        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties'
        ]);
    }

    /**
     * @Route("/properties/{id}",name ="property.show")
     * @param $id
     * @return Response
     */
    public function show ($id):Response
    {
        $property = $this->repository->find($id);
        return $this->render('property/show.html.twig', [
            'property'=> $property,
            'current_menu' => 'properties'
        ]);
    }
}