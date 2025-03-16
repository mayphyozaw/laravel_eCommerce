@extends('layout.master')
@section('banner-text', 'About Us')
@section('content')
    <section class="about__Section section--padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="about__thumbnail padding__left position-relative">
                        <img src="{{ asset('web_assets/assets/img/other/about.webp') }}" alt="img">
                        <div class="about__experience--text text-center">
                            <span class="about__experience--years"><span
                                    class="about__experience--years__inner">3</span>+</span>
                            <span class="about__experience--title">YEARS
                                EXPERIENCE</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="about__content padding__left">
                        <h3 class="about__content--subtitle">About</h3>
                        <h2 class="about__content--title">Curated by color</h2>
                        <p class="about__content--desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
                        <a class="about__conten--btn primary__btn" href="about.html">VIEW MORE</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
