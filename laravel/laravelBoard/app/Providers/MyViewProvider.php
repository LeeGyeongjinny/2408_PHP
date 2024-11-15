<?php

namespace App\Providers;

use App\Models\BoardsCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MyViewProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['boardList','boardInsert'], function($view) {
            $resultBoardCategoryInfo = BoardsCategory::orderBy('bc_type')->get();
            $view->with('myGlobalBoardsCategoryInfo', $resultBoardCategoryInfo);
        });
    }
}
