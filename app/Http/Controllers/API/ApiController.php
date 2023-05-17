<?php

namespace App\Http\Controllers\API;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;

class ApiController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Api response for success
     *
     * @param Model|Collection|array $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithSuccess(Model|Collection|array $data): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => $data,
            'success' => true
        ], Response::HTTP_OK);
    }


    /**
     * Api response for error
     *
     * @param string $message
     * @param integer $error
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithError(string $message, int $error = 404): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $message,
            'success' => false
        ], $error);
    }
}
