@extends('layouts.backend.app')

@section('title','Banner')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('public/assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet" />

@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <a class="btn bg-blue-grey  m-t-15 waves-effect" href="{{ route('admin.banner.create') }}">
                <i class="material-icons">add_circle</i><span> Add New Banner</span>
            </a>
        </div>

        <!-- Exportable Table -->
        @if($banners->count() > 0 )
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            ALL Banner
                            <span class="badge bg-blue">{{ $banners->count() }}</span>
                        </h2>

                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Created_At</th>
                                    <th>Updated_At</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Created_At</th>
                                    <th>Updated_At</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($banners as $key => $banner)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td><img src="{{ asset( 'public/images/banners/small/'.$banner->image )}}" width="100" height="60" alt="banner" /></td>
                                        <td data-toggle="tooltip" data-placement="top" title=" {{ $banner->title }}">{{ str_limit($banner->title,"30") }}</td>
                                        <td>
                                            @if($banner->status == true)
                                                <span class="badge bg-blue">Published</span>
                                            @else
                                                <span class="badge bg-pink">Pending</span>

                                            @endif
                                        </td>
                                        <td>{{ $banner->created_at }}</td>
                                        <td>{{ $banner->updated_at }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-info btn-xs  waves-effect waves-float" href="{{ route('admin.banner.show',$banner->id) }}" data-toggle="tooltip" data-placement="top" title="Banner Details">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                            <a class="btn bg-teal btn-xs  waves-effect waves-float" href="{{ route('admin.banner.edit',$banner->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <button class="btn btn-danger btn-xs waves-effect waves-float" type="button" onclick="deleteBanner({{ $banner->id }})" data-toggle="tooltip" data-placement="top" title="Remove">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form id="delete-form-{{ $banner->id }}" action="{{ route('admin.banner.destroy',$banner->id) }}" method="POST" style="display: none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- #END# Exportable Table -->
    </div>
@endsection

@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>

    <script src="https://unpkg.com/sweetalert2@7.19.3/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deleteBanner(id) {
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