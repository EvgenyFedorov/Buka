<?php

use App\Task;
use Illuminate\Http\Request;
//use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Maatwebsite\Excel\Facades\Excel;

Route::auth();

Route::get('/', 'HomeController@index');

Route::group(array('prefix' => 'investor-adverts'), function () {

    Route::get('', [
        'uses' => 'AdvertsController@initInvestorAdverts'
    ]);

    Route::group(array('prefix' => '{advert_id}'), function () {

        Route::get('/', [
            'as' => 'advert_id',
            'uses' => 'AdvertsController@initInvestorAdvertsOne'
        ]);

    });

});

Route::group(array('prefix' => 'businessman-adverts'), function () {

    Route::get('', [
        'uses' => 'AdvertsController@initBusinessmanAdverts'
    ]);

    Route::group(array('prefix' => '{advert_id}'), function () {

        Route::get('/', [
            'as' => 'advert_id',
            'uses' => 'AdvertsController@initBusinessmanAdvertsOne'
        ]);

    });

});

Route::group(array('prefix' => 'profile'), function () {

    Route::get('', [
        'middleware' => 'auth',
        'uses' => 'ProfileController@init'
    ]);

    Route::group(array('prefix' => 'settings'), function () {

        Route::get('/', [
            'middleware' => 'auth',
            'as' => 'menu',
            'uses' => 'ProfileController@settings'
        ]);

    });

    Route::group(array('prefix' => 'adverts'), function () {

        Route::get('/', [
            'middleware' => 'auth',
            'as' => 'menu',
            'uses' => 'ProfileController@adverts'
        ]);

        Route::group(array('prefix' => '{advert_id}'), function () {

            Route::get('/', [
                'middleware' => 'auth',
                'as' => 'advert_id',
                'uses' => 'ProfileController@adverts'
            ]);

        });

    });

    Route::group(array('prefix' => 'dialogs'), function () {

        Route::get('/', [
            'middleware' => 'auth',
            'as' => 'menu',
            'uses' => 'ProfileController@dialogs'
        ]);

        Route::group(array('prefix' => '{dialog_id}'), function () {

            Route::get('/', [
                'middleware' => 'auth',
                'as' => 'dialog_id',
                'uses' => 'ProfileController@dialogs'
            ]);

        });

    });

    Route::group(array('prefix' => 'advert-create'), function () {

        Route::get('/', [
            'middleware' => 'auth',
            'as' => 'menu',
            'uses' => 'ProfileController@advertCreate'
        ]);

    });

    Route::group(array('prefix' => 'payment'), function () {

        Route::group(array('prefix' => '{advert_id}'), function () {

            Route::get('/', [
                'middleware' => 'auth',
                'as' => 'advert_id',
                'uses' => 'ProfileController@payment'
            ]);

        });

    });

});

Route::group(array('prefix' => 'api'), function() {

    Route::group(array('prefix' => 'adverts'), function () {

        Route::group(array('prefix' => 'show-phone-investor'), function () {

            Route::post('', [
                'uses' => 'ProfileController@showPhoneInvestor'
            ]);

        });

        Route::group(array('prefix' => 'show-phone-businessman'), function () {

            Route::post('', [
                'uses' => 'ProfileController@showPhoneBusinessman'
            ]);

        });

        Route::group(array('prefix' => 'send-dialog-investor'), function () {

            Route::post('', [
                'uses' => 'ProfileController@sendDialogInvestor'
            ]);

        });

        Route::group(array('prefix' => 'send-dialog-businessman'), function () {

            Route::post('', [
                'uses' => 'ProfileController@sendDialogBusinessman'
            ]);

        });

    });

    Route::group(array('prefix' => 'user'), function () {

        Route::group(array('prefix' => 'send-message'), function () {

            Route::post('', [
                'uses' => 'ProfileController@sendMessage'
            ]);

        });

        Route::group(array('prefix' => 'registration-investor'), function () {

            Route::post('', [
                'uses' => 'ProfileController@registrationInvestor'
            ]);

        });

        Route::group(array('prefix' => 'registration-businessman'), function () {

            Route::post('', [
                'uses' => 'ProfileController@registrationBusinessman'
            ]);

        });

        Route::group(array('prefix' => 'payment'), function () {

            Route::group(array('prefix' => 'get-payment'), function () {

                Route::post('', [
                    'uses' => 'ProfileController@paymentAdvert'
                ]);

            });

        });

        Route::group(array('prefix' => 'advert'), function () {

            Route::group(array('prefix' => 'get-sub-activities'), function () {

                Route::post('', [
                    'uses' => 'ProfileController@getSubActivities'
                ]);

            });

            Route::group(array('prefix' => 'create-advert'), function () {

                Route::post('', [
                    'uses' => 'ProfileController@createAdvertForPayment'
                ]);

            });

            Route::group(array('prefix' => 'update-advert'), function () {

                Route::post('', [
                    'uses' => 'ProfileController@updateAdvert'
                ]);

            });

            Route::group(array('prefix' => 'replay-advert'), function () {

                Route::post('', [
                    'uses' => 'ProfileController@replayAdvert'
                ]);

            });

            Route::group(array('prefix' => 'arhives-advert'), function () {

                Route::post('', [
                    'uses' => 'ProfileController@arhivesAdvert'
                ]);

            });

        });

        // Загрузка изображений

        Route::group(array('prefix' => 'loadimages'), function () {

            Route::group(array('prefix' => 'uploadfile'), function () {

                Route::post('', array('as' => 'img', 'uses' => 'ProfileController@uploadFileImages'));

            });
            Route::group(array('prefix' => 'deletefile'), function () {

                Route::post('', array('as' => 'deletefile', 'uses' => 'ProfileController@deleteFileImages'));

            });

        });

    });

});