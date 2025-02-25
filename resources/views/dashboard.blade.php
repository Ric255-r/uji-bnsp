@extends('sidebar')

@section('konten')
  <style>
    /* div {
      border: 1px solid red;
    } */
  </style>
  <div class="flex flex-wrap mt-2 mb-5">
    <div class="lg:w-4/12 md:w-4/12 lg:mb-0 md:mb-0 mb-3 w-full ">
      <div class="flex flex-wrap shadow rounded-sm mx-2 h-24">
        <div class="w-full px-6 py-3 bg-white rounded">
          <h3 class="uppercase text-sm text-green-700">Total Unit Terjual</h3>
          <p class="text-2xl font-medium pt-1 ">
            <i class="bi bi-phone text-bold"></i> {{ array_sum($jlh_jual)}} Unit
          </p>
        </div>

      </div>
    </div>
    <div class="lg:w-4/12 md:w-4/12 lg:mb-0 md:mb-0 mb-3 w-full">
      <div class="flex flex-wrap shadow rounded-sm mx-2 h-24">
        <div class="w-full px-6 py-3 bg-white rounded">
          <h3 class="uppercase text-sm text-green-700">Omset Bulan Ini</h3>
          <p class="text-2xl font-medium pt-1 ">
            <i class="bi bi-cash text-bold"></i>  Rp. {{ number_format($now_omset, 0)}}
          </p>
        </div>

      </div>
    </div>
    <div class="lg:w-4/12 md:w-4/12 lg:mb-0 md:mb-0 mb-3 w-full">
      <div class="flex flex-wrap shadow rounded-sm mx-2 h-24">
        <div class="w-full px-6 py-3 bg-white rounded">
          <h3 class="uppercase text-sm text-green-700">Total Omset</h3>
          <p class="text-2xl font-medium pt-1 ">
            <i class="bi bi-cash-stack text-bold"></i> 
            Rp. {{ number_format($total_omset, 0)}}
          </p>
        </div>

      </div>
    </div>
  </div>

  <div class="flex flex-wrap">
    <div class="lg:w-7/12 md:w-7/12 lg:mb-0 mb-3 w-full">
      <div class="flex flex-wrap shadow rounded-sm mx-2 bg-white ">
        <div id="chart" class="w-full"></div>
      </div>

    </div>
    <div class="lg:w-5/12 md:w-5/12 lg:mb-0 mb-3 w-full">
      <div class="flex flex-wrap shadow rounded-sm mx-2 bg-white lg:h-full md:h-full">
        <div id="donutChart" class="w-full"></div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script>
    // Untuk Bar Chart
    var options = {
      chart: {
        type: 'bar',

      },
      title: {
        text: 'Product Sales', // Judul Chart
        align: 'center', // peletakan title ('left', 'center', 'right')
        margin: 12,
        style: {
          fontSize:  '15px', // Font size
          fontWeight:  'bold', // Font weight
          fontFamily:  'Arial', // Font family
          color:  '#263238' // warna judul
        }
      },
      subtitle: {
        text: 'Chart Unit Terjual', // Subtitle text
        align: 'center',
        style: {
          fontSize: '14px',
          fontWeight: 'normal',
          fontFamily: 'Arial',
          color: '#666'
        }
      },
      series: [{
        name: 'Unit HP',
        data: @json($jlh_jual)
      }],
      xaxis: {
        categories: setBulan(@json($isi_bulan))
      }
    };

    function setBulan(arrBulan){
      let TxtBln = [];
      for (let i = 0; i < arrBulan.length; i++) {
        const element = arrBulan[i].split("-")[1];

        switch (element) {
          case '01':
            TxtBln.push("Jan");
            break;
          case '02':
            TxtBln.push("Feb");
            break;
          case '03':
            TxtBln.push("Mar");
            break;
          case '04':
            TxtBln.push("Apr");
            break;
          case '05':
            TxtBln.push("May");
            break;
          case '06':
            TxtBln.push("Jun");
            break;
          case '07':
            TxtBln.push("Jul");
            break;
          case '08':
            TxtBln.push("Aug");
            break;
          case '09':
            TxtBln.push("Sep");
            break;
          case '10':
            TxtBln.push("Okt");
            break;
          case '11':
            TxtBln.push("Nov");
            break;
          case '12':
            TxtBln.push("Dec");
            break;
      
          default:
            break;
        }
        
      }

      return TxtBln;

    }

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

    // Untuk Donut Chart
    var options2 = {
      chart: {
        type: 'donut'
      },
      title: {
        text: 'Akumulasi Brand Terlaris', //  title
        align: 'center',
        margin: 20, // utk margin bottom title
        style: {
          fontSize: '15px',
          fontWeight: 'bold',
          fontFamily: 'Arial',
          color: '#263238',
        }
      },
      labels: @json($arr_kategori),
      series: @json($arr_jlh_user), 
      colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0'], // Custom colors
      legend: {
        position: 'bottom' // Pindahkan legend ke bottom
      },
    };

    var chart2 = new ApexCharts(document.querySelector("#donutChart"), options2);
    chart2.render();

    // Ganti Judul. tag id ini ada di sidebar.blade.php
    let titlePage = document.getElementById('title-page');
    titlePage.textContent = "Dashboard Page";

</script>
@endsection