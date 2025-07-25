<?php

use App\Http\Controllers\APi\ApiGeneralOrderController;
use App\Http\Controllers\APi\ApiServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\RatingApiController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\MessageApiController;
use App\Http\Controllers\Api\ProfileApiController;
use App\Http\Controllers\Api\Furniture\ApiAdsController;
use App\Http\Controllers\Api\furniture\ApiAirconController;
use App\Http\Controllers\Api\Furniture\ApiWaterController;
use App\Http\Controllers\Api\Furniture\ApiBigCarController;
use App\Http\Controllers\Api\Furniture\ApiFamilyController;
use App\Http\Controllers\Api\Furniture\ApiGardenController;
use App\Http\Controllers\Api\Furniture\ApiWorkerController;
use App\Http\Controllers\Api\Furniture\ApiTeacherController;
use App\Http\Controllers\Api\Furniture\ApiCarWaterController;
use App\Http\Controllers\Api\Furniture\ApiCleaningController;
use App\Http\Controllers\Api\Furniture\ApiPublicGeController;
use App\Http\Controllers\Api\Furniture\ApiCounterInsectsController;
use App\Http\Controllers\Api\Furniture\ApiPartyPreparationController;
use App\Http\Controllers\Api\Furniture\ApiServeillanceCamerasController;
use App\Http\Controllers\Api\Furniture\ApiFurnitureTransportationsController;
use App\Models\GeneralOrder;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Guest (public) routes
Route::post('/login' , [AuthController::class , 'login'])->name('api_login');
Route::post('/register' , [AuthController::class , 'register'])->name('api_register');

// Public GET routes (listing, viewing, etc.)
Route::get('/{dapartment_id}/posts', [PostController::class ,'index'])->name('all_posts');
Route::get('/departments' ,[DepartmentController::class , 'index'])->name('api.departments');
Route::get('/departments/{id}' ,[DepartmentController::class , 'childern'])->name('api.departments.childern');
Route::get('/departments/show_post_inputs/{id}' ,[DepartmentController::class , 'showDepartment'])->name('api.departments.show');
Route::get('/categories' ,[CategoryController::class , 'index'])->name('api.Categories');
Route::get('/categories/{id}' ,[CategoryController::class , 'childern'])->name('api.Categories.childern');
Route::get('/comments/{id}' , [CommentController::class , 'index'])->name('api.comments');
Route::get('/countries-governements', [App\Http\Controllers\Api\LocationController::class, 'getCountriesWithGovernements']);
Route::get('orders', [ApiGeneralOrderController::class, 'index']);
Route::get('orders/{order}', [ApiGeneralOrderController::class, 'show']);

// All routes that require authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthController::class , 'logout'])->name('api_logout');
    Route::post('/posts/store', [PostController::class ,'store'])->name('post.store');
    Route::post('/comments/create' , [CommentController::class , 'store'])->name('api.comments.store');
Route::group(['prefix' => 'orders'], function () {
        Route::post('/create' , [OrderApiController::class , 'store'])->name('api.orders.store');
        Route::get('/{id}' , [OrderApiController::class , 'myOrders'])->name('api.orders');
    });
Route::group(['prefix' => 'messages'], function () {
        Route::get('/conversation' , [MessageApiController::class , 'conversation'])->name('api.messages.myconversation');
        Route::post('/send' , [MessageApiController::class , 'store'])->name('api.messages.store');
        Route::get('/{recipient_id}' , [MessageApiController::class , 'myMessage'])->name('api.messages');
    });
