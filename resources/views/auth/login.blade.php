<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ITE System | Login</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ URL::to('/') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::to('/') }}/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ URL::to('/') }}/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ URL::to('/') }}/css/AdminLTE.min.css">
  <style type="text/css">
    .login-box {
      display: block;
      position: absolute;
      z-index: 10;
      width: 360px;
      background: #eee;
      top: 30%;
      left: 45%;
      margin: -110px 0 0 -100px;
      padding: 20px;
      border-radius: 4px;
      box-sizing: border-box;
      z-index: 100;
    }
    @media only screen and (max-width: 600px) {
      .login-box {
        width: 80%;
        left: 35%;
      }
    }
  </style>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body id="particles-js" style="overflow: hidden">

<div class="login-box">
  <div class="login-logo">
    <a href="{{ URL::to('/') }}"><b>DKM</b> AL-KAUTSAR</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Silahkan Login</p>

    <form id="login-form" action="{{ URL::to('login') }}" method="post">
      <div class="form-group has-feedback nik">
        <input type="text" name="username" class="form-control" placeholder="Username" autofocus="">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <span class="help-block"></span>
      </div>
      <div class="form-group has-feedback password">
        <input type="password" name="password" class="form-control" placeholder="Kata Sandi Anda">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span class="help-block"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-6">
          <button id="submit-button" type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


  </div>
  <!-- /.login-box-body -->
</div>

<!-- jQuery 3 -->
<script src="{{ URL::to('/') }}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ URL::to('/') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE for demo purposes -->
@stack('scripts')
<script type="text/javascript">
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $(document).ready( () => {
    $('#login-form').submit( function (e) {
      e.preventDefault();
      $('#submit-button').text('Memeriksa...');
      $('#submit-button').addClass('disabled');
      $('.help-block').text('');
      $.ajax({
        url: '{{ URL::to('/login') }}',
        type: 'POST',
        data: $(this).serialize(),
        success: function ( response ) {
          $('#submit-button').text('Masuk');
          $('#submit-button').removeClass('disabled');
          location.reload();
        },
        error: function ( error ) {
          $('#submit-button').text('Masuk');
          $('#submit-button').removeClass('disabled');
          if(error.status == 422 || error.status == 401)
          {
            alert("Gagal login");
          }
          $.each(error.responseJSON.errors, (index, item) => {
            $('.'+index+' .help-block').text(item);
          });
        }
      });
    });
  });
</script>
</body>
</html>
