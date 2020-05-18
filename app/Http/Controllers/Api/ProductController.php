<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ResponseTrait;

    public function show_product($id)
    {
        $product = Product::find($id);
        if ($product)
            return $this->successJsonResponse([], new ProductResource($product), 'Product');

        return $this->failJsonResponse([__('product.not_found')]);
    }
}
