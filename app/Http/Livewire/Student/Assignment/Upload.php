<?php

namespace App\Http\Livewire\Student\Assignment;

use App\Models\Assignment;
use App\Models\Jkp;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upload extends Component
{
    use WithFileUploads;

    public $assignment_id;
    public $file;

    protected $rules = [
        'file' => 'required|mimes:png,jpg,jpeg,pdf',
    ];

    public function upload()
    {
        $data = $this->validate();

        $filenameWithExt = $data['file']->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $data['file']->getClientOriginalExtension();

        $filename = $filename . '.' . $extension;

        $jkp = Jkp::create([
            'assignment_id' => $this->assignment_id,
            'file' => $filename
        ]);

        $assignment = Assignment::find($this->assignment_id);
        $jkp = $jkp->with('user.student.rayon:id,name')->first();

        $minggu_ke = $assignment->minggu_ke;
        $rayon = $jkp->user->student->rayon->name;

        $this->file->storeAs("public/jkp/minggu-ke-$minggu_ke/$rayon", $filename);

        $this->emit('hideForm');
    }

    public function render()
    {
        return view('livewire.student.assignment.upload');
    }
}
