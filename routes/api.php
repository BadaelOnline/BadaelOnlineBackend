<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// change language
Route::get('locale/{locale?}', array('en'=>'set-locale', 'uses'=>'App\Http\Controllers\Languages\LanguageController@changeLang'));

Route::group(['namespace'=>'Front','middleware' => ['Localization'],'prefix' => app()->setLocale('{lang}')],function()
    {
        // api layout side front
        Route::get('/home',  'FrontController@home')->name('homepage');
        Route::post('/home/subscribe',  'FrontController@subscribe')->name('subscribe');
        Route::get('/about-us', 'FrontController@about')->name('about');
        Route::get('/team', 'FrontController@team')->name('team');
        Route::get('/testimonials',  'FrontController@testi')->name('testi');
        Route::get('/services',  'FrontController@service')->name('service');
        Route::get('/services/{slug}',  'FrontController@serviceshow')->name('serviceshow');
        Route::get('/portfolio',  'FrontController@portfolio')->name('portfolio');
        Route::get('/portfolio/{slug}',  'FrontController@portfolioshow')->name('portfolioshow');
        Route::get('/blog', 'FrontController@blog')->name('blog');
        Route::get('/blog/search', 'FrontController@search')->name('search');
        Route::get('/blog/{slug}', 'FrontController@blogshow')->name('blogshow');
        Route::get('/categories', 'FrontController@category')->name('category');
        Route::get('/categories/{slug}', 'FrontController@categoryshow')->name('categoryshow');
        Route::get('/tags', 'FrontController@tag')->name('tag');
        Route::get('/pages',  'FrontController@page')->name('page');
        Route::get('/pages/{slug}',  'FrontController@pageshow')->name('pageshow');
    });
