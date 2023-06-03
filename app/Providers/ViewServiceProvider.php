<?php

namespace App\Providers;

use View;
use App\View\Composers\SettingComposer;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer([
            'welcome.blade.php',
           
        ], SettingComposer::class);
    }
}
