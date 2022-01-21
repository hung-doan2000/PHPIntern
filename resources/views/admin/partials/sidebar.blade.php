<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Cowell Asia</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">JR Hung</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.users.index')}}" @if (strstr( $_SERVER['REQUEST_URI'], '/admin/users/' ) == true)  class="nav-link active"; @else class = "nav-link"; @endif>
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users Management</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.users.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New User</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-key"></i>
                        <p>
                            Role
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.roles.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roles Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.roles.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New Role</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            Permission
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.permissions.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permission Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.permissions.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New Permission</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Product
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.products.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Product Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.products.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create New Product</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
