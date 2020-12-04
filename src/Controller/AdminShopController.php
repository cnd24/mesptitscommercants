<?php

namespace App\Controller;

use App\Entity\Shop;
use App\Form\ShopType;
use App\Repository\ShopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/shop")
 */
class AdminShopController extends AbstractController
{
    /**
     * @Route("/", name="admin_shop")
     * @param ShopRepository $shopRepository
     * @return Response
     */
    public function index(ShopRepository $shopRepository): Response
    {
        return $this->render('admin_shop/index.html.twig', [
            'shops' => $shopRepository->findAll()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_shop_edit", methods={"GET","POST"})
     * @return Response
     */
    public function edit(Request $request, Shop $shop): Response
    {
        $form = $this->createForm(ShopType::class, $shop);
//        $form->handleRequest($request);


        return $this->render('admin_shop/edit.html.twig', [
            'shop' => $shop,
            'form' => $form->createView(),
        ]);
    }
}
