<?php

namespace Luminee\Validator\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeRuleCommand extends Command
{
    protected $signature = 'validator:make-rule {name}';

    protected $description = 'Create a new rule class';

    public function handle()
    {
        $name = Str::studly($this->argument('name'));
        $path = app_path('Http/Requests/Rules/' . $name . '.php');

        if (File::exists($path)) {
            $this->error('Rule already exists!');
            return;
        }

        if (!File::exists(app_path('Http/Requests/Rules'))) {
            File::makeDirectory(app_path('Http/Requests/Rules'), 0755, true);
        }

        $stub = File::get(__DIR__ . '/../Stub/rule.stub');
        $stub = str_replace('$CLASS$', $name, $stub);
        File::put($path, $stub);
        $this->info('Rule created successfully! [Move to where you want if necessary.]');
    }
}
