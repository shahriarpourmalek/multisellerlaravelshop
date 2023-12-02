@extends('front::layouts.master', ['title' => 'صفحه محصولات فروشنده '])



@push('befor-styles')
    <link rel="stylesheet" href="{{ theme_asset('css/vendor/nouislider.min.css') }}">
@endpush


@section('content')

    <!-- Start main-content -->
    <main class="main-content dt-sl mt-4 mb-3">
        <div class="container main-container">


            <div class="row">


                <div id="category-products-div" data-action="{{ route('front.products.seller-products',  $seller) }}" class=" col-md-12 col-sm-12">
                    @if($products->count())
                        <div class="dt-sl dt-sn px-0 search-amazing-tab">



                            <div class="row mb-3 mx-0 px-res-0">
                                @foreach($products as $product)

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 px-10 mb-1 px-res-0 category-product-div">
                                        @include('front::products.partials.product-card', ['product' => $product])
                                    </div>

                                @endforeach
                            </div>

                            {{ $products->appends(request()->all())->links('front::components.paginate') }}
                        </div>
                    @else
                        @include('front::partials.empty')
                    @endif
                </div>
            </div>



        </div>
    </main>
    <!-- End main-content -->
@endsection

@push('scripts')



    <script src="{{ theme_asset('js/pages/products/category.js') }}?v=6"></script>
    <script src="{{ theme_asset('js/vendor/nouislider.min.js') }}"></script>
    <script src="{{ theme_asset('js/vendor/wNumb.js') }}"></script>
    <script src="{{ theme_asset('js/vendor/ResizeSensor.min.js') }}"></script>
@endpush
