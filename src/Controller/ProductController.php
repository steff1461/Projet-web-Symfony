<?php


namespace App\Controller;


use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProductController extends AbstractController
{


    /**
     *
     * @param ProductRepository $productRepository
     * @param Request $request
     * @param $id
     * @return Response
     * @Route(
     *     name="products_by_category",
     *     path="/api/products/category/{id}",
     *     methods={"GET"},
     *     defaults={
     *         "api_resource_class"=Product::class,
     *         "api_item_operation_name"="products_by_cat"
     *     }
     *     )
     */
    public function findAllByCategory(ProductRepository $productRepository, Request $request, $id): Response
    {


        $products = $productRepository->findAllByCategoryId($id);
        $data = $this->get('serializer')->serialize($products, 'json');
        $response = new Response($data);
        $response->headers->set('Content-type', 'application/json');
        return $response;

    }
}