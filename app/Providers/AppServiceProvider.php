<?php

namespace App\Providers;

use App\Models\AttentionNumber;
use App\Models\General;
use App\Models\Theme;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        $generalInfo = General::first();
        $themes = Theme::first();
        $attentionNumbers = AttentionNumber::where("status", 1)->get();

        View::share([
            'generalInfo' => $generalInfo,
            'themes' => $themes,
            'attentionNumbers' => $attentionNumbers
        ]);
    }
}
