<?php

use Illuminate\Support\Facades\Route;

Route::get('ping', 'Api\PingController@index');

Route::get('assets/{uuid}/render', 'Api\Assets\RenderFileController@show');

Route::post('register', 'Api\Auth\RegisterController@store');
Route::get('notification', 'Api\Auth\RegisterController@notification');
Route::get('status', 'Api\Auth\RegisterController@userStatus');
Route::post('applyPromo', 'Api\Auth\RegisterController@applyPromo');
Route::post('sitevisit', 'Api\Auth\RegisterController@sitevigit');

Route::post('passwords/reset', 'Api\Auth\PasswordsController@store');
Route::put('passwords/reset', 'Api\Auth\PasswordsController@update');

Route::group(['middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'Api\Users\UsersController@index');
        Route::post('/', 'Api\Users\UsersController@store');
        Route::get('/{uuid}', 'Api\Users\UsersController@show');
        Route::put('/{uuid}', 'Api\Users\UsersController@update');
        Route::patch('/{uuid}', 'Api\Users\UsersController@update');
        Route::delete('/{uuid}', 'Api\Users\UsersController@destroy');
    });

    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', 'Api\Users\RolesController@index');
        Route::post('/', 'Api\Users\RolesController@store');
        Route::get('/{uuid}', 'Api\Users\RolesController@show');
        Route::put('/{uuid}', 'Api\Users\RolesController@update');
        Route::patch('/{uuid}', 'Api\Users\RolesController@update');
        Route::delete('/{uuid}', 'Api\Users\RolesController@destroy');
    });
    Route::get('permissions', 'Api\Users\PermissionsController@index');

    Route::post('order', 'Api\Users\OrderController@createORder');
    Route::put('order', 'Api\Users\OrderController@updatePayment');
    Route::get('dates', 'Api\Users\OrderController@dates');

    
    

    Route::group(['prefix' => 'me'], function () {
        Route::get('/', 'Api\Users\ProfileController@index');
        Route::put('/', 'Api\Users\ProfileController@update');
        Route::patch('/', 'Api\Users\ProfileController@update');
        Route::put('/password', 'Api\Users\ProfileController@updatePassword');
        Route::group(['prefix' => 'bankinfo'], function () {
            Route::get('/', 'Api\Profile\BankdetailsController@index');
            Route::post('/', 'Api\Profile\BankdetailsController@store');
            Route::put('/{uuid}', 'Api\Profile\BankdetailsController@update');
        });
        Route::group(['prefix' => 'personal'], function () {
            Route::get('/', 'Api\Profile\PersonalController@index');
            Route::post('/', 'Api\Profile\PersonalController@store');
            Route::put('/{uuid}', 'Api\Profile\PersonalController@update');
        });
    
        Route::group(['prefix' => 'express_interest'], function () {
            Route::get('/', 'Api\Profile\BankdetailsController@intrest');
            Route::post('/', 'Api\Profile\BankdetailsController@store');
            Route::put('/{uuid}', 'Api\Profile\BankdetailsController@update');
        });
        Route::group(['prefix' => 'checklist'], function () {
            Route::get('/', 'Api\Profile\UserCheckListController@index');
            Route::post('/', 'Api\Profile\UserCheckListController@store');
            Route::put('/{uuid}', 'Api\Profile\UserCheckListController@update');
        });
        
        Route::group(['prefix' => 'social_identity'], function () {
            Route::get('/', 'Api\Profile\SocialController@index');
            Route::post('/', 'Api\Profile\SocialController@store');
            Route::put('/{uuid}', 'Api\Profile\SocialController@update');
        });
        
        Route::group(['prefix' => 'bankinfo'], function () {
            Route::get('/', 'Api\Profile\BankdetailsController@index');
            Route::post('/', 'Api\Profile\BankdetailsController@store');
            Route::put('/{uuid}', 'Api\Profile\BankdetailsController@update');
        });
        Route::group(['prefix' => 'children'], function () {
            Route::get('/', 'Api\Profile\ChildrendetailController@index');
            Route::post('/', 'Api\Profile\ChildrendetailController@store');
            Route::put('/{uuid}', 'Api\Profile\ChildrendetailController@update');
        });
        Route::group(['prefix' => 'education'], function () {
            Route::get('/', 'Api\Profile\EducationaldetailController@index');
            Route::post('/', 'Api\Profile\EducationaldetailController@store');
            Route::put('/{uuid}', 'Api\Profile\EducationaldetailController@update');
        });
        Route::group(['prefix' => 'family'], function () {
            Route::get('/', 'Api\Profile\FamilyDetailController@index');
            Route::post('/', 'Api\Profile\FamilyDetailController@store');
            Route::put('/{uuid}', 'Api\Profile\FamilyDetailController@update');
        });
        Route::group(['prefix' => 'health'], function () {
            Route::get('/', 'Api\Profile\HealthDetailController@index');
            Route::post('/', 'Api\Profile\HealthDetailController@store');
            Route::put('/{uuid}', 'Api\Profile\HealthDetailController@update');
        });
        Route::group(['prefix' => 'authorization'], function () {
            Route::get('/', 'Api\Profile\AuthorizationController@index');
            Route::post('/','Api\Profile\AuthorizationController@store');
            Route::put('/{uuid}', 'Api\Profile\AuthorizationController@update');
        });
        Route::group(['prefix' => 'reference'], function () {
            Route::get('/', 'Api\Users\UserReferencesController@index');
            Route::post('/', 'Api\Users\UserReferencesController@createRef');
            Route::put('/{uuid}', 'Api\Users\UserReferencesController@updateRef');
        });
        
        Route::group(['prefix' => 'document'], function () {
            Route::get('/', 'Api\Profile\DocumentController@index');
            Route::post('/', 'Api\Profile\DocumentController@store');
            Route::put('/{uuid}', 'Api\Profile\DocumentController@update');
        });
        Route::group(['prefix' => 'referencewwww'], function () {
            Route::get('/', 'Api\Profile\DocumentController@index');
            Route::post('/', 'Api\Profile\DocumentController@store');
            Route::put('/{uuid}', 'Api\Profile\DocumentController@update');
        });

        Route::group(['prefix' => 'staff'], function () {
            Route::get('/', 'Api\Profile\StaffController@index');
            Route::post('/', 'Api\Profile\StaffController@store');
            Route::put('/{uuid}', 'Api\Profile\StaffController@update');
        });
        Route::group(['prefix' => 'location'], function () {
            Route::get('/', 'Api\Profile\LocationController@index');
            Route::post('/', 'Api\Profile\LocationController@store');
            Route::put('/{uuid}', 'Api\Profile\LocationController@update');
        });
        Route::group(['prefix' => 'finability'], function () {
            Route::get('/', 'Api\Profile\FinabilityController@index');
            Route::post('/', 'Api\Profile\FinabilityController@store');
            Route::put('/{uuid}', 'Api\Profile\FinabilityController@update');
        });
        Route::group(['prefix' => 'agreement'], function () {
            Route::get('/', 'Api\Profile\AgreementController@index');
            Route::post('/', 'Api\Profile\AgreementController@store');
            Route::put('/{uuid}', 'Api\Profile\AgreementController@update');
        });

        Route::group(['prefix' => 'personalreference'], function () {
            Route::get('/', 'Api\Profile\PersonalReferenceController@index');
            Route::post('/', 'Api\Profile\PersonalReferenceController@store');
            Route::put('/{uuid}', 'Api\Profile\PersonalReferenceController@update');
        });

        Route::group(['prefix' => 'professional_references'], function () {
            Route::get('/', 'Api\Profile\ProfessionalReferenceController@index');
            Route::post('/', 'Api\Profile\ProfessionalReferenceController@store');
            Route::put('/{uuid}', 'Api\Profile\ProfessionalReferenceController@update');
        });
        Route::group(['prefix' => 'leave'], function () {
            Route::get('/', 'Api\Profile\LeaveController@index');
            Route::post('/', 'Api\Profile\LeaveController@store');
            Route::put('/{uuid}', 'Api\Profile\LeaveController@update');
        });
        Route::group(['prefix' => 'referral'], function () {
            Route::get('/', 'Api\Profile\ReferralController@index');
            Route::post('/', 'Api\Profile\ReferralController@store');
            Route::put('/{uuid}', 'Api\Profile\ReferralController@update');
        });
        Route::group(['prefix' => 'work'], function () {
            Route::get('/', 'Api\Profile\WorkController@index');
            Route::post('/', 'Api\Profile\WorkController@store');
            Route::put('/{uuid}', 'Api\Profile\WorkController@update');
        });
        
    });

        Route::group(['prefix' => 'assets'], function () {
        Route::post('/', 'Api\Assets\UploadFileController@store');
    });
});
/*
Route::group(['middleware' => ['role:super-admin']], function () {
});

Route::group(['middleware' => ['permission:publish articles']], function () {
});

Route::group(['middleware' => ['role:super-admin','permission:publish articles']], function () {
});

Route::group(['middleware' => ['role_or_permission:super-admin|edit articles']], function () {
});

Route::group(['middleware' => ['role_or_permission:publish articles']], function () {
});

Alternatively, you can separate multiple roles or permission with a | (pipe) character:

Route::group(['middleware' => ['role:super-admin|writer']], function () {
    //
});

Route::group(['middleware' => ['permission:publish articles|edit articles']], function () {
    //
});

Route::group(['middleware' => ['role_or_permission:super-admin|edit articles']], function () {
    //
});

You can protect your controllers similarly, by setting desired middleware in the constructor:

public function __construct()
{
    $this->middleware(['role:super-admin','permission:publish articles|edit articles']);
}
public function __construct()
{
    $this->middleware(['role_or_permission:super-admin|edit articles']);
}

*/