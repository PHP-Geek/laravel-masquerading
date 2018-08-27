<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Product;
use Auth;

class ProductController extends Controller {

    /**
     * load view of view product
     * @return type
     */
    function manageProduct() {
	return view('admin/product/manageProduct');
    }

    /**
     * Product datatables
     * @param Request $request
     * @return type\
     */
    function productDtatable(Request $request) {
	$productObj = new \App\Product();
	$data = $productObj->getProductDatatable($request);
	return response()->json(["draw" => intval($request->draw), "recordsTotal" => $data[0], "recordsFiltered" => $data[0], "data" => $data[1]]);
    }
    
    


}
