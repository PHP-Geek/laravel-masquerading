<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Product extends Model {

    protected $table = 'products';

    /**
     * foreign key from brand
     */
    function brand() {
        return $this->belongsTo(Brand::class, 'brandId');
    }

    /**
     * forign key from category table
     * @return type
     */
    function productCategory() {
        return $this->hasMany(ProductCategory::class, 'productId');
    }

    /**
     * get the products in datatable
     * @param type $request
     * @return type
     */
    function getProductDatatable($request) {
        $data = $this->join('projects', 'products.projectId', '=', 'projects.id')
              
                ->where([
            ['products.companyId', '=', Auth::user()->companyId],
            ['products.productStatus', '!=', '-1']
        ]);

        //filtration for keyword
        if (isset($request->keyword) && $request->keyword != '') {
            $data = $data->where(function($query) use ($request) {
                $query->orWhere('products.productName', 'LIKE', '%' . $request->keyword . '%');
                $query->orWhere('products.productCategory', 'LIKE', '%' . $request->keyword . '%');
                $query->orWhere('products.productAltName', 'LIKE', '%' . $request->keyword . '%');
                $query->orWhere('products.productManufacturingYear', 'LIKE', '%' . $request->keyword . '%');
            });
        }
        $datacount = $data->count();
        $dataArray = $data->select('products.*', 'projects.projectTitle');
        if ($request->length == -1) {
            $dataArray = $dataArray->get();
        } else {
            $dataArray = $dataArray->skip($request->start)->take($request->length)->get();
        }
        return [$datacount, $dataArray];
    }

    /**
     * Add Product Detail
     * @param type $request
     * @return type
     */
    function addProduct($request) {
        $this->companyId = Auth::user()->companyId;
        $this->productCreatedBy = Auth::user()->id;
        $this->brandId = $request->brandId;
        $this->productName = $request->productName;
        $this->productSlug = str_slug($request->productName);
        $this->productAltName = $request->productAltName;
        $this->productManufacturingYear = $request->productManufacturingYear;
        $this->productDescription = $request->productDescription;
        $this->productStatus = 1;
        $this->created_at = date('Y-m-d h:i:s');
        $this->save();
        return $this->id;
    }

    /**
     * update product data
     * @param type $id
     * @param type $editProductArray
     * @return type
     */
    function updateProductData($id, $editProductArray) {
        return $this->where('id', $id)->update($editProductArray);
    }

    /**
     * upload the product data to desired table
     * @param type $productData
     */
    function uploadData($productData = [], $projectId = 0) {
        $insertArray = [];
        if (count($productData) > 0) {
            foreach ($productData as $row) {
                if ($row != false) {
                    $_Values = array_values($row);
                    if ($_Values[1] != '') {
                        $insertArray[] = [
                            'projectId' => $projectId,
                            'companyId' => Auth::user()->id,
                            'productCode' => $_Values[0],
                            'productCategory' => $_Values[2],
                            'productName' => $_Values[1],
                            'productSlug' => str_slug($_Values[1]),
                            'productAltName' => $_Values[8],
                            'productDescription' => $_Values[5],
                            'productStimuli' => $_Values[3],
                            'productComment' => $_Values[4],
                            'productShownToMom' => $_Values[6],
                            'productManufacturing' => $_Values[7],
                            'productManufacturingYear' => $_Values[9],
                            'productStatus' => '1',
                            'productCreatedBy' => Auth::user()->id
                        ];
                    }
                }
            }
        }
        if ($this->insert($insertArray) > 0) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * copy dictionary data by any project id
     * @param type $projectId
     */
    function copyByProjectId($projectId, $newProjectId) {
        $productArray = $this->where('projectId', $projectId)->get();
        foreach ($productArray as $product) {
            $copyTask = $product->replicate();
            $copyTask->projectId = $newProjectId;
            $copyTask->save();
        }
        return TRUE;
    }

}
