    <?php

    use App\Http\Controllers\Admin\CategoryItemController;
    use App\Http\Controllers\Admin\DashboardController;
    use App\Http\Controllers\Admin\FoodController;
    use App\Http\Controllers\Admin\FoodItemController;
    use App\Http\Controllers\Admin\OrderController;
    use App\Http\Controllers\Admin\UserController;
    use Illuminate\Support\Facades\Route;

    Route::middleware(['auth', 'roleOr404:admin'])->group(function () {
        Route::resource('dashboard', DashboardController::class);

        Route::resource('foods', FoodController::class);
        Route::patch('/foods/{food}/delete-image', [FoodController::class, 'deleteImage'])->name('foods.delete_image');

        Route::resource('categories', CategoryItemController::class);

        Route::resource('food-items', FoodItemController::class);

        Route::resource('/orders', OrderCOntroller::class);

        Route::resource('/users', UserController::class);
    });
