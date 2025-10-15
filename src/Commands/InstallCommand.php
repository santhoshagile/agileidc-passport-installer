<?php

namespace SantuAgile\PassportInstaller\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'passport:easy-install';
    protected $description = 'Install Passport and pre-configured auth routes';

    public function handle()
    {
        $this->info('🚀 Setting up Laravel Passport...');

        $this->call('migrate');
        $this->call('passport:install');

        $this->info('✅ Passport Installed Successfully.');
        $this->info('✅ Routes, controllers, and migrations loaded.');
    }
}
