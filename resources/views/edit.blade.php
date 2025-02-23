@extends('sidebar')

@section('konten')
  <div class="flex flex-wrap mx-3">
    <div class="w-full">
      <button onclick="window.location.href='{{ route('home')}}'" class="bg-blue-700 hover:bg-blue-900 cursor-pointer text-white font-bold py-1 px-3 rounded-md">
        <- Back To Home
      </button>
    </div>

    <div class="w-full mt-3">
      <form method="POST" action="{{ route('updateData', $data->id)}}" id="myForm" enctype="multipart/form-data" >
        @csrf
        @method('PUT')
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">
            Thumbnail
          </label>
          <div class="border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline">
            <input accept=".jpg,.jpeg,.bmp,.png" name="thumbnail" type="file" id="files" onchange="handleFile(this.files)" class="hidden" />
            <label for="files" class="cursor-pointer text-gray-400 " id="labelFile">Pilih file</label>
          </div>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="produk">
            Nama Produk
          </label>
          <input class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            id="produk" name="produk" type="text" placeholder="Input Nama Produk" value="{{$data->produk}}">
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="kategori">
            Kategori Produk
          </label>
          <select class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            name="kategori" id="kategori" aria-placeholder="Pilih Kategori Product">
            <option value="Iphone" {{ $data->kategori == 'Iphone' ? ' selected' : ''}}>Iphone</option>
            <option value="Samsung" {{ $data->kategori == 'Samsung' ? ' selected' : ''}}>Samsung</option>
            <option value="Nokia" {{ $data->kategori == 'Nokia' ? ' selected' : ''}}>Nokia</option>
            <option value="Xiaomi" {{ $data->kategori == 'Xiaomi' ? ' selected' : ''}}>Xiaomi</option>

          </select>
          {{-- <input class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            id="kategori" name="kategori" type="text" placeholder="Input Kategori Produk" > --}}
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="harga">
            Harga Produk
          </label>
          <input class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            id="harga" name="harga" type="number" placeholder="Input harga Produk" value="{{$data->harga}}">
        </div>
        <div class="mb-4">
          <button type="submit" class="bg-blue-200 py-2 px-3 cursor-pointer">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function handleFile(params = null) {
      const labelFile = document.getElementById("labelFile");

      if(params == null){
        labelFile.textContent = "Klik Untuk Ubah File"

      }else{
        const namaFile = params[0].name.length < 15 ? params[0].name : params[0].name.substring(0, 15) + "...";
        labelFile.textContent = namaFile + ". Klik Untuk Ubah File"
      }

    }

    handleFile();

    document.getElementById('myForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const thumbnail = document.getElementById('files').files[0];

      if(thumbnail === undefined){
        this.submit(); // langsung submit klo dia g ubah2 file
      }else{
        const extensionFile = thumbnail.name.split('.')[1];

        switch (extensionFile) {
          case 'jpg':
          case 'jpeg':
          case 'png':
          case 'bmp':
            this.submit();
            break;

          default:
            alert("Format File Tidak Cocok")
            break;
        }
      }

    });

    // Ganti Judul. tag id ini ada di sidebar.blade.php
    document.getElementById('title-page').textContent = "Edit Data";
  </script>
@endsection