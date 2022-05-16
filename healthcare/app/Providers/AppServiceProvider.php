<?php

namespace App\Providers;

use App\Models\setting;
use App\View\Components\adminPayment;
use App\View\Components\AppLayout;
use App\View\Components\covid;
use App\View\Components\earningChart;
use App\View\Components\GuestLayout;
use App\View\Components\patientGender;
use App\View\Components\prescription;
use App\View\Components\welcomeCategory;
use App\View\Components\welcomeTeam;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //component registering
        Blade::component('admin-payment', adminPayment::class);
        Blade::component('app', AppLayout::class);
        Blade::component('covid', covid::class);

        Blade::component('earning-chart', earningChart::class);
        Blade::component('guest', GuestLayout::class);
        Blade::component('patient-gender', patientGender::class);

        Blade::component('prescription', prescription::class);
        Blade::component('welcome-category', welcomeCategory::class);
        Blade::component('welcome-team', welcomeTeam::class);

        $setting = setting::firstOrFail();
        view()->share('setting', $setting);
    }
}
