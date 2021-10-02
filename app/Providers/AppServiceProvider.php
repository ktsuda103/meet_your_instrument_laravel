<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Models\Item;


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
        //
        
        view()->composer('*', function ($view) {
            $user = \Auth::user();
            if(isset($user)){
                $id = $user['id'];
                
                $item_model = new Item();

                $my_items = $item_model->getMyItems($id);
              
                $view->with('user', $user)->with('my_items', $my_items);
            }
            
            
            
        });
        Paginator::useBootstrap();

        
    }
}