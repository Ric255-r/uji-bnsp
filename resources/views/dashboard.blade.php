@extends('sidebar')

@section('konten')
  <style>
    /* div {
      border: 1px solid red;
    } */
  </style>
  <div class="flex flex-wrap my-5">
    <div class="lg:w-4/12 md:w-4/12 lg:mb-0 md:mb-0 mb-3 w-full">
      <div class="flex flex-wrap shadow rounded-sm mx-2 h-24">
        Hai
      </div>
    </div>
    <div class="lg:w-4/12 md:w-4/12 lg:mb-0 md:mb-0 mb-3 w-full">
      <div class="flex flex-wrap shadow rounded-sm mx-2 h-24">
        Hai
      </div>
    </div>
    <div class="lg:w-4/12 md:w-4/12 lg:mb-0 md:mb-0 mb-3 w-full">
      <div class="flex flex-wrap shadow rounded-sm mx-2 h-24">
        Hai
      </div>
    </div>
  </div>

  <div class="flex flex-wrap">
    <div class="lg:w-7/12 md:w-7/12 lg:mb-0 mb-3 w-full">
      <div class="flex flex-wrap shadow rounded-sm mx-2">
        <div id="chart" class="w-full"></div>
      </div>

    </div>
    <div class="lg:w-5/12 md:w-5/12 lg:mb-0 mb-3 w-full">
      <div class="flex flex-wrap shadow rounded-sm mx-2 lg:h-full md:h-full">
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
        style: {
          fontSize:  '15px', // Font size
          fontWeight:  'bold', // Font weight
          fontFamily:  'Arial', // Font family
          color:  '#263238' // warna judul
        }
      },
      subtitle: {
        text: 'Penjualan Bulanan', // Subtitle text
        align: 'center',
        style: {
          fontSize: '14px',
          fontWeight: 'normal',
          fontFamily: 'Arial',
          color: '#666'
        }
      },
      series: [{
        name: 'sales',
        data: [30, 40, 45, 50, 49, 60, 70, 91]
      }],
      xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug']
      }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

    // Untuk Donut Chart
    var options2 = {
      chart: {
        type: 'donut'
      },
      title: {
        text: 'Sales Distribution', //  title
        align: 'center',
        margin: 20, // utk margin bottom title
        style: {
          fontSize: '15px',
          fontWeight: 'bold',
          fontFamily: 'Arial',
          color: '#263238',
        }
      },
      labels: ['Electronics', 'Clothing', 'Groceries', 'Accessories', 'Other'],
      series: [25, 15, 30, 20, 10], 
      colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0'], // Custom colors
      legend: {
        position: 'bottom' // Pindahkan legend ke bottom
      },
    };

    var chart2 = new ApexCharts(document.querySelector("#donutChart"), options2);
    chart2.render();

    // Ganti Judul. tag id ini ada di sidebar.blade.php
    document.getElementById('title-page').textContent = "Dashboard Page";

  </script>
@endsection