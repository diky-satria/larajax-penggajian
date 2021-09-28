@extends('templates/template')

@section('konten')
<div class="row">
   <div class="col-md">
      <h6>Slip Gaji</h6>
   </div>
   <div class="col-md">
      <form action="" class="d-flex float-end" id="form-cari">
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
         <button type="submit" class="btn btn-sm btn-primary d-flex" id="btn-cari-slip">
            <div>Cari</div>
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
<hr>
<div class="row">
   <div class="col-md" id="daftar-kehadiran-slip">
      <div class="text-center">
         <img class="img-cari" src="{{ asset('assets/img/cari.png') }}">
         <h5 class="text-cari-data">Silahkan cari data</h5>
      </div>
   </div>
</div>

<!-- modal slip gaji -->
<div class="modal fade modal-slip-edited" id="modal-slip-gaji" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-slip-gajiLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header modal-header-edited">
         <div id="wait" style="display:none;float:left;">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;float:left;" width="24px" height="24px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
               <g>
               <path d="M50 15A35 35 0 1 0 74.74873734152916 25.251262658470843" fill="none" stroke="#007bff" stroke-width="12"></path>
               <path d="M49 3L49 27L61 15L49 3" fill="#007bff"></path>
               <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
               </g>
            </svg><span style="font-weight:bold;display:block;float:right;">Loading...</span>
         </div>
        <button type="button" class="btn-close" id="tutup-modal-slip-gaji" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-body-cetak">
         <div class="row">
            <div class="col text-center">
               <h6 class="mb-4">PT. JAVA ANIMA DARMAJA</h6>
               <p style="line-height:15px;">One Stop Business IT and Solution</p>
               <p style="line-height:15px;">Jl. Cempaka Blok C3 No.24 Perum Beringin Raya, Kemiling, Bandar Lampung, Telp. 021-123456</p>
               <hr>
               <h6>SLIP GAJI KARYAWAN</h6>
               <h6>Bulan <b><span id="bulan-detail"></span></b> Tahun <b><span id="tahun-detail"></span></b></h6>
            </div>
         </div>
         <div class="row">
            <div class="col-6">
               <table class="table table-sm" style="border:0px solid white;">
                  <tr>
                     <td>NIP</td>
                     <td>:</td>
                     <td id="nip-detail"></td>
                  </tr>
                  <tr>
                     <td>Nama</td>
                     <td>:</td>
                     <td id="nama-detail"></td>
                  </tr>
                  <tr>
                     <td>Jabatan</td>
                     <td>:</td>
                     <td id="jabatan-detail"></td>
                  </tr>
                  <tr>
                     <td>Golongan</td>
                     <td>:</td>
                     <td id="golongan-detail"></td>
                  </tr>
               </table>
            </div>
         </div>
         <div class="row">
            <div class="col mt-2">
               <h6>PENGHASILAN</h6>
               <table class="table table-sm" style="border:0px solid white;">
                  <tr>
                     <td>Gaji Pokok</td>
                     <td>=</td>
                     <td style="text-align:right;" id="gaji-detail"></td>
                  </tr>
                  <tr>
                     <td>Tunjangan Jabatan</td>
                     <td>=</td>
                     <td style="text-align:right;" id="tunjangan-detail"></td>
                  </tr>
                  <tr>
                     <td><b>Total (A)<b></td>
                     <td colspan="2" style="text-align:right;"><b id="total-a"><b></td>
                  </tr>
               </table>
            </div>
            <div class="col mt-3">
               <h6>POTONGAN</h6>
               <table class="table table-sm" style="border:0px solid white;">
                  <tr>
                     <td>PPh (10%)</td>
                     <td>=</td>
                     <td style="text-align:right;" id="pph-detail"></td>
                  </tr>
                  <tr>
                     <td>Asuransi</td>
                     <td>=</td>
                     <td style="text-align:right;" id="asuransi-detail"></td>
                  </tr>
                  <tr>
                     <td>Izin ( <span id="izin-nilai"></span> * 100.000 )</td>
                     <td>=</td>
                     <td style="text-align:right;" id="izin-detail"></td>
                  </tr>
                  <tr>
                     <td>Alpha ( <span id="alpha-nilai"></span> * 200.000 )</td>
                     <td>=</td>
                     <td style="text-align:right;" id="alpha-detail"></td>
                  </tr>
                  <tr>
                     <td><b>Total (B)<b></td>
                     <td colspan="2" style="text-align:right;"><b id="total-b"><b></td>
                  </tr>
               </table>
            </div>
         </div>
         <div class="row" style="padding:0px 20px;">
            <div class="col total-gaji">
               <h6>PENERIMAAN BERSIH (A-B) = <span id="total-bersih"></span></h6>
            </div>
         </div>
         <div class="row">
            <div class="col-8"></div>
            <div class="col-4 mt-5">
               <p style="line-height:15px;">B. Lampung, 30 Juni 2021</p>
               <p style="line-height:15px;">Manager Operasional</p>
               <p style="margin-top:70px;">Supri. SE.</p>
            </div>
         </div>
      </div>
      <div class="modal-footer mt-2" style="border:0;">
         <button class="btn btn-sm btn-primary float-end" id="btn-cetak-pdf">PDF</button>
      </div>
    </div>
  </div>
