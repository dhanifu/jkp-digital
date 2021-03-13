<?php

namespace App\Console\Commands;

use App\Mail\AssignmentMail;
use App\Models\Assignment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AutoAssignment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assignment:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an assignment every monday at 8:00 AM';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('cron is working fine');

        // ambil data minggu dan tanggalnya
        $assignmentLatest = Assignment::latest()->first();

        $minggu_ke = strval($assignmentLatest->minggu_ke + 1);
        $from_date = date('Y-m-d H:i:s', strtotime('+7 days', strtotime($assignmentLatest->from_date)));
        $to_date = date('Y-m-d H:i:s', strtotime('+7 days', strtotime($assignmentLatest->to_date)));

        // Buat assignment nya
        $assignment = Assignment::create([
            'minggu_ke' => $minggu_ke,
            'from_date' => $from_date,
            'to_date' => $to_date,
        ]);

        $users = DB::table('users')
            ->join('students', 'users.id', '=', 'students.user_id')
            ->select('users.email')
            ->get();

        // Dan Kirim Notifikasi Email 
        foreach ($users as $user) {
            Mail::to($user->email)->send(new AssignmentMail($assignment));
        }

        $this->info('assignment:create Command Run successfully!');
    }
}
