<meta charset="UTF-8">
<title>@yield('page-title', '404') | Prima Perabot</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/x-icon" href="{{ asset('assets/global/images/logo.svg') }}">

<!-- GOOGLE FONT -->
<link href="{{ url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap') }}"
    rel="stylesheet">

<!-- GOOGLE ICON -->
<link href="{{ url('https://fonts.googleapis.com/icon?family=Material+Icons') }}" rel="stylesheet">
<link href="{{ url('https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined') }}" rel="stylesheet">
<link href="{{ url('https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded') }}" rel="stylesheet">

<!-- FONT AWESOME (ICON ASLI) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- CSS -->
<link rel="stylesheet" href="{{ asset('assets/customer/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/customer/css/header.css') }}">
<link rel="stylesheet" href="{{ asset('assets/customer/css/footer.css') }}">

{{-- VENDOR --}}
<link rel="stylesheet" href="{{ url('//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css') }}">
@yield('custom-css')
