<?php

namespace App\Http\Controllers\groupManager;

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
	return view('groupManager/product/manageProduct');
    }
    
    
    /**
     * Product datatables
     * @param Request $request
     * @return type\
     */
    function productDtatable() {
	
    }

    /**
     * Add product details
     * @param Request $request
     * @return type
     */
    function add() {
	
	return view('groupManager/product/add');
    }

    /**
     * Import csv files
     * @param Request $request
     * @return type
     */
    function import() {
	
	return view('groupManager/product/import');
    }

    /**
     * Upload csv product file
     * @param type $file
     * @return string
     */
    function uploadProducts() {
        
    }

}

