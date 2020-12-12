<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Shop;
use App\Entity\ShopCategory;
use App\Form\SearchType;
use App\Form\ShopType;
use App\Repository\ProductRepository;
use App\Repository\ShopCategoryRepository;
use App\Repository\ShopRepository;
use App\Services\GeoApi;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/shop")
 */
class ShopController extends AbstractController
{
    /**
     * @Route("/", name="shop", methods={"GET"})
     */
    public function index(ShopRepository $shopRepository, Request $request): Response
    {
        //$geoApi->getCity();

        $data = [];
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $data = $form->getData();
        }


        $shops = $shopRepository->findBySearch($data);

        return $this->render('shop/index.html.twig', [
            'shops' => $shops,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="shop_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $shop = new Shop();

        $form = $this->createForm(ShopType::class, $shop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($shop);
            $entityManager->flush();
            $this->addFlash('success', 'Commerce créé avec succès');

            return $this->redirectToRoute('shop');
        }

        return $this->render('shop/new.html.twig', [
            'shop' => $shop,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}-{slug}", name="shop_show", methods={"GET"}, requirements={"slug": "[a-z0-9\-]*"})
     */
    public function show(
        Shop $shop,
        ProductRepository $productRepository,
        string $slug,
        PaginatorInterface $paginator,
        Request $request): Response
    {
        if ($shop->getSlug() !== $slug) {
            return $this->redirectToRoute('shop_show', [
                'id' => $shop->getId(),
                'slug' => $shop->getSlug()
            ], 301);
        }

        $products = $paginator->paginate(
            $productRepository->findAllInStock($shop->getId()),
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('shop/show.html.twig', [
            'shop' => $shop,
            'products' => $products,
        ]);
    }



}
