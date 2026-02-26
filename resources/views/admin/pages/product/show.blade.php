@extends('admin.index')

@section('page-title', 'Detail Produk')

@section('custom-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/src/plugins/slick/slick.css') }}">
@endsection

@section('page-content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title">
                        <h4>Detail Produk</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.product') }}">Produk</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detail Produk</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="product-wrap">
            <div class="product-detail-wrap mb-30">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="product-slider slider-arrow">
                            @foreach ($product->productImage as $productImage)
                                <div class="product-slide"
                                    style="max-height: 420px; display: flex; justify-content: center; align-items: center;">
                                    <img src="{{ asset('storage/' . $productImage->image_path) }}"
                                        alt="{{ $product->name }}">
                                </div>
                            @endforeach
                        </div>
                        <div class="product-slider-nav">
                            @foreach ($product->productImage as $productImage)
                                <div class="product-slide-nav"
                                    style="max-height: 120px; display: flex; justify-content: center; align-items: center;">
                                    <img src="{{ asset('storage/' . $productImage->image_path) }}"
                                        alt="{{ $product->name }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="product-detail-desc pd-20 card-box height-100-p">
                            <h4 class="mb-20 pt-20">{{ $product->name }}</h4>
                            <p>{{ $product->description }}</p>
                            <div class="price">
                                SKU : {{ $product->sku ?? '-' }}
                            </div>
                            <div class="price">
                                Stok : {{ $product->stock }}
                            </div>
                            <div class="price">
                                Harga :
                                @if ($product->discount_percent)
                                    <del>{{ $product->formatted_price }}</del>
                                    <ins>{{ $product->formatted_final_price }}</ins>
                                    <ins style="color: red;">({{ $product->discount_percent }}% OFF)</ins>
                                @else
                                    {{ $product->formatted_price }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')
    <script src="{{ asset('assets/admin/src/plugins/slick/slick.min.js') }}"></script>
    <!-- bootstrap-touchspin js -->
    <script src="{{ asset('assets/admin/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery('.product-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                infinite: true,
                speed: 1000,
                fade: true,
                asNavFor: '.product-slider-nav'
            });
            jQuery('.product-slider-nav').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                asNavFor: '.product-slider',
                dots: false,
                infinite: true,
                arrows: false,
                speed: 1000,
                centerMode: true,
                focusOnSelect: true
            });
            $("input[name='demo3_22']").TouchSpin({
                initval: 1
            });
        });
    </script>
@endsection
