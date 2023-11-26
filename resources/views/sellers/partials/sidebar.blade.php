<div class="main-menu menu-fixed menu-accordion menu-shadow {{ user_option('theme_color') == 'light' ? 'menu-light' : 'menu-dark' }}" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ Route::has('front.index') ? route('front.index') : url('/') }}" target="_blank">
                    <h2 class="brand-text mb-0">{{ option('info_site_title', 'لاراول شاپ') }}</h2>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="{{ active_class('sellers.dashboard') }} nav-item">
                <a href="{{ route('sellers.dashboard') }}">
                    <i class="feather icon-home"></i>
                    <span class="menu-title">داشبورد</span>
                </a>
            </li>

            @if(auth('sellers')->user())
                <li class="nav-item has-sub {{ open_class(['admin.products.*', 'admin.brands.*', 'admin.sizetypes.*']) }}">
                    <a href="#"><i class="feather icon-shopping-cart"></i><span class="menu-title"> محصولات</span></a>
                    <ul class="menu-content">

                        <li class="{{ active_class('sellers.products.index') }}">
                            <a href="{{ route('products.index') }}"><i class="feather icon-circle"></i><span class="menu-item"> لیست محصولات شما</span></a>
                        </li>

                        <li class="{{ active_class('sellers.products.create') }}">
                            <a href="{{ route('products.create') }}"><i class="feather icon-circle"></i><span class="menu-item">ایجاد محصول</span></a>
                        </li>






{{--                        <li class="{{ active_class('admin.stock-notifies.index') }}">--}}
{{--                            <a href="{{ route('admin.stock-notifies.index') }}"><i class="feather icon-circle"></i><span class="menu-item">لیست اطلاع از موجودی</span></a>--}}
{{--                        </li>--}}

                        <li class="{{ active_class('sellers.product.prices.index') }}">
                            <a href="{{ route('sellers.product.prices.index') }}"><i class="feather icon-circle"></i><span class="menu-item">قیمت ها</span></a>
                        </li>

