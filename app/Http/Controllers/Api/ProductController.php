<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\FavoriteForm;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\ProductCategoryCollection;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Traits\ResponseTrait;

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

    public function subCategory()
    {
        $categories = Category::where('status', 'A')->where('level', 2)->paginate();
        return $this->successJsonResponse([], new CategoryCollection($categories->items()), 'Category', $categories);
    }

    public function orders()
    {
        $orders = Order::where('user_id', 252)->paginate();
        return $this->successJsonResponse([], new OrderCollection($orders->items()), 'Order', $orders);
    }

    public function favourite(FavoriteForm $form)
    {
        return $form->favorite();
    }

    public function allFavourites()
    {
        $products = Product::where('status', 'A')->whereHas('session_product', function ($q) {
            $q->where('type', 'W');
        })->paginate();
        return $this->successJsonResponse([], new ProductCollection($products->items()), 'Product', $products);
    }

    public function productsCategory()
    {
//        $products = ProductCategory::whereHas('category' , function ($q2){
//                $q2->where('status', 'A')->where('level', 2);
//            })->get();

        $products = Product::where('status', 'A')->whereHas('category', function ($q1) {
//            $q1->whereHas('category', function ($q2) {
//                $q2->where('status', 'A')->where('level', 2);
//            });
            $q1->where('category_id', request()->category_id);
        })->paginate(9);
//        dd($products);
        return $this->successJsonResponse([], new ProductCollection($products->items()), 'Product', $products);
    }

}

