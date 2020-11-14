<?php declare(strict_types=1);

namespace App\Controller;

use App\Service\Contract\RateServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RateController
 *
 * @package App\Controller
 */
class RateController extends AbstractController
{
    /**
     * @Route("/rate", name="rate_listing", methods={"POST"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function rate(Request $request, RateServiceInterface $rateService)
    {
        $rateService->rate(
            $request->request->getInt('listing_id'),
            $request->getClientIp(),
            $request->request->getInt('rate'),
        );

        $this->addFlash('success', 'Listing Rated Successfully!');

        return $this->redirect($this->generateUrl('listings_index'), Response::HTTP_FOUND);
    }
}
