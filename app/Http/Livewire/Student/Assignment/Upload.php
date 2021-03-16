<?php

namespace App\Http\Livewire\Student\Assignment;

use App\Models\Jkp;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upload extends Component
{
    use WithFileUploads;

    public $assignment_id;
    public $file;

    public function upload()
    {
        $validate = $this->validate([
            'file' => 'required|mimes:png,jpg,jpeg,pdf',
        ]);

        $filenameWithExt = $validate['file']->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $validate['file']->getClientOriginalExtension();

        $filename = $filename . '.' . $extension;

        $this->file->storeAs('public/jkp', $filename);

        Jkp::create([
            'assignment_id' => $this->assignment_id,
            'file' => $filename
        ]);

        $this->emit('hideForm');
    }

    public function render()
    {
        return view('livewire.student.assignment.upload');
    }
}
