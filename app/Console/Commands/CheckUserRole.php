<?php

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class CheckUserRole extends Command
{
    protected $signature = 'check:role';
    protected $description = 'Check if the logged-in user has an admin role';

    public function handle()
    {
        $user = User::find(Auth::user()->id);

        if ($user->hasRole('admin')) {
            $this->info('User is an admin');
        } else {
            $this->info('User is not an admin');
        }
    }
}