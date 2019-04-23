@extends("layouts.frontend.app")
@section("title","Personal")
@push('css')

    <link href="{{ asset('assets/frontend/css/home/styles.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/frontend/css/home/responsive.css') }}" rel="stylesheet">
    <style rel="stylesheet">
        .favorite_posts{
            color: blue;
        }
    </style>
@endpush

@section("content")

@endsection

@push('js')


@endpush