<!DOCTYPE html>
  <html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/icon/favicon.png">
        <link rel="icon" type="image/png" href="/assets/img/icon/favicon.png">
        <title>
            Administrator LKM
        </title>
        <meta name="keywords" content="">
        <meta name="description" content="Sistem Informasi Dana Bergulir Masyarakat &mdash; Siap Audit Kapanpun Siapapun">
    
        <link rel="stylesheet" type="text/css"
            href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    
        <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
        <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
    
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    
        <link rel="stylesheet" href="/admin/style.css">
        <link id="pagestyle" href="/admin/css/material-dashboard.min.css" rel="stylesheet" />

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

        <style>
            .swal2-container {
                height: unset !important;
            }
        </style>
        <form role="form" method="post" action="/master/login" class="text-start">
            @csrf
        <div class="login">

            <div class="avatar">
                <img src="admin/img/1.png" style="width: 100px;" alt="Avatar">       
            </div>

            <h2><b>Login Administrator Aplikasi</b></h2>
            <br>

            <div class="box-login  @error('gmail') is-invalid @enderror">
                <i class="fa fa-user"></i>
                <input type="email" name="gmail" id="gmail" autocomplete="off" placeholder="@gmail.com">
            </div>

            <div class="box-login @error('password') is-invalid @enderror">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="password">
            </div>
            <br>
            <button type="submit" name="login" class="btn-login">SIGN IN</button>
        </div>
        </form>
    </head>
    <script src="/assets/js/core/popper.min.js"></script>
    <script src="/assets/js/core/bootstrap.min.js"></script>
    <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="/assets/js/material-dashboard.min.js"></script>
    <script src="/assets/js/plugins/sweetalert.min.js"></script>
    <script>
      const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
      })

      function Toastr(icon, text) {
          font = "1.2rem Nimrod MT";

          canvas = document.createElement("canvas");
          context = canvas.getContext("2d");
          context.font = font;
          width = context.measureText(text).width;
          formattedWidth = Math.ceil(width) + 100;

          Toast.fire({
              icon: icon,
              title: text,
              width: formattedWidth
          })
      }
  </script>
  @if (session('pesan'))
      <script>
          Toastr('success', "{{ session('pesan') }}")
      </script>
  @endif
  @if (session('error'))
      <script>
          Toastr('error', "{{ session('error') }}")
      </script>
  @endif
  </html>