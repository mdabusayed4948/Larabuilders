@extends('layouts.backend.app')
@section('title','Admin Dashboard')

@push('css')

 @endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">slideshow</i>
                    </div>
                    <div class="content">
                        <div class="text">Total Banner</div>
                        <div class="number count-to" data-from="0" data-to="{{ $banner_count }}" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">local_parking</i>
                    </div>
                    <div class="content">
                        <div class="text">Total Product</div>
                        <div class="number count-to" data-from="0" data-to="{{ $product_count }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-red hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">group</i>
                    </div>
                    <div class="content">
                        <div class="text">Total Client</div>
                        <div class="number count-to" data-from="0" data-to="{{ $client_count }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">group_add</i>
                    </div>
                   <div class="content">
                       <div class="text">Total Management</div>
                       <div class="number count-to" data-from="0" data-to="{{ $management_count }}" data-speed="1000" data-fresh-interval="20"></div>
                   </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->

    <!-- #START# banner -->
    @if($banners->count() > 0 )

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Latest Banner

                        </h2>

                    </div>
                    <div class="body">
                        @foreach($banners as $key => $banner)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="card">

                                <div class="body">
                                    <img src="{{ asset( 'public/images/banners/small/'.$banner->image )}}" width="100%" alt="banner" />
                                </div>
                                <div class="footer text-center">
                                    <h6>
                                        <a style="text-decoration: none" class=" waves-effect waves-float" href="{{ route('admin.banner.show',$banner->id) }}" data-toggle="tooltip" data-placement="bottom" title=" {{ $banner->title }}">
                                             {{ str_limit($banner->title,"30") }}
                                        </a>
                                    </h6>

                                </div>
                               <br>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    @endif
     <!-- #END# banner -->
     <!-- #START# Product -->
    @if($products->count() > 0 )

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Latest Product

                            </h2>

                        </div>
                        <div class="body">
                            @foreach($products as $key => $product)
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="card">

                                        <div class="body">
                                            <img src="{{ asset( 'public/images/products/small/'.$product->image )}}" width="100%" alt="banner" />
                                        </div>
                                        <div class="footer text-center">
                                            <h6>
                                                <a style="text-decoration: none" class=" waves-effect waves-float" href="{{ route('admin.product.show',$product->id) }}" data-toggle="tooltip" data-placement="bottom" title=" {{ $product->name }}">
                                                    {{ str_limit($product->name,"30") }}
                                                </a>
                                            </h6>

                                        </div>
                                        <br>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
    @endif
     <!-- #END# Product -->

    <!-- #START# Product -->
     @if($newsdata->count() > 0 )

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Latest News

                            </h2>

                        </div>
                        <div class="body">
                            @foreach($newsdata as $key => $news)
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="card">

                                        <div class="body">
                                            <img src="{{ asset( 'public/images/news/small/'.$news->image )}}" width="100%" alt="banner" />
                                        </div>
                                        <div class="footer text-center">
                                            <h6>
                                                <a style="text-decoration: none" class=" waves-effect waves-float" href="{{ route('admin.news.show',$news->id) }}" data-toggle="tooltip" data-placement="bottom" title=" {{ $news->title }}">
                                                    {{ str_limit($news->title,"30") }}
                                                </a>
                                            </h6>

                                        </div>
                                        <br>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
    @endif
    <!-- #END# Product -->



    </div>
@endsection

@push('js')

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('public/assets/backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ asset('public/assets/backend/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/morrisjs/morris.js') }}"></script>

    <!-- ChartJs -->
    <script src="{{ asset('public/assets/backend/plugins/chartjs/Chart.bundle.js') }}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="{{ asset('public/assets/backend/plugins/flot-charts/jquery.flot.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/flot-charts/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/flot-charts/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/flot-charts/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/flot-charts/jquery.flot.time.js') }}"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{ asset('public/assets/backend/plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>

    <script src="{{ asset('public/assets/backend/js/pages/index.js') }}"></script>


@endpush
