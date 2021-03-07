<?php

namespace App\Http\Livewire\Assignment;

use App\Mail\AssignmentMail;
use App\Models\Assignment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Create extends Component
{
    public $minggu_ke, $from_date, $to_date;

    protected $rules = [
        'minggu_ke' => 'required',
        'from_date' => 'required|date',
        'to_date' => 'required|date'
    ];

    public function store()
    {
        $data = $this->validate();

        $assignment = Assignment::create($data);

        $users = DB::table('users')
            ->join('students', 'users.id', '=', 'students.user_id')
            ->select('users.email')
            ->get();

        foreach ($users as $key => $user) {
            Mail::to($user->email)->send(new AssignmentMail($assignment));
        }

        $this->reset(['minggu_ke', 'from_date', 'to_date']);
        $this->emit('refresh', 'Sukses Membuat Assignment');
    }

    public function render()
    {
        return view('livewire.assignment.create');
    }
}
