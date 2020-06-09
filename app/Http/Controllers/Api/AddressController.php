<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\Address;
use App\Models\CountryDescription;
use App\Models\Page;
use App\Models\PageDescription;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    use ResponseTrait;

    public function shipping_address(Address $address)
    {
        $id = Auth::id();
        return $address->shipping($address, $id);
    }

    public function payment_address(Address $address)
    {
        $id = Auth::id();
        return $address->payment($address, $id);
    }

    public function countries()
    {
        $countries = CountryDescription::where('lang_code', app()->getLocale())->get(['code', 'country']);
        return $this->successJsonResponse([], $countries);
    }

    public function page($id)
    {
        $page = PageDescription::where('page_id', $id)->where('lang_code', app()->getLocale())->first(['page', 'description']);
        return $this->successJsonResponse([], $page);
    }

    public function pages()
    {
        $page = PageDescription::where('lang_code', app()->getLocale())->get(['page', 'page_id']);
        return $this->successJsonResponse([], $page);
    }

}
