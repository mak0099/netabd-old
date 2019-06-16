<?php

Auth::routes();

Route::get('/', 'PostController@index')->name('home');

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::get('/', ['as' => 'index', 'uses' => 'HomeController@getIndex']);
Route::group(['middleware' => 'guest'], function() {
    Route::get('/login', ['as' => 'login', 'uses' => 'HomeController@getLoginPage']);
    Route::post('/login', ['as' => 'attempt_login', 'uses' => 'HomeController@attemptLogin']);
});


Route::group(['middleware' => 'auth'], function() {
    Route::get('/logout', ['as' => 'logout', 'uses' => 'HomeController@logout']);
    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@getDashboard']);
    //Unit
    Route::group(['prefix' => 'profile',], function() {
        Route::get('/view-profile', ['as' => 'view_profile', 'uses' => 'UserController@visit_profile']);
    });
    Route::group(['prefix' => 'unit', 'middleware' => 'mainUnit'], function() {
        Route::get('/list-unit', ['as' => 'list_unit', 'uses' => 'UnitController@listUnit']);
        Route::get('/add-unit', ['as' => 'add_unit', 'uses' => 'UnitController@addUnit']);
        Route::post('/save-unit', ['as' => 'save_unit', 'uses' => 'UnitController@saveUnit']);
        Route::get('/view-unit/{id}', ['as' => 'view_unit', 'uses' => 'UnitController@viewUnit']);
        Route::get('/edit-unit/{id}', ['as' => 'edit_unit', 'uses' => 'UnitController@editUnit']);
        Route::post('/update-unit/{id}', ['as' => 'update_unit', 'uses' => 'UnitController@updateUnit']);
        Route::get('/unpublish-unit/{id}', ['as' => 'unpublish_unit', 'uses' => 'UnitController@unpublishUnit']);
        Route::get('/publish-unit/{id}', ['as' => 'publish_unit', 'uses' => 'UnitController@publishUnit']);
        Route::get('/delete-unit/{id}', ['as' => 'delete_unit', 'uses' => 'UnitController@deleteUnit']);
    });
    //Employee
    Route::group(['prefix' => 'employee'], function() {
        //Employee
        Route::get('/list-employee', ['as' => 'list_employee', 'uses' => 'EmployeeController@listEmployee']);
        Route::get('/add-employee', ['as' => 'add_employee', 'uses' => 'EmployeeController@addEmployee']);
        Route::post('/save-employee', ['as' => 'save_employee', 'uses' => 'EmployeeController@saveEmployee']);
        Route::get('/view-employee/{id}', ['as' => 'view_employee', 'uses' => 'EmployeeController@viewEmployee']);
        Route::get('/edit-employee/{id}', ['as' => 'edit_employee', 'uses' => 'EmployeeController@editEmployee']);
        Route::post('/update-employee/{id}', ['as' => 'update_employee', 'uses' => 'EmployeeController@updateEmployee']);
        Route::get('/unpublish-employee/{id}', ['as' => 'unpublish_employee', 'uses' => 'EmployeeController@unpublishEmployee']);
        Route::get('/publish-employee/{id}', ['as' => 'publish_employee', 'uses' => 'EmployeeController@publishEmployee']);
        Route::get('/delete-employee/{id}', ['as' => 'delete_employee', 'uses' => 'EmployeeController@deleteEmployee']);
    });
    
    //News
    Route::group(['prefix' => 'news'], function() {
        Route::get('/list-news', ['as' => 'list_news', 'uses' => 'NewsController@listNews']);
        Route::post('/save-news', ['as' => 'save_news', 'uses' => 'NewsController@saveNews']);
        Route::get('/view-news/{id}', ['as' => 'view_news', 'uses' => 'NewsController@viewNews']);
        Route::get('/edit-news/{id}', ['as' => 'edit_news', 'uses' => 'NewsController@editNews']);
        Route::post('/update-news/{id}', ['as' => 'update_news', 'uses' => 'NewsController@updateNews']);
        Route::get('/unpublish-news/{id}', ['as' => 'unpublish_news', 'uses' => 'NewsController@unpublishNews']);
        Route::get('/publish-news/{id}', ['as' => 'publish_news', 'uses' => 'NewsController@publishNews']);
        Route::get('/delete-news/{id}', ['as' => 'delete_news', 'uses' => 'NewsController@deleteNews']);
    });
    
    //Announcement
    Route::group(['prefix' => 'announcement'], function() {
        Route::get('/list-announcement', ['as' => 'list_announcement', 'uses' => 'AnnouncementController@listAnnouncement']);
        Route::get('/add-announcement', ['as' => 'add_announcement', 'uses' => 'AnnouncementController@addAnnouncement']);
        Route::post('/save-announcement', ['as' => 'save_announcement', 'uses' => 'AnnouncementController@saveAnnouncement']);
        Route::get('/view-announcement/{id}', ['as' => 'view_announcement', 'uses' => 'AnnouncementController@viewAnnouncement']);
        Route::get('/edit-announcement/{id}', ['as' => 'edit_announcement', 'uses' => 'AnnouncementController@editAnnouncement']);
        Route::post('/update-announcement/{id}', ['as' => 'update_announcement', 'uses' => 'AnnouncementController@updateAnnouncement']);
        Route::get('/unpublish-announcement/{id}', ['as' => 'unpublish_announcement', 'uses' => 'AnnouncementController@unpublishAnnouncement']);
        Route::get('/publish-announcement/{id}', ['as' => 'publish_announcement', 'uses' => 'AnnouncementController@publishAnnouncement']);
        Route::get('/delete-announcement/{id}', ['as' => 'delete_announcement', 'uses' => 'AnnouncementController@deleteAnnouncement']);
    });
    
    //Status
    Route::group(['prefix' => 'status'], function() {
        Route::get('/list-status', ['as' => 'list_status', 'uses' => 'StatusController@listStatus']);
        Route::get('/add-status', ['as' => 'add_status', 'uses' => 'StatusController@addStatus']);
        Route::post('/save-status', ['as' => 'save_status', 'uses' => 'StatusController@saveStatus']);
        Route::get('/view-status/{id}', ['as' => 'view_status', 'uses' => 'StatusController@viewStatus']);
        Route::get('/edit-status/{id}', ['as' => 'edit_status', 'uses' => 'StatusController@editStatus']);
        Route::post('/update-status/{id}', ['as' => 'update_status', 'uses' => 'StatusController@updateStatus']);
        Route::get('/unpublish-status/{id}', ['as' => 'unpublish_status', 'uses' => 'StatusController@unpublishStatus']);
        Route::get('/publish-status/{id}', ['as' => 'publish_status', 'uses' => 'StatusController@publishStatus']);
        Route::get('/delete-status/{id}', ['as' => 'delete_status', 'uses' => 'StatusController@deleteStatus']);
    });
    
    //Message
    Route::group(['prefix' => 'message'], function() {
        Route::get('/compose', ['as' => 'compose_message', 'uses' => 'MessageController@composeMessage']);
        Route::post('/send', ['as' => 'send_message', 'uses' => 'MessageController@sendMessage']);
        Route::get('/inbox', ['as' => 'inbox_message', 'uses' => 'MessageController@inboxMessage']);
        Route::get('inbox/{id}/view', ['as' => 'view_inbox', 'uses' => 'MessageController@viewInbox']);
        Route::get('/sent', ['as' => 'sent_message', 'uses' => 'MessageController@sentMessage']);
        Route::get('sent/{id}/view', ['as' => 'view_sent', 'uses' => 'MessageController@viewSent']);
        Route::get('/edit-message/{id}', ['as' => 'edit_message', 'uses' => 'MessageController@editMessage']);
        Route::post('/update-message/{id}', ['as' => 'update_message', 'uses' => 'MessageController@updateMessage']);
        Route::get('/unpublish-message/{id}', ['as' => 'unpublish_message', 'uses' => 'MessageController@unpublishMessage']);
        Route::get('/publish-message/{id}', ['as' => 'publish_message', 'uses' => 'MessageController@publishMessage']);
        Route::get('/delete-message/{id}', ['as' => 'delete_message', 'uses' => 'MessageController@deleteMessage']);
    });
});

