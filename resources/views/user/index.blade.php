@extends('templates/template')

@section('konten')
<div class="row user">
   <div class="col-lg-8">
      <div class="card">
         <div class="card-header">
            Riwayat
         </div>
         <div class="card-body">
            <ul class="list-group">
               
            </ul>
         </div>
      </div>
   </div>
   <div class="col-lg-4 kanan-user text-center">
      <img src="{{ asset('assets/img/user-gaji.png') }}">
      <h5 style="font-size:16px;font-weight:bold;">CEK GAJIMU DISINI</h5>
   </div>
</div>

<!-- modal slip gaji user -->
<div class="modal fade modal-slip-edited" id="modal-slip-gaji-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-slip-gaji-userLabel" aria-hidden="true">
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
        <button type="button" class="btn-close" id="tutup-modal-slip-gaji-user" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-body-cetak">
         <div class="row">
            <div class="col text-center">
               <h6 class="mb-4">PT. JAVA ANIMA DARMAJA</h6>
               <p>One Stop Business IT and Solution</p>
               <p>Jl. Cempaka Blok C3 No.24 Perum Beringin Raya, Kemiling, Bandar Lampung, Telp. 021-123456</p>
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
               <p>B. Lampung, 30 Juni 2021</p>
               <p>Manager Operasional</p>
               <p style="margin-top:70px;">Supri. SE.</p>
            </div>
         </div>
      </div>
      <div class="modal-footer mt-2" style="border:0;">
         <button class="btn btn-sm btn-primary float-end" id="btn-cetak-pdf-user">PDF</button>
      </div>
    </div>
  </div>
</div>
<!-- akhir modal slip gaji user -->
@endsection

@push('js')
<!-- html2pdf | di documentasi linknya di console -->
<script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.min.js"></script>
<!-- akhir html2pdf -->
<script>
   let overlay = document.getElementById('overlay-container')
   overlay.style.display = 'flex'
   $(document).ready(function(){

      // ambil data gaji
      $.ajax({
         type: 'GET',
         url: 'user/riwayat',
         success: function(response){
            $.each(response.data, function(key, value){
               $('.list-group').append('<li class="list-group-item d-flex justify-content-between">\
                                          <div>\
                                             <span id="bulan-gajian">'+ value.dataBulan +'</span>\
                                             <span id="tahun-gajian">'+ value.dataTahun +'</span></div>\
                                          <span class="badge rounded-pill bg-info text-dark detail-slip-gaji-user" data-bs-toggle="modal" data-bs-target="#modal-slip-gaji-user" bulan="'+ value.dataBulanAngka +'" tahun="'+ value.dataTahun +'" bulanHuruf="'+ value.dataBulan +'">Detail</span>\
                                       </li>')
            })

            overlay.style.display = 'none'
         }
      })

      // tutup modal detail user
      $(document).on('click', '#tutup-modal-slip-gaji-user', function(){
         // hilangkan data detail
         $('#bulan-detail').html('')
         $('#tahun-detail').html('')
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
      // akhir tutup modal detail user

      // modeal detail gaji
      $(document).on('click', '.detail-slip-gaji-user', function(){
         let wait = document.getElementById('wait')
         wait.style.display = 'block'

         let bulan = $(this).attr('bulan')
         let tahun = $(this).attr('tahun')
         let bulanHuruf = $(this).attr('bulanHuruf')

         $.ajax({
            type: 'GET',
            url: 'user/detail/'+ bulan + '/' + tahun,
            success: function(response){
               
               // ganti bulan dan tanggal
               $('#bulan-detail').append(bulanHuruf)
               $('#tahun-detail').append(tahun)

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

      // cetak pdf
      $(document).on('click', '#btn-cetak-pdf-user', function(e){
         e.preventDefault()
         let bulan = document.getElementById('bulan-detail').textContent
         let tahun = document.getElementById('tahun-detail').textContent

         var element = document.getElementById('modal-body-cetak');
         var opt = {
            margin:       [20, 15, 0, 15],
            filename:     'slip-gaji-'+ bulan +'-'+ tahun +'.pdf'
         };

         html2pdf().set(opt).from(element).save();
      })

   })
</script>
@endpush