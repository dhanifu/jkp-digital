<li>
    <a href="{{ route('kesiswaan.rayon', 'keagamaan') }}" class="{{ request()->is('kesiswaan/keagamaan')? ' active' : '' }}">
        <span class="icon{{ request()->is('kesiswaan/keagamaan')? ' active' : '' }}">
            <i class="fas fa-tasks"></i>
        </span>
        <span class="list">Keagamaan</span>
    </a>
</li>
<li>
    <a href="{{ route('kesiswaan.rayon', 'literasi') }}" class="{{ request()->is('kesiswaan/literasi')? ' active' : '' }}">
        <span class="icon{{ request()->is('kesiswaan/literasi')? ' active' : '' }}">
            <i class="fas fa-tasks"></i>
        </span>
        <span class="list">Literasi</span>
    </a>
</li>
<li>
    <a href="{{ route('kesiswaan.rayon', 'kesehatan') }}" class="{{ request()->is('kesiswaan/kesehatan')? ' active' : '' }}">
        <span class="icon{{ request()->is('kesiswaan/kesehatan')? ' active' : '' }}">
            <i class="fas fa-tasks"></i>
        </span>
        <span class="list">Kesehatan</span>
    </a>
</li>
<li>
    <a href="{{ route('kesiswaan.rayon', 'lingkungan') }}" class="{{ request()->is('kesiswaan/lingkungan')? ' active' : '' }}">
        <span class="icon{{ request()->is('kesiswaan/lingkungan')? ' active' : '' }}">
            <i class="fas fa-tasks"></i>
        </span>
        <span class="list">Lingkungan</span>
    </a>
</li>
<li>
    <a href="{{ route('kesiswaan.rayon', 'pramuka') }}" class="{{ request()->is('kesiswaan/pramuka')? ' active' : '' }}">
        <span class="icon{{ request()->is('kesiswaan/pramuka')? ' active' : '' }}">
            <i class="fas fa-tasks"></i>
        </span>
        <span class="list">Pramuka</span>
    </a>
</li>