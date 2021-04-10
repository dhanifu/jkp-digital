<span class="menu-icon icon-nav remove"><i class="fas fa-times" ></i></span>
<div class="top-navbar">
    <div class="top-menu">
        <span class="icon-nav menu-icon"><i class="fas fa-bars" ></i></span>
        <span class="dash">
            <span class="title">@yield('title')</span>
        </span>
        <div class="right-info">
            <div class="dropdown mt-2">
                <button type="button" id="servicesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" 
                    aria-expanded="false">
                    <img src="{{ profileImage() }}" class="rounded-full" width="40px"
                        alt="{{ getName() }} Profile Image">
                </button>

                <div class="dropdown-menu dropdown-menu-right mt-2 shadow" aria-labelledby="servicesDropdown"
                    style="width: 200px">
                    <i class="fas fa-caret-up fa-lg"
                        style="position: relative; float: right; bottom: 17.5px; right: 13px; color: #fff"></i>

                    <div class="dropdown-header py-2 text-dark" style="font-size: 15px">
                        <strong>Halo, {!! getFirstName() !!}</strong>
                    </div>

                    <div class="dropdown-divider"></div>

                    <div class="mt-0">
                        <button class="dropdown-item py-2">
                            <i class="fas fa-user-alt"></i>
                            <span class="text-dark ml-3">Profile</span>
                        </button>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item py-2">
                                <i class="fas fa-sign-out-alt"></i>
                                <span class="text-dark ml-3">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- top-menu -->
</div><!-- top-navbar -->

@push('css')
    <link rel="stylesheet" href="{{asset('css/tailwind.css')}}">
@endpush

@push('script')
    <script>
        $(".dropdown-menu").click(function (e) {
            e.stopPropagation()
        })
    </script>
@endpush