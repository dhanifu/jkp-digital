<?php

namespace App\Http\Livewire\Student\Todo;

use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Missing extends Component
{
    public function render()
    {
        $user_id = Auth::user()->id;
        $data = Assignment::doesntHave('jkps', 'or', function ($q) use ($user_id) {
            $q->where('user_id', $user_id);
        })->latest()->get();

        $missing = [];
        $current_date = strtotime(date('Y-m-d H:i:s'));

        foreach ($data as $key => $value) {
            $due_date = strtotime($value->to_date);

            if ($current_date > $due_date) {
                $missing[$key] = $value;
            }
        }
        return view('livewire.student.todo.missing', compact('missing'));
    }
}
