<?php

namespace App\Http\Livewire\Student\Assignment;

use App\Models\Assignment;
use App\Models\Jkp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upload extends Component
{
    use WithFileUploads;

    public $assignment_id;
    public $file_keagamaan;
    public $file_literasi;
    public $file_lingkungan;
    public $file_kesehatan;
    public $file_pramuka;

    public function upload()
    {
        $validasi = [
            'file_keagamaan' => 'required|mimes:png,jpg,jpeg,pdf',
            'file_literasi' => 'required|mimes:png,jpg,jpeg,pdf',
            'file_lingkungan' => 'required|mimes:png,jpg,jpeg,pdf',
            'file_kesehatan' => 'required|mimes:png,jpg,jpeg,pdf',
        ];

        if (Auth::user()->student->kelas == '10') {
            $validasi += array('file_pramuka' => 'required|mimes:png,jpg,jpeg,pdf');
        }

        $data = $this->validate($validasi);

        $filenameWithExt = [];
        $filenames = [];
        $extensions = [];
        $insert = ['assignment_id' => $this->assignment_id];

        foreach ($data as $key => $value) {
            $filenameWithExt[$key] = $data[$key]->getClientOriginalName();
            $filenames[$key] = pathinfo($filenameWithExt[$key], PATHINFO_FILENAME);
            $extensions[$key] = $data[$key]->getClientOriginalExtension();
        }

        foreach ($filenames as $key => $value) {
            $insert[$key] = Str::slug($value) . '_' . substr(Str::uuid(), 0, 8) . '.' . $extensions[$key];
        }

        $jkp = Jkp::create($insert);

        $assignment = Assignment::find($this->assignment_id);
        $jkp = $jkp->with('user.student.rayon:id,name')->first();

        $minggu_ke = $assignment->minggu_ke;
        $rayon = $jkp->user->student->rayon->name;

        foreach ($filenames as $key => $value) {
            $this->$key->storeAs("public/jkp/minggu-ke-$minggu_ke/$rayon/$key", $insert[$key]);
        }

        $this->emit('hideForm');
    }

    public function render()
    {
        return view('livewire.student.assignment.upload');
    }
}
