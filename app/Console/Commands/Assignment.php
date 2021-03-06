<?php

namespace App\Console\Commands;

use App\Mail\AssignmentMail;
use App\Models\Major;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Assignment extends Command
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

        // Buat assignment nya, dan kirim email
        // Assignmen::create([]);

        // $users = DB::table('users')
        //     ->join('students', 'users.id', '=', 'students.user_id')
        //     ->select('users.email')
        //     ->get();

        // $emails = [];
        // foreach ($users as $key => $user) {
        //     $emails[$key] = $user->email;
        // }

        // $details = [
        //     'link' => 
        // ];

        // Mail::send(new AssignmentMail($details), [] ,function ($m) use ($emails) {
        //     $m->to($emails);
        // });

        $this->info('Assignment:create Command Run successfully!');
    }
}
