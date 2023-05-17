<?php

use App\Events\Client\Order_find_offer;
use App\Events\Vendor\Order_created;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// ** GLOB **
Auth::routes();
Route::get('/', 'HomeController@start')->name('start');
Route::get('/forget_index', 'ForgetCodeController@forget_index')->name('forget_index');
Route::get('/forget_code_send', 'ForgetCodeController@forget_code_send')->name('forget_code_send');
Route::get('/user_update', 'BadAuthController@user_update')->name('user_update');
Route::get('/user_update_with_code', 'BadAuthController@user_update_with_code')->name('user_update_with_code');
Route::get('/order_online', 'Client\OfferController@order_online')->name('order_online');
Route::get('/credit_added', 'Client\CreditController@credit_added')->name('credit_added');


Route::prefix('banner')->group(function () {
    Route::get('/', 'HomeController@banner')->name('banner');
    Route::post('/store', 'HomeController@banner_store')->name('banner_store');
});

Route::prefix('notification')->group(function () {
    Route::get('/index', 'NotificationController@index')->name('notification_index');
    Route::get('/hide/{id}', 'NotificationController@hide')->name('notification_hide');
});

Route::prefix('comment')->group(function () {
    Route::get('/sotre', 'CommentController@store')->name('comment_store');
});


Route::prefix('tickets')->group(function () {
    Route::get('/', 'TicketController@index')->name('ticket_index');
    Route::get('/create', 'TicketController@create')->name('ticket_create');
    Route::get('/store', 'TicketController@store')->name('ticket_store');
    Route::get('/show/{id}', 'TicketController@show')->name('ticket_show');
    Route::get('/update', 'TicketController@update')->name('ticket_update');
});

Route::prefix('approvation')->group(function () {
    Route::get('/', 'UserAttrController@user_not_approved')->name('user_not_approved');
    Route::get('/approve/{id}/{status}', 'UserAttrController@admin_approve_status')->name('user_approve_status');
});





Route::prefix('stuff')->group(function () {
    Route::get('/show/{id}', 'StuffController@show')->name('stuff_show');
});

