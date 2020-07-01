@extends('admin.layouts.master')
@section('title','Products Attributes')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="header-icon">
                <i class="fa fa-product-hunt"></i>
            </div>
            <div class="header-title">
                <h1>Products Attributes</h1>
                <small>Add Products Attributes</small>
            </div>
        </section>
        <!-- Main content -->
        @include('other.message')
        <section class="content">
            <div class="row">
                <!-- Form controls -->
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">                   
                            <div class="btn-group" id="buttonlist"> 
                                <a class="btn btn-add " href="{{url('/admin/view-products')}}"> 
                                <i class="fa fa-eye"></i>  View Products </a>  
                            </div>
                        </div>
                        <div class="panel-body">
                            <form class="col-sm-6" action="{{ url('/admin/store-attributes/'.$productDetails->id) }}" method="post" enctype="multipart/form-data">
                                @csrf                              
                                <div class="form-group">
                                    <label>Product Name:</label> {{ $productDetails->name }}
                                </div>
                                <div class="form-group">
                                    <label>Product Code:</label> {{ $productDetails->code }}
                                </div>
                                <div class="form-group">
                                    <label>Product Color:</label> {{ $productDetails->color }}
                                </div>
                                <div class="form-group">
                                    <div class="field_wrapper">
                                        <div style="display:flex;">
                                            <input type="text" name="sku[]" id="sku" placeholder="SKU" class="form-control" style="width:150px;margin-right:5px;"/>
                                            <input type="text" name="size[]" id="size" placeholder="Size" class="form-control" style="width:150px;margin-right:5px;"/>
                                            <input type="number" name="price[]" id="price" placeholder="Price" class="form-control" style="width:150px;margin-right:5px;"/>
                                            <input type="number" name="stock[]" id="stock" placeholder="Stock" class="form-control" style="width:150px;margin-right:2px;"/>
                                            <a href="javascript:void(0);" class="add_button" title="Add Field"><i class="fa fa-plus-circle fa-2x"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <input type="submit" class="btn btn-success" value="Add Attributes">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- view attribute-->
        <section class="content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="btn-group" id="buttonexport">
                                <a href="#">
                                    <h4>View Attributes</h4>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">                                                    
                            <div class="table-responsive">                               
                                <table id="table_id" class="table table-bordered table-striped table-hover">
                                    <form action="{{ url('/admin/update-attributes/'.$productDetails->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <thead>
                                            <tr class="info">                                        
                                                <th>Attribute ID</th>
                                                <th>SKU</th>
                                                <th>Size</th>
                                                <th>Price</th>
                                                <th>Stock</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($productDetails['attributes'] as $attribute)
                                                <tr>
                                                    <td style="display: none;"><input type="hidden" name="attr[]" value="{{ $attribute->id }}">{{ $attribute->id }}</td>
                                                    <td>{{ $attribute->id }}</td>
                                                    <td><input type="text" name="sku[]" value="{{ $attribute->sku }}" class="form-control text-center"></td>
                                                    <td><input type="text" name="size[]" value="{{ $attribute->size }}" class="form-control text-center"></td>
                                                    <td><input type="number" name="price[]" value="{{ $attribute->price }}" class="form-control text-center"></td>
                                                    <td><input type="number" name="stock[]" value="{{ $attribute->stock }}" class="form-control text-center"></td>
                                                    <td>
                                                        <div style="display: flex;">
                                                            <button type="submit" class="btn btn-add btn-sm" data-toggle="tooltip" title="Update Product Attributes!" style="margin-right: 5px;"><i class="fa fa-pencil"></i></button>                                                       
                                                            <a href="{{ url('/admin/delete-attributes/'.$attribute->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Product Attributes!"><i class="fa fa-trash-o"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </form>
                                </table>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end view attribute -->
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
