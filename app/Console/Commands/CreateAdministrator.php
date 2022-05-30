<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class CreateAdministrator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:create-administrator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an administrative user';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $provider = App::make(UserProvider::class);
        /* First, prompt for the email address and validate that it isn't
        already in use. */
        $valid = false;
        while (!$valid) {
            $email = $this->ask('Email address');
            try {
                Validator::make(['email' => $email], ['email' => [
                    'email',
                    function ($attribute, $value, $fail) use ($provider) {
                        if ($provider->emailInUse($value)) {
                            $fail('The user "'.$value.'" already exists.');
                        }
                    }
                ]])->validate();
                $valid = true;
            } catch (ValidationException $e) {
                $this->error($e->getMessage());
            }
        }
        // Prompt for a valid password
        $valid = false;
        while (!$valid) {
            $password = $this->secret('Password');
            $password2 = $this->secret('Password (again)');
            try {
                Validator::make(['password' => $password], ['password' => [
                    Password::defaults(),
                    function ($attribute, $value, $fail) use ($password2) {
                        if ($value != $password2) {
                            $fail("The passwords don't match.");
                        }
                    }
                ]])->validate();
                $valid = true;
            } catch (ValidationException $e) {
                $this->error($e->getMessage());
            }
        }
        $name = $this->ask('Name (optional)');
        $provider->createAdministrator($email, $password, ['name' => $name ?? '']);
        $this->info('Administrator "'.$email.'" created successfully.');
    }
}
