<li>
    <a href="{{ route('kesiswaan.rayon') }}" 
        class="{{ request()->is('rayon') || request()->is('rayon/*') ? ' active' : '' }}">
        <span class="icon{{ request()->is('rayon') || request()->is('rayon/*') ? ' active' : '' }}">
            <i class="fas fa-tasks"></i>
        </span>
        <span class="list">Rayon</span>
    </a>
</li>
<li>
    <a href="{{ route('kesiswaan.siswa') }}" 
        class="{{ request()->is('siswa') || request()->is('siswa/*') ? ' active' : '' }}">
        <span class="icon{{ request()->is('siswa') || request()->is('siswa/*') ? ' active' : '' }}">
            <i class="fas fa-tasks"></i>
        </span>
        <span class="list">Siswa</span>
    </a>
</li>
