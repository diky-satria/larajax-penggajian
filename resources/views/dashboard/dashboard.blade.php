@extends('templates/template')

@section('konten')
<div class="row">
   <div class="col-md-4">
      <div class="back">
         <div class="front front-pegawai">
            <h6 style="font-size:13px;">DATA PEGAWAI</h6>
            <h5 id="data-pegawai"></h5>
         </div>
      </div>
   </div>
   <div class="col-md-4">
      <div class="back">
         <div class="front front-jabatan">
            <h6 style="font-size:13px;">DATA JABATAN</h6>
            <h5 id="data-jabatan"></h5>
         </div>
      </div>
   </div>
   <div class="col-md-4">
      <div class="back">
         <div class="front front-golongan">
            <h6 style="font-size:13px;">DATA GOLONGAN</h6>
            <h5 id="data-golongan"></h5>
         </div>
      </div>
   </div>
</div>
<div class="row mb-4">
   <div class="col-md">
      <div class="row">
         <div class="col-md">
            <canvas id="lineChart"></canvas>
         </div>
         <div class="col-md">
            <canvas id="barChart"></canvas>
         </div>
      </div>
   </div>
   <div class="col-md">    
      <canvas id="doughnutChart"></canvas>
   </div>
</div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
   let overlay = document.getElementById('overlay-container')
   overlay.style.display = 'flex'
   $(document).ready(function(){

      // ambil data 
      $.ajax({
         type: 'GET',
         url: 'dashboard/ambilData',
         success: function(response){
          
            $('#data-pegawai').append(response.pegawai)
            $('#data-jabatan').append(response.jabatan)
            $('#data-golongan').append(response.golongan)

            // chart line
            var ctx = document.getElementById('lineChart').getContext('2d');
            var myChart = new Chart(ctx, {
               type: 'line',
               data: {
                  labels: response.nama_jabatan,
                  datasets: [
                     {
                        label: 'Gaji Pokok',
                        data: response.gaji_pokok,
                        borderColor: 'red',
                        borderWidth: 1,
                        pointBackgroundColor: 'red',
                        tension: 0.5,
                     },
                     {
                        label: 'Tunjangan',
                        data: response.tunjangan,
                        borderColor: 'green',
                        borderWidth: 1,
                        pointBackgroundColor: 'green',
                        tension: 0.5,
                     }
                  ]
               },
               options: {
                  scales: {
                        y: {
                           beginAtZero: true
                        }
                  },
                  plugins: {
                        title: {
                           display: true,
                           text: 'Jabatan',
                           padding: {
                              top: 10,
                              bottom: 10
                           }
                        }
                  },
                  responsive: true
               }
            })
            // akhir chart line

            // chart bar
            var ctx = document.getElementById('barChart').getContext('2d');
            var myChart = new Chart(ctx, {
               type: 'bar',
               data: {
                  labels: response.kode_golongan,
                  datasets: [{
                        label: 'Uang Lembur',
                        data: response.uang_lembur,
                        backgroundColor: [
                           'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                           'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 1
                  }]
               },
               options: {
                  scales: {
                        y: {
                           beginAtZero: true
                        }
                  },
                  plugins: {
                        title: {
                           display: true,
                           text: 'Golongan',
                           padding: {
                              top: 20,
                              bottom: 10
                           }
                        }
                  },
                  responsive: true
               }
            })
            // akhir chart bar

            // doughnut chart
            var ctx = document.getElementById('doughnutChart').getContext('2d');
            var myChart = new Chart(ctx, {
               type: 'doughnut',
               data: {
                  labels: ['Laki-laki', 'Perempuan'],
                  datasets: [{
                     label: 'Jenis Kelamin',
                     data: [response.laki_laki, response.perempuan],
                     backgroundColor: [
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)'
                     ],
                     hoverOffset: 4
                  }]
               },
               options: {
                  plugins: {
                        title: {
                           display: true,
                           text: 'Jenis Kelamin',
                           padding: {
                              top: 10,
                              bottom: 10
                           }
                        }
                  },
                  responsive: true
               }
            })
            // akhir pie chart

            overlay.style.display = 'none'
         }
      })

   })
</script>
@endpush