<?php

namespace Bearly\Ui\Commands;

use Bearly\Ui\Welcome;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\info;
use function Laravel\Prompts\note;

class Install extends Command
{
    use Welcome;

    public $signature = 'bear:install
        {--skip-welcome : Skip the welcome message}';

    // TODO: Ensure tailwind is actually installed in app.css (with confirmation)
    // TODO: Ensure tailwind is installed with autoprefixer and stuff
    // TODO: Add / initialize an app layout for livewire if one doesn't exist (with confirmation)
    // TODO: Add a test route at / URL to ensure everything is working -- it should go to a demo view that shows some buttons being used
    // TODO: Test that we can do the following: `composer require bearly/ui && php artisan bear-ui:install` and it works with a demo page
    // TODO: Add prefix setting/class/prompt to affect publish path

    protected function ensureJsFileHasValues(string $path, string $key, array $values)
    {
        $jsFile = File::get(base_path($path));
        $arrayFromFile = str($jsFile)->match("/{$key}:[\s]*?\[.*?\],?/sm")
            ->after('[')
            ->beforeLast(']')
            ->replaceMatches('/\s/', '')
            ->trim()
            ->explode(',')
            ->filter()
            ->push($values)
            ->flatten()
            ->unique();

        File::put(
            path: base_path($path),
            contents: str($jsFile)->replaceMatches(
                "/{$key}:[\s]*?\[.*?\],?/sm",
                str("{$key}: [\n    ")->append($arrayFromFile->implode(",\n    "))->append("\n  ],\n")

            )
        );
    }

    protected function installLivewire()
    {
        note('🛠️  Checking for Livewire installation...');

        $livewireInstalled = str(File::get(base_path('composer.json')))->contains('livewire/livewire');

        if ($livewireInstalled) {
            info('👍  Livewire is already installed.');

            return;
        }

        if (confirm('⛔️  Livewire is not installed. Do you want to install it now?')) {
            Process::run('composer require livewire/livewire', function ($type, $output) {
                // echo $output;
            })->throw();
            info('✅  Livewire installed.');
        }
    }

    protected function installTailwind()
    {
        note('🛠️  Checking Tailwind CSS installation...');

        $this->tailwindPackagesInstalled();
        $this->tailwindInAppCss();
        $this->installBearUiTailwindPlugin();
        $this->ensureJsFileHasValues('tailwind.config.js', 'content', ["'./resources/**/*.blade.php'", "'./app/**/*.php'"]);
    }

    protected function tailwindPackagesInstalled()
    {
        $tailwindAndRequirementsInstalled = str(File::get(base_path('package.json')))
            ->containsAll([
                '"tailwindcss":',
                '"@tailwindcss/forms":',
                '"postcss":',
                '"autoprefixer":',
            ]);

        if (! $tailwindAndRequirementsInstalled) {
            if (confirm('⛔️  Tailwind CSS and its required packages are not installed. Do you want to install them now?')) {
                Process::run('npm install -D tailwindcss postcss autoprefixer @tailwindcss/forms', function ($type, $output) {
                    // echo $output;
                })->throw();
                info('✅  Installed Tailwind CSS and required packages.');

                Process::run('npx tailwindcss init -p', fn ($type, $output) => null/* note($output)*/);
            }
        }
    }

    protected function tailwindInAppCss()
    {
        $appCssFile = File::get(base_path('resources/css/app.css'));
        if (! str($appCssFile)->contains([
            '@tailwind base',
            '@tailwind components',
            '@tailwind utilities',
        ])) {
            File::put(
                path: base_path('resources/css/app.css'),
                contents: str($appCssFile)->prepend(
                    "\n@tailwind base;\n",
                    "@tailwind components;\n",
                    "@tailwind utilities;\n",
                )
            );
        }
    }

    protected function installBearUiTailwindPlugin()
    {
        if (! File::exists(base_path('tailwind.config.js'))) {
            if (confirm('⛔️  No tailwind.config.js file found. Do you want to create one now?')) {

                // First, publish Tailwind and PostCSS files from tailwind
                Process::run('npx tailwindcss init -p', function (string $type, string $output) {
                    // echo $output;
                })->throw();
            }
        }

        // Get the tailwind config file and check if it has the forms plugin
        $tailwindConfig = str(File::get(base_path('tailwind.config.js')));

        // Do we have the import statement?
        if (! $tailwindConfig->contains("import bearUI from './vendor/bearly/ui/ui'")) {
            $tailwindConfig = $tailwindConfig->prepend("import bearUI from './vendor/bearly/ui/ui'\n");
            File::put(base_path('tailwind.config.js'), $tailwindConfig);
        }
        $this->ensureJsFileHasValues('tailwind.config.js', 'plugins', ['bearUI']);

        info('✅  Bear UI Tailwind CSS plugin installed.');
    }

    public function handle()
    {
        $this->welcome();
        $this->installTailwind();
        $this->newLine();
        $this->installLivewire();
        $this->newLine();
        $this->call('bear:add', ['--skip-welcome' => true]);
        info('✅  Bear UI installation complete. Enjoy! 🐻');
    }
}
