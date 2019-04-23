@extends('layouts.backend.app')

@section('title','Career')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">

        <!-- Vertical Layout | With Floating Label -->
        <a href="{{ route('admin.career.index') }}" class="btn btn-danger btn-xs waves-effect"><i class="material-icons">reply_all</i> BACK</a>

        <br>
        <br>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <table class="table table-hover  table-responsive ">
                        <tr>
                            <th><strong> Title</strong></th>
                            <th>:</th>
                            <td><p> {{ $career->title }} </p> </td>
                        </tr>
                        <tr>
                            <th><strong> Created At</strong></th>
                            <th>:</th>
                            <td><p> {{ $career->created_at->toFormattedDateString() }} </p> </td>
                        </tr>
                        <tr>
                            <th><strong>Updated At</strong></th>
                            <th>:</th>
                            <td><p> {{ $career->updated_at->toFormattedDateString() }} </p> </td>
                        </tr>
                        <tr>
                            <th><strong>Status</strong></th>
                            <th>:</th>
                            <td>
                                <p>
                                    @if($career->status == true)
                                        <span class="badge bg-blue">Published</span>
                                    @else
                                        <span class="badge bg-pink">Pending</span>

                                    @endif
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <th><strong> Description</strong></th>
                            <th>:</th>
                            <td><p>  {!! $career->description !!} </p> </td>
                        </tr>

                    </table>

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

        function approvePost(id) {
            swal({
                title: 'Are you sure?',
                text: "You went to approve this post !",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('approval-form').submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'The post remain pending :)',
                        'info'
                    )
                }
            })
        }
    </script>


@endpush