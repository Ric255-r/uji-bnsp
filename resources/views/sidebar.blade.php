<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hape-Ku</title>
  @vite('resources/css/app.css')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
</head>

<style>
  /* Hilangkan Arrow Input number */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    margin: 0;
    -webkit-appearance: none;

  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }

  /* background filter */
  .for-overlay {
    background: rgba(0, 0, 0, 0.693);
  }
</style>
<body class="font-[Poppins]" id="for-body">
  {{-- Mini Sidebar --}}
  <div id="mini-sidebar" class="fixed top-0 bottom-0 left-0 w-[60px] p-2 overflow-y-auto text-center bg-gray-900">

    <span class="absolute text-white text-2xl top-4 left-2 cursor-pointer" role="button" onclick="Open()">
      <i class="bi bi-filter-left px-2 py-1 bg-gray-900 rounded-md"></i>
    </span>

    <br>
    <hr class="mt-5 border-gray-700">

    <div class="for-dashboard p-2.5 mt-3 rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-300 text-white">
      <a href="{{ url('/')}}"> 
        <i class="bi bi-house text-sm"></i>
      </a>
    </div>

    <hr class="mt-3 border-gray-700">

    <div class="for-product p-2.5 mt-3 rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-300 text-white">
      <a href="{{ url('/product')}}">
        <i class="bi bi-phone text-sm"></i>

      </a>
    </div>
  </div>


  {{-- Original sidebar --}}
  <div id="ori-sidebar" class="z-10 fixed top-0 bottom-0 lg:left-0 left-[-300px] w-[300px] p-2  overflow-y-auto text-center bg-gray-900 ">
    <div class="text-gray-100 text-xl">
      <div class="p-2.5 mt-1 flex items-center">
        <i class="bi bi-app-indicator px-2 py-1 bg-blue-600 rounded-md"></i>
        <h1 class="font-bold text-gray-200 text-[15px] ml-3">Hape-ku</h1>
        <i class="bi bi-x ml-30 cursor-pointer lg:hidden" onclick="Close()"></i>
      </div>
      <hr class="my-2 text-gray-600">
    </div>

    <div class="for-dashboard p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer  hover:bg-blue-300 text-white" role="button" onclick="window.location.href='{{ url('/')}}'">
      <i class="bi bi-house text-sm"></i>
      <span class="text-[15px] ml-4 text-left w-full bg-transparent focus-outline-none">Dashboard</span>
    </div>

    <hr class="my-4 text-gray-600">

    <div class="for-product p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer  hover:bg-blue-300 text-white" role="button" onclick="window.location.href='{{ url('/product')}}'">
      <i class="bi bi-phone text-sm"></i>
      <span class="text-[15px] ml-4 text-gray-200">Produk</span>
    </div>
  </div>

  <div id="outer-content" class="font-bold ml-15 lg:ml-[300px]  h-screen" onclick="this.classList.contains('cursor-pointer') ? Close() : ''">

    <div id="inner-content">
      <div class="flex flex-wrap shadow-md py-3">
        <div class="w-10/12  pl-10 pt-2 text-center" id="title-page">
          
        </div>
        <div class="w-2/12  text-right pr-5">
          <button style="border-radius: 50%" class="bg-gray-200 py-1 px-2 cursor-pointer" id="dropdownDefault" data-dropdown-toggle="dropdown" type="button">
            <i class="bi bi-person text-xl"></i>
          </button>
          <!-- Dropdown menu -->
          <div id="dropdown" class="z-10 w-44 rounded bg-white shadow hidden" data-popper-placement="bottom" >
            <ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownDefault">
              <li>
                <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
              </li>
              <li>
                <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
              </li>
              <li>
                <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
              </li>
              <li>
                <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign out</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <hr class="border-gray-200 h-3">

      @yield('konten')
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // buat function handleResize utk dipanggil pas dom onload & addEventListener resize;
      let isResize = false; // global variable utk delay

      function handleResize() {
        if(!isResize) {
          isResize = true;
          let currentWidth = window.innerWidth;

          if(currentWidth > 500){
            Close(true); // panggil function close sidebar
            // console.log("Test")
          }

          setTimeout(() => {
            // kembalikan lagi ke false
            isResize = false;
          }, 1500);
        }

      }

      // tambah addEventListener resize
      window.addEventListener('resize', handleResize);

      // cek url, utk mainkan styling shadow
      let splitPath = window.location.pathname.split('/');
      //console.log(splitPath);

      switch (splitPath[1]) {
        case 'product':
          makeShadow('product');
          break;
      
        default:
          makeShadow('dashboard');
          break;
      }
    });

    function makeShadow(params) {
      const element = document.getElementsByClassName(`for-${params}`);

      for (let i = 0; i < element.length; i++) {
        element[i].classList.add('bg-gray-700');
      }
    }

    const tagBody = document.getElementById('for-body');
    const oriSidebar = document.getElementById("ori-sidebar");
    const miniSidebar = document.getElementById("mini-sidebar");
    const innerContent = document.getElementById("inner-content");
    const outerContent = document.getElementById("outer-content");

    // ketika sidebar ori di open
    function Open() {
      oriSidebar.classList.remove('left-[-300px]');
      oriSidebar.classList.add('animate__animated');
      oriSidebar.classList.add('animate__fadeInLeft');
      setTimeout(() => {
        oriSidebar.classList.remove('animate__animated');
        oriSidebar.classList.remove('animate__fadeInLeft');
      }, 900);

      miniSidebar.setAttribute('hidden', true);
      innerContent.setAttribute('hidden', true);
      outerContent.classList.add('cursor-pointer');
      tagBody.classList.add('for-overlay');

 
      // document.querySelector('.sidebar').classList.toggle('left-[-300px]');
    }

    // ketika sidebar ori di close
    // jika bkn d panggil dr handleResize, tambah animasi
    function Close(isResized = false) {
      if(!isResized){
        oriSidebar.classList.add('left-[-300px]');
        oriSidebar.classList.add('animate__animated');
        oriSidebar.classList.add('animate__fadeInRight');

        miniSidebar.removeAttribute('hidden');
        miniSidebar.classList.add('animate__animated');
        miniSidebar.classList.add('animate__fadeInLeft');

        setTimeout(() => {
          oriSidebar.classList.remove('animate__animated');
          oriSidebar.classList.remove('animate__fadeInRight');
          miniSidebar.classList.remove('animate__animated');
          miniSidebar.classList.remove('animate__fadeInLeft');
        }, 900);

      }else{
        oriSidebar.classList.add('left-[-300px]');
        miniSidebar.removeAttribute('hidden');
      }

      innerContent.removeAttribute('hidden');
      outerContent.classList.remove('cursor-pointer');
      tagBody.classList.remove('for-overlay');
    }


  </script>
  <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
</body>
</html>