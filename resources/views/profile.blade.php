@extends('layout.master')
@section('banner-text', 'Profile')
@section('content')
    <div id="root"></div>
@endsection

@section('script')
    <script src="{{ mix('js/profile.js') }}"></script>
@endsection
