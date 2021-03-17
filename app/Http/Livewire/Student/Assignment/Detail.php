<?php

namespace App\Http\Livewire\Student\Assignment;

use App\Models\Assignment;
use App\Models\Jkp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class Detail extends Component
{
    // nilainya dari views/student/assignment/detail
    public $assignment_id;
    public $formHide = false;

    protected $listeners = [
        'refreshDetail' => '$refresh',
        'delete',
        'hideForm',
        'showForm',
    ];

    public function delete(Jkp $jkp)
    {
        $jkp = $jkp->with(['assignment:id,minggu_ke', 'user.student.rayon:id,name'])->first();

        $minggu_ke = $jkp->assignment->minggu_ke;
        $rayon = $jkp->user->student->rayon->name;

        File::delete(storage_path("app/public/jkp/minggu-ke-$minggu_ke/$rayon/" . $jkp->file));

        $jkp->delete();

        $this->showForm();
    }

    public function hideForm()
    {
        $this->formHide = true;
        $this->emit('$refresh');
    }

    public function showForm()
    {
        $this->formHide = false;
        $this->emit('$refresh');
    }

    public function render()
    {
        $assignment_id = $this->assignment_id;

        $assignment = Assignment::find($assignment_id);
        $jkp = Jkp::where('assignment_id', $assignment_id)
            ->where('user_id', Auth::user()->id)
            ->with([
                'user:id,pemilik_id',
                'user.student:id,rayon_id',
                'user.student.rayon:id,name'
            ])->first();

        $turned_in = '';

        if (!empty($jkp)) {
            $this->hideForm();
            $turned_in = '<span class="font-weight-bold text-dark">Turned in</span>';
        } else {
            $this->showForm();
            $turned_in = '<span class="font-weight-bold text-success">Assigned</span>';
        }


        return view('livewire.student.assignment.detail', compact('assignment', 'jkp', 'turned_in'));
    }
}
