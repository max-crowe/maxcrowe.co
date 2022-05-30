<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Database\RecordsNotFoundException;
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
        try {
            $provider->deactivate($email);
            $this->info('User "'.$email.'" deactivated successfully.');
        } catch (RecordsNotFoundException $e) {
            $this->error('The user "'.$email.'" does not exist.');
        } catch (\Exception $e) {
            $this->error($e->toString());
        }
    }
}
