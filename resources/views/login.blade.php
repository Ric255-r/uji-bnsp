<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  @vite('resources/css/app.css')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body >
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="px-8 py-6 mt-4 text-left bg-white shadow-lg">
      <div class="text-center my-5">
        <i class="bi bi-app-indicator px-2 py-1 text-3xl bg-blue-600 rounded-lg text-white"></i>
      </div>
      @if (session('error'))
        <div class="w-full mb-2 " id="alert-failure">
          <div class="flex items-center bg-red-500 rounded-md text-white text-sm font-bold px-4 py-2" role="alert">
            <i class="bi bi-exclamation-triangle text-sm"></i> &nbsp;&nbsp;
            <p>{{ session('error') }}</p>
          </div>
        </div>
      @endif
      <h3 class="text-xl font-bold text-center font-[Poppins] uppercase">Login to your account</h3>
      <form action="{{ route('postLogin')}}" method="POST">
        @csrf
        <div class="mt-4">
          <div>
            <label class="block">Email</label>
            <input name="email" type="text" placeholder="Email"
              class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
              id="email" required />
          </div>
          <div class="mt-4">
            <label class="block">Password</label>
            <input name="password" type="password" placeholder="Password"
              class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
              id="password" required />
          </div>
          <div class="flex items-baseline justify-between my-3">
            <button class="px-6 py-2 w-full mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900"
              type="submit">LOGIN</button>

          </div>

        </div>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      let err = document.getElementById('alert-failure');
      
      if(err !== null){
        setTimeout(() => {
          err.remove();
        }, 3000);
      }
    });
  </script>
</body>

</html>