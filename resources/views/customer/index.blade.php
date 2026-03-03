<!DOCTYPE html>
<html lang="id">

<head>
    @include('customer.sections.head')
</head>

<body>
    @include('customer.sections.header')

    @yield('page-content')

    @include('customer.sections.footer')

    @include('customer.sections.script')
</body>

</html>
