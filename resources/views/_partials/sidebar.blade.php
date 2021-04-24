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
                    <a href="{{ route('admin.student.index') }}" class="{{ request()->routeIs('admin.student.*')? ' active' : '' }}">
                        <span class="icon{{ request()->routeIs('admin.student.*')? ' active' : '' }}"><i class="fas fa-user" aria-hidden="true"></i></span>
                        <span class="list">Siswa</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.teacher.index') }}" class="{{ request()->routeIs('admin.teacher.*')? ' active' : '' }}">
                        <span class="icon{{ request()->routeIs('admin.teacher.*')? ' active' : '' }}"><i class="fas fa-users" aria-hidden="true"></i></span>
                        <span class="list">Guru</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.assignment') }}" class="{{ request()->is('admin/assignment')? ' active' : '' }}">
                        <span class="icon{{ request()->is('admin/assignment')? ' active' : '' }}"><i class="fas fa-users" aria-hidden="true"></i></span>
                        <span class="list">Assignment</span>
                    </a>
                </li>
                @elserole('pembimbing')
                    <li>
                        <a href="{{ route('home') }}" class="{{ request()->is('home')? ' active' : '' }}">
                            <span class="icon{{ request()->is('home')? ' active' : '' }}"><i class="fas fa-tachometer-alt" aria-hidden="true"></i></span>
                            <span class="list">Dashboard</span>
                        </a>
                    </li>
                    @include('pembimbing.sidebar')

                @elserole('student')
                    <li>
                        <a href="{{ route('home') }}" class="{{ request()->is('home')? ' active' : '' }}">
                            <span class="icon{{ request()->is('home')? ' active' : '' }}"><i class="fas fa-tachometer-alt" aria-hidden="true"></i></span>
                            <span class="list">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('student.to-do.index') }}" class="{{ request()->is('to-do')? ' active' : '' }}">
                            <span class="icon{{ request()->is('to-do')? ' active' : '' }}">
                                <i class="fas fa-tasks"></i>
                            </span>
                            <span class="list">To-do</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('student.assignment.index') }}" class="{{ request()->is('assignments/*') || request()->is('assignments')? ' active' : '' }}">
                            <span class="icon{{ request()->is('assignments') || request()->is('assignments/*')? ' active' : '' }}">
                                <i class="fas fa-tasks"></i>
                            </span>
                            <span class="list">Assignments</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('student.profile') }}" class="{{ request()->is('profile/*') || request()->is('profile')? ' active' : '' }}">
                            <span class="icon{{ request()->is('profile') || request()->is('profile/*')? ' active' : '' }}">
                                <i class="fas fa-tasks"></i>
                            </span>
                            <span class="list">Profile</span>
                        </a>
                    </li>
                @elserole('kesiswaan')
                    <li>
                        <a href="{{ route('home') }}" class="{{ request()->is('home')? ' active' : '' }}">
                            <span class="icon{{ request()->is('home')? ' active' : '' }}"><i class="fas fa-tachometer-alt" aria-hidden="true"></i></span>
                            <span class="list">Dashboard</span>
                        </a>
                    </li>
                    @include('kesiswaan.sidebar')
                @endrole
            </ul>
        </div>
    </div>
</div> <!-- sidebar-menu -->