{{--                        <li class="{{ open_class(['admin.brands.*']) }}">--}}
{{--                            <a href="#"><i class="feather icon-circle"></i><span class="menu-item"> برندها</span></a>--}}
{{--                            <ul class="menu-content">--}}
{{--                                <li class="{{ active_class('admin.brands.index') }}">--}}
{{--                                    <a class="{{ active_class('admin.brands.index') }}" href="{{ route('admin.brands.index') }}"><i class="feather icon-circle"></i><span class="menu-item">لیست برندها</span></a>--}}
{{--                                </li>--}}
{{--                                <li class="{{ active_class('admin.brands.create') }}">--}}
{{--                                    <a class="{{ active_class('admin.brands.create') }}" href="{{ route('admin.brands.create') }}"><i class="feather icon-circle"></i><span class="menu-item">ایجاد برند</span></a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}

{{--                        <li class="{{ open_class(['admin.attributeGroups.*']) }}">--}}
{{--                            <a href="#"><i class="feather icon-circle"></i><span class="menu-item"> ویژگی ها</span></a>--}}
{{--                            <ul class="menu-content">--}}
{{--                                <li class="{{ active_class('admin.attributeGroups.index') }}">--}}
{{--                                    <a class="{{ active_class('admin.attributeGroups.index') }}" href="{{ route('admin.attributeGroups.index') }}"><i class="feather icon-circle"></i><span class="menu-item">لیست گروه ویژگی ها</span></a>--}}
{{--                                </li>--}}
{{--                                <li class="{{ active_class('admin.attributeGroups.create') }}">--}}
{{--                                    <a class="{{ active_class('admin.attributeGroups.create') }}" href="{{ route('admin.attributeGroups.create') }}"><i class="feather icon-circle"></i><span class="menu-item">ایجاد گروه ویژگی</span></a>--}}
{{--                                </li>--}}
{{--                                <li class="{{ active_class('admin.attributes.create') }}">--}}
{{--                                    <a class="{{ active_class('admin.attributes.create') }}" href="{{ route('admin.attributes.create') }}"><i class="feather icon-circle"></i><span class="menu-item">ایجاد ویژگی</span></a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}

{{--                        <li class="{{ open_class(['admin.filters.*']) }}">--}}
{{--                            <a href="#"><i class="feather icon-circle"></i><span class="menu-item"> فیلترها</span></a>--}}
{{--                            <ul class="menu-content">--}}
{{--                                <li class="{{ active_class('admin.filters.index') }}">--}}
{{--                                    <a class="{{ active_class('admin.filters.index') }}" href="{{ route('admin.filters.index') }}"><i class="feather icon-circle"></i><span class="menu-item">لیست فیلتر ها</span></a>--}}
{{--                                </li>--}}
{{--                                <li class="{{ active_class('admin.filters.create') }}">--}}
{{--                                    <a class="{{ active_class('admin.filters.create') }}" href="{{ route('admin.filters.create') }}"><i class="feather icon-circle"></i><span class="menu-item">ایجاد فیلتر</span></a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}

                    </ul>
                </li>
            @endif

            @if(auth('sellers')->user())
                <li class="nav-item has-sub {{ open_class(['admin.orders.*']) }}">
                    <a href="#"><i class="feather icon-briefcase"></i><span class="menu-title" > سفارشات</span></a>
                    <ul class="menu-content">
                        <li class="{{ active_class('admin.orders.index') }}">
                            <a href="{{ route('admin.orders.index') }}"><i class="feather icon-circle"></i><span class="menu-item">همه سفارشات</span></a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.orders.index') }}?status=paid&shipping_status=pending"><i class="feather icon-circle"></i><span class="menu-item">سفارشات جدید</span></a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.orders.index') }}?status=paid"><i class="feather icon-circle"></i><span class="menu-item">سفارشات پرداخت شده</span></a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.orders.index') }}?status=paid&shipping_status=reserved"><i class="feather icon-circle"></i><span class="menu-item">سفارشات رزرو شده</span></a>
                        </li>
                        <li class="{{ active_class('admin.orders.notCompleted') }}">
                            <a href="{{ route('admin.orders.notCompleted') }}"><i class="feather icon-circle"></i><span class="menu-item"> محصولات منتظر ارسال</span></a>
                        </li>
                        <li class="{{ active_class('admin.orders.create') }}">
                            <a href="{{ route('admin.orders.create') }}"><i class="feather icon-circle"></i><span class="menu-item"> افزودن سفارش</span></a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(auth('sellers')->user())
                <li class="nav-item has-sub">
                    <a href="#"><i class="feather icon-pie-chart"></i><span class="menu-title" >گزارشات</span></a>
                    <ul class="menu-content">
                        <li class="{{ active_class('admin.statistics.orders') }}">
                            <a href="{{ route('admin.statistics.orders') }}"><i class="feather icon-circle"></i><span class="menu-item">سفارشات</span></a>
                        </li>
                        <li class="{{ active_class('admin.statistics.views') }}">
                            <a href="{{ route('admin.statistics.views') }}"><i class="feather icon-circle"></i><span class="menu-item">آمار بازدیدها</span></a>
                        </li>
                        <li class="{{ active_class('admin.statistics.viewsList') }}">
                            <a href="{{ route('admin.statistics.viewsList') }}"><i class="feather icon-circle"></i><span class="menu-item">لیست بازدیدها</span></a>
                        </li>
                        <li class="{{ active_class('admin.statistics.viewers') }}">
                            <a href="{{ route('admin.statistics.viewers') }}"><i class="feather icon-circle"></i><span class="menu-item"> بازدید کنندگان امروز</span></a>
                        </li>
                        <li class="{{ active_class('admin.statistics.smsLog') }}">
                            <a href="{{ route('admin.statistics.smsLog') }}"><i class="feather icon-circle"></i><span class="menu-item"> لاگ پیامک های ارسالی</span></a>
                        </li>
                    </ul>
                </li>
            @endif

        </ul>
    </div>
</div>
