<!DOCTYPE html>
<html lang="en">
<head> 
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href={{asset('plugins/fontawesome-free/css/all.min.css')}}>
  <link rel="icon" href={{asset('adminlte/img/AdminLTELogo.png')}}>

  <!-- Theme style -->
  <link rel="stylesheet" href={{ asset('adminlte/css/adminlte.min.css') }}>
   <!-- DataTables -->
   <link rel="stylesheet" href={{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}>
   <link rel="stylesheet" href={{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}>
   <link rel="stylesheet" href={{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}>
   <link rel="stylesheet" href={{asset('plugins/summernote/summernote-bs4.min.css')}}>

</head>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src={{asset('plugins/jquery/jquery.min.js')}}></script>
<!-- Bootstrap 4 -->
<script src={{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}></script>
<!-- AdminLTE App -->
<script src={{asset('adminlte/js/adminlte.min.js')}}></script>
<!-- AdminLTE for demo purposes -->
<script src={{asset('adminlte/js/demo.js')}}></script>

 <script src={{asset('plugins/datatables/jquery.dataTables.min.js')}}></script>
<script src={{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}></script>
<script src={{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}></script>
<script src={{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}></script>
<script src={{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>


<script src={{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}></script>
<script src={{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}></script>
<script src={{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}></script>

</body>
</html>