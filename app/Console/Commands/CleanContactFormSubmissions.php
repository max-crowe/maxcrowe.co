<?php

namespace App\Console\Commands;

use App\Models\ContactFormSubmission;
use Illuminate\Console\Command;
use Illuminate\Support\Pluralizer;

class CleanContactFormSubmissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contact:clear-submissions {--q|quiet}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes contact form submissions that have been marked as read from the database.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $deleted = ContactFormSubmission::where('read', true)->delete();
        if (!$this->option('quiet')) {
            $this->info(sprintf(
                'Deleted %s contact form %s.',
                $deleted,
                Pluralizer::plural('submission', $deleted)
            ));
        }
    }
}
