<?php

use App\Http\Controllers\BlogController;
use App\Models\Blog;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use \App\Http\Controllers\CompanyDashboardController;
use App\Models\RegistrationType;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BillController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ContactMeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// 
Route::middleware(['guest'])->group(function () {
    // Registration Routes
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Login Routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});
// Route::view('/login', 'login');
// Route::view('/sign-up', 'sign-up');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



Route::view('/edit-password', 'edit-password');
Route::view('/', 'index');
Route::view('/index', 'index')->name('home');
// Route::view('/settings', 'settings');
Route::get('/settings', [ProfileController::class, 'showProfile'])->name('showProfile');
//edit-profile
Route::get('/edit-profile', [ProfileController::class, 'editProfile'])->name('editProfile');
//update-profile
Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('updateProfile');


// Route::view('/URL-option', 'URL-option')->name('URL-option');
Route::get('/URL-option', [ScanController::class, 'showForm'])->name('URL-option');

//scan
Route::post('/scan', [ScanController::class, 'scan'])->name('scan');
//ip-result
Route::get('/ip-result', [ScanController::class, 'ip_result'])->name('ip-result');
//domain-result
Route::get('/domain-result', [ScanController::class, 'domain_result'])->name('domain-result');
//port-result
Route::get('/port-result', [ScanController::class, 'port_result'])->name('port-result');


// Route::view('/domain-result', 'domain-result');
// Route::view('/edit-profile', 'edit-profile');
// Route::view('/ip-result', 'ip-result');
// Route::view('/port-result', 'port-result');





Route::view('/welcome', 'welcome');





Route::get('/blogs', [BlogController::class, 'showAllBlogs']);
//show one blog
Route::get('/blogs/{id}', [BlogController::class, 'showOneBlog'])->name('blogs.showOneBlog');
//contacts
Route::get('/contacts', [BlogController::class, 'showContactMe'])->name('contacts');








Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', 'Auth\Admin\LoginController@showLoginForm')->name('show.login');
    Route::middleware(['throttle:5,1'])->post('/login', 'Auth\Admin\LoginController@userLogin')->name('login');
    Route::post('/logout', 'Auth\Admin\LoginController@logout')->name('logout');
});
Route::post('/logout', 'Auth\Admin\LoginController@logout')->name('logout');

########dashboard#########
//route home with /
// Route::view('/', 'welcome')->name('home');

Route::group([
    'prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin',
    'middleware' => [
        'auth', 'admin'
    ]
], function () {
    Route::get('/', 'AdminController@admin')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');
    Route::post('/users/{user}/update-status', 'UsersController@updateStatus')->name('users.updateStatus');


    // Bills
    Route::delete('bills/destroy', 'BillController@massDestroy')->name('bills.massDestroy');
    Route::resource('bills', 'BillController');
    Route::post('/bills/{bill}/update-status', 'BillController@updateStatus')->name('bills.updateStatus');

    // Payments
    Route::delete('payments/destroy', 'PaymentController@massDestroy')->name('payments.massDestroy');
    Route::resource('payments', 'PaymentController');
    Route::post('/payments/{payment}/update-status', 'PaymentController@updateStatus')->name('payments.updateStatus');


    // Contact-Us
    Route::delete('contact/destroy', 'ContactsController@massDestroy')
        ->name('contact.massDestroy');
    Route::resource('contact', 'ContactsController');


    //Blogs
    Route::delete('blogs/destroy', 'BlogController@massDestroy')->name('blogs.massDestroy');
    Route::resource('blogs', 'BlogController');
});


Route::group([
    'prefix' => 'profile', 'as' => 'profile.',
    'namespace' => 'Auth',
    'middleware' => [
        'auth', 'admin'

    ]
], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        Route::post(
            'profile/language',
            'ChangePasswordController@language'
        )
            ->name('password.language');
    }
});

Route::group(
    [
        'as' => 'frontend.', 'namespace' => 'Frontend',
        'middleware' => [
            'auth', 'admin'
        ]
    ],
    function () {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
        Route::resource('permissions', 'PermissionsController');
        Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
        Route::resource('roles', 'RolesController');
        Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
        Route::resource('users', 'UsersController');
        Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
        Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
        Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
        Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
    }
);
Route::get('/search/users-and-companies', 'BillController@searchUsersAndCompanies');

Route::post('/language/update', 'LanguageController@update')->name('language.update');



// Route for custom 404 error page
Route::fallback(function () {
    ###
    return view('errors.404');
})->middleware('web');

Route::fallback(function () {
    ###
    return view('errors.403');
})->middleware('web');

