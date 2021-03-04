<?php

namespace App\Http\Livewire\Student;
use App\Models\Student;
use App\Models\Rayon;
use App\Models\Rombel;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $email, $password, $user_id, $nis ,$name, $rayon_id, $rombel_id, $kelas, $agama, $gender;

    protected $rules = [
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
        'nis' => 'required|string|min:8|max:8|unique:students',
        'name' => 'required',
        'rayon_id' => 'required|exists:rayons,id',
        'rombel_id' => 'required|exists:rombels,id',
        'kelas' => 'required',
        'agama' => 'required',
        'gender' => 'required'
    ];

    public function store(Student $student, User $user)
    {
        $this->validate();
        $user = User::create([
            'email' => $this->email,
            'password' => $this->password
        ]);

        $user->assignRole('student');

        $student = Student::create([
            'user_id' => $user->id,
            'nis' => $this->nis,
            'name' => $this->name,
            'rayon_id' => $this->rayon_id,
            'rombel_id' => $this->rombel_id,
            'kelas' => $this->kelas,
            'agama' => $this->agama,
            'gender' => $this->gender
        ]);

        $user->update(['pemilik_id' => $student->id]);

        $this->emit('refresh', 'Sukses Menambah Siswa');
        $this->reset('email', 'password', 'nis', 'name', 'rayon_id', 'rombel_id', 'kelas', 'agama', 'gender');
    }

    public function render(Rayon $rayon, Rombel $rombel)
    {
        $rayons = $rayon->all();
        $rombels = $rombel->all();
        return view('livewire.student.create', compact('rayons', 'rombels'));
    }
}
