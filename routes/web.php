<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminDashController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\CartController;

use App\Http\Middleware\admin;
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

Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/about-us', [IndexController::class, 'about_us'])->name('about-us');
Route::get('/products', [IndexController::class, 'products'])->name('products');
Route::get('/contact-us', [IndexController::class, 'contact_us'])->name('contact-us');
Route::get('/cart', [IndexController::class, 'cart'])->name('cart');
Route::get('/products-detail/{slug?}', [IndexController::class, 'products_detail'])->name('products-detail');
Route::get('/privacy-policy', [IndexController::class, 'privacy_policy'])->name('privacy-policy');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/place-order', [CartController::class,'placeorder'])->name('placeorder');

Route::get('/blog-detail/{slug}', [IndexController::class, 'blog_detail'])->name('blog_detail');
Route::get('/news-detail/{slug}', [IndexController::class, 'news_detail'])->name('news_detail');
Route::get('/products-search', [IndexController::class, 'products_search'])->name('products_search');

Route::post('/newsletter/store', [IndexController::class,'newsletterstore'])->name('newsletterstore');
Route::post('/contact-us-submit', [UserController::class, 'contact_us_submit'])->name('contact-us-submit');

Route::get('/sign-in', [UserController::class, 'signin'])->name('sign-in');
Route::post('/sign-in', [UserController::class, 'signin_submit'])->name('sign-in-submit');
Route::get('/sign-up', [UserController::class, 'signup'])->name('sign-up');
Route::post('/sign-up', [UserController::class, 'signup_submit'])->name('sign-up-submit');

Route::get('/forget-password', [UserController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('/forget-password-submit', [UserController::class, 'submitForgetPasswordForm'])->name('forget.password.submit'); 
Route::get('/reset-password/{token}', [UserController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('/reset-password', [UserController::class, 'submitResetPasswordForm'])->name('reset.password.post');

// Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('update-cart',[CartController::class,'updatecart'])->name('update-cart');
Route::post('remove-cart',[CartController::class,'removecart'])->name('remove-cart');
Route::post('/save-cart', [CartController::class, 'save_cart'])->name('save-cart');
Route::post('/checkout-course', [CartController::class, 'checkout_course'])->name('checkout-course');
// Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');  
Route::post('order-inquiry',[CartController::class,'order_inquiry'])->name('order_inquiry');

// Route::get('/take-quiz-after-payment', [IndexController::class, 'take_quiz_after_pay'])->name('take_quiz_after');
// Route::get('/payment-success', [CartController::class,'checkout_landing'])->name('checkout_landing');
// Route::post('/quiz-pay-status', [IndexController::class,'paystatus'])->name('quiz-paystatus');

Route::post('user/create-review', [IndexController::class, 'create_review'])->name('user.create-review');

Route::get('/payment', [CartController::class,'paysecure'])->name('paysecure');
Route::group(['middleware' => 'auth'], function()
{
  Route::get('/sign-out', [UserController::class, 'signout'])->name('signout');

  Route::get('dashboard/password_change', [DashboardController::class, 'passwordchange'])->name('dashboard.passwordChange');
	Route::post('dashboard/update/password',[DashboardController::class, 'updatepassword'])->name('update.account.password');
	
  Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.index');
	Route::get('dashboard/my-profile', [DashboardController::class, 'myProfile'])->name('dashboard.myProfile');
	Route::get('dashboard/edit_profile', [DashboardController::class, 'editprofile'])->name('dashboard.editProfile');
	Route::post('dashboard/edit_profile', [DashboardController::class, 'saveprofile'])->name('dashboard.submitProfile');
  Route::get('dashboard/my-tickets', [DashboardController::class, 'mytickets'])->name('dashboard.mytickets');
  Route::get('dashboard/add-tickets', [DashboardController::class, 'addtickets'])->name('dashboard.addtickets');
  Route::post('dashboard/add-tickets-post', [DashboardController::class, 'createtickets'])->name('dashboard.createtickets');
  Route::post('dashboard/tickets-chat-post', [DashboardController::class, 'chatmessage'])->name('dashboard.chatmessage');
  Route::get('/ticket-closed/{id}', [DashboardController::class, 'ticketclosed'])->name('dashboard.ticketclosed'); 
  Route::get('dashboard/view-ticket/{decrypt}', [DashboardController::class, 'viewticket'])->name('dashboard.viewticket');
  Route::get('dashboard/my-orders', [DashboardController::class, 'myorders'])->name('dashboard.myBookings');
  Route::get('dashboard/view-orders/{decrypt}', [DashboardController::class, 'vieworders'])->name('dashboard.viewAppointment');
  Route::get('dashboard/delete-orders/{decrypt}', [DashboardController::class, 'deleteorders'])->name('dashboard.deleteAppointment');
  
  Route::post('stripe', [CartController::class, 'stripePost'])->name('stripe.post');
  Route::get('/order-submit', [CartController::class, 'order_submit'])->name('order.submit');
  
});

Route::get('/admins', function(){
	return redirect('admin/login');
})->name('admin.admin');

Route::middleware(['guest'])->prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'get_login'])->name('admin.login');
    Route::post('/perform-login', [AdminLoginController::class, 'performLogin'])->name('admin.performLogin');
});

