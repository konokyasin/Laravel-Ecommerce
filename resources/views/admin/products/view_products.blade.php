@extends('admin.layouts.master')
@section('title','View Products')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="header-icon">
                <i class="fa fa-product-hunt"></i>
            </div>
            <div class="header-title">
                <h1>View Products</h1>
                <small>Products List</small>
            </div>
        </section>
        <!-- Main content -->
        @include('other.message')
        <div id="message_success" style="display: none;" class="alert alert-sm alert-success">Status Enabled</div>
        <div id="message_error" style="display: none;" class="alert alert-sm alert-danger">Status Disabled</div>
        <section class="content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="btn-group" id="buttonexport">
                                <a href="#">
                                    <h4>View Products</h4>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">                          
                            <div class="btn-group">
                                <div class="buttonexport" id="buttonlist">
                                    <a class="btn btn-add" href="{{ route('admin.add-product') }}"> <i class="fa fa-plus"></i> Add Product
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="table_id" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr class="info">
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Category ID</th>
                                        <th>Product Code</th>
                                        <th>Product Color</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Featured Products</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->category_id }}</td>
                                            <td>{{ $product->code }}</td>
                                            <td>{{ $product->color }}</td>
                                            <td>
                                                @if(!empty($product->image))
                                                    <img src="{{asset('uploads/product/'.$product->image)}}" alt="no image" style="width: 100px;">
                                                @endif
                                            </td>
                                            <td>{{ $product->price }}</td>
                                            <td>
                                                <input type="checkbox" class="btn btn-success" id="ProductStatus" rel="{{ $product->id }}"
                                                data-toggle="toggle" data-on="Enabled" data-off="Disabled" data-onstyle="success" data-offstyle="danger"
                                                @if ($product['status']=="1") checked @endif>       
                                            </td>
                                            <td>
                                                <input type="checkbox" class="btn btn-success" id="FeaturedStatus" rel="{{ $product->id }}"
                                                data-toggle="toggle" data-on="Enabled" data-off="Disabled" data-onstyle="success" data-offstyle="danger"
                                                @if ($product['status']=="1") checked @endif>       
                                            </td>
                                            <td>
                                                <div style="display: flex;">
                                                    <a href="{{ url('/admin/add-images/'.$product->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Add Attributes Images!" ><i class="fa fa-image"></i></a>
                                                    <a href="{{ url('/admin/add-attributes/'.$product->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Add Product Attributes!" ><i class="fa fa-list"></i></a>                                                
                                                    <a href="{{ url('/admin/edit-product/'.$product->id) }}" class="btn btn-add btn-sm" data-toggle="tooltip" title="Edit Product!" ><i class="fa fa-pencil"></i></a>
                                                    <a href="{{ url('/admin/delete-product/'.$product->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Product!" ><i class="fa fa-trash-o"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection
