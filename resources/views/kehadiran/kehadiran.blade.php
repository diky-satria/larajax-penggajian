@extends('templates/template')

@section('konten')
<div class="row">
   <div class="col-md">
      <h6>Data Kehadiran</h6>
   </div>
   <div class="col-md d-flex">
      <form action="" class="d-flex ms-auto">
         <div class="form-group">
            <select class="form-control form-control-edited" name="bulan" id="bulan" required>
               <option value="">----</option>
               <option value="1">Januari</option>
               <option value="2">Februari</option>
               <option value="3">Maret</option>
               <option value="4">April</option>
               <option value="5">Mei</option>
               <option value="6">Juni</option>
               <option value="7">Juli</option>
               <option value="8">Agustus</option>
               <option value="9">September</option>
               <option value="10">Oktober</option>
               <option value="11">November</option>
               <option value="12">Desember</option>
            </select>
         </div>
         <div class="form-group mx-1">
            <select class="form-control form-control-edited" name="tahun" id="tahun" required>
               <option value="">----</option>
               <option value="2021">2021</option>
               <option value="2022">2022</option>
               <option value="2023">2023</option>
               <option value="2024">2024</option>
               <option value="2025">2025</option>
            </select>
         </div>
         <button class="btn btn-sm btn-primary d-flex" id="btn-cari">
            <div>Cari</div>
            <svg id="loadingCari" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgba(255, 255, 255, 0); display: none; shape-rendering: auto;" width="24px" height="24px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                  <g>
                     <path d="M50 15A35 35 0 1 0 74.74873734152916 25.251262658470843" fill="none" stroke="#ffffff" stroke-width="12"></path>
                     <path d="M49 3L49 27L61 15L49 3" fill="#ffffff"></path>
                     <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                  </g>
            </svg>
         </button>
      </form>
      <div style="border:1px solid gray;margin:0 4px;"></div>
      <a href="{{ url('kehadiran-input') }}" class="btn btn-sm btn-primary">Input</a>
   </div>
</div>
<hr>
<div class="row">
   <div class="col-md" id="table-kehadiran">
      <div class="text-center">
         <img class="img-cari" src="{{ asset('assets/img/cari.png') }}">
         <h5 class="text-cari-data">Silahkan cari data</h5>
      </div>
   </div>
</div>

<!-- modal edit kehadiran -->
<div class="modal fade" id="modal-edit-kehadiran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-edit-kehadiranLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-edit-kehadiranLabel">Edit Kehadiran</h5>
        <button type="button" class="btn-close" id="tutup-modal-edit-kehadiran" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" id="form-edit-kehadiran">
           <input type="hidden" id="id">
           <div class="row">
              <div class="col-md">
                  <div class="form-group mt-3">
                     <label>NIP</label>
                     <input type="text" name="nip" id="nip" class="form-control" readonly>
                  </div>
              </div>
              <div class="col-md">
                  <div class="form-group mt-3">
                     <label>Nama</label>
                     <input type="text" name="nama" id="nama" class="form-control" readonly>
                  </div>
              </div>
           </div>
           <div class="row">
              <div class="col-md">
                  <div class="form-group mt-3">
                     <label>Sakit</label>
                     <input type="text" name="sakit" id="sakit" class="form-control">
                  </div>
              </div>
              <div class="col-md">
                  <div class="form-group mt-3">
                     <label>Izin</label>
                     <input type="text" name="izin" id="izin" class="form-control">
                  </div>
              </div>
              <div class="col-md">
                  <div class="form-group mt-3">
                     <label>Alpha</label>
                     <input type="text" name="alpha" id="alpha" class="form-control">
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
               <button type="submit" class="btn btn-sm btn-primary float-end d-flex" id="btn-edit-kehadiran">
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
<!-- akhir modal edit kehadiran -->
@endsection

