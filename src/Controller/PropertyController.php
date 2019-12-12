<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request):Response
    {

        // Other methode to get repository
        //$repo = $this->getDoctrine()->getRepository(Property::class);


        $properties = $paginator->paginate(
            $this->repository->findAllVisibleQuery(),
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties' ,
            'properties' => $properties
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