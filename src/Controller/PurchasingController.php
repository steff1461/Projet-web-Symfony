<?php


namespace App\Controller;


use App\Repository\PurchasingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PurchasingController extends AbstractController
{

    /**
     *
     * @param PurchasingRepository $purchasingRepository
     * @param Request $request
     * @param $userId
     * @return Response
     * @Route (
     *     name="purchasings_by_user",
     *     path="/api/purchasings/user/{userId}",
     *     methods={"GET"},
     *     defaults={
     *         "api_resource_class"=Purchasing::class,
     *         "api_item_operation_name"="purchasings_by_user"
     *     }
     *     )
     */
    public function findAllByUser(PurchasingRepository $purchasingRepository, Request $request, $userId): Response
    {

        $purchasings = $purchasingRepository->findBy(
            ['userId' => $userId]
        );
        $data = $this->get('serializer')->serialize($purchasings, 'json');
        $response = new Response($data);
        $response->headers->set('Content-type', 'application/json');
        return $response;
    }
}