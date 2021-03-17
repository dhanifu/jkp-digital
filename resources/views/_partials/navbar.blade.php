<span class="menu-icon icon-nav remove"><i class="fas fa-times" ></i></span>
<div class="top-navbar">
    <div class="top-menu">
        <span class="icon-nav menu-icon"><i class="fas fa-bars" ></i></span>
        <span class="dash">
            <span class="title">@yield('title')</span>
        </span>
        <div class="right-info">
            <span class="icon-nav top click">
                <i class="fas fa-user"></i>
            </span>
            <span class="icon-nav click">
                <i class="fas fa-user"></i>
            </span>
            <div class="dropdwon shadow-md" id="dropDown">
                <div class="header-dropdown">
                    <h4 class="font-semibold border-b border-gray-200 pb-3">{{ getName() }}</h4>
                </div>
                <a href="{{ route('logout') }}" class="flex items-center font-semibold hover:no-underline"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
                ><i class="fas fa-power-off"></i>Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div><!-- top-menu -->
</div><!-- top-navbar -->