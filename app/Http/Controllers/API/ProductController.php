<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


/**
 * @OA\Info(title="LiberApi", version="1.0")]
 * @OA\Tag(name="Products")
 */

class ProductController extends ApiController
{
    /**
     * @OA\Get(
     *    path="/api/product",
     *    operationId="index",
     *    security={{"jwt":{}}},
     *    tags={"Products"},
     *    summary="Get all products",
     *    @OA\Response(
     *      response=200,
     *      description="Successful operation",
     *      @OA\JsonContent(
     *          @OA\Property(
     *              property="data",
     *              type="array",
     *              @OA\Items(
     *                  ref="#/components/schemas/Product"
     *              )
     *          )
     *      )
     *    ),
     *    @OA\Response(
     *      response=401,
     *      description="Unauthenticated",
     *      @OA\JsonContent(
     *          @OA\Property(
     *              property="message",
     *              type="string",
     *              example="Unauthenticated"
     *          )
     *      )
     *    )
     * )
     */
    public function index(): JsonResponse
    {
        $products = Product::all();

        return $this->respondWithSuccess($products);
    }

    /**
     * @OA\Get(
     *    path="/api/product/{id}",
     *    operationId="show",
     *    security={{"jwt":{}}},
     *    tags={"Products"},
     *    summary="Get product by id",
     *    @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *          type="integer"
     *      )
     *    ),
     *    @OA\Response(
     *      response=200,
     *      description="Successful operation",
     *      @OA\JsonContent(
     *          @OA\Property(
     *              property="data",
     *              type="object",
     *              ref="#/components/schemas/Product"
     *          )
     *      )
     *    ),
     *    @OA\Response(
     *      response=401,
     *      description="Unauthenticated",
     *      @OA\JsonContent(
     *          @OA\Property(
     *              property="message",
     *              type="string",
     *              example="Unauthenticated"
     *          )
     *      )
     *    ),
     *    @OA\Response(
     *      response=404,
     *      description="Product not found",
     *      @OA\JsonContent(
     *          @OA\Property(
     *              property="message",
     *              type="string",
     *              example="Product not found"
     *          )
     *      )
     *    )
     * )
     */
    public function show($id): JsonResponse
    {
        try {
            $product = Product::findOrFail($id);

            return $this->respondWithSuccess($product);
        } catch (\Throwable $th) {
            return $this->respondWithError('Product not found');
        }
    }
}
