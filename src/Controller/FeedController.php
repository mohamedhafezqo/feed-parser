<?php

namespace App\Controller;

use App\Form\ScrapeFormType;
use App\Service\Contract\ScrapeInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FeedController
 *
 * @package App\Controller
 */
class FeedController extends AbstractController
{
    /**
     * @Route("/feeds", name="feeds_index", methods={"GET"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $scrapeForm = $this->createForm(ScrapeFormType::class, null, [
            'action' => $this->generateUrl('feeds_scrape')
        ]);

        return $this->render('feed/index.html.twig', [
            'scrapeForm' => $scrapeForm->createView(),
        ]);
    }

    /**
     * @Route("/feeds/scrape", name="feeds_scrape", methods={"POST"})
     *
     * @param Request $request
     * @param ScrapeInterface $scrapeService
     *
     * @return Response
     */
    public function scrape(Request $request, ScrapeInterface $scrapeService)
    {
        $scrapeService->scrape($request->request->get('url'));
        $this->addFlash('success', 'Feeds scrapped!');

        return $this->redirect($this->generateUrl('feeds_index'), Response::HTTP_FOUND);
    }
}
