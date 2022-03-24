<?php

    use Illuminate\Http\Request;
    use App\Http\Requests;
    use Tymon\JWTAuth\Exceptions\JWTException;

    use App\User;
    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    /** ============= CORS ============= */
    header('Access-Control-Allow-Origin: http://localhost');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
    header('Access-Control-Allow-Headers: Accept, Authorization, Content-Type, Origin, X-Requested-With, X-Auth-Token, X-Xsrf-Token');
    header('Access-Control-Allow-Credentials: true');
    header('Content-Type: application/json;charset=utf-8');
    header('Access-Control-Max-Age: 3600');
    /** ============= CORS ============= */

    /** ============= HOME PAGE =============
     * we dont need to use Laravel Blade
    * we will return a PHP file that will hold all of our Angular content
    * see the "Where to Place Angular Files" below to see ideas on how to structure your app return.
    */
    Route::get('/', function () {
        return view('home');
    });

    /**
     * ============= web group =============
    */
    Route::group(['middleware' => 'web'], function(){
        /**
         * ============= Authentication =============
         */
        Route::get('/auth/login', function () {
            return view('auth.login');
        });

        Route::get('/auth/register', function () {
            return view('auth.register');
        });

        /**
         * ============= disability =============
         */
        Route::get('/disabilities', 'DisabilityController@index');
        Route::get('/disabilities/list', 'DisabilityController@getDisabilities');
        Route::get('/disability/create', 'DisabilityController@create');
        Route::post('/disability', 'DisabilityController@store');
        Route::get('/disability/edit/{id}', 'DisabilityController@edit');
        Route::post('/disability/update', 'DisabilityController@update');
        Route::get('/disability/delete/{id}', 'DisabilityController@destroy');

        Route::get('/patients', 'PatientController@index');
        Route::get('/patient/{hn}', 'PatientController@findbyhn');

        Route::get('/reports/list-type', 'ReportController@listByType');
    });

    /**
     * ============= api group =============
     */
    Route::group(['prefix' => 'api'], function(){
        Route::post('/auth', 'Api\ApiController@auth');
        Route::post('/signup', 'Api\ApiController@signup');
        Route::get('/users', 'Api\ApiController@index');
        Route::get('/user/{email}', 'Api\ApiController@online');
    });

    /** ============= CATCH ALL ROUTE =============
     * all routes that are not home or api will be redirected to the frontend
    * this allows angular to route them
    */
    // App::missing(function($exception) {
    //   return View('home');
    // });
