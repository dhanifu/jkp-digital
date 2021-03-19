<?php

namespace App\Http\Livewire\Student\Todo;

use App\Models\Assignment;
use App\Models\Jkp;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Assigned extends Component
{
    public $perPage = 8;

    protected $listeners = [
        'refreshAssigned' => '$refresh',
        'load-more' => 'loadMore'
    ];

    public function loadMore()
    {
        $this->perPage += 8;
    }

    public function render()
    {
        $user_id = Auth::user()->id;
        $data = Assignment::doesntHave('jkps', 'or', function ($q) use ($user_id) {
            $q->where('user_id', $user_id);
        })->latest()->get();

        $assignments = [];
        $current_date = strtotime(date('Y-m-d H:i:s'));

        foreach ($data as $key => $value) {
            $due_date = strtotime($value->to_date);

            if ($current_date < $due_date) {
                $assignments[$key] = $value;
            }
        }

        return view('livewire.student.todo.assigned', compact('assignments'));
    }
}
