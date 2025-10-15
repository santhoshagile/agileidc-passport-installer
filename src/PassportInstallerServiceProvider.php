<?php

namespace SantuAgile\PassportInstaller;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use SantuAgile\PassportInstaller\Commands\InstallCommand;

class PassportInstallerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            InstallCommand::class,
        ]);
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'/Http/Controllers' => app_path('Http/Controllers/PassportInstaller'),
        ], 'passport-installer-controllers');
    }
}
