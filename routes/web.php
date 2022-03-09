<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAuthMiddleware;

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

//frontend
Route::get('/', [App\Http\Controllers\frontEndController::class, 'index']);
Route::get('/all-dish', [App\Http\Controllers\frontEndController::class, 'allDish'])->name('show_all_dish');
Route::get('/category/dish/show/{category_id}', [App\Http\Controllers\frontEndController::class, 'dish_show'])->name('show_category_dish');
Route::get('/TroVe-muasam', [App\Http\Controllers\frontEndController::class, 'trove'])->name('TroVeMua');

//search
Route::post('/search', [App\Http\Controllers\frontEndController::class, 'search'])->name('search_dish');

//cart
Route::post('/add/cart', [App\Http\Controllers\cartController::class, 'insert'])->name('add_to_cart');
Route::get('/cart/show', [App\Http\Controllers\cartController::class, 'show'])->name('show_cart');
Route::get('/cart/remove/{rowId}', [App\Http\Controllers\cartController::class, 'remove'])->name('remove_cart');
Route::post('/cart/update', [App\Http\Controllers\cartController::class, 'update'])->name('update_cart');

//coupon in cart
Route::post('/check-coupon', [App\Http\Controllers\cartController::class, 'CheckCoupon'])->name('check_coupon');

//coupon in Coupon
Route::get('/upset-coupon', [App\Http\Controllers\couponController::class, 'UpsetCoupon'])->name('upset_coupon');

//checkout
Route::get('/checkout/payment', [App\Http\Controllers\checkoutController::class, 'payment'])->name('checkout_payment');
Route::post('/checkout/neworder', [App\Http\Controllers\checkoutController::class, 'newOrder'])->name('new_order');
Route::get('/checkout/order/complete', [App\Http\Controllers\checkoutController::class, 'complete'])->name('order_complete');

//stripe payment
Route::get('/stripe-payment', [App\Http\Controllers\stripeController::class, 'handleGet']);
Route::post('/stripe-payment', [App\Http\Controllers\stripeController::class, 'handlePost'])->name('stripe.payment');

//login and register customer
Route::get('/register/customer', [App\Http\Controllers\customerController::class, 'register'])->name('sign_up');
Route::post('/check/customer/register', [App\Http\Controllers\customerController::class, 'store_register'])->name('store_customer_register');

Route::get('/login/customer', [App\Http\Controllers\customerController::class, 'login'])->name('sign_in');
Route::post('/check/customer/login', [App\Http\Controllers\customerController::class, 'store_login'])->name('store_customer_login');
Route::post('/logout/customer', [App\Http\Controllers\customerController::class, 'logout'])->name('sign_out');

//shipping customer
Route::get('/shipping', [App\Http\Controllers\customerController::class, 'shipping'])->name('shipping');
Route::post('/shipping/store', [App\Http\Controllers\customerController::class, 'storeShipping'])->name('store_shipping');

//feeship customer
Route::post('/select-deliver-home', [App\Http\Controllers\customerController::class, 'SelectDeliverHome'])->name('select_deliver_home');
Route::post('/calculate-fee', [App\Http\Controllers\customerController::class, 'CalculateFee'])->name('calculate_fee');
Route::get('/del-fee', [App\Http\Controllers\customerController::class, 'DelFee'])->name('del_fee');

//contact
Route::get('/con-tact', [App\Http\Controllers\contactController::class, 'contact'])->name('contact');

//about
Route::get('/a-bout', [App\Http\Controllers\aboutController::class, 'about'])->name('about');

Auth::routes();

//backend
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/all-customer', [App\Http\Controllers\HomeController::class, 'show_cus'])->name('show_customer');
Route::get('/delete/{customer_id}', [App\Http\Controllers\HomeController::class, 'delete'])->name('delete_customer');

//view filter date
// Route::post('/view-filter-date', [App\Http\Controllers\HomeController::class, 'view_filter_date'])->name('filter_date');


// Bieu do doanh thu
// Route::post('/filter-by-date', [App\Http\Controllers\HomeController::class, 'filter_by_date'])->name('filterBydate');
// Route::post('/dashboard-filter', [App\Http\Controllers\HomeController::class, 'dashboard_filter'])->name('dashboardFilter');

// Route::get('/order-date', [App\Http\Controllers\HomeController::class, 'order_date'])->name('orderDate');
// Route::post('/days-order', [App\Http\Controllers\HomeController::class, 'days_order'])->name('daysOrder');

Route::prefix('user')->group(function(){
    //user
    Route::get('/manage', [App\Http\Controllers\userController::class, 'manage'])->name('manage_user');
});

Route::prefix('category')->group(function(){
    // category
    Route::get('/add', [App\Http\Controllers\categoryController::class, 'index'])->name('show_category');
    Route::post('/save', [App\Http\Controllers\categoryController::class, 'save'])->name('cate_save');
    Route::get('/manage', [App\Http\Controllers\categoryController::class, 'manage'])->name('manage_category');
    Route::get('/active/{category_id}', [App\Http\Controllers\categoryController::class, 'active'])->name('active_category');
    Route::get('/inactive/{category_id}', [App\Http\Controllers\categoryController::class, 'inactive'])->name('inactive_category');
    
    Route::get('/delete/{category_id}', [App\Http\Controllers\categoryController::class, 'delete'])->name('delete_category');
    Route::post('/update', [App\Http\Controllers\categoryController::class, 'update'])->name('update_category');

    Route::get('/category-export-csv', [App\Http\Controllers\categoryController::class, 'Category_Export_csv'])->name('category_export_csv');
    Route::post('/category-import-csv',[App\Http\Controllers\categoryController::class, 'Category_Import_csv'])->name('category_import_csv');
});

