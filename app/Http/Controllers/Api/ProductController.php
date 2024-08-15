<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    /**
     * Product List
     *
     * @param Request $request object
     *
     * @return string
    */
    public function productList(Request $request){
        $productList = Product::paginate(10);
        return $this->sendResponse('Product List',$productList);
    }

    /**
     * Product Details
     *
     * @param Request $request object
     *
     * @return string
    */
    public function productDetails($id){
        $product = Product::findOrFail($id);
        return $this->sendResponse('Product details',$product);
    }
    
    /**
     * Product Search By name
     *
     * @param Request $request object
     *
     * @return string
    */
    public function productSearch(Request $request,$search){
        $products = Product::where('name','like',"%$search%")->paginate(10);
        return $this->sendResponse('Product search',$products);
    }
}
