<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *      required={"name","price"},
 *      @OA\Xml(
 *          name="Product"
 *      ),
 *      @OA\Property(
 *          property="id",
 *          type="integer",
 *          format="int64",
 *          readOnly=true,
 *          example=1
 *      ),
 *      @OA\Property(
 *          property="name",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="description",
 *          type="string"
 *
 *      ),
 *      @OA\Property(
 *          property="price",
 *          type="number"
 *      )
 *  )
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price'
    ];
}
