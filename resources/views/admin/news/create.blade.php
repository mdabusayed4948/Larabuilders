@extends('layouts.backend.app')

@section('title','News')

@push('css')
    <!-- Bootstrap Material Datetime Picker Css -->
   <!-- Bootstrap Select Css -->
    <link href="{{ asset('public/assets/backend/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />

@endpush

@section('content')
    <div class="container-fluid">

        <!-- Vertical Layout | With Floating Label -->
        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ADD NEW NEWS
                            </h2>

                        </div>
                        <div class="body">

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="title" class="form-control" name="title">
                                    <label class="form-label">News Title</label>
                                </div>
                            </div>
                             <div class="form-group">
                                 <div class="form-line">
                                     <input type="text" name="news_date" id="news_date" class="datetimepicker form-control" placeholder="Please choose date &amp; time..." >
                                 </div>
                             </div>

                            <div class="form-group">
                                <input type="checkbox" id="publish" class="filled-in" name="status" >
                                <label for="publish">Status</label>
                            </div>

                            <div class="form-group">
                                <h5>
                                    Description
                                </h5>
                                <textarea id="tinymce" name="description"></textarea>
                             </div>

                            <a class="btn btn-danger btn-xs m-t-15 waves-effect" href="{{ route('admin.news.index') }}"><i class="material-icons">reply_all</i> Back</a>
                            <button type="submit" class="btn btn-primary btn-xs m-t-15 waves-effect"><i class="material-icons">save</i> Save</button>


                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card ">
                        <div class="header text-center">
                            <h2 >
                                Featured Image
                            </h2>

                        </div>
                        <div class="body" style="padding-top: 0px;">
                            <h5 class="text-center photo-id" >
                                {{ sprintf('%05d',$news_id+1) }}
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
    <!-- Moment Plugin Js -->
    <script src="{{ asset('public/assets/backend/plugins/momentjs/moment.js') }}"></script>

    <!-- Moment Plugin Js -->
    <script src="{{ asset('public/assets/backend/plugins/momentjs/moment.js') }}"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('public/assets/backend/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>


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
            defaultPreviewContent: '<img src="{{ asset( 'public/images/default/logo.png' ) }}" alt="Profile Image" style="width:100%;">',
            layoutTemplates: {main2: '{preview} {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
        });

    </script>

    <script>
        $('.datetimepicker').bootstrapMaterialDatePicker({
            format : 'YYYY-MM-DD HH:mm',
            clearButton: true
        });
    </script>


@endpush