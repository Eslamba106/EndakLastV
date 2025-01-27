<?php $settings = App\Models\Settings::first(); 
$lang = config('app.locale'); 
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ $settin }}</span>
    </a> --}}

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->first_name ?? 'Adminadmin' }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                @can('admin_general_dashboard')
                    <li class="nav-item has-treeview">
                        <a href="{{ route('admin.dashboard') }}"
                            class="nav-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th-large"></i>
                            {{-- <i class="fa fa-th-large"></i> --}}

                            <p>
                                {{ __('general.dashboard') }}
                            </p>
                        </a>


                    </li>
                @endcan
                @can('Admin_Roles')

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link {{ request()->is('admin/roles*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>
                                {{ __('roles.User_Roles') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.roles') }}"
                                    class="nav-link {{ request()->is('admin/roles') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('roles.All_Roles') }}</p>
                                </a>
                            </li>
                            @can('Create_Admin_Roles')
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.create') }}"
                                        class="nav-link {{ request()->is('admin/roles/create') ? 'active' : '' }}">

                                        {{-- <a href="{{ route('admin.roles.create') }}" class="nav-link {{ @if (request()->is('admin/roles/create')) 'active' @elseif ( request()->is('admin/roles/edit') ) 'active' @else '' @endif }}"> --}}
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('roles.New_Roles') }}</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('Admin_Roles')

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link {{ request()->is('admin/user_management*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>
                                {{ __('user.user_management') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.user_management') }}"
                                    class="nav-link {{ request()->is('admin/user_management') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{ __('user.All_User') }}</p>
                                </a>
                            </li>
                            {{-- @can('Create_Admin_Roles')
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.create') }}"
                                        class="nav-link {{ request()->is('admin/user_management/create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('roles.New_Roles') }}</p>
                                    </a>
                                </li>
                            @endcan --}}
                        </ul>
                    </li>
                @endcan
                
                @can('Admin_Departments')
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link {{ request()->is('admin/furniture_transportations*') ? 'active' : '' }}">
                            {{-- <i class="nav-icon fas fa-cog"></i> --}}
                            <i class="fas fa-car nav-icon"></i>

                            <p>
                                {{ ($lang == 'ar')? 'قسم نقل عفش' : 'Furniture Transportations' }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        {{-- @can('Edit_Admin_Settings') --}}
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('main_furniture_transportations') }}" class="nav-link {{ request()->is('admin/furniture_transportations') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        {{ ($lang == 'ar')? 'نقل عفش' : 'Furniture Transportations' }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('main_furniture_transportations.product') }}" class="nav-link {{ request()->is('admin/furniture_transportations/products') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        {{ ($lang == 'ar')? 'منتجات قسم نقل عفش' : 'Product Furniture Transportations' }}
                                    </a>
                                </li>
                                
                                {{-- <li class="nav-item">
                                    <a href="" class="nav-link {{ request()->is('admin/departments/edit') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> {{ __('department.edit_department') }} </p>
                                    </a>
                                </li> --}}

                            </ul>
                        {{-- @endcan --}}

                    </li>
                @endcan
                @can('Admin_Departments')
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link {{ request()->is('admin/surveillance_cameras*') ? 'active' : '' }}">
                            {{-- <i class="nav-icon fas fa-cog"></i> --}}
                            <i class="fas fa-car nav-icon"></i>

                            <p>
                                {{ ($lang == 'ar')? 'قسم كاميرات مراقبة ' : 'Surveillance Cameras' }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        {{-- @can('Edit_Admin_Settings') --}}
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.surveillance') }}" class="nav-link {{ request()->is('admin/furniture_transportations') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        {{ ($lang == 'ar')? 'قسم كاميرات مراقبة ' : 'Surveillance Cameras' }}
                                    </a>
                                </li>
                                
                                
                                {{-- <li class="nav-item">
                                    <a href="" class="nav-link {{ request()->is('admin/departments/edit') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> {{ __('department.edit_department') }} </p>
                                    </a>
                                </li> --}}

                            </ul>
                        {{-- @endcan --}}

                    </li>
                @endcan
                @can('Admin_Departments')
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link {{ request()->is('admin/party_preparation*') ? 'active' : '' }}">
                            <i class="fas fa-car nav-icon"></i>

                            <p>
                                {{ ($lang == 'ar')? 'قسم تجهيز حفلات ' : 'Party preparation' }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.party_preparation') }}" class="nav-link {{ request()->is('admin/party_preparation') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        {{ ($lang == 'ar')? 'قسم تجهيز حفلات ' : 'Party preparation' }}
                                    </a>
                                </li>
                               
                            </ul>

                    </li>
                @endcan
                @can('Admin_Departments')
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link {{ request()->is('admin/counter_insects*') ? 'active' : '' }}">
                            <i class="fas fa-car nav-icon"></i>

                            <p>
                                {{ ($lang == 'ar')? 'مكافحة الحشرات' : 'Counter Insects' }}


                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.counter_insects') }}" class="nav-link {{ request()->is('admin/counter_insects') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        {{ ($lang == 'ar')? 'مكافحة الحشرات' : 'Counter Insects' }}


                                    </a>
                                </li>
                               
                            </ul>

                    </li>
                @endcan
                @can('Admin_Departments')
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link {{ request()->is('admin/garden*') ? 'active' : '' }}">
                            <i class="fas fa-car nav-icon"></i>

                            <p>
                                {{ ($lang == 'ar')? 'تنسيق حدائق وزراعة' : 'Garden and Agriculture Coordination' }}

                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.garden') }}" class="nav-link {{ request()->is('admin/garden') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        {{ ($lang == 'ar')? 'تنسيق حدائق وزراعة' : 'Garden and Agriculture Coordination' }}

                                    </a>
                                </li>
                               
                            </ul>

                    </li>
                @endcan
                @can('Admin_Departments')
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link {{ request()->is('admin/cleaning*') ? 'active' : '' }}">
                            <i class="fas fa-car nav-icon"></i>

                            <p>
                                {{ ($lang == 'ar')? 'خدمات تنظيف' : "Cleaning Services" }}

                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.cleaning') }}" class="nav-link {{ request()->is('admin/cleaning') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        {{ ($lang == 'ar')? 'خدمات تنظيف' : "Cleaning Services" }}

                                    </a>
                                </li>
                               
                            </ul>

                    </li>
                @endcan
                @can('Admin_Departments')
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link {{ request()->is('admin/teacher*') ? 'active' : '' }}">
                            <i class="fas fa-car nav-icon"></i>

                            <p>
                                {{ ($lang == 'ar')? 'دروس خصوصي' : "Private Teacher" }}

                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.teacher') }}" class="nav-link {{ request()->is('admin/teacher') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        {{ ($lang == 'ar')? 'دروس خصوصي' : "Private Teacher" }}

                                    </a>
                                </li>
                               
                            </ul>

                    </li>
                @endcan
                @can('Admin_Departments')
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link {{ request()->is('admin/family*') ? 'active' : '' }}">
                            <i class="fas fa-car nav-icon"></i>

                            <p>
                                {{ ($lang == 'ar')? 'أسر منتجة' : "Productive Families" }}

                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.family') }}" class="nav-link {{ request()->is('admin/family') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        {{ ($lang == 'ar')? 'أسر منتجة' : "Productive Families" }}

                                    </a>
                                </li>
                               
                            </ul>

                    </li>
                @endcan
                @can('Admin_Departments')
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link {{ request()->is('admin/worker*') ? 'active' : '' }}">
                            <i class="fas fa-car nav-icon"></i>

                            <p>
                                {{ ($lang == 'ar')? 'عمال وحرفيين باليومية' : "Worker By Days" }}

                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.worker') }}" class="nav-link {{ request()->is('admin/worker') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        {{ ($lang == 'ar')? 'عمال وحرفيين باليومية' : "Worker By Days" }}

                                    </a>
                                </li>
                               
                            </ul>

                    </li>
                @endcan
                @can('Admin_Departments')
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link {{ request()->is('admin/public_ge*') ? 'active' : '' }}">
                            <i class="fas fa-car nav-icon"></i>

                            <p>
                                {{ ($lang == 'ar')? 'خدمات عامة' : "General Services" }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.public_ge') }}" class="nav-link {{ request()->is('admin/public_ge') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        {{ ($lang == 'ar')? 'خدمات عامة' : "General Services" }}
                                    </a>
                                </li>
                               
                            </ul>

                    </li>
                @endcan
                @can('Admin_Departments')
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link {{ request()->is('admin/ads*') ? 'active' : '' }}">
                            <i class="fas fa-car nav-icon"></i>

                            <p>
                                {{ ($lang == 'ar')? 'دعاية واعلان' : "Advertising" }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.ads') }}" class="nav-link {{ request()->is('admin/ads') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        {{ ($lang == 'ar')? 'دعاية واعلان' : "Advertising" }}

                                    </a>
                                </li>
                               
                            </ul>

                    </li>
                @endcan
                @can('Admin_Departments')
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link {{ request()->is('admin/water*') ? 'active' : '' }}">
                            <i class="fas fa-car nav-icon"></i>

                            <p>
                                {{ ($lang == 'ar')? 'فلاتر مياة شرب' : "Drinking water filters" }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.water') }}" class="nav-link {{ request()->is('admin/water') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        {{ ($lang == 'ar')? 'فلاتر مياة شرب' : "Drinking water filters" }}

                                    </a>
                                </li>
                               
                            </ul>

                    </li>
                @endcan
                @can('Admin_Departments')
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link {{ request()->is('admin/car_water*') ? 'active' : '' }}">
                            <i class="fas fa-car nav-icon"></i>

                            <p>
                                {{ ($lang == 'ar')? 'صهريج مياة' : "Water Tank" }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.car_water') }}" class="nav-link {{ request()->is('admin/car_water') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        {{ ($lang == 'ar')? 'صهريج مياة' : "Water Tank" }}

                                    </a>
                                </li>
                               
                            </ul>

                    </li>
                @endcan
                @can('Admin_Departments')
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link {{ request()->is('admin/big_car*') ? 'active' : '' }}">
                            <i class="fas fa-car nav-icon"></i>

                            <p>
                                {{ ($lang == 'ar')? 'سطحه' : "Big Car" }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.big_car') }}" class="nav-link {{ request()->is('admin/big_car') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        {{ ($lang == 'ar')? 'سطحه' : "Big Car" }}

                                    </a>
                                </li>
                               
                            </ul>

                    </li>
                @endcan


                @can('Admin_Departments')
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link {{ request()->is('admin/departments*') ? 'active' : '' }}">
                            {{-- <i class="nav-icon fas fa-cog"></i> --}}
                            <i class="fas fa-layer-group nav-icon"></i>

                            <p>
                                {{ __('department.departments') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        {{-- @can('Edit_Admin_Settings') --}}
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.departments') }}" class="nav-link {{ request()->is('admin/departments') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> {{ __('department.departments') }} </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.departments.create') }}" class="nav-link {{ request()->is('admin/departments/create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> {{ __('department.create_department') }} </p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="" class="nav-link {{ request()->is('admin/departments/edit') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> {{ __('department.edit_department') }} </p>
                                    </a>
                                </li> --}}

                            </ul>
                        {{-- @endcan --}}

                    </li>
                @endcan
                @can('Admin_Categories')
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
                            <i class="fas fa-tags nav-icon"></i>
                            <p>
                                {{ __('category.categories') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        {{-- @can('Edit_Admin_Settings') --}}
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.categories') }}" class="nav-link {{ request()->is('admin/categories') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> {{ __('category.categories') }} </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.categories.create') }}" class="nav-link {{ request()->is('admin/categories/create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> {{ __('category.create_category') }} </p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="" class="nav-link {{ request()->is('admin/categories/edit') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> {{ __('category.edit_category') }} </p>
                                    </a>
                                </li> --}}

                            </ul>
                        {{-- @endcan --}}

                    </li>
                @endcan
                @can('Admin_Categories')
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}">
                            <i class="fas fa-list nav-icon"></i>
                            <p>
                                {{ __('products.products') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.products') }}" class="nav-link {{ request()->is('admin/products') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> {{ __('products.products') }} </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.products.store') }}" class="nav-link {{ request()->is('admin/products/create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> {{ __('products.create_product') }} </p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="" class="nav-link {{ request()->is('admin/categories/edit') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> {{ __('category.edit_category') }} </p>
                                    </a>
                                </li> --}}

                            </ul>
                        {{-- @endcan --}}

                    </li>
                @endcan
                
                    <li class="nav-item has-treeview">
                        <a href="{{ route('admin.orders') }}" class="nav-link {{ request()->is('admin/orders*') ? 'active' : '' }}">
                            <i class="fas fa-list nav-icon"></i>
                            <p>
                                {{ __('order.orders') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                     

                    </li>
                    
                @can('Admin_Pages')
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link {{ request()->is('admin/pages*') ? 'active' : '' }}">
                            <i class="fas fa-file-alt nav-icon"></i>
                            <p>
                                {{ __('page.pages') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        {{-- @can('Edit_Admin_Settings') --}}
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.pages') }}" class="nav-link {{ request()->is('admin/pages') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> {{ __('page.pages') }} </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.pages.create') }}" class="nav-link {{ request()->is('admin/pages/create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> {{ __('page.page_create') }} </p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="" class="nav-link {{ request()->is('admin/pages/edit') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> {{ __('page.edit_page') }} </p>
                                    </a>
                                </li> --}}

                            </ul>
                        {{-- @endcan --}}

                    </li>
                @endcan
                {{-- @can('Admin_Pages') --}}
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link {{ request()->is('admin/posts*') ? 'active' : '' }}">
                            <i class="fas fa-file-alt nav-icon"></i>
                            <p>
                                {{ __('posts.posts') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        {{-- @can('Edit_Admin_Settings') --}}
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.posts') }}" class="nav-link {{ request()->is('admin/posts') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> {{ __('posts.posts') }} </p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="{{ route('admin.pages.create') }}" class="nav-link {{ request()->is('admin/pages/create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> {{ __('page.page_create') }} </p>
                                    </a>
                                </li> --}}
                                {{-- <li class="nav-item">
                                    <a href="" class="nav-link {{ request()->is('admin/pages/edit') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> {{ __('page.edit_page') }} </p>
                                    </a>
                                </li> --}}

                            </ul>
                        {{-- @endcan --}}

                    </li>
                {{-- @endcan --}}
                    <li class="nav-item has-treeview">
                        <a href="{{ route('admin.inputs') }}" class="nav-link {{ request()->is('admin/inputs*') ? 'active' : '' }}">
                            <i class="fas fa-file-alt nav-icon"></i>
                            <p>
                                {{ __('department.inputs') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                 

                    </li>

                @can('Admin_Settings')
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                {{ __('settings.settings') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        @can('Edit_Admin_Settings')
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->is('admin/settings') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> {{ __('settings.settings') }} </p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="" class="nav-link {{ request()->is('admin/settings/edit') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> {{ __('settings.edit_settings') }} </p>
                                    </a>
                                </li> --}}

                            </ul>
                        @endcan

                    </li>
                @endcan





                





                <li class="nav-item has-treeview">
                    <a href="{{ url('/') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            {{ __('general.Front_Office') }}
                            {{-- <i class="right fas fa-angle-left"></i> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            {{ __('general.Logout') }}
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
