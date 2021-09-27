@extends('templates/template')

@section('konten')
<div class="row">
   <div class="col-md">
      <h6>Input Kehadiran</h6>
   </div>
   <div class="col-md d-flex">
      <form action="" class="d-flex ms-auto" id="form-generate">
         <div class="form-group">
            <select name="bulan" id="bulan" class="form-control form-control-edited">
               <option value="">-Bulan-</option>
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
            <select name="tahun" id="tahun" class="form-control form-control-edited">
               <option value="">-Tahun-</option>
               <option value="2021">2021</option>
               <option value="2022">2022</option>
               <option value="2023">2023</option>
               <option value="2024">2024</option>
               <option value="2025">2025</option>
            </select>
         </div>
         <button type="submit" class="btn btn-sm btn-primary d-flex" id="btn-generate">
            <div>Generate</div>
            <svg id="loading-generate" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgba(255, 255, 255, 0); display: none; shape-rendering: auto;" width="24px" height="24px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
               <g>
                  <path d="M50 15A35 35 0 1 0 74.74873734152916 25.251262658470843" fill="none" stroke="#ffffff" stroke-width="12"></path>
                  <path d="M49 3L49 27L61 15L49 3" fill="#ffffff"></path>
                  <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
               </g>
            </svg>
         </button>
      </form>
      <div style="border:1px solid gray;margin:0 4px;"></div>
      <a href="{{ url('kehadiran') }}" class="btn btn-sm btn-dark">Kembali</a>
   </div>
</div>
<hr>
<div class="row">
   <div class="col-md" id="daftar-kehadiran">
      <div class="text-center">
         <img class="img-cari" src="{{ asset('assets/img/cari.png') }}">
         <h5 class="text-cari-data">Silahkan generate data</h5>
      </div>
   </div>
</div>
@endsection

@push('js')
<script>
   $(document).ready(function(){

      // generate data
      $(document).on('click', '#btn-generate', function(e){
         e.preventDefault()

         // manipulasi btn generate dan loading generate
         let btn = document.getElementById('btn-generate')
         btn.setAttribute('disabled', true)
         let loading = document.getElementById('loading-generate')
         loading.style.display = 'block'
         
         // sebelum melakuakan fungsi generate data kosongkan dulu yang ada di dalam id daftar-kehadiran
         let daftarKehadiran = $('#daftar-kehadiran')
         daftarKehadiran.html('')
         let alertGenerate = $('#alert-generate')
         alertGenerate.remove()
         
         let bln = document.getElementById('bulan').value
         let thn = document.getElementById('tahun').value
         // let bt = bln + thn

         if (bln=="" || thn=="")
         {
            toastFail.fire({
               icon: 'error',
               title: 'Bulan dan Tahun harus di pilih'
            })
            daftarKehadiran.append('<div class="text-center">\
                                       <img class="img-cari" src="{{ asset("assets/img/cari.png") }}">\
                                       <h5 class="text-cari-data">Silahkan generate data</h5>\
                                    </div>')

            btn.removeAttribute('disabled', false)
            loading.style.display = 'none'
         }else{
            $.ajax({
               type: 'GET',
               url: 'kehadiran-input/generate',
               data:{
                  bulan: bln, 
                  tahun: thn
               },
               success: function(response){

                  // jika data nya ada dan tidak kosong
                  if(response.data.length > 0){
                     $('#daftar-kehadiran').append('<div class="alert alert-success text-center">Form Input          kehadiran bulan <b>'+ response.dataBulan +'</b> tahun <b>'+ thn +'</b></div>\
                                                   <form id="form-input-kehadiran">\
                                                   <table id="example" class="table table-sm" style="width:100%">\
                                                      <thead>\
                                                         <tr>\
                                                            <th>No</th>\
                                                            <th>NIP</th>\
                                                            <th>Nama</th>\
                                                            <th>Sakit</th>\
                                                            <th>Izin</th>\
                                                            <th>Alpha</th>\
                                                         </tr>\
                                                      </thead>\
                                                      <tbody id="tbody-form-input">\
                                                      </tbody>\
                                                   </table>\
                                                   <div class="d-flex justify-content-center">\
                                                      <button type="submit" class="btn btn-sm btn-primary float-end mt-3 mb-5 d-flex" id="btn-tambah-inputan">\
                                                         <div>Lanjutkan</div>\
                                                         <svg id="loading" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgba(255, 255, 255, 0); display: none; shape-rendering: auto;" width="24px" height="24px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">\
                                                            <g>\
                                                               <path d="M50 15A35 35 0 1 0 74.74873734152916 25.251262658470843" fill="none" stroke="#ffffff" stroke-width="12"></path>\
                                                               <path d="M49 3L49 27L61 15L49 3" fill="#ffffff"></path>\
                                                               <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>\
                                                            </g>\
                                                         </svg>\
                                                      </button>\
                                                   </div>\
                                                   </form>')
                     
                     // menambahkan baris di tbody form inputan
                     let no = 0
                     $.each(response.data, function(key, value){
                        no++
                        $('#tbody-form-input').append('<tr>\
                                                         <td>'+ no +'</td>\
                                                         <td>'+ value.nip +'</td>\
                                                         <td>'+ value.nama +'</td>\
                                                         <td>\
                                                            <input type="hidden" name="pegawai_id[]" value="'+ value.id +'">\
                                                            <input type="hidden" name="bulan[]" value="'+ bln +'">\
                                                            <input type="hidden" name="tahun[]" value="'+ thn +'">\
                                                            <input type="number" min="0" name="sakit[]" class="form-control" required>\
                                                         </td>\
                                                         <td>\
                                                            <input type="number" min="0" name="izin[]" class="form-control" required>\
                                                         </td>\
                                                         <td>\
                                                            <input type="number" min="0" name="alpha[]" class="form-control" required>\
                                                         </td>\
                                                      </tr>')
                     })
                  }else{
                     //jika data nya ada tapi sudah di input
                     $('#daftar-kehadiran').append('<div class="text-center">\
                                                      <img class="img-cari" src="{{ asset("assets/img/no-data.png") }}">\
                                                      <h5 class="text-cari-data">Kehadiran bulan <b>'+ response.dataBulan +'</b> tahun <b>'+ thn +'</b> sudah di input</h5>\
                                                   </div>')
                  }

                  btn.removeAttribute('disabled', false)
                  loading.style.display = 'none'
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


      // input kehadiran
      $(document).on('submit', '#form-input-kehadiran', function(e){
         e.preventDefault()

         let btn = document.getElementById('btn-tambah-inputan')
         btn.setAttribute('disabled', true)
         let loading = document.getElementById('loading')
         loading.style.display = 'block'

         let formData = new FormData($('#form-input-kehadiran')[0])

         $.ajax({ 
            type: 'POST',
            url: 'kehadiran-input/tambah',
            data: formData,
            processData: false,
            contentType: false,
            success: function(){
               Toast.fire({
                  icon: 'success',
                  title: 'Kehadiran berhasil di input'
               })

               window.location.replace('kehadiran')
            }
         })
      })
      // akhir input kehadiran

   })
</script>
@endpush