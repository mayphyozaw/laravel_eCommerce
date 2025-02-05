<header class="main-header">
    <!-- Logo -->
    <a href="" class="logo blue-bg">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="{{ asset('assets/dist/img/logo-n-blue.png') }}" alt=""></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="{{ asset('assets/dist/img/logo-blue.png') }}" alt=""></span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar blue-bg navbar-static-top" style="background-color: lightblue;">
        <!-- Sidebar toggle button-->
        <ul class="nav navbar-nav pull-left">
            <li><a class="sidebar-toggle" data-toggle="push-menu" href="#"></a> </li>
        </ul>
        <div class="pull-left search-box">
            <form action="#" method="get" class="search-form">
                <div class="input-group">
                    <input name="search" class="form-control" placeholder="" type="text">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                                class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>

        </div>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">



                <!-- User Account  -->
                <li class="dropdown user user-menu p-ph-res"> <a href="#" class="dropdown-toggle"
                        data-toggle="dropdown"> <img src="{{ asset('data/user.png') }}" class="user-image"
                            alt="User Image">
                        <span class="hidden-xs">MM Dora</span> </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <div class="pull-left user-img"><img src="{{ asset('data/user.png') }}"
                                    class="img-responsive img-circle" alt="User"></div>
                            <p class="text-left">MM Douglas <small>Welcome!</small> </p>
                        </li>

                        <li>
                            <a href="#">

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <i class="fa fa-power-off"></i>
                                    <input type="submit" value="logout" class="border-0">
                                </form>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="image text-center"><img src="{{ asset('data/user.png') }}" class="img-circle" alt="User Image"
                    style="height: 50%;">
            </div>
            <div class="info">
                <p>MM Admin</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu -->
        <ul class="sidebar-menu" data-widget="tree">

            <li class=""> <a href="#"> <i class="icon-list"></i>
                    <span>Dashboard</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
            </li>
            <li class=""> <a href="{{ route('color.index') }}"> <i class="icon-list"></i>
                    <span>Color</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
            </li>
            <li class=""> <a href="{{ route('category.index') }}">
                    <i class="icon-list"></i>
                    <span>Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
            </li>
            <li class=""> <a href="{{ route('brand.index') }}"> <i class="icon-list"></i>
                    <span>Brand</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
            </li>
            <li class=""> <a href="{{ route('product.index') }}"> <i class="icon-list"></i>
                    <span>Product</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
            </li>
            <li class=""> <a href="{{ route('product-add-transaction') }}"> <i class="icon-list"></i>
                    <span>Product Transactions</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
            </li>

        </ul>
    </div>
    <!-- /.sidebar -->
</aside>
