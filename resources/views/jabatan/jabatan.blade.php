@extends('templates/template')

@section('konten')
<div class="row">
   <div class="col-md-3">
      <div class="d-flex justify-content-between">
         <h6>Tambah Jabatan</h6>
      </div>
      <hr>
      <form action="" id="form-tambah-jabatan">
         <div class="form-group mt-3">
            <label class="mb-2">Kode Jabatan</label>
            <input type="text" name="kode_jabatan" id="kode_jabatan" class="form-control">
         </div>
         <div class="form-group mt-3">
            <label class="mb-2">Nama Jabatan</label>
            <input type="text" name="nama_jabatan" id="nama_jabatan" class="form-control">
         </div>
         <div class="form-group mt-3">
            <label class="mb-2">Gaji Pokok</label>
            <input type="text" name="gaji_pokok" id="gaji_pokok" class="form-control">
         </div>
         <div class="form-group mt-3">
            <label class="mb-2">Tunjangan Jabatan</label>
            <input type="text" name="tunjangan" id="tunjangan" class="form-control">
         </div>
         <button type="submit" class="btn btn-sm btn-primary float-end mt-3 d-flex" id="btn-tambah-jabatan">
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
         <h6>Data Jabatan</h6>
      </div>
      <hr>
      <table id="example" class="table table-sm">
         <thead>
            <tr>
               <th>No</th>
               <th>Kode</th>
               <th>Nama</th>
               <th>Gaji Pokok</th>
               <th>Tunjangan</th>
               <th>Opsi</th>
            </tr>
         </thead>
      </table>
   </div>
</div>

