@extends('layouts.backend.app')

@section('title','News')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('public/assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet" />

@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <a class="btn bg-blue-grey  m-t-15 waves-effect" href="{{ route('admin.news.create') }}">
                <i class="material-icons">add_circle</i><span> Add New News</span>
            </a>
        </div>

        <!-- Exportable Table -->
        @if($newsdata->count() > 0 )
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            ALL News Information
                            <span class="badge bg-blue">{{ $newsdata->count() }}</span>
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
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>News Date</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($newsdata as $key => $news)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td><img src="{{ asset( 'public/images/news/small/'.$news->image )}}" width="100" height="60" alt="anner" /></td>
                                        <td data-toggle="tooltip" data-placement="top" title=" {{ $news->title }}">{{ str_limit($news->title,60) }}</td>
                                        <td>
                                            @if($news->status == true)
                                                <span class="badge bg-blue">Published</span>
                                            @else
                                                <span class="badge bg-pink">Pending</span>

                                            @endif
                                        </td>
                                        <td>{{ $news->created_at }}</td>
                                        <td class="text-center">
                                             <a class="btn btn-info btn-xs  waves-effect waves-float" href="{{ route('admin.news.show',$news->id) }}" data-toggle="tooltip" data-placement="top" title="News Details">
                                                <i class="material-icons">visibility</i>
                                             </a>
                                             <a class="btn btn-xs bg-teal waves-effect waves-float" href="{{ route('admin.news.edit',$news->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="material-icons">edit</i>
                                             </a>
                                             <button class="btn btn-danger btn-xs waves-effect waves-float" type="button" onclick="deleteNews({{ $news->id }})" data-toggle="tooltip" data-placement="top" title="Remove">
                                                <i class="material-icons">delete</i>
                                             </button>
                                             <form id="delete-form-{{ $news->id }}" action="{{ route('admin.news.destroy',$news->id) }}" method="POST" style="display: none">
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
        function deleteNews(id) {
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