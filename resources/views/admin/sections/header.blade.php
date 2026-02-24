<div class="header-left">
    <div class="menu-icon dw dw-menu"></div>
</div>
<div class="header-right">
    <div class="user-info-dropdown">
        <div class="dropdown">
            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                <span class="user-icon">
                    <img src="{{ asset('assets/admin/vendors/images/photo3.jpg') }}" alt="">
                </span>
                <span class="user-name">{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                <a class="dropdown-item" href="#"><i class="dw dw-user1"></i> Profile</a>
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button class="dropdown-item"><i class="dw dw-logout"></i> Log Out</button>
                </form>
            </div>
        </div>
    </div>
</div>
