<div class="sidebar-menu">
    <div class="new-sidebar">
        <div class="title-sidebar-menu">
        </div>
        <div class="header-sidebar">
            <img src="{{ asset('image/logo-wk.png') }}" alt="" width="40%">
        </div>
            
        <div class="text-sidebar font-semibold">
            <h4>Jurnal Kejar Prestasi</h4>
            <span>SMK Wikrama Bogor</span>
        </div>
        
        <div class="inner-sidebar-menu">
            <ul>
                @role('admin')
                <li>
                    <a href="{{ route('admin.home') }}" class="{{ request()->is('admin/home')? ' active' : '' }}">
                        <span class="icon{{ request()->is('admin/home')? ' active' : '' }}"><i class="fas fa-tachometer-alt" aria-hidden="true"></i></span>
                        <span class="list">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.rayon') }}" class="{{ request()->is('admin/rayon')? ' active' : '' }}">
                        <span class="icon{{ request()->is('admin/rayon')? ' active' : '' }}"><i class="fas fa-user" aria-hidden="true"></i></span>
                        <span class="list">Rayon</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.major') }}" class="{{ request()->is('admin/major')? ' active' : '' }}">
                        <span class="icon{{ request()->is('admin/major')? ' active' : '' }}"><i class="fas fa-users" aria-hidden="true"></i></span>
                        <span class="list">Jurusan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.rombel') }}" class="{{ request()->is('admin/rombel')? ' active' : '' }}">
                        <span class="icon{{ request()->is('admin/rombel')? ' active' : '' }}"><i class="fas fa-users" aria-hidden="true"></i></span>
                        <span class="list">Rombel</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.student.index') }}" class="{{ request()->is('admin/student')? ' active' : '' }}">
                        <span class="icon{{ request()->is('admin/student')? ' active' : '' }}"><i class="fas fa-user" aria-hidden="true"></i></span>
                        <span class="list">Siswa</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pembimbing.index') }}" class="{{ request()->is('admin/pembimbing')? ' active' : '' }}">
                        <span class="icon{{ request()->is('admin/pembimbing')? ' active' : '' }}"><i class="fas fa-users" aria-hidden="true"></i></span>
                        <span class="list">Pembimbing</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.assignment') }}" class="{{ request()->is('admin/assignment')? ' active' : '' }}">
                        <span class="icon{{ request()->is('admin/assignment')? ' active' : '' }}"><i class="fas fa-users" aria-hidden="true"></i></span>
                        <span class="list">Assignment</span>
                    </a>
                </li>
                @elserole('pembimbing')
                {{--  --}}

                @elserole('student')
                {{--  --}}
                @endrole
            </ul>
        </div>
    </div>
</div> <!-- sidebar-menu -->