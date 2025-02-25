@extends('sidebar')

@section('konten')
  
  <div class="flex flex-wrap mx-3">
    <div class="w-full">
      <button onclick="window.location.href='{{ route('home')}}'" class="bg-blue-700 hover:bg-blue-900 cursor-pointer text-white font-bold py-1 px-3 rounded-md">
        <- Back To Home
      </button>
    </div>

    <div class="w-full mt-3">
      <form id="myForm">
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">
            Thumbnail
          </label>
          <div class="border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline">
            <input accept=".jpg,.jpeg,.bmp,.png" type="file" id="files" class="hidden" onchange="handleFile(this.files)"/>
            <label for="files" class="cursor-pointer text-gray-400 " id="labelFile" >Pilih file</label>
          </div>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">
            Preview Thumbnail
          </label>
          <div class="border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline">
            <img class="h-[100px] w-[100px]" id="preview-thumbnail" alt="img">
          </div>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="produk">
            Nama Produk
          </label>
          <input class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            id="produk" type="text" placeholder="Input Nama Produk" required>
        </div>
  
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="kategori">
            Kategori Produk
          </label>
          <select class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            name="kategori" id="kategori">
            <option value="-" selected>-Pilih Kategori-</option>
            <option value="Iphone">Iphone</option>
            <option value="Samsung" >Samsung</option>
            <option value="Nokia" >Nokia</option>
            <option value="Xiaomi" >Xiaomi</option>

          </select>
          {{-- <input class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            id="kategori" type="text" placeholder="Input Kategori Produk"> --}}
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="harga">
            Harga Produk
          </label>
          <input class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            id="harga" type="number" placeholder="Input harga Produk" required>
        </div>
        <div class="mb-4">
          <button type="submit" class="bg-blue-200 py-2 px-3 cursor-pointer">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.getElementById('myForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const thumbnail = document.getElementById('files').files[0];
      const produk = document.getElementById('produk').value;
      const kategori = document.getElementById('kategori').value;
      const harga = document.getElementById('harga').value;

      if(thumbnail === undefined) {
        Swal.fire({
          title: "Peringatan",
          text: "Input Thumbnail",
          icon: "warning"
        });

      }else{
        const extensionFile = thumbnail.name.split('.')[1];      
        const isValidatedFile = validateFile(extensionFile);

        if(isValidatedFile){
          let formData = new FormData();
          formData.append('_method', 'POST');
          formData.append('csrf_token', '{{ csrf_token() }}');
          formData.append('thumbnail', thumbnail);
          formData.append('produk', produk);
          formData.append('kategori', kategori == "-" ? "" : kategori);
          formData.append('harga', harga)


          axios.post("{{ route('addData')}}", formData, {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          })
          .then(function (_) {
            Swal.fire({
              title: "Success",
              text: "Berhasil Tambah Data",
              icon: "success"
            });

            document.getElementById('myForm').reset();
            handleFile(); // buat handle label

            let imgTag = document.getElementById('preview-thumbnail');
            imgTag.src = '';
          })
          .catch(function (error) {
            console.warn(error);

            if(error.response.status == 422){
              Swal.fire({
                title: "Peringatan",
                text: "Cek Kembali inputan Data",
                icon: "warning"
              });
            }else{
              Swal.fire({
                title: "Error",
                text: "Cek Console",
                icon: "error"
              });
            }
          });
        }

      }

    });

    // Untuk mainkan nama label file
    function handleFile(params = null) {
      // params == this.files dari onchange label;

      const labelFile = document.getElementById("labelFile");

      if(params == null){
        labelFile.textContent = "Klik Untuk Ubah File"

      }else{
        const file = params[0].name;
        const isValidatedFile = validateFile(file.split('.')[1]);

        if(isValidatedFile){
          const checkedFile = file.length < 15 ? file : file.substring(0, 15) + "...";
          labelFile.textContent = checkedFile + ". Klik Untuk Ubah File";

          let reader = new FileReader();

          reader.onload = function(){
            let imgTag = document.getElementById('preview-thumbnail');
            imgTag.src = reader.result;
          };

          reader.readAsDataURL(params[0]);
        }
      }
    }

    function validateFile(extFile){
      switch (extFile) {
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'bmp':
          return true;
          break;
        default:
          Swal.fire({
            title: "Peringatan",
            text: "Format File Tidak Mendukung",
            icon: "warning"
          });
          return false;
          break;
      }

    }

    // Ganti Judul. tag id ini ada di sidebar.blade.php
    document.getElementById('title-page').textContent = "Tambah Data";
  </script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection