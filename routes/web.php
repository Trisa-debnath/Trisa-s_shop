<?php
use App\Http\Controllers\AdminMainController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductDiscountController;
use App\Http\Controllers\Seller\SellerMainController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Seller\SellerStoreController;
use App\Http\Controllers\Customer\CustomerMainController;
use App\Http\Controllers\MasterCategoryController;
use App\Http\Controllers\MasterSubcategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ReviewController;



//use App\Livewire\HomePageComponent;
use Illuminate\Support\Facades\Route;


Route::controller(HomePageController::class)->group(function () {
    Route::get('/','index')->name('home');
   Route::get('/category/{category_name}','showCategoryProducts')->name('productby.category');
  Route::get('/viewdetails/{id}','viewdetails')->name('products.viewdetails');
   Route::get('/order/proceed','orderproceed')->name('order.proceed');
    Route::post('/order/store','orderstore')->name('order.store');
  
Route::get('/order/success', function() {return view('home.ordersuccess');
})->name('order.success');
Route::get('/order/cancel', function() {
    return view('home.ordercancel'); 
})->name('order.cancel');

  
Route::get('/stripe/{total}','stripe')->name('order.stripe');
Route::post('/stripe/post','stripePost')->name('stripe.post');
});


//admin 

Route::middleware(['auth', 'verified','rolemanager:admin'])->group(function () {
    Route::prefix('admin')->group(function () {

Route::controller(AdminMainController::class)->group(function () {
    Route::get('/dashboard','index')->name('admin');
    Route::get('/seeting','seeting')->name('admin.seeting');
     Route::post('/setting/update','homepage_settingupdate')->name('home.setting.update');
    Route::get('/manage/users','manage_user')->name('admin.manage.user');
    Route::get('/manage/stores','manage_stores')->name('admin.manage.store');
    Route::get('/cart/history','cart_history')->name('admin.cart.history');
    //order history
    Route::get('/order/history','order_history')->name('admin.order.history');
 
  Route::get('/order/edit/{id}', 'order_edit')->name('admin.order.edit');
  Route::put('/order/update/{id}', 'order_update')->name('admin.order.update');
   Route::delete('/order/delete/{id}', 'order_destroy')->name('admin.order.destroy');
  
Route::get('/order/Print_pdf/{id}', 'Print_pdf')
     ->name('admin.order.Printpdf');
     //admin order search
Route::get('/order/search','order_search')->name('admin.order.search');
 
});


Route::controller(CategoryController::class)->group(function () {
    Route::get('/category/create','index')->name('category.create');
    Route::get('/category/manage','manage')->name('category.manage');
});

Route::controller(SubcategoryController::class)->group(function () {
    Route::get('/subcategory/create','index')->name('subcategory.create');
    Route::get('/subcategory/manage','manage')->name('subcategory.manage');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/product/create','create')->name('admin.product.create');
    Route::post('/product/store','store')->name('admin.product.store');
    Route::get('/product/manage','index')->name('product.manage');
    Route::get('/product/edit/{id}','edit')->name('admin.product.edit');
    Route::put('/product/update/{id}','update')->name('admin.product.update');
    Route::get('/product/review/manage','review_manage')->name('product.manageproductreview');
     Route::delete('/product/delete/{id}','destroy')->name('admin.product.destroy');
});

Route::controller(ProductAttributeController::class)->group(function () {
    Route::get('/productattribute/create','index')->name('productattribute.create');
    Route::get('/productattribute/manage','manage')->name('productattribute.manage');

 Route::post('/store/defaultattribute','storeattribute')->name('store.productattribute');
    Route::get('/edit/defaultattribute/{id}','editattribute')->name('edit.productattribute');
    Route::get('/delete/defaultattribute/{id}','deleteattribute')->name('delete.productattribute'); 
    Route::post('/update/defaultattribute/{id}','upattribute')->name('update.productattribute');


});

Route::controller(ProductDiscountController::class)->group(function () {
    //create
    Route::get('/discount/create','index')->name('discount.create');
    // store discount
    Route::post('/discount/store','store')->name('discount.store');
    // manage page
    Route::get('/discount/manage','manage')->name('discount.manage');

    Route::get('/edit/discount/{id}','edit')->name('discount.edit'); 
    Route::post('/update/discount/{id}','update')->name('discount.update');
    Route::get('/remove/discount/{id}','remove')->name('discount.remove');




});

Route::controller(MasterCategoryController::class)->group(function () {
    Route::post('/store/categore','storecategore')->name('store.categore');
    Route::get('/edit/categore/{id}','editcategore')->name('edit.categore');
    Route::get('/delete/categore/{id}','deletecategore')->name('delete.categore'); 
    Route::post('/update/categore/{id}','upcategore')->name('update.categore');
});

Route::controller(MasterSubcategoryController::class)->group(function () {
    Route::post('/store/subcategore','storesubcategore')->name('store.subcategore');
    Route::get('/edit/subcategore/{id}','editsubcategore')->name('edit.subcategore');
    Route::get('/delete/subcategore/{id}','deletesubcategore')->name('delete.subcategore'); 
    Route::post('/update/subcategore/{id}','upsubcategore')->name('update.subcategore');
   
});


}); 
});
//vendor
Route::middleware(['auth', 'verified','rolemanager:vendor'])->group(function () {
    Route::prefix('vendor')->group(function () {

Route::controller(SellerMainController::class)->group(function () {
    Route::get('/dashboard','index')->name('vendor');  
     Route::get('/orderhistory','orderhistory')->name('seller.orderhistory');
     //seller order search
     Route::get('/order/search','order_search')->name('seller.order.search');

});
Route::controller(SellerProductController::class)->group(function () {
    Route::get('/product/create','index')->name('vendor.product');  
      Route::get('/product/manage','manage')->name('vendor.product.manage');
       Route::post('/store/seeler/product','store')->name('vendor.store.procuct');  
});
Route::controller(SellerStoreController::class)->group(function () {
    Route::get('/store/create','index')->name('vendor.store');  
    Route::get('/store/manage','manage')->name('vendor.store.manage'); 
    Route::post('/store/published','store')->name('vendor.store.create');
    Route::get('/edit/store/{id}','editstore')->name('edit.store');
  
    Route::delete('/delete/store/{id}', 'deletestore')->name('delete.store'); 
    Route::post('/update/store/{id}','upstore')->name('update.store');
        
});
}); 
});

//customer
Route::middleware(['auth', 'verified','rolemanager:customer'])->group(function () {
    Route::prefix('user')->group(function () {
Route::controller(CustomerMainController::class)->group(function () {
    Route::get('/dashboard','index')->name('dashboard');  
     Route::get('/order/history','history')->name('customer.history');
      Route::get('/setting/payment','payment')->name('customer.payment');    
 Route::get('/affiliate','affiliate')->name('customer.affiliate');
});


}); 
});







Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(ReviewController::class)->group(function () {
    Route::post('/product/review/store','store')
     ->name('review.store');
     
     Route::get('/review/approve/{id}','approve')
     ->name('admin.review.approve');

Route::get('/review/reject/{id}','reject')
     ->name('admin.review.reject');

});



require __DIR__.'/auth.php';
