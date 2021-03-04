<?php

namespace App\Http\Livewire\Student;
use App\Models\Student;
use App\Models\Rayon;
use App\Models\Rombel;
use Livewire\Component;

class Edit extends Component
{

    public $isOpen;
    public $student;

    protected $listeners = ['edit'];

    protected $rules = [
        'student.nis' => 'required|string|min:8|max:8|unique:students,nis',
        'student.name' => 'required',
        'student.rayon_id' => 'required|exists:rayons,id',
        'student.rombel_id' => 'required|exist:rombels,id',
        'student.kelas' => 'required',
        'student.agama' => 'required',
        'student.gender' => 'required',
    ];

    public function edit(Student $student)
    {
        $this->isOpen = true;
        $this->student = $student;
        $this->resetValidation();
    }

    public function update()
    {
        $this->validate(array_merge($this->rules, [
            'student.nis' => 'required|string|min:8|max:8' . $this->student->nis, 
            'student.name' => 'required',
            'student.rayon_id' => 'required|exists:rayons,id',
            'student.rombel_id' => 'required|exists:rombels,id',
            'student.kelas' => 'required',
            'student.agama' => 'required',
            'student.gender' => 'required',
        ]));

        $this->student->save();

        $this->reset('isOpen');
        $this->emit('refresh', 'Sukses Mengedit Siswa');
    }

    public function render(Rayon $rayon, Rombel $rombel, Student $student)
    {
        $rayons = $rayon->all();
        $rombels = $rombel->all();
        $students = $student->all();
        return view('livewire.student.edit', compact('rayons', 'rombels', 'students'));
    }
}
