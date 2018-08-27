@extends('./layouts.admin')
@section('content')
<style>
    .verify-btn p, .brand-btn p{
        margin-bottom: 10px;
    }
    .verify-btn, .brand-btn{
        margin-top: 15px;
    }

</style>
<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="container">
                        <!-- BEGIN PAGE BREADCRUMBS -->
                        <ul class="page-breadcrumb breadcrumb">
                            <li>
                                <a href="{{url('/home')}}">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span><a href="{{url("/group-manager/products")}}">Product</a></span>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span></span>
                            </li>
                        </ul>
                        <div class="page-content-inner">
                            <div class="mt-content-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="portlet light">
                                            <div class="portlet-title">
                                                <div class="caption caption-md">
                                                    <i class="icon-bar-chart font-dark hide"></i>
                                                    <span class="caption-subject font-red-sunglo uppercase bold">Product Details</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <form role="form" id="addProductForm" method='post'>
                                                    {{csrf_field()}}
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Brand </label>
                                                                    <select class="form-control" id="brandId" name="brandId">
                                                                        <option value="" selected="selected" disabled="disabled">Select Brand</option>
                                                                       

                                                                        <option</option> 

                                                                        
                                                                    </select>
                                                                    <p>
                                                                        <b>
                                                                            <a href="javascript:;" class="pull-right text-info verify-btn" data-toggle="modal" data-target="#addBrandModal"><i class="fa fa-plus-circle"></i> Add New</a>
                                                                        </b>
                                                                    </p> 
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Category</label>
                                                                    <select class="form-control" id="categoryId" name='categoryId'>
                                                                        <option value="" selected="selected" disabled="disabled">Select Category</option>
                                                                        

                                                                        <option</option>
                                                                       
                                                                    </select>
                                                                    <p>
                                                                        <b>
                                                                            <a href="javascript:;" class="pull-right text-info verify-btn" data-toggle="modal" data-target="#addCategoryModal"><i class="fa fa-plus-circle"></i> Add New</a>
                                                                        </b>
                                                                    </p>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Product Name </label>
                                                                    <input type="text" class="form-control" placeholder="Product Name" name="productName" id="productName" value="">

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Alternate Name</label>
                                                                    <input type="text" class="form-control" placeholder="Alternate Name" name="productAltName" id="productAltName" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Manufacturing Year</label>
                                                                    <select class='form-control' id='productManufacturingYear' name='productManufacturingYear'>
                                                                        <option value="" selected="selected" disabled="disabled">Select Year</option>
                                                                       
                                                                        <option </option>
                                                                       
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label> Product Description</label>
                                                                    <textarea type="text" class="form-control" placeholder="Product Description" name='productDescription' id='productDescription'></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-actions margin-top-23">
                                                                    <button type="submit" class="btn btn-orange text-white text-center" name='addProductBtn' id='addProductBtn'>Submit</button>
                                                                    <button id="cancelBtn" type="button" class="btn default">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Add new Brand
--><div id="addBrandModal" class="modal fade in" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title fontgreen">Add Brand</h4>
            </div>
            <form id="addBrandform" method="post" action="">
                <div class="modal-body">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="control-label">Brand Name</label>
                        <input type="text" id="brandName" name="brandName" class="form-control" autocomplete="off" placeholder="brand Name"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Brand Description</label>
                        <textarea type="text" id="brandDescription" name="brandDescription" class="form-control" autocomplete="off" placeholder="brand Description"/></textarea>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                    <button type="submit" id="addBrandBtn" class="btn green_btn">Add Brand</button>
                </div>
            </form>
        </div>
    </div>
</div><!--

<!--Add new Category-->
<div id="addCategoryModal" class="modal fade in" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title fontgreen">Add Category</h4>
            </div>
            <form id="addCategoryForm" method="post" action="">
                <div class="modal-body">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="control-label">Category Name</label>
                        <input type="text" id="categoryName" name="categoryName" class="form-control" autocomplete="off" placeholder="Category Name"/>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                    <button type="submit" id="addCategoryBtn" class="btn green_payeebtn">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{url('/js/groupManager/product/add.js')}}"></script>

@endsection