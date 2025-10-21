<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- custom css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    {{-- favicon --}}
    <link rel="shortcut icon" href="{{ asset('assets/img/list.png') }}" type="image/x-icon">

    {{-- cdn bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-Zenh87qX5JnK2JlQW4u2k2rkdQ2qp6s7Di2xsb1TXbcnCeu0XjzrPF/et3URY9Bv1WTRi" crossorigin="anonymous">

    {{-- cdn font-awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" 
        integrity="sha512-xh6O/CkQoPOWdDYTDqeRpDCVd1SpC9XXcUnZS2FmJNp1coFAZvtCN9BmamE+4aHK8yyUHUSCcJHGxloTyT2A==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- nama aplikasi yang akan tampil pada tab browser --}}
    <title>Todo App</title>
</head>
<body>
{{-- agar navbar hanya dapat diakses setelah login --}}
@if (Auth::check())
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Todo App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="{{route('todo.index')}}">Data</a>
                <a class="nav-link" href="{{route('todo.create')}}">Create</a>
                <a class="nav-link" href="/logout">Logout</a>
            </div>
        </div>
    </div>
</nav>
@endif


    @yield('content')

    {{-- cdn bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" 
        integrity="sha384-oBqDVmMz9ATKx1ep9jtCks/Z9fNFEX1DAYTuJWEABa5JfuCZSmkB55uNQ1mh/jp3" 
        crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" 
        integrity="sha384-IDwe1+LCz8ORU9k972gdvy1+AESN10+x7tBKc9I5HFtun2eWnnPcIz06p9vxnk" 
        crossorigin="anonymous"></script>
</body>
</html>


    
