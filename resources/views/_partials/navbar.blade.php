<span class="menu-icon icon-nav remove"><i class="fas fa-times" ></i></span>
<div class="top-navbar">
    <div class="top-menu">
        <span class="icon-nav menu-icon"><i class="fas fa-bars" ></i></span>
        <span class="dash">
            <span class="title">@yield('title')</span>
        </span>
        <div class="right-info">
            <div class="flex items-center">
                <p class="text-sm mr-2 text-white">@role('admin')
                    {{ Auth::user()->admin->name }}
                    @elserole('pembimbing')
                    {{ Auth::user()->pembimbing->name }}
                    @elserole('student')
                    {{ Auth::user()->student->name }}
                    @endrole</p>
                <div>
                    <a href="{{ route('logout') }}" class="icon-nav hover:no-underline"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                    ><i class="fas fa-power-off"></i></i></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div><!-- top-menu -->
</div><!-- top-navbar -->