<!-- modal edit jabatan -->
<div class="modal fade" id="modal-edit-jabatan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-edit-jabatanLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-edit-jabatanLabel">Edit Jabatan</h5>
        <button type="button" class="btn-close" id="tutup-modal-edit-jabatan" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="form-edit-jabatan">
           <input type="hidden" id="id_jabatan_edit">
           <div class="form-group mt-3">
              <label>Kode Jabatan</label>
              <input type="text" name="kode_jabatan_edit" id="kode_jabatan_edit" class="form-control" readonly>
           </div>
           <div class="form-group mt-3">
              <label>Nama Jabatan</label>
              <input type="text" name="nama_jabatan_edit" id="nama_jabatan_edit" class="form-control">
           </div>
           <div class="form-group mt-3">
              <label>Gaji Pokok</label>
              <input type="text" name="gaji_pokok_edit" id="gaji_pokok_edit" class="form-control">
           </div>
           <div class="form-group mt-3">
              <label>Tunjangan</label>
              <input type="text" name="tunjangan_edit" id="tunjangan_edit" class="form-control">
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
               <button type="submit" class="btn btn-sm btn-primary float-end d-flex" id="btn-edit-jabatan">
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
<!-- akhir modal edit jabatan -->
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

      // menampilkan data
      $('#example').DataTable({
         serverSide: true,
         responsive: true,
         processing: true,
         ajax: {
            url: 'jabatan'
         },
         columns: [
            {
               "data" : null, "sortable" : false,
               render: function(data, type, row, meta){
                  return meta.row + meta.settings._iDisplayStart + 1
               }
            },
            {data: 'kode_jabatan', name: 'kode_jabatan'},
            {data: 'nama_jabatan', name: 'nama_jabatan'},
            {data: 'gaji_pokok', name: 'gaji_pokok'},
            {data: 'tunjangan', name: 'tunjangan'},
            {data: 'opsi', name: 'opsi'}
         ]
      })

      overlay.style.display = 'none'
      // akhir menampilkan data


      // csrf token
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      })
      // akhir csrf token


      // tambah jabatan
      $(document).on('submit', '#form-tambah-jabatan', function(e){
         e.preventDefault()

         let form = $('.form-group')
         form.find('.form-text').remove()

         let btn = document.getElementById('btn-tambah-jabatan')
         btn.setAttribute('disabled', true)
         let loading = document.getElementById('loading')
         loading.style.display = 'block'

         let formData = new FormData($('#form-tambah-jabatan')[0])

         $.ajax({
            type: 'POST',
            url: 'jabatan/tambah',
            data: formData,
            contentType: false,
            processData: false,
            success: function(){
               loading.style.display = 'none'
               btn.removeAttribute('disabled', false)

               $('#example').DataTable().ajax.reload()

               // hapus inputan
               $('#kode_jabatan').val('')
               $('#nama_jabatan').val('')
               $('#gaji_pokok').val('')
               $('#tunjangan').val('')

               Toast.fire({
                  icon: 'success',
                  title: 'Jabatan berhasil ditambahkan'
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
      // akhir tambah jabatan


      // tutup modal edit jabatan
      $(document).on('click', '#tutup-modal-edit-jabatan', function(){
         $('#id_jabatan_edit').val('')
         $('#kode_jabatan_edit').val('')
         $('#nama_jabatan_edit').val('')
         $('#gaji_pokok_edit').val('')
         $('#tunjangan_edit').val('')

         let validate = $('#form-edit-jabatan')
         validate.find('.form-text').remove()
      })
      // akhir tutup modal edit jabatan


      // ambil data detail jabatan untuk di edit
      $(document).on('click', '.modal-edit-jabatan', function(e){
         e.preventDefault()
         let id = $(this).attr('id')

         let btn = document.getElementById('btn-edit-jabatan')
         btn.setAttribute('disabled', true)
         let wait = document.getElementById('wait')
         wait.style.display = 'block'

         $.ajax({
            typr: 'GET',
            url: 'jabatan/detail/'+ id,
            success: function(response){
               $('#id_jabatan_edit').val(response.jabatan.id)
               $('#kode_jabatan_edit').val(response.jabatan.kode_jabatan)
               $('#nama_jabatan_edit').val(response.jabatan.nama_jabatan)
               $('#gaji_pokok_edit').val(response.jabatan.gaji_pokok)
               $('#tunjangan_edit').val(response.jabatan.tunjangan)
               btn.removeAttribute('disabled', false)
               wait.style.display = 'none'
            }
         })
      })
      // akhir ambil data detail jabatan untuk di edit


      // proses edit jabatan
      $(document).on('submit', '#form-edit-jabatan', function(e){
         e.preventDefault()
         let id = $('#id_jabatan_edit').val()

         let validate = $('#form-edit-jabatan')
         validate.find('.form-text').remove()

         let btn = document.getElementById('btn-edit-jabatan')
         btn.setAttribute('disabled', true)
         let loadingEdit = document.getElementById('loadingEdit')
         loadingEdit.style.display = 'block'
         let formData = new FormData($('#form-edit-jabatan')[0])

         $.ajax({
            type: 'POST',
            url: 'jabatan/edit/'+ id,
            data: formData,
            processData: false,
            contentType: false,
            success: function(){
               $('#example').DataTable().ajax.reload()
               $('#tutup-modal-edit-jabatan').click()

               btn.removeAttribute('disabled', false)
               loadingEdit.style.display = 'none'

               Toast.fire({
                  icon: 'success',
                  title: 'Jabatan berhasil diedit'
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
      // akhir proses edit jabatan


      // hapus jabatan
      $(document).on('click', '.hapus-jabatan', function(){
         let id = $(this).attr('id')
         let nama_jabatan = $(this).attr('nama-jabatan')

         Swal.fire({
            title: 'Apa kamu yakin ?',
            text: 'ingin menghapus jabatan "'+ nama_jabatan + '"',
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
                  url: 'jabatan/hapus/'+ id,
                  success: function(){
                     $('#example').DataTable().ajax.reload()
                     Toast.fire({
                        icon: 'success',
                        title: 'Jabatan berhasil dihapus'
                     })
                  },
                  error: function(){
                     toastFail.fire({
                        icon: 'error',
                        title: 'Jabatan gagal dihapus, masih ada mahasiswa yang menggunakan jabatan ini !'
                     })
                  }
               })

            }
         })
      })
      // akhir hapus jabatan

   })
</script>
@endpush