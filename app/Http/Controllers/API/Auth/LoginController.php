<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


/**
 * @OA\Tag(name="Login")
 */
class LoginController extends ApiController
{


    /**
     * @OA\Post(
     *      path="/api/login",
     *      operationId="login",
     *      tags={"Login"},
     *      summary="Login",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              ref="#/components/schemas/UserLoginRequest"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  @OA\Property(
     *                      property="token",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="token_type",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="expires_in",
     *                      type="integer"
     *                  )
     *              )
     *          )
     *      )
     * )
     *
     * @param UserLoginRequest $request
     * @return void
     */
    public function login(UserLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = Auth::attempt($credentials)) {
            return $this->respondWithError('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithSuccess([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}
