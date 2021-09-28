<!doctype html>
<html lang="en">
  <head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <!-- csrf token laravel ajax -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <!-- akhir csrf token laravel ajax -->

   <!-- datatable -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap5.min.css">
   <!-- akhir datatable -->

   <title>penggajian</title>

   <!-- cssku -->
   <link rel="stylesheet" href="{{ asset('assets/css/cssku.css') }}">
   <!-- akhir cssku -->

  </head>
  <body>
    
    <!-- navbar -->
    @include('templates/navbar')
    <!-- akhir navbar -->

    <!-- konten -->
    <div class="container container-konten">
        @yield('konten')
    </div>
    <!-- akhir konten -->

    <!-- loading overlay -->
    <div id="overlay-container" style="display:none;">
        <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
    </div>
    <!-- akhir loading overlay -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- akhir jquery -->

    <script>
      // format rupiah javascript
      function format_rupiah(angka, prefix){
            var number_string = angka.toString()
            var split             = number_string.split(',')
            var sisa              = split[0].length % 3
            var rupiah            = split[0].substr(0, sisa)
            var ribuan            = split[0].substr(sisa).match(/\d{3}/gi)

            if(ribuan){
                var separator = sisa ? '.' : ''
                rupiah   += separator + ribuan.join('.')
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '')
        }
        // akhir format rupiah javascript
    </script>

    <!-- sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      // toast success
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        },
        iconColor: 'green',
        background: 'rgb(91, 255, 96)'
      })

      // toast fail
      const toastFail = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 5000,
          timerProgressBar: true,
          didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
          },
          iconColor: 'green',
          background: 'rgb(255, 71, 71)'
      })
    </script>
    <!-- akhir sweetalert -->
    
    @stack('js')
  </body>
</html>