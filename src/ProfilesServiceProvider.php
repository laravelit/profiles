<?php

namespace Laravelit\Profiles;

use Illuminate\Support\ServiceProvider;

class ProfilesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            dirname(__DIR__)  . '/config/profiles.php' => config_path('profiles.php')
        ], 'config');

        $this->publishes([
            dirname(__DIR__)  . '/migrations/' => base_path('/database/migrations')
        ], 'migrations');

        $this->registerBladeExtensions();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(dirname(__DIR__)   . '/config/profiles.php', 'profiles');
    }

    /**
     * Register Blade extensions.
     *
     * @return void
     */
    protected function registerBladeExtensions()
    {
        $blade = $this->app['view']->getEngineResolver()->resolve('blade')->getCompiler();

        $blade->directive('profile', function ($expression) {
            return "<?php if (Auth::check() && Auth::user()->is{$expression}): ?>";
        });

        $blade->directive('endprofile', function () {
            return "<?php endif; ?>";
        });

        $blade->directive('segment', function ($expression) {
            return "<?php if (Auth::check() && Auth::user()->can{$expression}): ?>";
        });

        $blade->directive('endsegment', function () {
            return "<?php endif; ?>";
        });

    }
}
