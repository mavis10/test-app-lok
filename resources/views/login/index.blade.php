<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Lok</title>

        <!-- Global stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        <link href="/css/global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
        <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
        <link href="/css/layout.min.css" rel="stylesheet" type="text/css">
        <link href="/css/components.min.css" rel="stylesheet" type="text/css">
        <link href="/css/colors.min.css" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->

        <!-- Theme JS files -->
        <script src="assets/js/app.js"></script>
    </head>
    <body>
        <!-- Page content -->
        <div class="page-content">
            <!-- Main content -->
            <div class="content-wrapper">
                <!-- Content area -->
                <div class="content d-flex justify-content-center align-items-center">

                    <!-- Login form -->
                    <form  method="POST" action="/api/authenticate">
                        @csrf
                        <div class="card mb-0">
                            <div class="card-body">
                                <div class="text-center mb-3">
<!--                                    <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>-->
                                    <h5 class="mb-0">Login to your account</h5>
                                    <br>
                                    <span class="d-block text-muted">Enter your credentials below</span>
                                </div>

                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="email" class="form-control" placeholder="Email" name="email">
                                    <div class="form-control-feedback">
                                        <i class="icon-user text-muted"></i>
                                    </div>
                                </div>

                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                </div>
                                <div class="form-group form-group-feedback form-group-feedback-left">
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox" class="" name="remember">
                                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                    </label>
                                </div>
                                
                                 @if ($errors->has('email'))
                                  <span id="spanUsernameExist" class="parsley-required" style="color: red;">{{ $errors->first('email') }}</span>
                                  
                                @endif
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
                                </div>

                               
                                <div class="text-center">
                                    <a href="/register">Need an account? Sign up!</a>

                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /login form -->

                </div>
                <!-- /main content -->
            </div>
            <!-- /page content -->
    </body>
</html>
