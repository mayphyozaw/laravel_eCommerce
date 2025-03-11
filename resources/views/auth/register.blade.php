@extends('layout.master')
@section('content')
    <div class="login__section section--padding">
        <div class="container">

            <div class="login__section--inner">
                <div class="row row-cols-md-2 row-cols-1 justify-content-center">

                    <div class="col">
                        <div class="account__login register">
                            <div class="account__login--header mb-25 text-center">
                                <h2 class="account__login--header__title mb-15">Create an Account</h2>
                                <p class="account__login--header__desc">Register here if you are a new customer</p>
                            </div>
                            <form action="{{ route('register') }}" enctype="multipart/form-data" method="post"
                                class="form-group">
                                @csrf
                                <div class="account__login--inner">
                                    <label style="display:block;font-size: 14px;" for="">
                                        Enter Name
                                        <input class="account__login--input" type="text" name="name"
                                            style="height:35px;">
                                    </label>
                                    <label style="display:block;font-size: 14px;" for="">
                                        Enter Email
                                        <input class="account__login--input" name="email" type="email"
                                            style="height:35px;">
                                    </label>
                                    <label style="display:block;font-size: 14px;" for="">
                                        Enter Password
                                        <input class="account__login--input" name="password" type="password"
                                            style="height:35px;">
                                    </label>

                                    <label style="display:block;font-size: 14px;" for="">
                                        Enter Image
                                    </label>
                                    <input class="account__login--input form-control" name="image" type="file"
                                        style="height:35px;">

                                    <label style="display:block;font-size: 14px;" for="">
                                        Enter Phone
                                        <input class="account__login--input" name="phone" type="number"
                                            style="height:35px;">
                                    </label>
                                    <label style="display:block;font-size: 14px;" for="">
                                        Enter Address
                                        <textarea name="address" id="" cols="30" rows="10" class="account__login--input"></textarea>
                                    </label>

                                    <input type="submit" class="account__login--btn primary__btn mb-10" value="Register">

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
