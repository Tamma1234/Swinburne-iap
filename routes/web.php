<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');
//Route::get('/login', 'AuthController@index')->name('login');
Route::post('/login', 'AuthController@login')->name('login.post');
Route::get('/logout', 'AuthController@logout')->name('logout.index');
Route::get('/redirect', 'SocialController@redirect')->name('login.redirect');
Route::get('/callback/google', 'SocialController@callback');


Route::middleware('auth')->group(function () {
    Route::get('/admin', 'DashboardController@index')->name('dashboard');
    Route::get('/dashboard', 'DashboardController@getCareer')->name('chooseOffices');

    // Route phần users
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UserController@index')->name('users.index');
        Route::get('/search', 'UserController@search')->name('users.search');
        Route::post('/post-search', 'UserController@postSearch')->name('users.post.search');
        Route::get('create', 'UserController@create')->name('users.create');
        Route::post('store', 'UserController@store')->name('users.store');
        Route::get('edit/{id}', 'UserController@edit')->name('users.edit');
        Route::post('update/{id}', 'UserController@update')->name('users.update');
        // Cancel account
        Route::get('profile/{id}', 'UserController@profile')->name('users.profile');

        Route::get('remove/{id}', 'UserController@delete')->name('users.remove');
        // List user delete
        Route::get('user-trashout', 'UserController@userTrashOut')->name('users.trash');
        // Delete user completely
        Route::get('delete-completely/{id}', 'UserController@deleteCompletely')->name('users.delete.completely');
    });

    Route::group(['prefix' => 'room'], function () {
        Route::get('index', 'RoomController@index')->name('rooms.index');
        Route::get('list-room', 'RoomController@listRooms')->name('list.rooms');
        Route::get('create-room', 'RoomController@createRooms')->name('create.rooms');
        Route::post('store', 'RoomController@store')->name('room.store');
        Route::get('delete-room/{id}', 'RoomController@deleteRoom')->name('delete.room');
        Route::get('search', 'RoomController@searchDate')->name('rooms.search');
        Route::post('add-room/{id?}', 'RoomController@addRooms')->name('rooms.add');
        Route::get('active-room/{id}', 'RoomController@activeRooms')->name('rooms.active');
        Route::get('update-room/{id}', 'RoomController@updateRooms')->name('rooms.update');
        Route::get('cancel-room/{id}', 'RoomController@cancelRooms')->name('rooms.cancel');
        Route::post('store-room/{id}', 'RoomController@storeCancel')->name('rooms.store.cancel');
    });
    //Course
    Route::group(['prefix' => 'course'], function () {
        Route::get('index', 'CourseController@index')->name('course.index');
        Route::post('list-course', 'CourseController@listCourse')->name('list.course');
        Route::get('create-course', 'CourseController@createRooms')->name('course.create');
        Route::post('store', 'CourseController@store')->name('course.store');
        Route::get('search', 'CourseController@doSearch')->name('course.search');
        Route::get('edit/{id}', 'CourseController@edit')->name('course.edit');
        Route::get('list-group/{id}', 'CourseController@listGroup')->name('course.group');
        Route::get('list-subject', 'CourseController@listSubject')->name('course.list-subject');
        Route::get('subject-search', 'CourseController@subjectSearch')->name('subjects.search');
//        Route::get('update-room/{id}', 'RoomController@updateRooms')->name('rooms.update');
//        Route::get('cancel-room/{id}', 'RoomController@cancelRooms')->name('rooms.cancel');
//        Route::post('store-room/{id}', 'RoomController@storeCancel')->name('rooms.store.cancel');
    });

    //Subjects
    Route::group(['prefix' => 'subject'], function () {
        Route::get('create/{id}', 'SubjectController@createSubject')->name('subject.create');
        Route::get('list/{id}/view_child/{view_child}', 'SubjectController@getSubject')->name('subject.list');
        Route::get('search', 'SubjectController@searchTerm')->name('search.term');
//        Route::post('store-room/{id}', 'RoomController@storeCancel')->name('rooms.store.cancel');
    });

    //Groups
    Route::group(['prefix' => 'group'], function () {
        Route::get('index', 'GroupController@index')->name('group.index');
        Route::get('group-search', 'GroupController@search')->name('group.search');
        Route::get('/search', 'GroupController@valueSearch')->name('value.search');
        Route::get('schedule', 'GroupController@schedule')->name('group.schedule');
        Route::get('search-schedule', 'GroupController@searchSchedule')->name('search.schedule');
        Route::get('create', 'GroupController@create')->name('group.create');
        Route::get('store', 'GroupController@store')->name('group.store');
        Route::post('list', 'GroupController@listGroup')->name('group.list');
//        Route::post('store-room/{id}', 'RoomController@storeCancel')->name('rooms.store.cancel');
    });

    Route::group(['prefix' => 'event'], function () {
        Route::get('index', 'EventController@index')->name('event.index');
        Route::get('add', 'EventController@create')->name('event.add');
        Route::post('store', 'EventController@store')->name('event.store');
        Route::get('delete/{id}', 'EventController@delete')->name('event.delete');
    });

    Route::group(['prefix' => 'Fee'], function () {
        Route::get('index', 'FeeController@index')->name('fee.index');
        Route::get('list/{id}', 'FeeController@listFeeStudent')->name('fees.list');
        Route::get('list-student/{id}', 'FeeController@listStudent')->name('list.student');
//        Route::get('add', 'EventController@create')->name('event.add');
//        Route::post('store', 'EventController@store')->name('event.store');
//        Route::get('delete/{id}', 'EventController@delete')->name('event.delete');
    });

    Route::group(['prefix' => 'term'], function () {
        Route::get('index', 'TermController@index')->name('term.index');
        Route::post('list-course', 'CourseController@listCourse')->name('list.course');
        Route::get('create-term', 'TermController@createTerm')->name('term.create');
        Route::get('edit-term/{id}', 'TermController@edit')->name('term.edit');
        Route::post('update-term/{id}', 'TermController@update')->name('term.update');
        Route::post('store', 'TermController@store')->name('term.store');
//        // Cancel Roles
        Route::get('delete/{id}', 'TermController@delete')->name('term.delete');
//        // List Roles delete
        Route::get('term-trashout', 'TermController@termTrashOut')->name('term.trash');
//        // Delete Roles completely
        Route::get('delete-completely/{id}', 'TermController@deleteCompletely')->name('term.delete.completely');
        // Restore Term Delete
        Route::get('restore/{id}', 'TermController@restore')->name('term.restore');

    });
    // Route Roles
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', 'RoleController@index')->name('roles.index');
        Route::get('create', 'RoleController@create')->name('roles.create');
        Route::post('store', 'RoleController@store')->name('roles.store');
        Route::get('edit/{id}', 'RoleController@edit')->name('roles.edit');
        Route::post('update/{id}','RoleController@update')->name('roles.update');
//        // Cancel Roles
        Route::get('remove/{id}', 'RoleController@delete')->name('roles.remove');
//        // List Roles delete
        Route::get('role-trashout', 'RoleController@roleTrashOut')->name('roles.trash');
//        // Delete Roles completely
        Route::get('delete-completely/{id}', 'RoleController@deleteCompletely')->name('roles.delete.completely');
    });

    //Route Permissions
    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/', 'PermissionController@index')->name('permissions.index');
        Route::get('create', 'PermissionController@create')->name('permissions.create');
        Route::post('store', 'PermissionController@store')->name('permissions.store');
        Route::get('edit/{id}', 'PermissionController@edit')->name('permissions.edit');
        Route::post('update/{id}', 'PermissionController@update')->name('permissions.update');
//        // Cancel Roles
        Route::get('remove/{id}', 'PermissionController@delete')->name('permissions.remove');
//        // List Roles delete
        Route::get('permission-trashout', 'PermissionController@permissionTrashOut')->name('permissions.trash');
//        // Delete Roles completely
        Route::get('delete-completely/{id}', 'PermissionController@deleteCompletely')->name('permissions.delete.completely');
    });
});
