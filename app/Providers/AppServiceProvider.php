<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->PractitionersNewCount();
    }

    public function  PractitionersNewCount()
    {
        $PractitionersNewCount = DB::table('practitioner')->where('status','pending')->count();

        View::composer('admin.layouts.app', function($view) use($PractitionersNewCount) {
            $view->with('ShowPractitionersNewCount',$PractitionersNewCount);
        });

    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $card = \Session::get('card');
        view()->share('card', $card);
    }
}