Route::middleware(['admin'])->prefix('admin')->namespace('admin')->group(function () {
    Route::get('/',function(){
      return redirect('/admin/dashboard');
    });
    Route::get('/dashboard', [AdminDashController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users-listing', [AdminDashController::class, 'users_listing'])->name('admin.users_listing'); 
    Route::get('/add-users', [AdminDashController::class, 'add_users'])->name('admin.add_users'); 
    Route::post('/create-users', [AdminDashController::class, 'create_users'])->name('admin.create_users');
    Route::get('/edit-users/{id}', [AdminDashController::class, 'edit_user'])->name('admin.edit_user');  
    Route::post('/edit-users', [AdminDashController::class, 'saveprofile'])->name('admin.saveprofile');  
    Route::get('/suspend-user/{id}', [AdminDashController::class, 'suspend_user'])->name('admin.suspend_user');  

    Route::get('/contact-social-info', [SiteSettingsController::class, 'socialInfo'])->name('admin.socialInfo');
    Route::post('/contact-social-info', [SiteSettingsController::class, 'saveSocialInfo'])->name('admin.saveSocialInfo');

    Route::get('/logo-management', [SiteSettingsController::class, 'showLogo'])->name('admin.showLogo');
    Route::post('/logo-management-save', [SiteSettingsController::class, 'saveLogo'])->name('admin.saveLogo');

    Route::get('/category-listing', [AdminDashController::class, 'category_listing'])->name('admin.category_listing'); 
    Route::get('/add-category', [AdminDashController::class, 'add_category'])->name('admin.add_category'); 
    Route::post('/create-category', [AdminDashController::class, 'create_category'])->name('admin.create_category');
    Route::get('/edit-category/{id}', [AdminDashController::class, 'edit_category'])->name('admin.edit_category');  
    Route::post('/edit-category', [AdminDashController::class, 'savecategory'])->name('admin.savecategory');  
    Route::get('/suspend-category/{id}', [AdminDashController::class, 'suspend_category'])->name('admin.suspend_category');  
    Route::get('/delete-category/{id}', [AdminDashController::class, 'delete_category'])->name('admin.delete_category'); 

    Route::get('/products-listing', [ShopController::class, 'products_listing'])->name('admin.products_listing'); 
    Route::get('/add-products', [ShopController::class, 'add_products'])->name('admin.add_products'); 
    Route::post('/create-products', [ShopController::class, 'create_products'])->name('admin.create_products');
    Route::get('/edit-products/{slug}', [ShopController::class, 'edit_products'])->name('admin.edit_products');  
    Route::post('/edit-products', [ShopController::class, 'saveproducts'])->name('admin.saveproducts');  
    Route::get('/suspend-products/{id}', [ShopController::class, 'suspend_products'])->name('admin.suspend_products');
    Route::get('/feature-products/{id}', [ShopController::class, 'feature_products'])->name('admin.feature_products');
    Route::get('/delete-products/{id}', [ShopController::class, 'delete_products'])->name('admin.delete_products');  
    Route::get('/delete-multi-img/{id}', [ShopController::class, 'delete_multiimg'])->name('admin.delete_multiimg'); 

    Route::get('/orders', [OrderController::class,'orders'])->name('admin.orders');
    Route::get('/order-detail/{id}', [OrderController::class,'order_detail'])->name('admin.order_detail');
    Route::get('/order-delete/{id}', [OrderController::class,'order_delete'])->name('admin.order_delete');
    Route::get('/order-suspend/{id}', [OrderController::class,'order_suspend'])->name('admin.order_suspend');

    Route::get('/orders-inquiry', [OrderController::class,'orders_inquiry'])->name('admin.orders_inquiry');
    Route::get('/order-inquiry-delete/{id}', [OrderController::class,'order_inquiry_detail'])->name('admin.order-inquiry-delete');

    Route::get('/cms-content', [SiteSettingsController::class, 'cms'])->name('admin.cms');
    Route::get('/cms-content-edit/{id}', [SiteSettingsController::class, 'edit_cms'])->name('admin.editCms');
    Route::post('/cms-content-update', [SiteSettingsController::class, 'update_cms'])->name('admin.updateCms');

    Route::get('/check_slug', [AdminDashController::class, 'check_slug'])
    ->name('admin.check_slug');

    Route::get('/reviews-listing', [AdminDashController::class, 'reviews_listing'])->name('admin.reviews_listing'); 
    //  Route::get('/add-reviews', [AdminDashController::class, 'add_reviews'])->name('admin.add_reviews'); 
    //  Route::post('/create-reviews', [AdminDashController::class, 'create_reviews'])->name('admin.create_reviews');
    //  Route::get('/edit-reviews/{id}', [AdminDashController::class, 'edit_reviews'])->name('admin.edit_reviews');  
    //  Route::post('/edit-reviews', [AdminDashController::class, 'savereviews'])->name('admin.savereviews');  
     Route::get('/suspend-reviews/{id}', [AdminDashController::class, 'suspend_reviews'])->name('admin.suspend_reviews');  
     Route::get('/delete-reviews/{id}', [AdminDashController::class, 'delete_reviews'])->name('admin.delete_reviews'); 

    Route::get('/admin-listing', [AdminDashController::class, 'admins_listing'])->name('admin.admin_listing'); 
    Route::get('/add-admin', [AdminDashController::class, 'add_admins'])->name('admin.add_admin'); 
    Route::post('/create-admin', [AdminDashController::class, 'create_admin'])->name('admin.create_admin');
    Route::get('/edit-admin/{id}', [AdminDashController::class, 'edit_admin'])->name('admin.edit_admin');  
    Route::post('/edit-admin', [AdminDashController::class, 'saveadmin'])->name('admin.saveadmin');  
    Route::get('/suspend-admin/{id}', [AdminDashController::class, 'suspend_admin'])->name('admin.suspend_admin'); 

    Route::get('/banner', [SiteSettingsController::class, 'homeSlider'])->name('admin.homeSlider');
    Route::get('/add-banner', [SiteSettingsController::class, 'addhomeSlider'])->name('admin.addhomeSlider');
    Route::post('/add-banner', [SiteSettingsController::class, 'createhomeSlider'])->name('admin.createhomeSlider');
    Route::get('/edit-banner/{id}', [SiteSettingsController::class, 'edithomeSlider'])->name('admin.edithomeSlider');
    Route::post('/edit-banner', [SiteSettingsController::class, 'updatehomeSlider'])->name('admin.updatehomeSlider');
    Route::get('/delete-home-slider/{id}', [SiteSettingsController::class, 'deletehomeSlider'])->name('admin.deletehomeSlider');
    Route::get('/suspend-home-slider/{id}', [SiteSettingsController::class, 'suspendhomeSlider'])->name('admin.suspendhomeSlider');

    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

});
