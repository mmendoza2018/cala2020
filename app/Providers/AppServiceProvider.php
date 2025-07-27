<?php

namespace App\Providers;

use App\Models\AttentionNumber;
use App\Models\General;
use App\Models\PaymentMethod;
use App\Models\SocialNetwork;
use App\Models\Theme;
use Illuminate\Support\Facades\Schema;
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
        $generalInfo = null;
        $themes = null;
        $attentionNumbers = collect();
        $socialNetworks = collect();
        $paymentMethods = collect();

        if (Schema::hasTable('generals')) {
            $generalInfo = \App\Models\General::first();
        }

        if (Schema::hasTable('themes')) {
            $themes = \App\Models\Theme::first();
        }

        if (Schema::hasTable('attention_numbers')) {
            $attentionNumbers = \App\Models\AttentionNumber::where("status", 1)->get();
        }

        if (Schema::hasTable('social_networks')) {
            $socialNetworks = \App\Models\SocialNetwork::where("status", 1)->get();
        }

        if (Schema::hasTable('payment_methods')) {
            $paymentMethods = \App\Models\PaymentMethod::where("status", 1)->get();
        }

        View::share([
            'generalInfo' => $generalInfo,
            'themes' => $themes,
            'attentionNumbers' => $attentionNumbers,
            'socialNetworks' => $socialNetworks,
            'paymentMethods' => $paymentMethods,
        ]);
    }
}
