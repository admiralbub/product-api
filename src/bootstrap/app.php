<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'LanguageSwitchOrchid' => \App\Http\Middleware\LanguageSwitchOrchid::class,
            'localize'                => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
            'localizationRedirect'    => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
            'localeSessionRedirect'   => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
            'localeCookieRedirect'    => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
            'guestion_user'           => \App\Http\Middleware\GuestionUser::class,
            'auth_user'               =>  \App\Http\Middleware\AuthUser::class,
            'localeViewPath'          => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class
        ]);
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(
        // Specify the routes to exclude from CSRF protection
            except: ['salesdriver/*']
        );
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('app:send-basket-email')->dailyAt('14:00');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
