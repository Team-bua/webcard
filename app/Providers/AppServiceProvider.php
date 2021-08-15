<?php

namespace App\Providers;

use App\Models\Index;
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
    public function boot()
    {
        view()->composer(['layout_index.header','layout_index.index','layout_index.footer','layout_index.page.card','layout_index.page.contact'], function ($view) {
            $index = Index::find(1);
            $view->with(['index' => $index]);
        });
        Schema::defaultStringLength(191);
    }
}
