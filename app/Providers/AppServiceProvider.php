<?php

namespace App\Providers;

use App\Models\AppSetting;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
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
    public function boot(Request $request)
    {
        // $client=Client::first();
        // auth('clients')->login($client);
        // dd($request->user());
        Schema::defaultStringLength(191);
        $settings=AppSetting::find(1);
        view()->share(compact('settings'));
    }
}
