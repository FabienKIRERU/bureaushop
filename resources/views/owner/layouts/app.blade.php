<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')| Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('fontawesome-free-6.5.2-web/fontawesome-free-6.5.2-web/css/all.min.css')}}">
    <link rel="shortcut icon" href="{{asset('logo/logo.ico')}}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
    <style>
        :root{
            --wSidBar: 250px;
        }
        body{
            /* background-color: rgba(12, 12, 12, 0.075); */
            text-align: center;
        }
        .page{
            width: 100%;
        }
        .page .sidBar{
            width: var(--wSidBar);
            height: 100vh;
            position: absolute;
            top: 0;
            left: -250px;
            z-index: 2;
            position: fixed;
            background-color: rgba(12, 12, 12, 0.015);
            /* background: rgb(217, 255, 0); */
            transition: all 0.5s ease;
        }
        .page .sidBar.active{
            width: var(--wSidBar);
            height: 100vh;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 2;
            position: fixed;
            /* background: rgb(255, 255, 255); */
        }
        .page .contenu{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: 2;
            position: fixed;
            padding: 1em;
            overflow-y: auto;
            /* border: 1px solid red; */
            transition: all 0.5s ease;
        }
        .page .contenu.active{
            position: absolute;
            top: 0;
            left: var(--wSidBar);
            width: calc(100% - var(--wSidBar));
            height: 100vh;
            z-index: 2;
            position: fixed;
            padding: 1em;
            overflow-y: auto;
            /* border: 1px solid red; */
        }
        .openCloseSidBar{
            position: absolute;
            left: -3px;
            top: 0px;
        }
        .openCloseSidBar .closeSid,
        .openCloseSidBar .openSid{
            display: none;
            cursor: pointer;
        }
        .openCloseSidBar .closeSid.active,
        .openCloseSidBar .openSid.active{
            display: block;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
    </style>
</head>
<body class="font-sans antialiased">
    <div class="page">
        <div class="bg-gray-100 sidBar active">
            @include('owner.layouts.nav')    
        </div>
        <div class="contenu active">
            <div class="openCloseSidBar">
                <div class="openSid"><i class="fa-solid fa-bars" style="background-color: red; border-radius: 10%; padding: 10px"></i></div>
                <div class="closeSid active" style="position: relative; "><i class="fa-solid fa-xmark " style="background-color: red; border-radius: 10%; padding: 10px"></i></div>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
            @include('owner.layouts.section')
        </div>
    </div>
</body>
</html>
<script>
    let contenu = document.querySelector('.contenu');
    let sidBar = document.querySelector('.sidBar');

    let closeSid = document.querySelector('.closeSid');
    let openSid = document.querySelector('.openSid');

    closeSid.addEventListener('click', () => {
        openSid.classList.add('active');
        closeSid.classList.remove('active');
        sidBar.classList.remove('active');
        contenu.classList.remove('active');
        console.log("fermeture");
    })
    openSid.addEventListener('click', () => {
        contenu.classList.add('active');
        sidBar.classList.add('active');
        openSid.classList.remove('active');
        closeSid.classList.add('active');
        console.log("ouverture");
    })
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="shca384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    new TomSelect('select[multiple]', {plugins: {remove_button: {title: 'Supprimer'}}})
</script>