// ** CLIENT **
Route::prefix('client')->middleware(['client', 'activation'])->group(function () {
    Route::get('/', 'Client\HomeController@index')->name('client_index');
    Route::get('/news', 'Client\HomeController@news')->name('client_news');
    Route::get('/user_edit', 'Client\HomeController@user_edit')->name('client_user_edit');

    Route::get('/catalog/{name}', 'Client\HomeController@catalog')->name('client_catalog');
    Route::get('/search', 'Client\HomeController@catalog_search')->name('client_catalog_search');
    Route::prefix('order')->group(function () {
        Route::get('/', 'Client\OrderController@index')->name('client_order_index');
        Route::get('/show/{id}', 'Client\OrderController@show')->name('client_order_show');
        Route::get('/active', 'Client\OrderController@index_active')->name('client_order_index_active');
        Route::post('/store', 'Client\OrderController@store')->name('client_order_store');
        Route::get('/delete/{id}', 'Client\OrderController@destroy')->name('client_order_destroy');
    });
    Route::prefix('offer')->group(function () {
        Route::get('/', 'Client\OfferController@index')->name('client_offer_index')->middleware('auth');
        Route::get('/list/{id}', 'Client\OfferController@list_order_offers')->name('client_offer_list_order_offers')->middleware('auth');
        // Route::get('/detect/{order_id}', 'Client\OfferController@show')->name('client_offer_detect')->middleware('auth'); // replaced with show
        Route::get('/history', 'Client\OfferController@history')->name('client_offer_history')->middleware('auth');
        Route::get('/choose/{id}', 'Client\OfferController@choose')->name('client_offer_choose');
        Route::get('/show/{id}', 'Client\OfferController@show')->name('client_offer_show');
        Route::get('/change_status/{id}', 'Client\OfferController@change_status')->name('client_offer_change_status');
        Route::get('/select', 'Client\OfferController@select')->name('client_offer_select');
        Route::get('/actives', 'Client\OfferController@actives')->name('client_offer_actives');
    });
    Route::prefix('support')->group(function () {
        Route::get('/', 'Client\HomeController@client_support')->name('client_support')->middleware('auth');
    });
    Route::prefix('credit')->group(function () {
        Route::get('/', 'Client\CreditController@index')->name('client_credit')->middleware('auth');
        Route::get('/add_credit', 'Client\CreditController@add_credit')->name('client_credit_add_credit')->middleware('auth');
        Route::get('/add_debt', 'Client\CreditController@add_debt')->name('client_credit_add_debt')->middleware('auth');
        Route::get('/add_debt', 'Client\CreditController@pay_debt')->name('client_credit_pay_debt')->middleware('auth');
    });
    Route::prefix('address')->group(function () {
        Route::get('/', 'AddressController@index')->name('client_setting_address_index')->middleware('auth');
        Route::get('/create', 'AddressController@create')->name('client_setting_address_create')->middleware('auth');
        Route::post('/store', 'AddressController@store')->name('client_setting_address_store')->middleware('auth');
        Route::get('/destroy/{id}', 'AddressController@destroy')->name('client_setting_address_destroy')->middleware('auth');
        Route::get('/list', 'AddressController@list')->name('client_setting_address_list')->middleware('auth');
    });
    Route::prefix('be_vendor')->group(function () {
        Route::get('/', 'BeVendorController@index')->name('client_be_vendor_index')->middleware('auth');
        Route::get('/store', 'BeVendorController@store')->name('client_be_vendor_store')->middleware('auth');
    });
});
// ** VENDOR **
Route::prefix('vendors')->middleware(['vendor', 'activation'])->group(function () {
    Route::get('/', 'Vendor\HomeController@index')->name('vendor_index');
    Route::get('/search', 'Vendor\HomeController@catalog_search')->name('vendor_catalog_search');
    Route::get('/accounting', 'Vendor\HomeController@accounting')->name('vendor_accounting');
    Route::get('/user_edit', 'Vendor\HomeController@user_edit')->name('vendor_user_edit');



    Route::prefix('order')->group(function () {
        Route::get('/', 'Vendor\OrderController@index')->name('vendor_order_index');
        Route::get('/show/{id}', 'Vendor\OrderController@show')->name('vendor_order_show');
        Route::any('/convert/{id}', 'Vendor\OrderController@convert')->name('vendor_order_convert');
    });
    Route::prefix('offer')->group(function () {
        Route::get('/', 'Vendor\OfferController@index')->name('vendor_offer_index');
        Route::get('/destroy/{id}', 'Vendor\OfferController@destroy')->name('vendor_offer_destroy');
        Route::get('/show/{id}', 'Vendor\OfferController@show')->name('vendor_offer_show');
        Route::get('/sended/{id}', 'Vendor\OfferController@sended')->name('vendor_offer_sended');
    });
    Route::prefix('setting')->group(function () {
        Route::get('/', 'Vendor\SettingController@index')->name('vendor_setting_index');
        Route::get('/catalog', 'Vendor\SettingController@catalog')->name('vendor_setting_catalog');
        Route::get('/catalog/{name}', 'Vendor\SettingController@catalog')->name('vendor_setting_catalog');
        Route::get('/notification_unset/{variable}', 'Vendor\SettingController@notification_unset')->name('vendor_setting_notification_unset');
        Route::get('/notification_insert/{variable}', 'Vendor\SettingController@notification_insert')->name('vendor_setting_notification_insert');
    });
    Route::prefix('support')->group(function () {
        Route::get('/', 'Vendor\HomeController@support')->name('vendor_support');
    });
    Route::prefix('history')->group(function () {
        Route::get('/', 'Vendor\OfferController@history')->name('vendor_history_index');
    });

    Route::get('/vendor_to_user', 'BeVendorController@vendor_to_user')->name('vendor_bevendor_vendor_to_user');
});
// ** ADMIN **
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::post('/upload', 'UploadController@upload')->name('admin_upload');
    Route::get('/', 'Admin\HomeController@index')->name('admin_index');
    Route::prefix('order')->group(function () {
        Route::get('/', 'Admin\OrderController@index')->name('admin_order_index');
        Route::get('/show/{id}', 'Admin\OrderController@show')->name('admin_order_show');
    });
    Route::prefix('stuff')->group(function () {
        Route::get('/{category_id}', 'Admin\StuffController@index')->name('admin_stuff_index');
        Route::get('/delete/{id}', 'Admin\StuffController@destroy')->name('admin_stuff_delete');
        Route::post('/update', 'Admin\StuffController@update')->name('admin_stuff_update');
        Route::post('/store', 'Admin\StuffController@store')->name('admin_stuff_store');
    });
    Route::prefix('cateogry')->group(function () {
        Route::get('/', 'Admin\CategoryController@index')->name('admin_category_index');
        Route::post('/update', 'Admin\CategoryController@update')->name('admin_category_update');
        Route::post('/store', 'Admin\CategoryController@store')->name('admin_category_store');
        Route::get('/destroy/{id}', 'Admin\CategoryController@destroy')->name('admin_category_destroy');
    });
    Route::prefix('user')->group(function () {
        Route::get('/', 'Admin\UserController@index')->name('admin_user_index');
        Route::any('/update', 'Admin\UserController@update')->name('admin_user_update');
        Route::any('/store', 'Admin\UserController@store')->name('admin_user_store');
    });
    Route::prefix('tickets')->group(function () {
        Route::get('/', 'TicketController@admin_index')->name('admin_ticket_index');
        Route::get('/show/{id}', 'TicketController@admin_show')->name('admin_ticket_show');
        Route::get('/users', 'TicketController@users')->name('admin_ticket_users');
    });
    Route::prefix('banner')->group(function () {
        Route::get('/', 'Admin\BannerController@index')->name('admin_banner_index');
        Route::get('/edit', 'Admin\BannerController@edit')->name('admin_banner_edit');
        Route::post('/selected_store', 'Admin\BannerController@banner_selected_store')->name('admin_banner_selected_store');
        Route::post('/selected_update', 'Admin\BannerController@banner_selected_update')->name('admin_banner_selected_update');
    });
    Route::prefix('credit')->group(function () {
        Route::get('/change', 'CreditController@change')->name('admin_credit_change');
        Route::get('/user_transaction/{user_id}', 'CreditController@user_transaction')->name('admin_user_transaction');
    });
    Route::prefix('bevendor')->group(function () {
        Route::get('/', 'BeVendorController@admin_index')->name('admin_bevendor_index');
        Route::get('/store', 'BadAuthController@store')->name('admin_badauth_store');
    });
    Route::prefix('withdraw')->group(function () {
        Route::get('/', 'WithdrawController@index')->name('admin_withdraw_index');
        Route::get('/store', 'WithdrawController@store')->name('admin_withdraw_store');
    });
});
//  SERVICE **
Route::prefix('sms')->group(function () {
    Route::get('/', 'SmsController@sms_active')->name('sms_active');
    Route::post('/account_actived', 'SmsController@account_actived')->name('sms_account_actived');
    Route::get('/send_code', 'SmsController@send_code')->name('sms_send_code');
});
//** TEST **
Route::get('/l', function () {
    return view('auth.logout');
});
Route::get('/x', function () {
    $vendors = User::with('UserAttr')->whereHas('UserAttr', function ($e) {
        return $e->where('job', 'vendor');
    })->get();
    $event_message = "{'eeee'}";
    event(new Order_created(User::where('id', 1)->first(), $event_message));
});
Route::get('/y', function () {
    $event_message = " پیشنهاد جدید برای سفارش ";
    event(new Order_find_offer(User::where('id', 5)->first(), $event_message));
});
Route::get('/s', function () {
    Smsirlaravel::sendVerification('121212', '09035366888');
});

Route::get('/w/{number}',function($number){
    // $number->'phone'= $number;
    app('App\Http\Controllers\WhatsappController')->curl_notification($number,'1111');
    return $number;
});