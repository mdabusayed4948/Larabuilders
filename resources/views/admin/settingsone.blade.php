@extends('layouts.backend.app')

@section('title','Settings')

@push('css')
    <link href="{{ asset('public/assets/backend/css/image.css') }}" rel="stylesheet">

@endpush

@section('content')
  <div class="container-fluid">
      <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                  <div class="header">
                      <h2>
                          SETTINGS
                      </h2>

                  </div>
                  <div class="body">
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                          <li role="presentation" class="active">
                              <a href="#profile_with_icon_title" data-toggle="tab">
                                  <i class="material-icons">face</i> UPDATE PROFILE
                              </a>
                          </li>
                          <li role="presentation">
                              <a href="#password_with_icon_title" data-toggle="tab">
                                  <i class="material-icons">change_history</i> CHANGE PASSWORD
                              </a>
                          </li>

                      </ul>

                      <!-- Tab panes -->
                      <div class="tab-content">
                          <div role="tabpanel" class="tab-pane fade in active" id="profile_with_icon_title">
                              <form method="POST" action="{{ route('admin.profile.update') }}" class="form-horizontal" enctype="multipart/form-data">
                                  @csrf
                                  @method('PUT')
                                  <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                                  <div class="card">
                                          <div class="header">
                                              <h2>
                                                  <strong>Personal Info</strong>
                                              </h2>

                                          </div>
                                          <div class="body">
                                              <div class="row clearfix">
                                                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                      <label for="email_address_2">Name : </label>
                                                  </div>
                                                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                      <div class="form-group">
                                                          <div class="form-line">
                                                              <input type="text" id="name" class="form-control" placeholder="Enter your name" name="name" value="{{ Auth::user()->name }}">
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="row clearfix">
                                                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                      <label for="email_address_2">Email Address : </label>
                                                  </div>
                                                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                      <div class="form-group">
                                                          <div class="form-line">
                                                              <input type="text" id="email_address_2" class="form-control" placeholder="Enter your email address" name="email" value="{{ Auth::user()->email }}">
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>

                                              <div class="row clearfix">
                                                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                      <label for="email_address_2">About : </label>
                                                  </div>
                                                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                      <div class="form-group">
                                                          <div class="form-line">
                                                              <textarea rows="5" name="about" class="form-control">{{ Auth::user()->about }}</textarea>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="row clearfix"></div>
                                      </div>
                                  </div>

                                  </div>
                                  <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                      <div class="card">
                                          <div class="header">
                                              <h2>
                                                  <strong>Featured Image</strong>
                                              </h2>

                                          </div>
                                          <div class="body">
                                              <table>
                                                  <thead>
                                                  <tr class="info">
                                                      <th class="photo-id">{{ sprintf('%05d',Auth::user()->id) }}</th>
                                                  </tr>
                                                  </thead>
                                                  <tbody>
                                                  <tr>
                                                      <td class="photo">
                                                          <img  class="photo-photo" id="showPhoto" src="{{ asset( 'public/images/profile/'.Auth::user()->image )}}"  />
                                                          <input type="file" name="image" id="photo" accept="image/x-png,image/png,image/jpg,image/jpeg,">

                                                      </td>
                                                  </tr>
                                                  <tr >
                                                      <td >
                                                          <input type="button" name="image" id="browse_file" class="form-control btn-browse" value="Brouse">
                                                      </td>
                                                  </tr>
                                                  </tbody>
                                              </table>


                                          </div>
                                      </div>

                                  </div>
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                       <div class="card">
                                           <div class="col-lg-offset-6 col-md-offset-6 col-sm-offset-8 col-xs-offset-5">
                                               <button style="margin-top: 5px; margin-bottom: 4px;" type="submit" class="btn btn-primary m-t-15 waves-effect"><i class="material-icons">save</i> UPDATE</button>
                                           </div>
                                       </div>
                                  </div>
                                   <div class="row clearfix"> </div>
                              </form>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="password_with_icon_title">
                              <form method="POST" action="{{ route('admin.password.update') }}" class="form-horizontal" >
                                  @csrf
                                  @method('PUT')
                                  <div class="row clearfix">
                                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                          <label for="old_password">Old Password : </label>
                                      </div>
                                      <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                          <div class="form-group">
                                              <div class="form-line">
                                                  <input type="password" id="old_password" class="form-control" placeholder="Enter your old password" name="old_password" >
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row clearfix">
                                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                          <label for="password">New Password : </label>
                                      </div>
                                      <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                          <div class="form-group">
                                              <div class="form-line">
                                                  <input type="password" id="password" class="form-control" placeholder="Enter your new password " name="password" >
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row clearfix">
                                      <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                          <label for="confirm_password">Confirm Password : </label>
                                      </div>
                                      <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                          <div class="form-group">
                                              <div class="form-line">
                                                  <input type="password" id="confirm_password" class="form-control" placeholder="Enter your new password again" name="password_confirmation" >
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row clearfix">
                                      <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                          <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                                      </div>
                                  </div>
                              </form>

                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection

@push('js')
    <script src="{{ asset('public/assets/backend/js/image.js') }}"></script>


@endpush