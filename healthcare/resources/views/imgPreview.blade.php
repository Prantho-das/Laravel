<!doctype html>
<html lang="en">

<head>
  <title>Img Preview</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="{{asset('assets/bootstrap/bootstrap.min.css')}}">
  <link rel="stylesheet" id="css-main" href="{{asset('assets/css/halthcare.min.css')}}">
  <link href="{{asset('assets/css/main.css')}}" rel="stylesheet" type="text/css" media="all">
</head>

<body>
  <main>
    <a href='{{URL::previous()}}'>
      <div style='position:fixed;left:3rem;top:3rem;background:black;width:3rem;height:3rem;border-radius:50%;padding-top: 0.8rem;'>
        <i class="fas fa-arrow-left"></i>
      </div>
    </a>
    <div style='background:rgba(0, 0, 0, 0.856);min-height: 100vh;max-width:100vw;display:grid;place-items: center;' class='p-md-5'>
      <div>
        <img src="{{asset('storage/image/'.$imgUrl)}}" class="img-fluid" alt="{{$imgUrl}}">
      </div>
    </div>
  </main>
  <script src="{{asset('assets/bootstrap/jquery-3.2.1.slim.min.js')}}"></script>
</body>

</html>
