<!-- Basic Page Info -->
<meta charset="utf-8">
<title>@yield('page-title', '404') | Admin Prima Perabot</title>

<!-- Site favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/global/images/logo.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/global/images/logo.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/global/images/logo.png') }}">

<!-- Mobile Specific Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<!-- Material Icons -->
<link href="{{ url('https://fonts.googleapis.com/icon?family=Material+Icons') }}" rel="stylesheet">
<link href="{{ url('https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined') }}" rel="stylesheet">
<link href="{{ url('https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded') }}" rel="stylesheet">

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/styles/core.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/styles/icon-font.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/styles/style.css') }}">
<link rel="stylesheet" href="{{ url('//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css') }}">
@yield('custom-css')
