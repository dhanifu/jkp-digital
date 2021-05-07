<li>
    <a href="{{ route('kesiswaan.rayon') }}" 
        class="{{ request()->is('kesiswaan/rayon') || request()->is('kesiswaan/rayon/*') ? ' active' : '' }}">
        <span class="icon{{ request()->is('kesiswaan/rayon') || request()->is('kesiswaan/rayon/*') ? ' active' : '' }}">
            <i class="fas fa-tasks"></i>
        </span>
        <span class="list">Rayon</span>
    </a>
</li>
