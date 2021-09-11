@extends('templates/template')

@section('konten')
<div class="row">
   <div class="col-md-3">
      <div class="d-flex justify-content-between">
         <h6>Tambah Golongan</h6>
      </div>
      <hr>
      <form action="" id="form-tambah-golongan">
         <div class="form-group mt-3">
            <label class="mb-2">Kode Golongan</label>
            <input type="text" name="kode_golongan" id="kode_golongan" class="form-control">
         </div>
         <div class="form-group mt-3">
            <label class="mb-2">Uang Makan / Hari</label>
            <input type="text" name="uang_makan" id="uang_makan" class="form-control">
         </div>
         <div class="form-group mt-3">
            <label class="mb-2">Uang Lembur / Jam</label>
            <input type="text" name="uang_lembur" id="uang_lembur" class="form-control">
         </div>
         <div class="form-group mt-3">
            <label class="mb-2">Asuransi Kesehatan (Askes)</label>
            <input type="text" name="asuransi_kesehatan" id="asuransi_kesehatan" class="form-control">
         </div>
         <button type="submit" class="btn btn-sm btn-primary float-end mt-3 d-flex" id="btn-tambah-golongan">
            <div>Tambah</div>
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
   <div class="col-md-9">
      <div class="d-flex justify-content-between">
         <h6>Data Golongan</h6>
      </div>
      <hr>
      <table id="example" class="table table-sm">
         <thead>
            <tr>
               <th>No</th>
               <th>Kode</th>
               <th>Uang Makan / Hari</th>
               <th>Uang Lembur / Jam</th>
               <th>Asuransi Kesehatan</th>
               <th>Opsi</th>
            </tr>
         </thead>
      </table>
   </div>
</div>

<!-- modal edit golongan -->
<div class="modal fade" id="modal-edit-golongan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-edit-golonganLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-edit-golonganLabel">Edit Golongan</h5>
        <button type="button" class="btn-close" id="tutup-modal-edit-golongan" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="form-edit-golongan">
           <input type="hidden" id="id_golongan_edit">
           <div class="form-group mt-3">
              <label>Kode Golongan</label>
              <input type="text" name="kode_golongan_edit" id="kode_golongan_edit" class="form-control" readonly>
           </div>
           <div class="form-group mt-3">
              <label>Uang Makan</label>
              <input type="text" name="uang_makan_edit" id="uang_makan_edit" class="form-control">
           </div>
           <div class="form-group mt-3">
              <label>Uang Lembur</label>
              <input type="text" name="uang_lembur_edit" id="uang_lembur_edit" class="form-control">
           </div>
           <div class="form-group mt-3">
              <label>Asuransi Kesehatan</label>
              <input type="text" name="asuransi_kesehatan_edit" id="asuransi_kesehatan_edit" class="form-control">
           </div>
           <div class="mt-3">
               <div id="wait" style="display:none;float:left;">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;float:left;" width="24px" height="24px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                     <g>
                     <path d="M50 15A35 35 0 1 0 74.74873734152916 25.251262658470843" fill="none" stroke="#007bff" stroke-width="12"></path>
                     <path d="M49 3L49 27L61 15L49 3" fill="#007bff"></path>
                     <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                     </g>
                  </svg><span style="font-weight:bold;display:block;float:right;">Loading...</span>
               </div>
               <button type="submit" class="btn btn-sm btn-primary float-end d-flex" id="btn-edit-golongan">
                  <div>Edit</div>
                  <svg id="loadingEdit" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgba(255, 255, 255, 0); display: none; shape-rendering: auto;" width="24px" height="24px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                      <g>
                         <path d="M50 15A35 35 0 1 0 74.74873734152916 25.251262658470843" fill="none" stroke="#ffffff" stroke-width="12"></path>
                         <path d="M49 3L49 27L61 15L49 3" fill="#ffffff"></path>
                         <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                      </g>
                   </svg>
               </button>
           </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- akhir modal edit golongan -->
@endsection

