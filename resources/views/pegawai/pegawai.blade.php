@extends('templates/template')

@section('konten')
<div class="row">
   <div class="col-md">
      <div class="d-flex justify-content-between">
         <h6>Data Pegawai</h6>
         <button class="btn btn-sm btn-primary" data-bs-toggle='modal' data-bs-target='#modal-tambah-pegawai'>Tambah</button>
      </div>
      <hr>
      <table id="example" class="table table-sm">
         <thead>
            <tr>
               <th>No</th>
               <th>NIP</th>
               <th>Nama</th>
               <th>Jabatan</th>
               <th>Golongan</th>
               <th>Jenis Kelamin</th>
               <th>Telepon</th>
               <th>Opsi</th>
            </tr>
         </thead>
      </table>
   </div>
</div>

<!-- modal tambah pegawai -->
<div class="modal fade" id="modal-tambah-pegawai" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-tambah-pegawaiLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-tambah-pegawaiLabel">Tambah Pegawai</h5>
        <button type="button" class="btn-close" id="tutup-modal-tambah-pegawai" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="form-tambah-pegawai">
           <div class="row">
              <div class="col-md">
                  <div class="form-group mt-3">
                     <label>NIP</label>
                     <input type="text" name="nip" id="nip" class="form-control">
                  </div>
                  <div class="form-group mt-3">
                     <label>Nama</label>
                     <input type="text" name="nama" id="nama" class="form-control">
                  </div>
                  <div class="form-group mt-3">
                     <label>Email</label>
                     <input type="text" name="email" id="email" class="form-control">
                  </div>
              </div>
              <div class="col-md">
                  <div class="form-group mt-3">
                     <label>Jabatan</label>
                     <select name="jabatan_id" id="jabatan_id" class="form-control">
                        <option value="">----</option>
                        @foreach($jabatan as $j)
                        <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="form-group mt-3">
                     <label>Golongan</label>
                     <select name="golongan_id" id="golongan_id" class="form-control">
                        <option value="">----</option>
                        @foreach($golongan as $g)
                        <option value="{{ $g->id }}">{{ $g->kode_golongan }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="form-group mt-3">
                     <label>Jenis Kelamin</label>
                     <select name="jenis_kelamin_id" id="jenis_kelamin_id" class="form-control">
                        <option value="">----</option>
                        @foreach($jenis_kelamin as $jk)
                        <option value="{{ $jk->id }}">{{ $jk->nama_jenis_kelamin }}</option>
                        @endforeach
                     </select>
                  </div>    
              </div>
           </div>
           <div class="row">
              <div class="col">
                  <div class="form-group mt-3">
                     <label>Telepon</label>
                     <input type="text" name="telepon" id="telepon" class="form-control">
                  </div>
              </div>
           </div>
            <button type="submit" class="btn btn-sm btn-primary float-end d-flex mt-3" id="btn-tambah-pegawai">
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
    </div>
  </div>
</div>
<!-- akhir modal edit jabatan -->

<!-- modal edit pegawai -->
<div class="modal fade" id="modal-edit-pegawai" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-edit-pegawaiLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-edit-pegawaiLabel">Edit Pegawai</h5>
        <button type="button" class="btn-close" id="tutup-modal-edit-pegawai" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="form-edit-pegawai">
           <div class="row">
              <div class="col-md">
                 <input type="hidden" id="id_edit">
                  <div class="form-group mt-3">
                     <label>NIP</label>
                     <input type="text" name="nip_edit" id="nip_edit" class="form-control" readonly>
                  </div>
                  <div class="form-group mt-3">
                     <label>Nama</label>
                     <input type="text" name="nama_edit" id="nama_edit" class="form-control">
                  </div>
                  <div class="form-group mt-3">
                     <label>Email</label>
                     <input type="text" name="email_edit" id="email_edit" class="form-control" readonly>
                  </div>
              </div>
              <div class="col-md">
                  <div class="form-group mt-3">
                     <label>Jabatan</label>
                     <select name="jabatan_id_edit" id="jabatan_id_edit" class="form-control">
                        @foreach($jabatan as $j)
                        <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="form-group mt-3">
                     <label>Golongan</label>
                     <select name="golongan_id_edit" id="golongan_id_edit" class="form-control">
                        @foreach($golongan as $g)
                        <option value="{{ $g->id }}">{{ $g->kode_golongan }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="form-group mt-3">
                     <label>Jenis Kelamin</label>
                     <select name="jenis_kelamin_id_edit" id="jenis_kelamin_id_edit" class="form-control">
                        @foreach($jenis_kelamin as $jk)
                        <option value="{{ $jk->id }}">{{ $jk->nama_jenis_kelamin }}</option>
                        @endforeach
                     </select>
                  </div>   
              </div>
           </div>
           <div class="row">
              <div class="col">
                  <div class="form-group mt-3">
                     <label>Telepon</label>
                     <input type="text" name="telepon_edit" id="telepon_edit" class="form-control">
                  </div>
              </div>
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
               <button type="submit" class="btn btn-sm btn-primary float-end d-flex" id="btn-edit-pegawai">
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
            url: 'pegawai'
         },
         columns: [
            {
               "data" : null, "sortable" : false,
               render: function(data, type, row, meta){
                  return meta.row + meta.settings._iDisplayStart + 1
               }
            },
            {data: 'nip', name: 'nip'},
            {data: 'nama', name: 'nama'},
            {data: 'jabatan', name: 'jabatan'},
            {data: 'golongan', name: 'golongan'},
            {data: 'jenis_kelamin', name: 'jenis_kelamin'},
            {data: 'telepon', name: 'telepon'},
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


      // tutup modal tambah pegawai
      $(document).on('click', '#tutup-modal-tambah-pegawai', function(){
         $('#nip').val('')
         $('#nama').val('')
         $('#email').val('')
         $('#golongan_id').val('')
         $('#jabatan_id').val('')
         $('#jenis_kelamin_id').val('')
         $('#telepon').val('')

         let validation = $('#form-tambah-pegawai')
         validation.find('.form-text').remove()
      })
      // akhir tutup modal tambah pegawai


      // tambah pegawai
      $(document).on('submit', '#form-tambah-pegawai', function(e){
         e.preventDefault()

         let btn = document.getElementById('btn-tambah-pegawai')
         btn.setAttribute('disabled', true)
         let loading = document.getElementById('loading')
         loading.style.display = 'block'
         let validation = $('#form-tambah-pegawai')
         validation.find('.form-text').remove()

         let formData = new FormData($('#form-tambah-pegawai')[0])

         $.ajax({
            type: 'POST',
            url: 'pegawai/tambah',
            data: formData,
            processData: false,
            contentType: false,
            success: function(){
               $('#example').DataTable().ajax.reload()

               $('#tutup-modal-tambah-pegawai').click()
               loading.style.display = 'none'
               btn.removeAttribute('disabled', false)

               Toast.fire({
                  icon: 'success',
                  title: 'Pegawai berhasil ditambahkan'
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
      // akhir tambah pegawai


      // ambil data untuk modal edit pegawai
      $(document).on('click', '.edit-pegawai', function(){
         let id = $(this).attr('id')

         let btn = document.getElementById('btn-edit-pegawai')
         btn.setAttribute('disabled', true)
         let wait = document.getElementById('wait')
         wait.style.display = 'block'

         $.ajax({
            type: 'GET',
            url: 'pegawai/detail/'+ id,
            success: function(response){
               console.log(response)
               $('#id_edit').val(response.pegawai.id)
               $('#nip_edit').val(response.pegawai.nip)
               $('#nama_edit').val(response.pegawai.nama)
               $('#email_edit').val(response.pegawai.email)
               $('#jabatan_id_edit').val(response.pegawai.jabatan_id)
               $('#golongan_id_edit').val(response.pegawai.golongan_id)
               $('#jenis_kelamin_id_edit').val(response.pegawai.jenis_kelamin_id)
               $('#telepon_edit').val(response.pegawai.telepon)

               btn.removeAttribute('disabled', false)
               wait.style.display = 'none'
            }
         })
      })
      // akhir ambil data untuk modal edit pegawai


      // tutup modal edit pegawai
      $(document).on('click', '#tutup-modal-edit-pegawai', function(){
         let validation = $('#form-edit-pegawai')
         validation.find('.form-text').remove()
      })
      // akhir tutup modal edit pegawai


      // edit pegawai
      $(document).on('submit', '#form-edit-pegawai', function(e){
         e.preventDefault()

         let id = $('#id_edit').val()
         let btn = document.getElementById('btn-edit-pegawai')
         btn.setAttribute('disabled', true)
         let loadingEdit = document.getElementById('loadingEdit')
         loadingEdit.style.display = 'block'

         let formData = new FormData($('#form-edit-pegawai')[0])

         $.ajax({
            type: 'POST',
            url: 'pegawai/edit/'+ id,
            data: formData,
            contentType: false,
            processData: false,
            success: function(){
               $('#example').DataTable().ajax.reload()

               $('#tutup-modal-edit-pegawai').click()
               btn.removeAttribute('disabled', false)
               loadingEdit.style.display = 'none'

               Toast.fire({
                  icon: 'success',
                  title: 'Pegawai berhasil diedit'
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
      // akhir edit pegawai


      // hapus pegawai
      $(document).on('click', '.hapus-pegawai', function(e){
         e.preventDefault()
         let id = $(this).attr('id')
         let nama = $(this).attr('nama-pegawai')

         Swal.fire({
            title: 'Apa kamu yakin ?',
            text: 'ingin menghapus pegawai "'+ nama + '"',
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
                  url: 'pegawai/hapus/'+ id,
                  success: function(){
                     $('#example').DataTable().ajax.reload()
                     Toast.fire({
                        icon: 'success',
                        title: 'Pegawai berhasil dihapus'
                     })
                  },
                  error: function(){
                     toastFail.fire({
                        icon: 'error',
                        title: 'Pegawai tidak bisa di hapus, masih ada data gaji yang menggunakan pegawai ini'
                     })
                  }
               })

            }
         })
      })
      // akhir hapus pegawai

   })
</script>
@endpush