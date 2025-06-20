<?php

namespace Luminee\Validator\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeRequestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'validator:make-request {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new request class';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $name = Str::studly($this->argument('name'));
        $path = app_path('Http/Requests/' . $name . '.php');

        if (File::exists($path)) {
            $this->error('Request already exists!');
            return;
        }

        $stub = File::get(__DIR__ . '/../Stub/request.stub');
        $stub = str_replace('$CLASS$', $name, $stub);
        File::put($path, $stub);
        $this->info('Request created successfully! [Move to where you want if necessary.]');
    }
}