Route::prefix('delivery')->group(function(){
    //delivry
    Route::get('/boy/add', [App\Http\Controllers\deliveryController::class, 'index'])->name('show_delivery');
    Route::post('/boy/save', [App\Http\Controllers\deliveryController::class, 'save_boy'])->name('delivery_save');
    Route::get('/boy/manage', [App\Http\Controllers\deliveryController::class, 'manage'])->name('manage_delivery');
    Route::get('/boy/active/{delivery_id}', [App\Http\Controllers\deliveryController::class, 'active'])->name('active_delivery');
    Route::get('/boy/inactive/{delivery_id}', [App\Http\Controllers\deliveryController::class, 'inactive'])->name('inactive_delivery');
    
    Route::get('/boy/delete/{delivery_id}', [App\Http\Controllers\deliveryController::class, 'delete'])->name('delete_delivery');
    Route::post('/boy/update', [App\Http\Controllers\deliveryController::class, 'update'])->name('update_delivery');

    // ----------------------fee ship-------------------
    Route::get('/manage-feeship', [App\Http\Controllers\deliveryController::class, 'ManageFeeShip'])->name('manage_feeship');
    Route::post('/select-delivery', [App\Http\Controllers\deliveryController::class, 'SelectDelivery'])->name('select_delivery');
    Route::post('/insert-delivery', [App\Http\Controllers\deliveryController::class, 'InsertDelivery'])->name('insert_delivery');
    Route::post('/select-feeship', [App\Http\Controllers\deliveryController::class, 'SelectFeeship'])->name('select_feeship');
    Route::post('/update-Feedelivery', [App\Http\Controllers\deliveryController::class, 'UpdateFeeDelivery'])->name('update_Feedelivery');

});

Route::prefix('coupon')->group(function(){
    //coupon
    Route::get('/add', [App\Http\Controllers\couponController::class, 'index'])->name('show_coupon');
    Route::post('/save', [App\Http\Controllers\couponController::class, 'save_boy'])->name('coupon_save');
    Route::get('/manage', [App\Http\Controllers\couponController::class, 'manage'])->name('manage_coupon');
    Route::get('/active/{coupon_id}', [App\Http\Controllers\couponController::class, 'active'])->name('active_coupon');
    Route::get('/inactive/{coupon_id}', [App\Http\Controllers\couponController::class, 'inactive'])->name('inactive_coupon');
    
    Route::get('/delete/{coupon_id}', [App\Http\Controllers\couponController::class, 'delete'])->name('delete_coupon');
    Route::post('/update', [App\Http\Controllers\couponController::class, 'update'])->name('update_coupon');
});

Route::prefix('dish')->group(function(){
    // dish
    Route::get('/add', [App\Http\Controllers\dishController::class, 'index'])->name('show_dish');
    Route::post('/save', [App\Http\Controllers\dishController::class, 'save'])->name('dish_save');
    Route::get('/manage', [App\Http\Controllers\dishController::class, 'manage'])->name('manage_dish');
    Route::get('/active/{dish_id}', [App\Http\Controllers\dishController::class, 'active'])->name('active_dish');
    Route::get('/inactive/{dish_id}', [App\Http\Controllers\dishController::class, 'inactive'])->name('inactive_dish');
    
    Route::get('/delete/{dish_id}', [App\Http\Controllers\dishController::class, 'delete'])->name('delete_dish');
    Route::post('/update', [App\Http\Controllers\dishController::class, 'update'])->name('update_dish');

    Route::get('/export-csv', [App\Http\Controllers\dishController::class, 'Export_csv'])->name('export_csv');
    Route::post('/import-csv',[App\Http\Controllers\dishController::class, 'Import_csv'])->name('import_csv');
});

Route::prefix('order')->middleware([CheckAuthMiddleware::class])->group(function(){
    //order
    Route::get('/manage', [App\Http\Controllers\orderController::class, 'manage'])->name('show_order');
    Route::get('/view/detail/{order_id}', [App\Http\Controllers\orderController::class, 'viewOrder'])->name('view_order');
    Route::get('/view/invoice/{order_id}', [App\Http\Controllers\orderController::class, 'viewInvoice'])->name('view_order_invoice');
    Route::get('/download/invoice/{order_id}', [App\Http\Controllers\orderController::class, 'downloadInvoice'])->name('download_order_invoice');
        
    Route::get('/delete/{order_id}', [App\Http\Controllers\orderController::class, 'delete'])->name('delete_order');

    Route::get('/order-export-csv', [App\Http\Controllers\orderController::class, 'Order_Export_csv'])->name('order_export_csv');
    Route::post('/order-import-csv',[App\Http\Controllers\orderController::class, 'Order_Import_csv'])->name('order_import_csv');
});

