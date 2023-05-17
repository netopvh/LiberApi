<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      required={"email", "password"},
 *      @OA\Xml(
 *          name="UserLoginRequest"
 *      ),
 *      @OA\Property(
 *          property="email",
 *          type="string",
 *          format="email",
 *          description="Email do usuário",
 *          example="admin@email.com",
 *      ),
 *       @OA\Property(
 *          property="password",
 *          type="string",
 *          format="password",
 *          description="Senha do usuário",
 *          example="123456",
 *      )
 *)
 */
class UserLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'Email',
            'password' => 'Senha',
        ];
    }
}
