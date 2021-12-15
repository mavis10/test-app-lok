@extends('layouts.page')
@section('content')
<div class="page-header page-header-light">
  <div class="page-header-content header-elements-md-inline">
    <div class="page-title d-flex">
      <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Not</span> Found</h4>
      <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
    </div>
  </div>
</div>


      <!-- Content area -->
      <div class="content d-flex justify-content-center align-items-center">

        <!-- Container -->
        <div class="flex-fill">

          <!-- Error title -->
          <div class="text-center mb-3">
            <h1 class="error-title">405</h1>
            <h5>Oops, an error has occurred. Method Not Allowed!!</h5>
          </div>
          <!-- /error title -->


          <!-- Error content -->
          <div class="row">
            <div class="col-xl-4 offset-xl-4 col-md-8 offset-md-2">
              <!-- Buttons -->
              <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                  <a href="{{ url('/') }}" class="btn btn-primary btn-block"><i class="icon-home4 mr-2"></i> Dashboard</a>
                </div>

                <div class="col-sm-3"></div>
              </div>
              <!-- /buttons -->

            </div>
          </div>
          <!-- /error wrapper -->

        </div>
        <!-- /container -->

      </div>
      <!-- /content area -->


@endsection