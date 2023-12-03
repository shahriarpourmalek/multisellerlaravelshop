@extends('front::layouts.master', ['title' => 'صفحه محصولات فروشنده '])



@push('before-styles')
    <link rel="stylesheet" href="{{ theme_asset('css/vendor/nouislider.min.css') }}">
@endpush


@section('content')
    <style>
        /* for card */
        .card {
            width: 400px;
            border: none;
            border-radius: 10px;
            background-color: #fff
        }

        .stats {
            background: #f2f5f8 !important;
            color: #000 !important
        }

        .articles {
            font-size: 10px;
            color: #a1aab9
        }

        .number1 {
            font-weight: 500
        }

        .followers {
            font-size: 10px;
            color: #a1aab9
        }

        .number2 {
            font-weight: 500
        }

        .rating {
            font-size: 10px;
            color: #a1aab9
        }

        .number3 {
            font-weight: 500
        }
        /* for card end*/
        svg.placeholder {
            max-width: 100%;
            background: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAzMiAzMiIgd2lkdGg9IjMyIiBoZWlnaHQ9IjMyIiBmaWxsPSJ3aGl0ZSI+CiAgPHBhdGggZD0iTTAgNCBMMCAyOCBMMzIgMjggTDMyIDQgeiBNNCAyNCBMMTAgMTAgTDE1IDE4IEwxOCAxNCBMMjQgMjR6IE0yNSA3IEE0IDQgMCAwIDEgMjUgMTUgQTQgNCAwIDAgMSAyNSA3Ij48L3BhdGg+Cjwvc3ZnPg==") no-repeat center hsl(0, 0%, 80%);
            background-size: calc(100%/3);
        }

        .ph-circle {
            border-radius: 100%;
        }

        span.placeholder,
        span.placeholder a {
            background: hsl(0, 0%, 80%);
            color: hsl(0, 0%, 80%);
        }

        button span.placeholder,
        button span.placeholder a {
            background: hsl(0, 0%, 100%);
            color: hsl(0, 0%, 100%);
        }

        button {
            background: hsl(0, 0%, 60%);
            padding: 1em;
            border: 0;
            border-radius: 2px;
            color: white;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: .1em;
            font-size: .8rem;
        }

        hr.placeholder {
            border: 0;
            height: .25em;
            background: hsla(0, 0%, 80%, .25);
            margin: 2rem 0;
        }


        /* Testing broken image style */

        img {
            font-family: inherit;
            text-align: center;
            width: 100%;
            height: auto;
            display: block;
            position: relative;
        }

        img.broken-3 {
            position: relative;
            min-height: 50px;
        }

        img.broken-3:before {
            content: " ";
            display: block;
            position: absolute;
            top: -10px;
            left: 0;
            height: calc(100% + 10px);
            width: 100%;
            background-color: silver;
        }

        img.broken-3:after {
            content: "\f127" " Broken Image (" attr(alt) ")";
            display: block;
            font-family: FontAwesome;
            color: white;
            position: absolute;
            top: 5px;
            left: 0;
            width: 100%;
            text-align: center;
        }
    </style>
{{--    {{dd($seller)}}--}}
<!-- for card -->

<!-- for card end-->
    <!-- Start main-content -->

    <main class="main-content dt-sl mt-4 mb-3">
        <div class="container main-container">


            <div class="row">



                <div id="category-products-div" data-action="{{ route('front.products.seller-products',  $seller) }}" class=" col-md-12 col-sm-12">
                    @if($products->count())
                        <div class="dt-sl dt-sn px-0 search-amazing-tab">
                            <div class="card p-3 w-100">
                                <div class="d-flex flex-column flex-sm-row">
                                    <div class="image ml-sm-3 mb-3 mb-sm-0 col-12 col-sm-3">
                                        @if($seller->image)
                                            <img class="" src="{{$seller->image}}" class="rounded" width="100%" style='object-fit: cover'>


                                            @else


                                        <svg class="placeholder " width="100%" height="150px"></svg>
                                        @endif
                                    </div>
                                    <div class="ml-3 w-100">
                                        <h4 class="mb-0 mt-0">{{$seller->seller_name}}</h4>
                                        <div class="p-2 mt-2 bg-primary d-flex justify-content-between rounded text-white stats">
                                            {{$seller->bio}}
                                             </div>
{{--                                        <div class="button mt-2 d-flex flex-row align-items-center">--}}

{{--                                            {{$seller->created_at}}--}}


{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>


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
