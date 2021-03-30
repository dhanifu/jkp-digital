@foreach (getRayon() as $rayon)
    <li>
        <a href="{{ route('pembimbing.rayon.student.index', $rayon->id) }}"
            class="{{ request()->is("r/$rayon->id*")? 'active' : '' }}">
            <span class="icon {{ request()->is("r/$rayon->id*")? 'active' : '' }}">
                <i class="fas fa-chalkboard-teacher"></i>
            </span>
            <span class="list">{{ $rayon->name }}</span>
        </a>
    </li>
@endforeach