@push('js')
<!-- datatable -->
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap5.min.js"></script>
<!-- akhir datatable -->
<script>
   $(document).ready(function(){

      // cari data
      $(document).on('click', '#btn-cari', function(e){
         e.preventDefault()

         let btn = document.getElementById('btn-cari')
         btn.setAttribute('disabled', true)
         let loadingCari = document.getElementById('loadingCari')
         loadingCari.style.display = 'block'

         $('#table-kehadiran').html('')

         let bulan = $('#bulan').val()
         let tahun = $('#tahun').val()

         if(bulan === '' || tahun === ''){
            toastFail.fire({
               icon: 'error',
               title: 'Bulan dan Tahun harus di pilih'
            })

            $('#table-kehadiran').append('<div class="text-center">\
                                             <img class="img-cari" src="{{ asset("assets/img/cari.png") }}">\
                                             <h5 class="text-cari-data">Silahkan cari data</h5>\
                                          </div>')

            btn.removeAttribute('disabled', false)
            loadingCari.style.display = 'none'
         }else{
            $.ajax({
               type: 'GET',
               url: 'kehadiran/cari',
               data: {
                  bulan: bulan,
                  tahun: tahun
               },
               success: function(response){

                  if(response.data.length > 0){

                     // tambahkan script html untuk membuat table
                     $('#table-kehadiran').append('<table id="example" class="table table-sm">\
                                                      <thead>\
                                                         <tr>\
                                                            <th>No</th>\
                                                            <th>NIP</th>\
                                                            <th>Nama</th>\
                                                            <th>Sakit</th>\
                                                            <th>Izin</th>\
                                                            <th>Alpha</th>\
                                                            <th>Opsi</th>\
                                                         </tr>\
                                                      </thead>\
                                                      <tbody id="tbody-data-kehadiran">\
                                                      </tbody>\
                                                   </table>')
   
                     // menambahkan data di tbody
                     let no = 0                              
                     $.each(response.data, function(key, value){
                        no++
                        $('#tbody-data-kehadiran').append('<tr>\
                                                            <td>'+ no +'</td>\
                                                            <td>'+ value.nip +'</td>\
                                                            <td>'+ value.nama +'</td>\
                                                            <td>'+ value.sakit +'</td>\
                                                            <td>'+ value.izin +'</td>\
                                                            <td>'+ value.alpha +'</td>\
                                                            <td><button class="btn btn-sm btn-success edit-kehadiran" data-bs-toggle="modal" data-bs-target="#modal-edit-kehadiran" id="'+ value.id +'">Edit</button></td>\
                                                         </tr>')
                     })
   
                     // memasang datatable client side
                     $('#example').DataTable()
   
                     btn.removeAttribute('disabled', false)
                     loadingCari.style.display = 'none'

                  }else{

                     $('#table-kehadiran').append('<div class="text-center">\
                                                      <img class="img-cari" src="{{ asset("assets/img/no-data.png") }}">\
                                                      <h5 class="text-cari-data">Data belum di input, silahkan input dulu</h5>\
                                                   </div>')
                     btn.removeAttribute('disabled', false)
                     loadingCari.style.display = 'none'

                  }

               }
            })
         }
      })


      // csrf token
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      })
      // akhir csrf token


      // ambil data untuk modal edit kehadiran
      $(document).on('click', '.edit-kehadiran', function(){
         let wait = document.getElementById('wait')
         wait.style.display = 'block'
         let btn = document.getElementById('btn-edit-kehadiran')
         btn.setAttribute('disabled', true)

         let id = $(this).attr('id')

         $.ajax({
            type: 'GET',
            url: 'kehadiran/detail/'+id,
            success: function(response){

               $('#id').val(response.data.id)
               $('#nip').val(response.data.nip)
               $('#nama').val(response.data.nama)
               $('#sakit').val(response.data.sakit)
               $('#izin').val(response.data.izin)
               $('#alpha').val(response.data.alpha)

               wait.style.display = 'none'
               btn.removeAttribute('disabled', false)
            }
         })
      })
      // akhir ambil data untuk modal edit kehadiran


      // proses edit kehadiran
      $(document).on('submit', '#form-edit-kehadiran', function(e){
         e.preventDefault()
         let validation = $('#form-edit-kehadiran')
         validation.find('.form-text').remove()

         let btn = document.getElementById('btn-edit-kehadiran')
         btn.setAttribute('disabled', true)
         let loadingEdit = document.getElementById('loadingEdit')
         loadingEdit.style.display = 'block'

         let id = $('#id').val()
         let formData = new FormData($('#form-edit-kehadiran')[0])

         $.ajax({
            type: 'POST',
            url: 'kehadiran/edit/'+id,
            data: formData,
            processData: false,
            contentType: false,
            success: function(){
               $('#btn-cari').click()
               $('#tutup-modal-edit-kehadiran').click()

               btn.removeAttribute('disabled', false)
               loadingEdit.style.display = 'none'
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
      // akhir proses edit kehadiran

   })
</script>
@endpush