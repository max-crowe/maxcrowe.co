<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\App;

class DeactivateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:deactivate-user {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivates a user';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $email = $this->argument('user');
        $provider = App::make(UserProvider::class);
        $user = $provider->createModel()->newQuery()->where(
            'email', $email
        )->first();
        if ($user === null) {
            $this->error('The user "'.$email.'" does not exist.');
        } elseif (!$user->is_active) {
            $this->error('The user "'.$email.'" has already been deactivated.');
        } else {
            $user->is_active = false;
            $user->save();
            $this->info('User "'.$email.'" deactivated successfully.');
        }
    }
}
