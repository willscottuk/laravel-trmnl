<?php

namespace Bnussbau\LaravelTrmnl;

use Bnussbau\LaravelTrmnl\Commands\LaravelTrmnlCommand;
use Bnussbau\LaravelTrmnl\View\Components\Column;
use Bnussbau\LaravelTrmnl\View\Components\Columns;
use Bnussbau\LaravelTrmnl\View\Components\Layout;
use Bnussbau\LaravelTrmnl\View\Components\TitleBar;
use Bnussbau\LaravelTrmnl\View\Components\View;
use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelTrmnlServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-trmnl')
            ->hasConfigFile()
            ->hasViews()
            //->hasMigration('create_trmnl_table')
            ->discoversMigrations()
            ->hasRoute('web')
            ->hasCommand(LaravelTrmnlCommand::class);
    }

    public function packageBooted()
    {
        // Register the components with the 'trmnl' prefix
        Blade::componentNamespace('Bnussbau\\LaravelTrmnl\\View\\Components', 'trmnl');

        // Or register them individually if you prefer more control
//        Blade::component('trmnl::layout', Layout::class);
//        Blade::component('trmnl::view', View::class);
//        Blade::component('trmnl::title-bar', TitleBar::class);
//        Blade::component('trmnl::columns', Columns::class);
//        Blade::component('trmnl::column', Column::class);
    }
}