@push('js')
<!-- datatable -->
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap5.min.js"></script>
<!-- akhir datatable -->
<script>
   let overlay = document.getElementById('overlay-container')
   overlay.style.display = 'flex'
   $(document).ready(function(){
 
      // menampilkan data golongan
      $('#example').DataTable({
         serverSide: true,
         responsive: true,
         processing: true,
         ajax: {
            url: 'golongan'
         },
         columns: [
            {
               "data" : null, "sortable" : false,
               render: function(data, type, row, meta){
                  return meta.row + meta.settings._iDisplayStart + 1
               }
            },
            {data: 'kode_golongan', name: 'kode_golongan'},
            {data: 'uang_makan', name: 'uang_makan'},
            {data: 'uang_lembur', name: 'uang_lembur'},
            {data: 'asuransi_kesehatan', name: 'asuransi_kesehatan'},
            {data: 'opsi', name: 'opsi'}
         ]
      })
      overlay.style.display = 'none'
      // akhir menampilkan golongan


      // csrf token
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      })
      // akhir csrf token


      // tambah data golongan
      $(document).on('submit', '#form-tambah-golongan', function(e){
         e.preventDefault()

         let validation = $('#form-tambah-golongan')
         validation.find('.form-text').remove()

         let btn = document.getElementById('btn-tambah-golongan')
         btn.setAttribute('disabled', true)
         let loading = document.getElementById('loading')
         loading.style.display = 'block'

         let formData = new FormData($('#form-tambah-golongan')[0])

         $.ajax({
            type: 'POST',
            url: 'golongan/tambah',
            data: formData,
            processData: false,
            contentType: false,
            success: function(){
               $('#example').DataTable().ajax.reload()

               $('#kode_golongan').val('')
               $('#uang_makan').val('')
               $('#uang_lembur').val('')
               $('#asuransi_kesehatan').val('')

               btn.removeAttribute('disabled', false)
               loading.style.display = 'none'

               Toast.fire({
                  icon: 'success',
                  title: 'Golongan berhasil ditambahkan'
               })
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
      // akhir tambah data golongan


      // tutup modal edit golongan
      $(document).on('click', '#tutup-modal-edit-golongan', function(){
         $('#id_golongan_edit').val('')
         $('#kode_golongan_edit').val('')
         $('#uang_makan_edit').val('')
         $('#uang_lembur_edit').val('')
         $('#asuransi_kesehatan_edit').val('')

         let validation = $('#form-edit-golongan')
         validation.find('.form-text').remove()
      })
      // akhir tutup modal edit golongan


      // ambil data detail untuk modal edit golongan
      $(document).on('click', '.edit-golongan', function(){
         let id = $(this).attr('id')

         let btn = document.getElementById('btn-edit-golongan')
         btn.setAttribute('disabled', true)
         let wait = document.getElementById('wait')
         wait.style.display = 'block'

         $.ajax({
            type: 'GET',
            url: 'golongan/detail/'+ id,
            success: function(response){
               $('#id_golongan_edit').val(response.golongan.id)
               $('#kode_golongan_edit').val(response.golongan.kode_golongan)
               $('#uang_makan_edit').val(response.golongan.uang_makan)
               $('#uang_lembur_edit').val(response.golongan.uang_lembur)
               $('#asuransi_kesehatan_edit').val(response.golongan.asuransi_kesehatan)

               btn.removeAttribute('disabled', false)
               wait.style.display = 'none'
            }
         })
      })
      // akhir ambil data detail untuk modal edit golongan


      // edit golongan
      $(document).on('submit', '#form-edit-golongan', function(e){
         e.preventDefault()

         let validation = $('#form-edit-golongan')
         validation.find('.form-text').remove()

         let btn = document.getElementById('btn-edit-golongan')
         btn.setAttribute('disabled', true)
         let loadingEdit = document.getElementById('loadingEdit')
         loadingEdit.style.display = 'block'

         let id = $('#id_golongan_edit').val()
         let formData = new FormData($('#form-edit-golongan')[0])

         $.ajax({
            type: 'POST',
            url: 'golongan/edit/'+ id,
            data: formData,
            processData: false,
            contentType: false,
            success: function(){
               $('#example').DataTable().ajax.reload()
               $('#tutup-modal-edit-golongan').click()

               btn.removeAttribute('disabled', false)
               loadingEdit.style.display = 'none'
               Toast.fire({
                  icon: 'success',
                  title: 'Golongan berhasil diedit'
               })
            },
            error: function(xhr){
               var res = xhr.responseJSON;
               if($.isEmptyObject(res) == false){
                  $.each(res.errors, function(key, value){
                     $('#' + key)
                        .closest('.form-group')
                        .append("<div class='form-text text-danger'>" + value + "</div>")
                        btn.removeAttribute('disabled', false)
                        loadingEdit.style.display = 'none'
                  })
               }
            }
         })
      })
      // akhir edit golongan


      // hapus golongan
      $(document).on('click', '.hapus-golongan', function(e){
         e.preventDefault()
         let id = $(this).attr('id')
         let kode_golongan = $(this).attr('kode-golongan')

         Swal.fire({
            title: 'Apa kamu yakin ?',
            text: 'ingin menghapus golongan "'+ kode_golongan + '"',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Kembali',
            cancelButtonColor: 'black'
            }).then((result) => {
            if (result.isConfirmed) {

               $.ajax({
                  type: 'DELETE',
                  url: 'golongan/hapus/'+ id,
                  success: function(){
                     $('#example').DataTable().ajax.reload()
                     Toast.fire({
                        icon: 'success',
                        title: 'golongan berhasil dihapus'
                     })
                  },
                  error: function(){
                     toastFail.fire({
                        icon: 'error',
                        title: 'Golongan gagal dihapus, masih ada mahasiswa yang menggunakan golongan ini !'
                     })
                  }
               })

            }
         })
      })
      // akhir hapus golongan

   })
</script>
@endpush