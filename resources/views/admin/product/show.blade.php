@extends('layouts.backend.app')

@section('title','Product')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">

        <!-- Vertical Layout | With Floating Label -->
        <a href="{{ route('admin.product.index') }}" class="btn btn-danger btn-xs waves-effect"><i class="material-icons">reply_all</i> BACK</a>

        <br>
        <br>
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <table class="table table-hover  table-responsive ">
                        <tr>
                            <th><strong>Product Name</strong></th>
                            <th>:</th>
                            <td><p> {{ $product->name }} </p> </td>
                        </tr>
                        <tr>
                            <th><strong> Created At</strong></th>
                            <th>:</th>
                            <td><p> {{ $product->created_at->toFormattedDateString() }} </p> </td>
                        </tr>
                        <tr>
                            <th><strong>Updated At</strong></th>
                            <th>:</th>
                            <td><p> {{ $product->updated_at->toFormattedDateString() }} </p> </td>
                        </tr>
                        <tr>
                            <th><strong>Status</strong></th>
                            <th>:</th>
                            <td>
                                <p>
                                    @if($product->status == true)
                                        <span class="badge bg-blue">Published</span>
                                    @else
                                        <span class="badge bg-pink">Pending</span>

                                    @endif
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th><strong>Short Description</strong></th>
                            <th>:</th>
                            <td><p> {{ $product->short_description }} </p> </td>
                        </tr>
                        <tr>
                            <th><strong> Description</strong></th>
                            <th>:</th>
                            <td><p>  {!! $product->description !!} </p> </td>
                        </tr>

                    </table>

                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">

                <div class="card">
                    <div class="header">
                        <h2 class="text-center">
                            Featured Image
                        </h2>

                    </div>
                    <div class="body">
                        <img class="img-responsive thumbnail" src="{{ asset( 'public/images/products/small/'.$product->image )}}"/>
                    </div>
                </div>

            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->

    </div>
@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.3/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">

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
            tinyMCE.baseURL = "{{ asset('assets/backend/plugins/tinymce') }}";
        });


    </script>


@endpush