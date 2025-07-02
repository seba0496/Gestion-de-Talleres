<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\TallerWebController;
use App\Http\Controllers\Web\InstructorWebController;
use App\Http\Controllers\Web\DashboardController; // ¡Nuevo controlador!
use App\Models\Usuario;
use App\Livewire\Prueba;
use App\Livewire\Talleres;
use App\Livewire\Cuenta;


Route::resource('/users', UserController::class);
Route::middleware(['auth'])->group(function () {
    // --- Dashboard ---
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rutas para Instructores
    Route::get('/instructores', [InstructorWebController::class, 'index'])->name('instructores.index');
    Route::post('/instructores', [InstructorWebController::class, 'store'])->name('instructores.store');
    Route::delete('/instructores/{id}', [InstructorWebController::class, 'destroy'])->name('instructores.destroy');

    // Rutas protegidas para cuenta y talleres
    Route::get('/cuenta', Cuenta::class)->name('cuenta');
    Route::get('/taller', Talleres::class)->name('talleres');
    Route::get('/talleres', [TallerWebController::class, 'index'])->name('talleres.index');
    Route::get('/talleres/crear', [TallerWebController::class, 'create'])->name('talleres.create');
    Route::post('/talleres', [TallerWebController::class, 'store'])->name('talleres.store');
});

// Rutas públicas (solo login, registro y logout)
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');