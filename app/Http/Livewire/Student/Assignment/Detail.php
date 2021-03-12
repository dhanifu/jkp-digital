<?php

namespace App\Http\Livewire\Student\Assignment;

use App\Models\Assignment;
use DateTime;
use Illuminate\Http\Request;
use Livewire\Component;

class Detail extends Component
{
    protected $listeners = ['refreshDetail' => '$refresh'];

    public function render(Request $request)
    {
        $assignment = Assignment::find($request->id);
        $current = strtotime(date('Y-m-d H:i:s'));
        $date = strtotime($assignment->to_date);

        $datediff = $date - $current;
        $difference = floor($datediff / (60 * 60 * 24));
        $due_date = '';

        if ($difference == 0) {
            $due_date = '<span class="font-weight-bold">Due Today, ' . date('h:i A', $date) . '</span>';
        } elseif ($difference > 1) {
            $due_date = '<span class="font-weight-bold">' . date('d F, h:i A', $date) . '</span>';
        } elseif ($difference > 0) {
            $due_date = '<span class="font-weight-bold">Due Tomorrow, ' . date('h:i A', $date) . '</span>';
        } elseif ($difference < -1) {
            $due_date = '<span class="text-danger font-weight-bold">Missing</span>';
        } else {
            $due_date = '<span class="text-danger font-weight-bold">Missing</span>';
        }
        return view('livewire.student.assignment.detail', compact('assignment', 'due_date'));
    }
}
