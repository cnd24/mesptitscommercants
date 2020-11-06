<?php

namespace App\Controller;

use App\Repository\ShopRepository;
use App\Services\GeoApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/shop")
 */
class ShopController extends AbstractController
{
    /**
     * @Route("/", name="shop_index", methods={"GET"})
     */
    public function index(ShopRepository $shopRepository, GeoApi $geoApi): Response
    {

        //$geoApi->getCity();
        return $this->render('shop/index.html.twig', [
            'shops' => $shopRepository->findAll(),
        ]);
    }
}
