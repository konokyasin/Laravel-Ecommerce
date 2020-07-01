<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar -->
    <div class="sidebar">
        <!-- sidebar menu -->
        <ul class="sidebar-menu">
            <li class="active">
                <a href="{{ url('/admin/dashboard') }}"><i class="fa fa-tachometer"></i><span>Dashboard</span>
                    <span class="pull-right-container">
                     </span>
                </a>
            </li>
             <li class="active">
                <a href="{{ url('/admin/banners') }}"><i class="fa fa-image"></i><span>Banners</span>
                    <span class="pull-right-container">
                     </span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list"></i><span>Categories</span>
                    <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.add-category') }}">Add Category</a></li>
                    <li><a href="{{ route('admin.view-categories') }}">View Categories</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-product-hunt"></i><span>Products</span>
                    <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.add-product') }}">Add Product</a></li>
                    <li><a href="{{ route('admin.view-products') }}">View Products</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gift"></i><span>Coupons</span>
                    <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.add-coupon') }}">Add Coupon</a></li>
                    <li><a href="{{ route('admin.view-coupons') }}">View Coupons</a></li>
                </ul>
            </li>
              <li class="active">
                <a href="{{ route('admin.orders') }}">
                    <i class="pe-7s-cart"></i><span>Orders</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar -->
</aside>
<!-- =============================================== -->