Route::post('/rating' , [RatingApiController::class , 'store'])->name('api.rating');
Route::group(['prefix' => "my_profile"] , function(){
    Route::get('/{id}' , [ProfileApiController::class , 'index'])->name('api.my_profile');
});
// furniture_transportations
Route::group(['prefix' => 'furniture_transportations' ] , function(){
    Route::get('/' , [ApiFurnitureTransportationsController::class , 'index']);
    Route::post('/store_service' , [ApiFurnitureTransportationsController::class , 'storeService']);
    Route::post('/accept_offer' , [ApiFurnitureTransportationsController::class , 'accept_offer']);
    Route::post('/accept_rate' , [ApiFurnitureTransportationsController::class , 'storeRate']);
    Route::get('/show_service/{id}' , [ApiFurnitureTransportationsController::class , 'showService']);
});
Route::group(['prefix' => 'furniture_transportations/service_provider' ] , function(){
    Route::get('/' , [ApiFurnitureTransportationsController::class , 'service_provider_index']);
    Route::post('/add_offer' , [ApiFurnitureTransportationsController::class , 'service_provider_add_offer']);
});
// Systems and surveillance cameras
Route::group(['prefix' => 'surveillance_cameras' ] , function(){
    Route::get('/' , [ApiServeillanceCamerasController::class , 'index']);
    Route::post('/store_service' , [ApiServeillanceCamerasController::class , 'storeService']);
    Route::post('/accept_offer' , [ApiServeillanceCamerasController::class , 'accept_offer']);
    Route::post('/accept_rate' , [ApiServeillanceCamerasController::class , 'storeRate']);
    Route::get('/show_service/{id}' , [ApiServeillanceCamerasController::class , 'showService']);
});
Route::group(['prefix' => 'surveillance_cameras/service_provider' ] , function(){
    Route::get('/' , [ApiServeillanceCamerasController::class , 'service_provider_index']);
    Route::post('/add_offer' , [ApiServeillanceCamerasController::class , 'service_provider_add_offer']);
});
// Party Preparation
Route::group(['prefix' => 'party_preparation' ] , function(){
    Route::get('/' , [ApiPartyPreparationController::class , 'index']);
    Route::post('/store_service' , [ApiPartyPreparationController::class , 'storeService']);
    Route::post('/accept_offer' , [ApiPartyPreparationController::class , 'accept_offer']);
    Route::post('/accept_rate' , [ApiPartyPreparationController::class , 'storeRate']);
    Route::get('/show_service/{id}' , [ApiPartyPreparationController::class , 'showService']);
});
Route::group(['prefix' => 'party_preparation/service_provider' ] , function(){
    Route::get('/' , [ApiPartyPreparationController::class , 'service_provider_index']);
    Route::post('/add_offer' , [ApiPartyPreparationController::class , 'service_provider_add_offer']);
});
// Garden
Route::group(['prefix' => 'garden' ] , function(){
    Route::get('/' , [ApiGardenController::class , 'index']);
    Route::post('/store_service' , [ApiGardenController::class , 'storeService']);
    Route::post('/accept_offer' , [ApiGardenController::class , 'accept_offer']);
    Route::post('/accept_rate' , [ApiGardenController::class , 'storeRate']);
    Route::get('/show_service/{id}' , [ApiGardenController::class , 'showService']);
});
Route::group(['prefix' => 'garden/service_provider' ] , function(){
    Route::get('/' , [ApiGardenController::class , 'service_provider_index']);
    Route::post('/add_offer' , [ApiGardenController::class , 'service_provider_add_offer']);
});
// CounterInsects
Route::group(['prefix' => 'counter_insects' ] , function(){
    Route::get('/' , [ApiCounterInsectsController::class , 'index']);
    Route::post('/store_service' , [ApiCounterInsectsController::class , 'storeService']);
    Route::post('/accept_offer' , [ApiCounterInsectsController::class , 'accept_offer']);
    Route::post('/accept_rate' , [ApiCounterInsectsController::class , 'storeRate']);
    Route::get('/show_service/{id}' , [ApiCounterInsectsController::class , 'showService']);
});
Route::group(['prefix' => 'counter_insects/service_provider' ] , function(){
    Route::get('/' , [ApiCounterInsectsController::class , 'service_provider_index']);
    Route::post('/add_offer' , [ApiCounterInsectsController::class , 'service_provider_add_offer']);
});
// Cleaning
Route::group(['prefix' => 'cleaning' ] , function(){
    Route::get('/' , [ApiCleaningController::class , 'index']);
    Route::post('/store_service' , [ApiCleaningController::class , 'storeService']);
    Route::post('/accept_offer' , [ApiCleaningController::class , 'accept_offer']);
    Route::post('/accept_rate' , [ApiCleaningController::class , 'storeRate']);
    Route::get('/show_service/{id}' , [ApiCleaningController::class , 'showService']);
});
Route::group(['prefix' => 'cleaning/service_provider' ] , function(){
    Route::get('/' , [ApiCleaningController::class , 'service_provider_index']);
    Route::post('/add_offer' , [ApiCleaningController::class , 'service_provider_add_offer']);
});
// Teacher
Route::group(['prefix' => 'teacher' ] , function(){
    Route::get('/' , [ApiTeacherController::class , 'index']);
    Route::post('/store_service' , [ApiTeacherController::class , 'storeService']);
    Route::post('/accept_offer' , [ApiTeacherController::class , 'accept_offer']);
    Route::post('/add_rate' , [ApiTeacherController::class , 'storeRate']);
    Route::get('/show_service/{id}' , [ApiTeacherController::class , 'showService']);
});
Route::group(['prefix' => 'teacher/service_provider' ] , function(){
    Route::get('/' , [ApiTeacherController::class , 'service_provider_index']);
    Route::post('/add_offer' , [ApiTeacherController::class , 'service_provider_add_offer']);
});
// Family
Route::group(['prefix' => 'family' ] , function(){
    Route::get('/' , [ApiFamilyController::class , 'index']);
    Route::post('/store_service' , [ApiFamilyController::class , 'storeService']);
    Route::post('/accept_offer' , [ApiFamilyController::class , 'accept_offer']);
    Route::post('/add_rate' , [ApiFamilyController::class , 'storeRate']);
    Route::get('/show_service/{id}' , [ApiFamilyController::class , 'showService']);
});
Route::group(['prefix' => 'family/service_provider' ] , function(){
    Route::get('/' , [ApiFamilyController::class , 'service_provider_index']);
    Route::post('/add_offer' , [ApiFamilyController::class , 'service_provider_add_offer']);
});
// Workers
Route::group(['prefix' => 'workers' ] , function(){
    Route::get('/' , [ApiWorkerController::class , 'index']);
    Route::post('/store_service' , [ApiWorkerController::class , 'storeService']);
    Route::post('/accept_offer' , [ApiWorkerController::class , 'accept_offer']);
    Route::post('/add_rate' , [ApiWorkerController::class , 'storeRate']);
    Route::get('/show_service/{id}' , [ApiWorkerController::class , 'showService']);
});
Route::group(['prefix' => 'workers/service_provider' ] , function(){
    Route::get('/' , [ApiWorkerController::class , 'service_provider_index']);
    Route::post('/add_offer' , [ApiWorkerController::class , 'service_provider_add_offer']);
});
// Public Ge
Route::group(['prefix' => 'public_ge' ] , function(){
    Route::get('/' , [ApiPublicGeController::class , 'index']);
    Route::post('/store_service' , [ApiPublicGeController::class , 'storeService']);
    Route::post('/accept_offer' , [ApiPublicGeController::class , 'accept_offer']);
    Route::post('/add_rate' , [ApiPublicGeController::class , 'storeRate']);
    Route::get('/show_service/{id}' , [ApiPublicGeController::class , 'showService']);
});
Route::group(['prefix' => 'public_ge/service_provider' ] , function(){
    Route::get('/' , [ApiPublicGeController::class , 'service_provider_index']);
    Route::post('/add_offer' , [ApiPublicGeController::class , 'service_provider_add_offer']);
});
// Ads
Route::group(['prefix' => 'ads' ] , function(){
    Route::get('/' , [ApiAdsController::class , 'index']);
    Route::post('/store_service' , [ApiAdsController::class , 'storeService']);
    Route::post('/accept_offer' , [ApiAdsController::class , 'accept_offer']);
    Route::post('/add_rate' , [ApiAdsController::class , 'storeRate']);
    Route::get('/show_service/{id}' , [ApiAdsController::class , 'showService']);
});
Route::group(['prefix' => 'ads/service_provider' ] , function(){
    Route::get('/' , [ApiAdsController::class , 'service_provider_index']);
    Route::post('/add_offer' , [ApiAdsController::class , 'service_provider_add_offer']);
});
// Water Filter
Route::group(['prefix' => 'water' ] , function(){
    Route::get('/' , [ApiWaterController::class , 'index']);
    Route::post('/store_service' , [ApiWaterController::class , 'storeService']);
    Route::post('/accept_offer' , [ApiWaterController::class , 'accept_offer']);
    Route::post('/add_rate' , [ApiWaterController::class , 'storeRate']);
    Route::get('/show_service/{id}' , [ApiWaterController::class , 'showService']);
});
Route::group(['prefix' => 'water/service_provider' ] , function(){
    Route::get('/' , [ApiWaterController::class , 'service_provider_index']);
    Route::post('/add_offer' , [ApiWaterController::class , 'service_provider_add_offer']);
});
// Car Water
Route::group(['prefix' => 'car_water' ] , function(){
    Route::get('/' , [ApiCarWaterController::class , 'index']);
    Route::post('/store_service' , [ApiCarWaterController::class , 'storeService']);
    Route::post('/accept_offer' , [ApiCarWaterController::class , 'accept_offer']);
    Route::post('/add_rate' , [ApiCarWaterController::class , 'storeRate']);
    Route::get('/show_service/{id}' , [ApiCarWaterController::class , 'showService']);
});
Route::group(['prefix' => 'car_water/service_provider' ] , function(){
    Route::get('/' , [ApiCarWaterController::class , 'service_provider_index']);
    Route::post('/add_offer' , [ApiCarWaterController::class , 'service_provider_add_offer']);
});
// Big Car
Route::group(['prefix' => 'big_car' ] , function(){
    Route::get('/' , [ApiBigCarController::class , 'index']);
    Route::post('/store_service' , [ApiBigCarController::class , 'storeService']);
    Route::post('/accept_offer' , [ApiBigCarController::class , 'accept_offer']);
    Route::post('/add_rate' , [ApiBigCarController::class , 'storeRate']);
    Route::get('/show_service/{id}' , [ApiBigCarController::class , 'showService']);
});
Route::group(['prefix' => 'big_car/service_provider' ] , function(){
    Route::get('/' , [ApiBigCarController::class , 'service_provider_index']);
    Route::post('/add_offer' , [ApiBigCarController::class , 'service_provider_add_offer']);
});
Route::group(['prefix' => 'air_con' ] , function(){
    Route::get('/' , [ApiAirconController::class , 'index']);
    Route::post('/store_service' , [ApiAirconController::class , 'storeService']);
    Route::post('/accept_offer' , [ApiAirconController::class , 'accept_offer']);
    Route::post('/add_rate' , [ApiAirconController::class , 'storeRate']);
    Route::get('/show_service/{id}' , [ApiAirconController::class , 'showService']);
});
Route::group(['prefix' => 'air_con/service_provider' ] , function(){
    Route::get('/' , [ApiAirconController::class , 'service_provider_index']);
    Route::post('/add_offer' , [ApiAirconController::class , 'service_provider_add_offer']);
});
//heavy equip
Route::group(['prefix' => 'air_con' ] , function(){
    Route::get('/' , [ApiAirconController::class , 'index']);
    Route::post('/store_service' , [ApiAirconController::class , 'storeService']);
    Route::post('/accept_offer' , [ApiAirconController::class , 'accept_offer']);
    Route::post('/add_rate' , [ApiAirconController::class , 'storeRate']);
    Route::get('/show_service/{id}' , [ApiAirconController::class , 'showService']);
});
Route::group(['prefix' => 'air_con/service_provider' ] , function(){
    Route::get('/' , [ApiAirconController::class , 'service_provider_index']);
    Route::post('/add_offer' , [ApiAirconController::class , 'service_provider_add_offer']);
});
Route::group(['prefix' => 'air_con' ] , function(){
    Route::get('/' , [ApiAirconController::class , 'index']);
    Route::post('/store_service' , [ApiAirconController::class , 'storeService']);
    Route::post('/accept_offer' , [ApiAirconController::class , 'accept_offer']);
    Route::post('/add_rate' , [ApiAirconController::class , 'storeRate']);
    Route::get('/show_service/{id}' , [ApiAirconController::class , 'showService']);
});
Route::group(['prefix' => 'air_con/service_provider' ] , function(){
    Route::get('/' , [ApiAirconController::class , 'service_provider_index']);
    Route::post('/add_offer' , [ApiAirconController::class , 'service_provider_add_offer']);
});
    // خدمات عامة
Route::prefix('services')->group(function () {
    Route::get('/', [ApiServiceController::class, 'index']);
    Route::post('/', [ApiServiceController::class, 'store']);
    Route::get('/department/{id}', [ApiServiceController::class, 'show']);
    Route::get('/{id}/edit', [ApiServiceController::class, 'edit']);
    Route::get('/{id}', [ApiServiceController::class, 'show_services']);
    Route::put('/{id}', [ApiServiceController::class, 'update']);
});
    // الطلبات العامة
Route::post('orders', [ApiGeneralOrderController::class, 'store']);
Route::delete('/orders/{id}', [ApiGeneralOrderController::class, 'destroy']);
Route::get('/accept_project/{id}', function ($id) {
    GeneralOrder::find($id)->update(['status' => "completed"]);
    return redirect()->back();
});
});
