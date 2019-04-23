@extends('layouts.backend.app')

@section('title','Career')

@push('css')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('public/assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/backend/css/image.css') }}" rel="stylesheet">


@endpush

@section('content')
    <div class="container-fluid">

        <!-- Vertical Layout | With Floating Label -->
        <form action="{{ route('admin.career.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ADD NEW CAREER
                            </h2>

                        </div>
                        <div class="body">

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="title" class="form-control" name="title">
                                    <label class="form-label">Title*</label>
                                </div>
                            </div>

                            <div class="form-group">
                                 <input type="checkbox" id="publish" class="filled-in" name="status" >
                                 <label for="publish">Status</label>
                            </div>


                        </div>
                    </div>
                </div>
             </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Description*
                            </h2>

                        </div>
                        <div class="body">
                            <textarea id="tinymce" name="description"></textarea>

                            <a class="btn btn-danger btn-xs m-t-15 waves-effect" href="{{ route('admin.career.index') }}"><i class="material-icons">reply_all</i> Back</a>
                            <button type="submit" class="btn btn-primary btn-xs m-t-15 waves-effect"><i class="material-icons">save</i> Save</button>
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


@endpush