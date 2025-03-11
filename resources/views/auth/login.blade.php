@extends('layout.master')
@section('banner-text', 'Login')

@section('content')
    <div class="login__section section--padding">
        <div class="container">

            <div class="login__section--inner">
                <div class="row row-cols-md-2 row-cols-1 justify-content-center">

                    <div class="col">
                        <div class="account__login register">
                            <div class="account__login--header mb-25 text-center">
                                <h2 class="account__login--header__title mb-15">Login</h2>
                                <p class="account__login--header__desc">Login if you are a returning customer.</p>
                            </div>
                            <form action="{{ route('userPostLogin') }}" method="post">
                                @csrf
                                <div class="account__login--inner">

                                    <label style="display:block;font-size: 14px;" for="">
                                        <input class="account__login--input" name="email" type="email"
                                            placeholder="Enter Email">
                                    </label>
                                    <label style="display:block;font-size: 14px;" for="">
                                        <input class="account__login--input" name="password" type="password"
                                            placeholder="Enter Password">
                                    </label>



                                    <input type="submit" class="account__login--btn primary__btn mb-10" value="Login">

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
