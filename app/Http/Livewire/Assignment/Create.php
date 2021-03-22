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
        /**
         *  ini kode testing biar cepet gausah input
         *  kalo mau pake, komen dulu $rules nya
         *  dan komen semua yang ada dibawah 2 variable ini
         *  kecuali yang assignment::create()
         */
        // $assignment_terbaru = Assignment::latest()->first();
        // $data = [
        //     'minggu_ke' => $assignment_terbaru->minggu_ke + 1,
        //     'from_date' => tambahTujuhHari($assignment_terbaru->from_date),
        //     'to_date' => tambahTujuhHari($assignment_terbaru->to_date),
        // ];

        $data = $this->validate();
        $data["from_date"] = date('Y-m-d H:i:00', strtotime($data["from_date"]));
        $data["to_date"] = date('Y-m-d H:i:59', strtotime($data["to_date"]));

        $assignment = Assignment::create($data);

        $this->reset(['minggu_ke', 'from_date', 'to_date']);
        $this->emit('refresh', 'Sukses Membuat Assignment');

        $users = DB::table('users')
            ->join('students', 'users.id', '=', 'students.user_id')
            ->select('users.email')
            ->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new AssignmentMail($assignment));
        }
    }

    public function render()
    {
        return view('livewire.assignment.create');
    }
}