</div>
<!-- akhir modal slip gaji -->
@endsection

@push('js')
<!-- datatable -->
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap5.min.js"></script>
<!-- akhir datatable -->

<!-- html2pdf | di documentasi linknya di console -->
<script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.min.js"></script>
<!-- akhir html2pdf -->
<script>
   $(document).ready(function(){

      // cari data
      $(document).on('click', '#btn-cari-slip', function(e){
         e.preventDefault()

         let btn = document.getElementById('btn-cari-slip')
         btn.setAttribute('disabled', true)
         let loading = document.getElementById('loading')
         loading.style.display = 'block'

         let daftarKehadiranSlip = $('#daftar-kehadiran-slip')
         daftarKehadiranSlip.html('')

         let bulan = $('#bulan').val()
         let tahun = $('#tahun').val()

         if(bulan === '' || tahun === ''){

            toastFail.fire({
               icon: 'error',
               title: 'Bulan dan Tahun harus di pilih'
            })
            daftarKehadiranSlip.append('<div class="text-center">\
                                          <img class="img-cari" src="{{ asset("assets/img/cari.png") }}">\
                                          <h5 class="text-cari-data">Silahkan cari data</h5>\
                                       </div>')
            btn.removeAttribute('disabled', false)
            loading.style.display = 'none'

         }else{

            $.ajax({
               type: 'GET',
               url: 'slip-gaji/cari',
               data:{
                  bulan: bulan,
                  tahun: tahun
               },
               success: function(response){

                  if(response.data.length > 0){

                     $('#daftar-kehadiran-slip').append('<div class="alert alert-success text-center">Data slip gaji bulan <b>'+ response.dataBulan +'</b> tahun <b>'+ tahun +'</b></div>\
                     <table class="table table-sm" id="example">\
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
                                                            <tbody id="tbody-data-slip">\
                                                            </tbody>\
                                                         </table>')
                     
                     let no = 0                                    
                     $.each(response.data, function(key, value){
                        no++
                        $('#tbody-data-slip').append('<tr>\
                                                         <td>'+ no +'</td>\
                                                         <td>'+ value.nip +'</td>\
                                                         <td>'+ value.nama +'</td>\
                                                         <td>'+ value.sakit +'</td>\
                                                         <td>'+ value.izin +'</td>\
                                                         <td>'+ value.alpha +'</td>\
                                                         <td><button class="btn btn-sm btn-info detail-cetak" data-bs-toggle="modal" data-bs-target="#modal-slip-gaji" id="'+ value.id +'" bulan="'+ response.dataBulan +'">Detail</button></td>\
                                                      </tr>')
                     })

                     $('#example').DataTable()
                     btn.removeAttribute('disabled', false)
                     loading.style.display = 'none'

                  }else{
                     daftarKehadiranSlip.append('<div class="text-center">\
                                                   <img class="img-cari" src="{{ asset("assets/img/no-data.png") }}">\
                                                   <h5 class="text-cari-data">Data bulan <b>'+ response.dataBulan +'</b> tahun <b>'+ tahun +'</b> belum ada, silahkan input dahulu di menu kehadiran</h5>\
                                                </div>')
                     btn.removeAttribute('disabled', false)
                     loading.style.display = 'none'
                  }
               }
            })

         }
      })


      // tutup modal slip gaji
      $(document).on('click', '#tutup-modal-slip-gaji', function(){

         // bulan dan tahun
         $('#bulan-detail').html('')
         $('#tahun-detail').html('')

         // data detail
         $('#nip-detail').html('')
         $('#nama-detail').html('')
         $('#jabatan-detail').html('')
         $('#golongan-detail').html('')
         $('#gaji-detail').html('')
         $('#tunjangan-detail').html('')
         $('#total-a').html('')
         $('#pph-detail').html('')
         $('#asuransi-detail').html('')
         $('#izin-nilai').html('')
         $('#alpha-nilai').html('')
         $('#izin-detail').html('')
         $('#alpha-detail').html('')
         $('#total-b').html('')
         $('#total-bersih').html('')
      })
      // akhir tutup modal slip gaji


      // detail data untuk modal cetak
      $(document).on('click', '.detail-cetak', function(){
         let id = $(this).attr('id')
         let dataBulan = $(this).attr('bulan')
         let wait = document.getElementById('wait')
         wait.style.display = 'block'
 
         $.ajax({
            type: 'GET',
            url: 'slip-gaji/detail/'+id,
            success: function(response){

               // ubah bulan dan tahun
               $('#bulan-detail').append(dataBulan)
               $('#tahun-detail').append($('#tahun').val())

               // ambil data pegawai
               $('#nip-detail').append(response.data.nip)
               $('#nama-detail').append(response.data.nama)
               $('#jabatan-detail').append(response.data.jabatan)
               $('#golongan-detail').append(response.data.golongan)
               $('#gaji-detail').append('Rp. '+format_rupiah(parseInt(response.data.gaji)))
               $('#tunjangan-detail').append('Rp. '+ format_rupiah(parseInt(response.data.tunjangan)))

               let totala = parseInt(response.data.gaji) + parseInt(response.data.tunjangan)

               $('#total-a').append('Rp. '+ format_rupiah(totala))
               $('#pph-detail').append('Rp. '+ format_rupiah((parseInt(response.data.gaji) + parseInt(response.data.tunjangan)) * 10 / 100))
               $('#asuransi-detail').append('Rp. '+ format_rupiah(response.data.asuransi))
               $('#izin-nilai').append(response.data.izin)
               $('#alpha-nilai').append(response.data.alpha)
               $('#izin-detail').append('Rp. '+ format_rupiah(parseInt(response.data.izin) * 100000))
               $('#alpha-detail').append('Rp. '+ format_rupiah(parseInt(response.data.alpha) * 200000))

               let totalb = ((parseInt(response.data.gaji) + parseInt(response.data.tunjangan)) * 10 / 100) + parseInt(response.data.asuransi) + (parseInt(response.data.izin) * 100000) + (parseInt(response.data.alpha) * 200000)

               $('#total-b').append('Rp. '+ format_rupiah(totalb))

               $('#total-bersih').append('Rp. '+ format_rupiah(totala - totalb))

               wait.style.display = 'none'
            }
         })

      })
      // akhir detail data untuk modal cetak


      // cetak pdf
      $(document).on('click', '#btn-cetak-pdf', function(e){
         e.preventDefault()

         var element = document.getElementById('modal-body-cetak');
         var opt = {
            margin:       [20, 15, 0, 15],
            filename:     'slip-gaji.pdf'
         };

         html2pdf().set(opt).from(element).save();

      })
      // akhir cetak pdf

   })
</script>
@endpush