@extends('admin.layouts.master')
@section('title','Products Attribute')

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
                <small>Add Attributes Images</small>
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
                            <form class="col-sm-6" action="{{ url('/admin/store-images/'.$productDetails->id) }}" method="post" enctype="multipart/form-data">
                                @csrf    
                                <input type="hidden" name="product_id" value="{{ $productDetails->id }}">                          
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
                                    <label>Images</label>
                                    <input type="file" name="image[]" id="image" multiple="multiple" required>
                                </div>
                                <div>
                                    <input type="submit" class="btn btn-success" value="Add Image">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
                                    <form action="#" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <thead>
                                            <tr class="info">                                        
                                                <th>ID</th>
                                                <th>Product ID</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($productImages as $productImage)
                                                <tr>
                                                    <td>{{ $productImage->id }}</td>
                                                    <td>{{ $productImage->product_id }}</td>
                                                    <td>
                                                        <img src="{{ url('uploads/product/'.$productImage->image) }}" alt="no image" style="width: 100px;">
                                                    </td>
                                                    <td>
                                                        <div style="display: flex;">                                                                                                                  
                                                            <a href="{{ url('/admin/delete-alt-image/'.$productImage->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Product Image Attributes!"><i class="fa fa-trash-o"></i></a>
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
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
