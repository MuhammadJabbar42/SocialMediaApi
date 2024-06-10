<?php

namespace App\Jobs;

use App\Http\Controllers\VerificationEmail;
use App\Mail\EmailVerificationReminder;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;


class SendingEmailVerification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::whereNull('email_verified_at')->get();
        foreach ($users as $user) {
            $id = $user->id;
            $vf = new  VerificationEmail();
            $vf->test($id);
        }
    }
}
