<!DOCTYPE html>
<html>

<head>
    @include('admin.sections.head')
</head>

<body>

    <div class="header">
        @include('admin.sections.header')
    </div>

    @include('admin.sections.sidebar')

    <div class="main-container">
        <div class="pd-ltr-20">
            @yield('page-content')

            <div class="footer-wrap pd-20 mb-20 card-box">
                &copy; Prima Perabot {{ date('Y') }}</a>
            </div>
        </div>
    </div>
    <!-- js -->
    @include('admin.sections.script')
</body>

</html>
