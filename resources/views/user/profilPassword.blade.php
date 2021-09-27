@extends('templates/template')

@section('konten')
<div class="row user mb-4">
   <div class="col-md-9 mb-4">
      @if(Auth::user()->role == 'user')
      <div class="d-flex justify-content-between">
         <h6>Profil</h6>
      </div>
      <hr>
      <div class="row">
         <div class="col-md">
            <table class="table table-sm" style="border:0px solid white;">
               <tr>
                  <td colspan="3" class="text-center"><b>Data Diri</b></td>
               </tr>
               <tr>
                  <td>NIP</td>
                  <td>:</td>
                  <td id="nip"></td>
               </tr>
               <tr>
                  <td>Nama</td>
                  <td>:</td>
                  <td id="nama"></td>
               </tr>
               <tr>
                  <td>Email</td>
                  <td>:</td>
                  <td id="email"></td>
               </tr>
               <tr>
                  <td>Jenis Kelamin</td>
                  <td>:</td>
                  <td id="jenis-kelamin"></td>
               </tr>
               <tr>
                  <td>Telepon</td>
                  <td>:</td>
                  <td id="telepon"></td>
               </tr>
            </table>
         </div>
         <div class="col-md">
            <table class="table table-sm" style="border:0px solid white;">
               <tr>
                  <td colspan="3" class="text-center"><b>Jabatan</b></td>
               </tr>
               <tr>
                  <td>Kode</td>
                  <td>:</td>
                  <td id="kode-jabatan"></td>
               </tr>
               <tr>
                  <td>Jabatan</td>
                  <td>:</td>
                  <td id="nama-jabatan"></td>
               </tr>
               <tr>
                  <td>Gaji Pokok</td>
                  <td>:</td>
                  <td id="gaji-pokok"></td>
               </tr>
               <tr>
                  <td>Tunjangan</td>
                  <td>:</td>
                  <td id="tunjangan"></td>
               </tr>
            </table>
         </div>
         <div class="col-md">
            <table class="table table-sm" style="border:0px solid white;">
               <tr>
                  <td colspan="3" class="text-center"><b>Golongan</b></td>
               </tr>
               <tr>
                  <td>Kode</td>
                  <td>:</td>
                  <td id="kode-golongan"></td>
               </tr>
               <tr>
                  <td>Uang Makan / Hari</td>
                  <td>:</td>
                  <td id="uang-makan"></td>
               </tr>
               <tr>
                  <td>Uang Lembur / Jam</td>
                  <td>:</td>
                  <td id="uang-lembur"></td>
               </tr>
               <tr>
                  <td>Asuransi Kesehatan / Bulan</td>
                  <td>:</td>
                  <td id="askes"></td>
               </tr>
            </table>
         </div>
      </div>
      <hr>
      @endif
   </div>
   <div class="col-md-3">
      <div class="d-flex justify-content-between">
         <h6>Ubah Password</h6>
      </div>
      <hr>
      <form action="" id="form-ubah-password">
         <div class="form-group mt-3">
            <label class="mb-2">Password</label>
            <input type="password" name="password" id="password" class="form-control">
         </div>
         <div class="form-group mt-3">
            <label class="mb-2">Konfirmasi Password</label>
            <input type="password" name="konfirmasi-password" id="konfirmasi-password" class="form-control">
         </div>
         <button type="submit" class="btn btn-sm btn-primary float-end mt-3 d-flex" id="btn-ubah-password">
            <div>Ubah</div>
            <svg id="loading" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgba(255, 255, 255, 0); display: none; shape-rendering: auto;" width="24px" height="24px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
               <g>
                  <path d="M50 15A35 35 0 1 0 74.74873734152916 25.251262658470843" fill="none" stroke="#ffffff" stroke-width="12"></path>
                  <path d="M49 3L49 27L61 15L49 3" fill="#ffffff"></path>
                  <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
               </g>
            </svg>
         </button>
      </form>
   </div>
</div>
@endsection

@push('js')
<script>
   let overlay = document.getElementById('overlay-container')
   overlay.style.display = 'flex'
   $(document).ready(function(){

      // ambil data profil
      $.ajax({
         type: 'GET',
         url: 'user/data',
         success: function(response){
            console.log(response)
            if(response.user !== 0 && response.jabatan !== 0 && response.golongan !== 0){
               // data diri
               $('#nip').append(response.user.nip)
               $('#nama').append(response.user.nama)
               $('#email').append(response.user.email)
               if(response.user.jenis_kelamin_id == 1){
                  $('#jenis-kelamin').append('Laki-laki')
               }else{
                  $('#jenis-kelamin').append('Perempuan')
               }
               $('#telepon').append(response.user.telepon)
   
               // jabatan
               $('#kode-jabatan').append(response.jabatan.kode_jabatan)
               $('#nama-jabatan').append(response.jabatan.nama_jabatan)
               $('#gaji-pokok').append('Rp. '+ format_rupiah(parseInt(response.jabatan.gaji_pokok)))
               $('#tunjangan').append('Rp. '+ format_rupiah(parseInt(response.jabatan.tunjangan)))
   
               // golongan
               $('#kode-golongan').append(response.golongan.kode_golongan)
               $('#uang-makan').append('Rp. '+ format_rupiah(parseInt(response.golongan.uang_makan)))
               $('#uang-lembur').append('Rp. '+ format_rupiah(parseInt(response.golongan.uang_lembur)))
               $('#askes').append('Rp. '+ format_rupiah(parseInt(response.golongan.asuransi_kesehatan)))
            }

            overlay.style.display = 'none'
         }
      })

      // csrf token
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      })
      // akhir csrf token

      // ubah password
      $(document).on('submit', '#form-ubah-password', function(e){
         e.preventDefault()

         // manipulasi tombol
         let btn = document.getElementById('btn-ubah-password')
         btn.setAttribute('disabled', true)
         let loading = document.getElementById('loading')
         loading.style.display = 'block'

         // hapus error validasi
         let err = $('#form-ubah-password')
         err.find('.form-text').remove()

         // object form
         let formData = new FormData($('#form-ubah-password')[0])

         $.ajax({
            type: 'POST',
            url: 'user/ubah-password',
            data: formData,
            processData: false,
            contentType: false,
            success: function(){
               Toast.fire({
                  icon: 'success',
                  title: 'Password berhasil di ubah'
               })

               $('#password').val('')
               $('#konfirmasi-password').val('')

               btn.removeAttribute('disabled', false)
               loading.style.display = 'none'
            },
            error: function(xhr){
               var res = xhr.responseJSON;
               if($.isEmptyObject(res) == false){
                  $.each(res.errors, function(key, value){
                     $('#' + key)
                        .closest('.form-group')
                        .append("<div class='form-text text-danger'>" + value + "</div>")
                        btn.removeAttribute('disabled', false)
                        loading.style.display = 'none'
                  })
               }
            }

         })
      })

   })
</script>
@endpush