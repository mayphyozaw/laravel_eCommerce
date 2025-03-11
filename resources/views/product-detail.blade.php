@extends('layout.master')
@section('banner-text', 'Product Detail')
@section('content')
    <section class="product__details--section  section--padding">
        <div class="container-fluid">
            <div class="row row-md-reverse">
                <div class="col-xl-3 col-lg-3">
                    <div class="shop__sidebar--widget widget__area product_d_widget">
                        <div class="single__widget widget__bg">
                            <h2 class="widget__title h3">All Categories</h2>
                            @foreach ($category as $c)
                                <ul class="widget__categories--menu">
                                    <li class="widget__categories--menu__list">
                                        <a class="widget__categories--sub__menu--link d-flex align-items-center justify-content-between"
                                            href="{{ url('/product?category=' . $c->slug) }}">
                                            <div class="d-flex align-items-center">
                                                <img class="widget__categories--sub__menu--img" src="{{ $c->image_url }}"
                                                    alt="">
                                                <span class="widget__categories--sub__menu--text">{{ $c->name }}</span>
                                            </div>
                                            <span class="badge badge-secondary"
                                                style="font-size: 10px;">{{ $c->product_count }}</span>
                                        </a>
                                    </li>
                                </ul>
                            @endforeach
                        </div>

                        {{-- Brand --}}

                        <div class="single__widget widget__bg">
                            <h2 class="widget__title h3">Brands</h2>

                            <ul class="widget__tagcloud">
                                @foreach ($brand as $b)
                                    <li class="widget__tagcloud--list">
                                        <a class="widget__tagcloud--link" href="">
                                            {{ $b->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                </div>


                {{-- Detail from React --}}
                <div class="col-xl-9 col-lg-8" id="root">
                </div>
            </div>

        </div>

    </section>
@endsection

@section('script')
    <script>
        window.product_slug = "{{ $slug }}";
    </script>
    <script src="{{ mix('js/productDetail.js') }}"></script>
@endsection
