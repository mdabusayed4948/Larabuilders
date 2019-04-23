@extends('layouts.backend.app')

@section('title','Media')

@push('css')

    <!-- Light Gallery Plugin Css -->
    <link href="{{ asset('public/assets/backend/plugins/light-gallery/css/lightgallery.css') }}" rel="stylesheet">

@endpush

@section('content')
    <div class="container-fluid">
        <!-- Image Gallery -->
        <div class="block-header">
            <h2>
                MEDIA GALLERY
            </h2>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            GALLERY
                            <span class="badge bg-blue">{{ $medias->count() }}</span>
                        </h2>

                    </div>
                    <div class="body">
                        <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                            @if($medias->count() > 0)

                                @foreach($medias as $key => $media)

                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <a href="{{ asset( 'public/images/photo/media/large/'.$media->image )}}" data-sub-html="{{ $media->photo->title }}">
                                            <img class="img-responsive thumbnail" src="{{ asset( 'public/images/photo/media/small/'.$media->image )}}">
                                        </a>
                                    </div>

                                @endforeach
                            @else
                                <div class="jumbotron jumbotron-fluid">
                                    <div class="container">
                                        <h2 class="display-4 text-center"> <small>Please Add Media Gallery</small></h2>

                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <!-- Light Gallery Plugin Js -->
    <script src="{{ asset('public/assets/backend/plugins/light-gallery/js/lightgallery-all.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('public/assets/backend/js/pages/medias/image-gallery.js') }}"></script>


@endpush