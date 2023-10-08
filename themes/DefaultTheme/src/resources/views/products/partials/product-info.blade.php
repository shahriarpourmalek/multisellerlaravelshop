<!-- Product Info -->
<div class="col-lg-8 mt-3 col-md-12 pb-5 product-info-block">
    <div class="product-info dt-sl">
        <div class="product-title">
            <h1>{{ $product->title }}</h1>
            <h3 class="mb-1">{{ $product->title_en }}</h3>
        </div>

        <div class="row pt-2">
            <div class="col-md-7 col-lg-7">
                <hr class="border-product-title">
                <div class="row mt-2">
                    @if ($product->rating)
                        <div class="col-12 d-flex">
                            <div class="d-flex">
                                <i class="mdi mdi mdi-star text-warning mx-0"></i>
                                <p class="mx-1 mb-2">{{ $product->rating }}</p>
                                <p class="mx-1 mb-2 text-muted">({{ $product->reviews_count }})</p>
                            </div>
                            <div class="d-flex">
                                <p class="text-primary font-weight-bold mx-2 mb-2">{{ trans('front::messages.products.review') }} {{ $product->reviews_count }}</p>
                                <p class="text-primary font-weight-bold mx-2 mb-2">{{ trans('front::messages.products.comment-count') }} {{ $product->comments()->accepted()->count() }}</p>
                            </div>
                        </div>
                    @endif

                    @if ($product->suggestionCount())
                        <div class="col-12 d-flex">
                            <i class="mdi mdi mdi-thumb-up-outline text-success mx-0"></i>
                            <p class="text-muted commodity mx-2"> <span>{{ $product->suggestionPercent() }}%</span>({{ $product->suggestionCount() }}) نفر از خریداران این کالا را پیشنهاد کردن </p>
                        </div>
                    @endif
                </div>
                @if ($product->short_description)
                    <p class="little-des pt-0 mt-0">{!! nl2br($product->short_description) !!}</p>
                @endif

                @php
                    $specialSpecifications = $product->specialSpecifications();
                @endphp

                @if ($specialSpecifications->count())
                    <div class="product-params dt-sl">
                        <ul class="mt-0"
                            data-title=" {{ trans('front::messages.products.product-features') }}">
                            @foreach ($specialSpecifications as $specification)
                                <li>
                                    <span>{{ $specification->name }}: </span>
                                    <span> {{ $specification->pivot->value }} </span>
                                </li>
                            @endforeach
                        </ul>
                        @if ($specialSpecifications->count() > 2)
                            <div class="sum-more">
                                <span class="show-more btn-link-border">
                                    {{ trans('front::messages.products.more-items') }}
                                </span>
                                <span class="show-less btn-link-border">
                                    {{ trans('front::messages.products.to-close') }}

                                </span>
                            </div>
                        @endif
                    </div>
                @endif

                @if ($product->brand)
                    <div class="d-block mb-2">
                        <span class="font-weight-bold">{{ trans('front::messages.products.brand') }}:</span>
                        <a href="{{ route('front.brands.show', ['brand' => $product->brand]) }}" class="link--with-border-bottom">{{ $product->brand->name }}</a>
                    </div>
                @endif

                @if ($product->sizeType)
                    <div class="mt-3 size-guide">
                        <img src="{{ theme_asset('img/size.png') }}" alt="size">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#size-modal" class="mt-4 link--with-border-bottom">راهنمای سایزبندی</a>
                    </div>
                @endif
            </div>


            <div class="col-xl-4 col-md-5 col-sm-8 mx-sm-auto mx-0">

                @if ($product->labels->count())
                    <div class="row mr-1 mb-2">
                        <div class="btn-group" role="group">
                            @foreach ($product->labels as $label)
                                <span class="btn-border badge text-white ml-1 bg-primary">{{ $label->title }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($product->isPhysical())
                    <div class="card box-card px-3 pb-3 pt-0">
                        <div class="box-border"></div>

                        @if ($product->getPrices->count())

                            @php
                                $prev_attribute = null;
                                $groups = null;
                                $attributes_id = [];
                                $group_loop = 0;
                            @endphp

                            @foreach ($attributeGroups as $attributeGroup)
                                @if ($product->get_attributes($attributeGroup, $prev_attribute, $groups, $attributes_id))
                                    @php
                                        $checked = false;
                                        $group_checked = false;
                                        $prev_selected_attr = $attributes_id;
                                    @endphp


                                    <div class="product-variant dt-sl {{ $attributeGroup->type == 'color' ? 'product-variant-color' : '' }}">
                                        <div class="section-title d-flex align-items-baseline text-sm-title no-after-title-wide mb-1">
                                            <span class="mdi mdi-checkbox-blank-circle-outline"></span>
                                            <h2 class=" mb-0 mx-1 d-block">{{ $attributeGroup->name }}: <span id="attributeGroup-{{ $attributeGroup->id }}"></span></h2>
                                        </div>
                                        <ul class="product-variants float-right ml-3">
                                            @foreach ($product->get_attributes($attributeGroup, $prev_attribute, $groups, $attributes_id) as $attribute)
                                                @php

                                                    if ($group_loop != 0 && count($prev_selected_attr)) {
                                                        $has_stock = $product->hasAttributeStock($attribute, $prev_selected_attr);
                                                    } else {
                                                        $has_stock = $product->hasAttributeStock($attribute);
                                                    }

                                                    if ($selected_price->get_attributes()->find($attribute->id)) {
                                                        $checked = true;
                                                        $prev_attribute = $attribute;
                                                        $attributes_id[] = $attribute->id;
                                                        $group_checked = true;
                                                    } else {
                                                        $checked = false;
                                                    }

                                                    if ($loop->last && $checked == false && $group_checked == false) {
                                                        $checked = true;
                                                        $prev_attribute = $attribute;
                                                        $attributes_id[] = $attribute->id;
                                                    }

                                                @endphp

                                                <li class="ui-variant product-attribute {{ $has_stock ? '' : 'unavailable' }}" title="{{ $has_stock ? '' : 'ناموجود' }}">
                                                    <label class="ui-variant mb-0 {{ $attributeGroup->type == 'color' ? 'ui-variant--color' : '' }}">

                                                        @if ($attributeGroup->type == 'color')
                                                            <span data-group-id="attributeGroup-{{ $attributeGroup->id }}" data-name="{{ $attribute->name }}" data-container="body" data-toggle="popover" data-placement="bottom"  data-trigger="hover" class="ui-variant-shape" style="background-color: {{ $attribute->value }}" {{ $checked ? 'checked' : '' }}></span>
                                                        @endif

                                                        <input data-product="{{ $product->slug }}" type="radio"
                                                            value="{{ $attribute->id }}"
                                                            name="attributes_group[{{ $loop->parent->iteration }}][]"
                                                            class="variant-selector" {{ $checked ? 'checked' : '' }} {{ $has_stock ? '' : 'disabled' }}>

                                                            <div class="ui-variant--check" >
                                                                <span  {{ $attributeGroup->type != 'color' ? 'product-warranty-span' : '' }}>{{ $attributeGroup->type != 'color' ? $attribute->name : '' }}</span>
                                                            </div>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    @php
                                        $groups[] = $attributeGroup;
                                        $group_loop++;
                                    @endphp
                                @endif
                            @endforeach

                            @php
                                $selected_price = $product->getPriceWithAttributes($attributes_id);
                            @endphp

                        @endif

                        <div class="dt-sl box-Price-number box-margin">
                            @if ($product->addableToCart())
                                <div class="mb-2 d-flex ">
                                    <span class="flex-grow-1 number">{{ $product->getUnit() }}</span>
                                    <div class="flex-grow-1 text-centertext-price d-flex align-items-center">
                                        <div class="number-input">
                                            <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></button>
                                            <input id="cart-quantity" class="quantity"
                                                min="{{ cart_min($selected_price) }}"
                                                max="{{ cart_max($selected_price) }}"
                                                value="{{ cart_min($selected_price) }}" type="number" required>
                                            <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="section-title text-sm-title no-after-title-wide mb-0 dt-sl">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between mt-4">
                                            <div class="text-price d-flex align-items-center">
                                                {{ trans('front::messages.products.price') }}
                                                </div>
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-end">
                                                    @if ($selected_price->hasDiscount())
                                                        <del>
                                                            {{ number_format($selected_price->regularPrice()) }}
                                                        </del>
                                                        <div class="discount show-discount mr-3 ">
                                                            <span>{{ $selected_price->discount() }}%</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-12 text-left">
                                                    <span class="price text-danger">
                                                        {{ trans('front::messages.currency.prefix') }}
                                                        {{ number_format($selected_price->salePrice()) }}
                                                    </span>
                                                    <span class="currency">
                                                        {{ trans('front::messages.currency.suffix') }}
                                                    </span>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <button data-price_id="{{ $selected_price->id }}"
                                    data-action="{{ route('front.cart.store', ['product' => $product]) }}"
                                    data-product="{{ $product->slug }}" type="button"
                                    class=" mt-4 w-100 btn-primary-cm btn-with-icon add-to-cart btn-show-product">
                                    {{ trans('front::messages.products.add-to-cart') }}
                                </button>
                            @elseif (!$product->addableToCart())
                                <div class="infoSection">
                                    <div class="box-product-unavailable">
                                        <div class="unavailable d-flex justify-content-center">
                                            <h5 class="">{{ trans('front::messages.products.unavailable') }}</h5>
                                        </div>
                                        <p class="text-justify">{{ trans('front::messages.products.text-unavailable') }}</p>
                                    </div>
                                    <div class="text-center">
                                        <button id="stock_notify_btn" data-user="{{ auth()->check() ? auth()->user()->id : '' }}"
                                            data-product="{{ $product->id }}" type="button"
                                            class="btn-primary-cm bg-secondary btn-with-icon cart-not-available ">
                                            <i class="mdi mdi-information"></i>
                                            {{ trans('front::messages.products.let-me-know') }}
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
