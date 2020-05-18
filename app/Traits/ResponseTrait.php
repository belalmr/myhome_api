<?php

namespace App\Traits;

use \Illuminate\Http\Request;

trait ResponseTrait
{
    public function currency($price, Request $header)
    {
        if ($header->header('currency') == null) {
            $code = 'USD';
        } else {
            $code = $header->header('currency');
        }
        $convert = Currency::where('code', $code)->first()->value;
        $price = $price * $convert;
        return $price;
    }

//        $currency = 'app()->getLocale()';
//        switch ($currency) {
//            case "en-gb":
//                $currency = 1;
//                break;
//            case "zh-cn":
//                $currency = 3;
//                break;
//            default:
//                $currency = 2; //"Arabic": "ar" or null or other
//        }
//    }

    public function lang()
    {
        $lang = app()->getLocale();
        switch ($lang) {
            case "en-gb":
                $lang = 1;
                break;
            case "zh-cn":
                $lang = 3;
                break;
            default:
                $lang = 2; //"Arabic": "ar" or null or other
        }
        return $lang;
    }

    protected function successJsonResponse(array $message, $data = [], string $data_name = 'data', $paging = [], int $code = 200)
    {
        return response()->json(
            [
//                'status' => [
                'status' => $code ? 'success' : 'fail',
                'message' => $message,
                'code' => $code,

//                ],
//                'data' => [
//                    '' . $data_name => $data,

                    'data' => $data,
                    'paging' => $paging ? [
                        'total' => $paging->total(),
                        'per_page' => $paging->perPage(),
                        'current_page' => $paging->currentPage(),
                        'last_page' => $paging->lastPage(),
                        'from' => $paging->firstItem(),
                        'to' => $paging->lastItem()
                    ] : null
//                ]
            ],
            200
        );
    }

    protected function successJsonResponsePost(array $message, $data = [], string $data_name = 'data', $paging = [], int $code = 200)
    {
        return response()->json(
            [
                'status' => $code ? 'success' : 'fail',
                'message' => $message,
                'code' => $code,
            ],
            200
        );
    }

    protected function failJsonResponse(array $message, $data = [], string $data_name = 'data', $paging = [], int $code = 200)
    {
        return response()->json(
            [
//                'status' => [
                'status' => 'fail',
                'message' => $message,
                'code' => $code,
//                ],
                'data' => [
                    '' . $data_name => $data,
                    'paging' => $paging

                ],
            ],
            200
        );
    }

    protected function errorJsonResponse(array $message, $data = [], string $data_name = 'data', $paging = [], int $code = 200)
    {

        return response()->json(
            [
//                'status' => [
                'status' => 'error',
                'message' => $message,
                'code' => $code,
//                ],
                'data' => [
                    '' . $data_name => $data,
                    'paging' => $paging

                ],
            ],
            200
        );
    }
}
