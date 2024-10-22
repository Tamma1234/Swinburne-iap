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
    Route::group(['prefix' => 'applications'], function () {
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UserController@index')->name('users.index');
            Route::get('/search', 'UserController@search')->name('users.search');
            Route::post('/post-search', 'UserController@postSearch')->name('users.post.search');
            Route::get('create', 'UserController@create')->name('users.create')->middleware('can:add_user');
            Route::post('store', 'UserController@store')->name('users.store')->middleware('can:add_user');
            Route::get('edit/{id}', 'UserController@edit')->name('users.edit')->middleware('can:edit_user');
            Route::post('update/{id}', 'UserController@update')->name('users.update');
            // Cancel account
            Route::get('profile/{id}', 'UserController@profile')->name('users.profile');

            Route::get('remove/{id}', 'UserController@delete')->name('users.remove')->middleware('can:delete_user');
            // List user delete
            Route::get('user-trashout', 'UserController@userTrashOut')->name('users.trash');
            // Delete user completely
            Route::get('delete-completely/{id}', 'UserController@deleteCompletely')->name('users.delete.completely');
            Route::get('create-qr','UserController@createQR')->name('user.createQR');
        });
    });

    Route::group(['prefix' => 'room'], function () {
        Route::get('index', 'RoomController@index')->name('rooms.index');
        Route::get('list-room', 'RoomController@listRooms')->name('list.rooms')->middleware('can:view_room');
        Route::get('create-room', 'RoomController@createRooms')->name('create.rooms')->middleware('can:add_room');
        Route::post('store', 'RoomController@store')->name('room.store');
        Route::get('delete-room/{id}', 'RoomController@deleteRoom')->name('delete.room')->middleware('can:delete_room');
        Route::get('search', 'RoomController@searchDate')->name('rooms.search');
        Route::post('add-room/{id?}', 'RoomController@addRooms')->name('rooms.add');
        Route::get('active-room/{id}', 'RoomController@activeRooms')->name('rooms.active');
        Route::get('update-room/{id}', 'RoomController@updateRooms')->name('rooms.update');
        Route::get('cancel-room/{id}', 'RoomController@cancelRooms')->name('rooms.cancel');
        Route::post('store-room/{id}', 'RoomController@storeCancel')->name('rooms.store.cancel');
    });
    //Course
    Route::group(['prefix' => 'course'], function () {
        Route::get('index', 'CourseController@index')->name('course.index')->middleware('can:view_course');
        Route::get('list-course', 'CourseController@listCourse')->name('list.course')->middleware('can:view_course');
        Route::get('create-course', 'CourseController@createRooms')->name('course.create')->middleware('can:add_course');
        Route::post('store', 'CourseController@store')->name('course.store');
        Route::get('search', 'CourseController@doSearch')->name('course.search');
        Route::get('edit/{id}', 'CourseController@edit')->name('course.edit')->middleware('can:edit_course');
        Route::get('list-group/{id}', 'CourseController@listGroup')->name('course.group');
        Route::get('list-subject', 'CourseController@listSubject')->name('course.list-subject');
        Route::get('subject-search', 'CourseController@subjectSearch')->name('subjects.search');
    });

    //Subjects
    Route::group(['prefix' => 'subject'], function () {
        Route::get('create/{id}', 'SubjectController@createSubject')->name('subject.create');
        Route::get('list/{id}/view_child/{view_child}', 'SubjectController@getSubject')->name('subject.list');
        Route::get('search', 'SubjectController@searchTerm')->name('search.term');
//        Route::post('store-room/{id}', 'RoomController@storeCancel')->name('rooms.store.cancel');
    });

    // Survey
    Route::group(['prefix' => 'survey'], function () {
        Route::get('index', 'SurveyController@index')->name('survey.list');
        Route::get('create', 'SurveyController@create')->name('survey.create');
        Route::post('store', 'SurveyController@store')->name('survey.store');
//        Route::get('search', 'SubjectController@searchTerm')->name('search.term');
//        Route::post('store-room/{id}', 'RoomController@storeCancel')->name('rooms.store.cancel');
    });

    //Subjects
    Route::group(['prefix' => 'notifications'], function () {
        Route::get('/', 'NotificationController@index')->name('notifications.index');
        Route::get('send-mail', 'NotificationController@sendGrade')->name('notifications.send.grade');
        Route::post('store-send-mail', 'NotificationController@storeSendMail')->name('store.send.mail');
        Route::get('send-group', 'NotificationController@sendGroup')->name('notifications.send.group');
        Route::post('/upload/image', 'NotificationController@uploadImage')->name('upload.image');

        Route::get('show-image/{id}', 'NotificationController@show')->name('notifications.show');
        Route::get('list-send', 'NotificationController@listSend')->name('notifications.list-send');
//        Route::post('store-room/{id}', 'RoomController@storeCancel')->name('rooms.store.cancel');
    });

    //Groups
    Route::group(['prefix' => 'group'], function () {
        Route::get('index', 'GroupController@index')->name('group.index')->middleware('can:view_group');
        Route::get('group-search', 'GroupController@search')->name('group.search');
        Route::get('/search', 'GroupController@valueSearch')->name('value.search');
        Route::get('schedule', 'GroupController@schedule')->name('group.schedule');
        Route::get('search-schedule', 'GroupController@searchSchedule')->name('search.schedule');
        Route::get('create', 'GroupController@create')->name('group.create')->middleware('can:add_group');
        Route::get('add-student', 'GroupController@addStudent')->name('add.student');
        Route::post('store', 'GroupController@store')->name('group.store');
        Route::post('list', 'GroupController@listGroup')->name('group.list');
        Route::get('import-class', 'GroupController@importClass')->name('import.class');
        Route::post('post-class', 'GroupController@postImportClass')->name('post.import.class');
        Route::get('import-student', 'GroupController@importStudent')->name('import.student');
        Route::post('post-student', 'GroupController@postImportStudent')->name('post.student');
        Route::get('export-group/{term_id}', 'GroupController@exportGroupSemmester')->name('export.group');
    });

    Route::group(['prefix' => 'event'], function () {
        Route::get('index', 'EventController@index')->name('event.index')->middleware('can:view_items');
        Route::get('send-mail', 'EventController@sendMail')->name('event.send');
        Route::get('/list-student', 'EventController@listStudent')->name('student.list');
        Route::get('detail/{id}', 'EventController@detail')->name('event.detail');
        Route::get('add', 'EventController@create')->name('event.add');
        Route::post('store', 'EventController@store')->name('event.store');
        Route::get('delete/{id}', 'EventController@delete')->name('event.delete')->middleware('delete:delete_events');
        Route::get('student-delete/{id?}', 'EventController@deleteStudent')->name('student-delete');
        Route::post('student-add', 'EventController@studentAdd')->name('student.add');
        Route::get('list-lecturer', 'EventController@listLecturer')->name('event.lecturer.list');
        Route::post('event-update', 'EventController@eventUpdate')->name('event.update');
        Route::get('event-history', 'EventController@eventHistory')->name('event.history');
        Route::get('export-event/{id}', 'EventController@exportEvents')->name('export.event');
    });

    Route::group(['prefix' => 'gold'], function () {
        Route::get('index', 'GoldController@index')->name('gold.index')->middleware('can:view_gold');
        Route::get('add', 'GoldController@goldPresent')->name('gold.add')->middleware('can:add_event');
        Route::post('update', 'GoldController@goldUpdate')->name('gold.update');
        Route::get('gold-detail/{user_code}', 'GoldController@goldDetail')->name('gold.detail');
        Route::get('gold-export', 'GoldController@goldExport')->name('export.gold');
//        Route::get('add', 'EventController@create')->name('event.add');
//        Route::post('store', 'EventController@store')->name('event.store');
//        Route::get('delete/{id}', 'EventController@delete')->name('event.delete');
    });

    Route::group(['prefix' => 'Fee'], function () {
        Route::get('index', 'FeeController@index')->name('fee.index')->middleware('can:view_fee');
        Route::get('list/{id}', 'FeeController@listFeeStudent')->name('fees.list')->middleware('can:view_fee');
        Route::get('list-student/{id}', 'FeeController@listStudent')->name('list.student');
        Route::get('email-fee', 'EventController@emailFee')->name('event.email');
//        Route::post('store', 'EventController@store')->name('event.store');
//        Route::get('delete/{id}', 'EventController@delete')->name('event.delete');
    });


    //Queries
    Route::group(['prefix' => 'queries'], function () {
        Route::get('index', 'QueryController@Queries')->name('queries.index');
        Route::post('search', 'QueryController@Search')->name('queries.search');
        Route::get('detail/{id}', 'QueryController@detail')->name('queries.detail');
    });

    //Curriculum
    Route::group(['prefix' => 'curriculum'], function () {
        Route::get('index', 'CurriculumController@index')->name('curriculum.index');
        Route::get('student-list', 'CurriculumController@studentList')->name('personal.index');
        Route::post('export-list', 'CurriculumController@exportStudenlist')->name('personal.export');
        Route::get('student-search', 'CurriculumController@studentSearch')->name('personal.search');
        Route::get('create', 'CurriculumController@create')->name('curriculum.create');
        Route::post('store', 'CurriculumController@store')->name('curriculum.store');
        Route::get('edit/{id}', 'CurriculumController@edit')->name('curriculum.edit');
        Route::post('update/{id}', 'CurriculumController@update')->name('curriculum.update');
        Route::post('search', 'CurriculumController@Search')->name('curriculum.search');
    });

    //Evaluate
    Route::group(['prefix' => 'evaluate'], function () {
        Route::get('index', 'StudentController@Evaluate')->name('evaluate.index');
        Route::get('detail/{id?}', 'StudentController@detail')->name('evaluate.detail');
        Route::post('update/{id?}', 'StudentController@update')->name('evaluate.update');
    });

    //Queries
    Route::group(['prefix' => 'student'], function () {
        Route::get('list', 'StudentController@listStudentStatus')->name('student.index');
        Route::get('/search', 'StudentController@getStudentStatus')->name('status.search');
    });

    Route::group(['prefix' => 'term'], function () {
        Route::get('index', 'TermController@index')->name('term.index')->middleware('can:view_terms');
//        Route::post('list-course', 'CourseController@listCourse')->name('list.course');
        Route::get('create-term', 'TermController@createTerm')->name('term.create')->middleware('can:add_terms');
        Route::get('edit-term/{id}', 'TermController@edit')->name('term.edit')->middleware('can:edit_terms');
        Route::post('update-term/{id}', 'TermController@update')->name('term.update');
        Route::post('store', 'TermController@store')->name('term.store');

//        // Cancel Roles
        Route::get('delete/{id}', 'TermController@delete')->name('term.delete')->middleware('can:delete_terms');
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
        Route::post('update/{id}', 'RoleController@update')->name('roles.update');
        // Cancel Roles
        Route::get('remove/{id}', 'RoleController@delete')->name('roles.remove');
        // List Roles delete
        Route::get('role-trashout', 'RoleController@roleTrashOut')->name('roles.trash');
        // Delete Roles completely
        Route::get('delete-completely/{id}', 'RoleController@deleteCompletely')->name('roles.delete.completely');
    });

    //Route Permissions
    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/', 'PermissionController@index')->name('permissions.index');
        Route::get('create', 'PermissionController@create')->name('permissions.create');
        Route::post('store', 'PermissionController@store')->name('permissions.store');
        Route::get('edit/{id}', 'PermissionController@edit')->name('permissions.edit');
        Route::post('update/{id}', 'PermissionController@update')->name('permissions.update');
        // Cancel Roles
        Route::get('remove/{id}', 'PermissionController@delete')->name('permissions.remove');
        // List Roles delete
        Route::get('permission-trashout', 'PermissionController@permissionTrashOut')->name('permissions.trash');
        // Delete Roles completely
        Route::get('delete-completely/{id}', 'PermissionController@deleteCompletely')->name('permissions.delete.completely');
    });

    //Route QR_Code
    Route::group(['prefix' => 'qr-code'], function () {
        Route::get('index/{id}', 'QRCodeController@index')->name('qr-code.index');
        Route::get('/store', 'QRCodeController@storeQrCode')->name('post.qr-code');
        Route::post('/post-friend', 'QRCodeController@postFriend')->name('post.friend');
    });

    //Route Items
    Route::group(['prefix' => 'items'], function () {
        Route::get('list', 'ItemController@itemList')->name('items.list')->middleware('can:view_items');
        Route::get('create', 'ItemController@create')->name('items.add')->middleware('can:add_items');
        Route::post('store', 'ItemController@store')->name('items.store');
        Route::get('edit/{id}', 'ItemController@edit')->name('items.edit')->middleware('can:edit_items');
        Route::post('update/{id}', 'ItemController@update')->name('items.update');
        Route::get('delete/{id}', 'ItemController@delete')->name('items.delete')->middleware('can:delete_items');
        Route::get('list-category', 'ItemController@category')->name('items.category');
        Route::get('create-category', 'ItemController@createCategory')->name('category.add');
        Route::post('store-category', 'ItemController@storeCategory')->name('category.store');
        Route::get('edit-category/{id}', 'ItemController@editCategory')->name('category.edit');
        Route::post('update-category/{id}', 'ItemController@updateCategory')->name('category.update');
        Route::get('delete-category/{id}', 'ItemController@deleteCategory')->name('category.delete');
    });

    //Route promotion
    Route::group(['prefix' => 'promotion'], function () {
        Route::get('/index', 'PromotionController@index')->name('promotion.index');
        Route::get('/item-promotion', 'PromotionController@itemList')->name('item-promotion.index');
        Route::get('/add', 'PromotionController@add')->name('promotion.add');
        Route::post('/store', 'PromotionController@store')->name('promotion.store');
        Route::get('edit/{id}', 'PromotionController@edit')->name('promotion.edit');
        Route::post('update/{id}', 'PromotionController@update')->name('promotion.update');
        Route::get('delete/{id}', 'PromotionController@delete')->name('promotion.delete');
    });
    //Route Club
    Route::group(['prefix' => 'club'], function () {
        Route::get('/index', 'ClubController@index')->name('club.index');
        Route::get('/delete/{id?}', 'ClubController@deleteMembder')->name('club.delete')->middleware('can:delete_clubs');
        Route::get('/create', 'ClubController@createClub')->name('club.create');
        Route::post('/post-create', 'ClubController@storeClub')->name('club.store');
        Route::get('/add/{id}', 'ClubController@addManagement')->name('add.management');
        Route::post('/store', 'ClubController@store')->name('update.management');
//        Route::post('/store', 'ClubController@store')->name('club.update');
        Route::get('/detail/{id}', 'ClubController@detail')->name('club.detail');
        Route::get('/edit/{id}', 'ClubController@edit')->name('club.edit')->middleware('can:edit_clubs');
        Route::post('/update/{id}', 'ClubController@update')->name('club.update');
        Route::get('/delete-member/{id?}', 'ClubController@deleteMembder')->name('delete.member');
        Route::post('/store', 'ClubController@store')->name('update.management');
    });

    //Route Bills
    Route::group(['prefix' => 'bills'], function () {
        Route::get('/index', 'BillController@index')->name('bills.index');
        Route::get('/update', 'BillController@updateStatus')->name('update.status');
        Route::get('/delete/{id}', 'BillController@delete')->name('bill.delete');
    });

    Route::group(['prefix' => 'guidline'], function () {
        Route::get('/index', 'SwinGuidlineController@index')->name('guidline.index');
        Route::get('/add', 'SwinGuidlineController@create')->name('guidline.add');
        Route::post('/store', 'SwinGuidlineController@store')->name('guidline.store');
//        Route::get('/delete/{id}', 'BillController@delete')->name('bill.delete');
    });
});
