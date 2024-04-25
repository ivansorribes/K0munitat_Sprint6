<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\contactMessages;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('adminPanel.layout', function ($view) {
            $unreadEmailsCount = contactMessages::where('read', false)->count(); // Lógica para obtener la cantidad de correos no leídos
            $view->with('unreadEmailsCount', $unreadEmailsCount);
        });
    }
}
