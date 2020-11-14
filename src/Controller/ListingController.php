<?php

namespace App\Controller;

use App\Service\Contract\ListingServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ListingController
 *
 * @package App\Controller
 */
class ListingController extends AbstractController
{
    /**
     * @Route("/listings", name="listings_index", methods={"GET"})
     *
     * @param Request $request
     * @param ListingServiceInterface $listingService
     *
     * @return JsonResponse
     */
    public function index(Request $request, ListingServiceInterface $listingService)
    {
        $data ['listings'] = $listingService->findAll(
            $request->query->get('page', 1)
        );

        return $this->render('listing/index.html.twig', $data);
    }
}
