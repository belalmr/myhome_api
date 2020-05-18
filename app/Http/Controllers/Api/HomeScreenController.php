<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannerCollection;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\ProductCollection;
use App\Models\Banner;
use App\Models\BannerImage;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class HomeScreenController extends Controller
{
    use ResponseTrait;

    public function categories()
    {
//        return App::getLocale();
        $categories = Category::where('status', 'A')->where('parent_id', 0)->where('level', 1)->paginate();
        return $this->successJsonResponse([], new CategoryCollection($categories->items()), 'Category', $categories);
    }

    public function products()
    {
        $products = Product::where('status', 'A')->where('amount', '>', 0)->paginate();
        return $this->successJsonResponse([], new ProductCollection($products->items()), 'Product', $products);
    }

    public function bestOffers()
    {
        $products = Product::where('status', 'A')->where('amount', '>', 0)->paginate();

        // TODO: check price best
        // price check list_price > price

        $products = Product::where('status', 'A')->where('amount', '>', 0)
            ->where('cscart_products.list_price', '>', 'cscart_product_prices.price')
            ->paginate();
        return $this->successJsonResponse([], new ProductCollection($products->items()), 'Product', $products);
    }

    public function mostSelling()
    {
        //  TODO: price amount > check
        $products = Product::where('status', 'A')->orderBy('amount', 'DESC')->paginate();
        return $this->successJsonResponse([], new ProductCollection($products->items()), 'Product', $products);

    }

    public function homeSlider()
    {
        $banner = DB::table('cscart_banners')
            ->select('cscart_images.image_id', 'cscart_images.image_path', 'cscart_images.image_x', 'cscart_images.image_y')
            ->leftJoin('cscart_banner_images', 'cscart_banners.banner_id', 'cscart_banner_images.banner_id')
            ->leftJoin('cscart_images_links', 'cscart_banner_images.banner_image_id', 'cscart_images_links.object_id')
            ->leftJoin('cscart_images', 'cscart_images_links.image_id', 'cscart_images.image_id')
            ->where('cscart_banners.status', 'A')->where('cscart_banners.type', 'G')
            ->where('cscart_images_links.object_type', 'promo')
            ->groupBy('cscart_images.image_id')
            ->paginate();

        return $this->successJsonResponse([], new BannerCollection($banner->items()), 'Banner', $banner);
    }

}
