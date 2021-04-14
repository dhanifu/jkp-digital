<li>
    <a href="{{ route('kesiswaan.rayon', 'keagamaan') }}" 
        class="{{ request()->is('keagamaan') || request()->is('keagamaan/*') ? ' active' : '' }}">
        <span class="icon{{ request()->is('keagamaan') || request()->is('keagamaan/*') ? ' active' : '' }}">
            <i class="fas fa-tasks"></i>
        </span>
        <span class="list">Keagamaan</span>
    </a>
</li>
<li>
    <a href="{{ route('kesiswaan.rayon', 'literasi') }}" 
        class="{{ request()->is('literasi') || request()->is('literasi/*') ? ' active' : '' }}">
        <span class="icon{{ request()->is('literasi') || request()->is('literasi/*') ? ' active' : '' }}">
            <i class="fas fa-tasks"></i>
        </span>
        <span class="list">Literasi</span>
    </a>
</li>
<li>
    <a href="{{ route('kesiswaan.rayon', 'kesehatan') }}" 
        class="{{ request()->is('kesehatan') || request()->is('kesehatan/*') ? ' active' : '' }}">
        <span class="icon{{ request()->is('kesehatan') || request()->is('kesehatan/*') ? ' active' : '' }}">
            <i class="fas fa-tasks"></i>
        </span>
        <span class="list">Kesehatan</span>
    </a>
</li>
<li>
    <a href="{{ route('kesiswaan.rayon', 'lingkungan') }}" 
        class="{{ request()->is('lingkungan') || request()->is('lingkungan/*') ? ' active' : '' }}">
        <span class="icon{{ request()->is('lingkungan') || request()->is('lingkungan/*') ? ' active' : '' }}">
            <i class="fas fa-tasks"></i>
        </span>
        <span class="list">Lingkungan</span>
    </a>
</li>
<li>
    <a href="{{ route('kesiswaan.rayon', 'pramuka') }}" 
        class="{{ request()->is('pramuka') || request()->is('pramuka/*') ? ' active' : '' }}">
        <span class="icon{{ request()->is('pramuka') || request()->is('pramuka/*') ? ' active' : '' }}">
            <i class="fas fa-tasks"></i>
        </span>
        <span class="list">Pramuka</span>
    </a>
</li>