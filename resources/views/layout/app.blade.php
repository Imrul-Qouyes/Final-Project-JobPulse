<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/toastify.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/progress.css')}}">
 


  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>JobPluse Home</title>

  <script src="{{asset('js/toastify-js.js')}}"></script>
  <script src="{{asset('js/axios.min.js')}}"></script>
  <script src="{{asset('js/config.js')}}"></script>
  
</head>
<body>
  
  <div id="loader" class="LoadingOverlay hidden">
    <div class="Line-Progress">
      <div class="indeterminate"></div>
    </div>
  </div>
  
  
  @yield('content')
  
  

</body>
</html>