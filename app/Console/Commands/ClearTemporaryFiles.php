<?php

namespace App\Console\Commands;

use App\Models\TemporaryFile;
use Illuminate\Console\Command;

class ClearTemporaryFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unrealestate:files-clear {--all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all temporaries files';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        if ($this->option('all')) {
            $temporaries = TemporaryFile::all();
        } else {
            $temporaries = TemporaryFile::where('created_at', '<=', now()->subDays(5))->get();
        }

        $this->withProgressBar($temporaries->count(), function () use ($temporaries) {
            foreach ($temporaries as $temporary) {
                $temporary->delete();
            }
        });
    }
}
