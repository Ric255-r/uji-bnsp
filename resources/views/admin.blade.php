@extends('sidebar')

@section('konten')

  <div class="flex flex-wrap mx-3">
    <div class="w-full">
      <button onclick="window.location.href='{{ route('viewAddData')}}'" class="bg-blue-700 hover:bg-blue-900 cursor-pointer text-white font-bold py-1 px-3 rounded-md">
        + Add Product
      </button>
    </div>
    @if (session('success'))
      <div class="w-full mt-3" id="alert-success">
        <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
          <i class="bi bi-check-all text-sm"></i> &nbsp;&nbsp;
          <p>Produk Sukses di Update</p>
        </div>
      </div>
      
    @endif
    @if (session('error'))
      <div class="w-full" id="alert-failure">
        <div class="flex items-center bg-red-500 text-white text-sm font-bold px-4 py-3" role="alert">
          <i class="bi bi-exclamation-triangle text-sm"></i> &nbsp;&nbsp;
          <p>{{ session('error') }}</p>
        </div>
      </div>
      
    @endif
    <div class="w-full mt-3 overflow-x-auto">
      <table class=" text-sm text-left text-gray-500 w-full">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3">No</th>
            <th scope="col" class="px-6 py-3">Thumbnail</th>
            <th scope="col" class="px-6 py-3">Nama Produk</th>
            <th scope="col" class="px-6 py-3">Kategori</th>
            <th scope="col" class="px-6 py-3">Harga</th>
            <th scope="col" class="px-6 py-3" colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody id="tbody">
          @foreach ($data as $d)
          <tr class="bg-white border-b border-gray-200 align-top">
            <th scope="row" class="px-6 py-4 font-medium auto-number">
              
            </th>
            <th scope="row" class="px-6 py-4">
              <img src="{{asset('storage/'. $d['thumbnail'])}}" class="h-[100px] w-[100px] cursor-pointer" 
                alt="Thumbnail" onclick="zoomImage('{{asset('storage/'. $d['thumbnail'])}}')">
            </th>
            <td class="px-6 py-4">
              {{ $d->produk }}
            </td>
            <td class="px-6 py-4">
              {{ $d->kategori }}
            </td>
            <td class="px-6 py-4">
              Rp. {{ number_format($d->harga, 0) }}
            </td>
            <td class="px-6 py-4" colspan="2">
              <a href="{{route('viewEditData', $d->id)}}">Edit</a> |
              <a class="cursor-pointer" role="button" onclick="deleteData({{ $d->id }}, this); return false">Delete</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
  </div>
  
  </div>


  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const alertSuccess = document.getElementById('alert-success');
      const alertFailure = document.getElementById('alert-failure');


      if(alertSuccess){
        setTimeout(() => {
          alertSuccess.remove();
        }, 3000);
      }

      if(alertFailure){
        setTimeout(() => {
          alertFailure.remove();
        }, 3000);
      }

      reIterate();

    });


    function deleteData(id, self) {
      Swal.fire({
        title: "Apakah Ingin Menghapus?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya!",
        cancelButtonText: "Tidak!"
      }).then((result) => {
        
        if (result.isConfirmed) {
          const row = self.closest('tr'); // ambil table row

          let url = "{{route('deleteData', ':id')}}";
          let replacedUrl = url.replace(':id', id);

          axios.delete(replacedUrl)
            .then(function(_) {
              Swal.fire({
                title: "Success",
                text: "Berhasil Hapus Data",
                icon: "success"
              });

              row.remove();

              reIterate();
            })
            .catch(function(err){
              console.log(err);
            });
        }
      });
    }

    function reIterate() {
      const tdTags = document.getElementsByClassName('auto-number');
      // console.log(tdTags);
      if (tdTags.length == 0) {
        document.getElementById('tbody').innerHTML = `
          <tr class="bg-white border-b border-gray-200 align-top">
            <td colspan="7" class="text-center py-3 ">No Data</td>
          </tr>
        `;

      }else{
        // buat auto-number
        for (let i = 0; i < tdTags.length; i++) {
          let element = tdTags[i];
          element.innerHTML = i + 1;
        }
      }
    }

    function zoomImage(url){
      Swal.fire({
        imageUrl: url,
        imageWidth: 600,
        imageHeight: 300,
        imageAlt: "Thumbnail"
      });
    }

    // Ganti Judul. tag id ini ada di sidebar.blade.php
    document.getElementById('title-page').textContent = "Admin Product Page";

  </script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection