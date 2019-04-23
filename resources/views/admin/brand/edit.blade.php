@extends('layouts.backend.app')

@section('title','Brand')

@push('css')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('public/assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/backend/css/image.css') }}" rel="stylesheet">


@endpush

@section('content')
    <div class="container-fluid">

        <!-- Vertical Layout | With Floating Label -->
        <form action="{{ route('admin.brand.update',$brand->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EDIT BRAND
                            </h2>

                        </div>
                        <div class="body">

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="name" class="form-control" name="name" value="{{ $brand->name }}">
                                    <label class="form-label">Brand Name</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="brand_link" class="form-control" name="brand_link" value="{{ $brand->brand_link }}">
                                    <label class="form-label">Brand URL</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="publish" class="filled-in" name="status"  {{ $brand->status == true ? 'checked' : '' }}>
                                <label for="publish">Status</label>
                            </div>

                            <a class="btn btn-danger btn-xs m-t-15 waves-effect" href="{{ route('admin.brand.index') }}"><i class="material-icons">reply_all</i> Back</a>
                            <button type="submit" class="btn btn-primary btn-xs m-t-15 waves-effect"><i class="material-icons">save</i> Update</button>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header text-center">
                            <h2 >
                                Featured Image
                            </h2>

                        </div>
                        <div class="body" style="padding-top: 0px;">

                            <h5 class="text-center photo-id" >
                                {{ sprintf('%05d',Auth::user()->id) }}
                            </h5>

                            <!-- the avatar markup -->
                            <div id="kv-avatar-errors-1" class="center-block" style="display:none;">

                            </div>

                            <div class="kv-avatar center-block">
                                <input type="file" class="form-control" id="profileImage"  name="image" class="file-loading" style="width:auto;"/>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </form>
        <!-- Vertical Layout | With Floating Label -->

    </div>
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('public/assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('public/assets/backend/js/image.js') }}"></script>

    <!-- TinyMCE -->
    <script src="{{ asset('public/assets/backend/plugins/tinymce/tinymce.js') }}"></script>
    <script>
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = "{{ asset('public/assets/backend/plugins/tinymce') }}";
        });
    </script>
    <script type="text/javascript">


        $("#profileImage").fileinput({
            overwriteInitial: true,
            maxFileSize: 2500,
            showClose: false,
            showCaption: false,
            browseLabel: '',
            removeLabel: '',
            browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
            removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-1',
            msgErrorClass: 'alert alert-block alert-danger',
            defaultPreviewContent: '<img src="{{ asset( 'public/images/brands/small/'.$brand->image )}}" alt="Profile Image" style="width:100%;">',
            layoutTemplates: {main2: '{preview} {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
        });

    </script>

@endpush