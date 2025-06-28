    <?php

    use App\Http\Controllers\Admin\CategoryController;
    use App\Http\Controllers\Admin\FoodController;
    use App\Http\Controllers\Admin\FoodItemController;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;

    Route::middleware(['auth', 'roleOr404:admin'])->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.index');
        })->name('admin.dashboard');

        Route::resource('foods', FoodController::class);

        Route::resource('categories', CategoryController::class);

        Route::resource('food-items', FoodItemController::class);

        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    });
