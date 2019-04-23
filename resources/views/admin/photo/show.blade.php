@extends('layouts.backend.app')

@section('title','Photo')

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" rel="stylesheet" />

@endpush

@section('content')
    <div class="container-fluid">

        <!-- Vertical Layout | With Floating Label -->
        <a href="{{ route('admin.photo.index') }}" class="btn btn-danger waves-effect"><i class="material-icons">reply_all</i> BACK</a>

        <br>
        <br>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <table class="table table-hover  table-responsive ">
                                    <tr>
                                        <th><strong>Title</strong></th>
                                        <th>:</th>
                                        <td><p> {{ $photo->title }} </p> </td>
                                    </tr>
                                    <tr>
                                        <th><strong> Created At</strong></th>
                                        <th>:</th>
                                        <td><p> {{ $photo->created_at->toFormattedDateString() }} </p> </td>
                                    </tr>
                                    <tr>
                                        <th><strong>Updated At</strong></th>
                                        <th>:</th>
                                        <td><p> {{ $photo->updated_at->toFormattedDateString() }} </p> </td>
                                    </tr>
                                    <tr>
                                        <th><strong>Status</strong></th>
                                        <th>:</th>
                                        <td>
                                            <p>
                                                @if($photo->status == true)
                                                    <span class="badge bg-blue">Published</span>
                                                @else
                                                    <span class="badge bg-pink">Pending</span>

                                                @endif
                                            </p>
                                        </td>
                                    </tr>

                                </table>
                            </div>

                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2 class="text-center">
                                        Cover Image
                                    </h2>

                                </div>
                                <div class="body">
                                    <img src="{{ asset( 'public/images/photo/small/'.$photo->image )}}" width="100%" alt="banner" />
                                </div>

                            </div>
                        </div>
                        @if($photo->media->count() > 0 )

                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="header">
                                        <h2> Multiple Image </h2>

                                    </div>
                                    <div class="body">
                                        @foreach($photo->media as $media)
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                                <div class="card">

                                                    <div class="body">
                                                        <img src="{{ asset( 'public/images/photo/media/small/'.$media->image )}}" width="100%" alt="banner" />
                                                        <button class="btn btn-default btn-xs waves-effect waves-float" type="button" onclick="deleteMedia({{ $media->id }})" data-toggle="tooltip" data-placement="top" title="Remove">
                                                            <i class="material-icons">delete</i>
                                                        </button>
                                                        <form id="delete-form-{{ $media->id }}" action="{{ route('admin.media.destroy',$media->id) }}" method="POST" style="display: none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        @endif
                        <!-- #END# Product -->

                        <hr>
                        <div><h2>Multiple Image Upload</h2></div><br/>
                        <form action="{{ route('admin.photo.upload',$photo->id) }}" method="post" class="dropzone" id="my-awesome-dropzone-{{ $photo->id }}">
                            @csrf
                            <div class="dz-message">
                                <div class="drag-icon-cph">
                                    <i class="material-icons">touch_app</i>
                                </div>
                                <h3>Drop files here or click to upload.</h3>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
        <!-- Vertical Layout | With Floating Label -->

    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.3/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deleteMedia(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>


@endpush