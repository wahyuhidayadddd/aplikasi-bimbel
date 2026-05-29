    <?php

    use App\Http\Controllers\ProfileController;
    use Illuminate\Support\Facades\Route;

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

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

Route::middleware(['auth'])->group(function () {

    // OWNER BRANCHES (FIX ERROR kamu)
    Route::get('/owner/branches', function () {
        return view('owner.branches.index');
    })->name('owner.branches.index');

});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/students', function () {
        return view('admin.students.index');
    })->name('students.index');

    Route::get('/teachers', function () {
        return view('admin.teachers.index');
    })->name('teachers.index');

    Route::get('/schedules', function () {
        return view('admin.schedules.index');
    })->name('schedules.index');

    Route::get('/payments', function () {
        return view('admin.payments.index');
    })->name('payments.index');

    Route::get('/tryouts', function () {
        return view('admin.tryouts.index');
    })->name('tryouts.index');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/students', function () {
        return view('admin.students.index');
    })->name('students.index');

    Route::get('/teachers', function () {
        return view('admin.teachers.index');
    })->name('teachers.index');

    Route::get('/schedules', function () {
        return view('admin.schedules.index');
    })->name('schedules.index');

    Route::get('/payments', function () {
        return view('admin.payments.index');
    })->name('payments.index');

    Route::get('/tryouts', function () {
        return view('admin.tryouts.index');
    })->name('tryouts.index');
});
use App\Http\Controllers\Owner\BranchController;

Route::middleware(['auth'])->prefix('owner')->name('owner.')->group(function () {

    Route::get('/branches', [BranchController::class, 'index'])->name('branches.index');
    Route::post('/branches', [BranchController::class, 'store'])->name('branches.store');
    Route::put('/branches/{id}', [BranchController::class, 'update'])->name('branches.update');
    Route::delete('/branches/{id}', [BranchController::class, 'destroy'])->name('branches.destroy');

});
    require __DIR__.'/auth.php';
