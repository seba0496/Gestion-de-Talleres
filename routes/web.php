<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\TallerWebController;
use App\Http\Controllers\Web\InstructorWebController;
use App\Http\Controllers\Web\DashboardController; // ¡Nuevo controlador!
use App\Models\Usuario;
use App\Livewire\Prueba;
use App\Livewire\Cuenta;
use App\Livewire\Talleres;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/users', UserController::class);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->group(function () {
    // --- Dashboard ---
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rutas para Talleres
    Route::get('/talleres', [TallerWebController::class, 'index'])->name('talleres.index');
    Route::get('/talleres/create', [TallerWebController::class, 'create'])->name('talleres.create');
    Route::get('/talleres/{taller}/edit', [TallerWebController::class, 'edit'])->name('talleres.edit');
    Route::get('/talleres/{taller}', [TallerWebController::class, 'show'])->name('talleres.show');

    // Rutas para Instructores
    Route::get('/instructores', [InstructorWebController::class, 'index'])->name('instructores.index');
    Route::get('/instructores/create', [InstructorWebController::class, 'create'])->name('instructores.create');
    Route::get('/instructores/{instructor}/edit', [InstructorWebController::class, 'edit'])->name('instructores.edit');
    Route::get('/instructores/{instructor}', [InstructorWebController::class, 'show'])->name('instructores.show');


});
    // ... (otras rutas protegidas) ...
Route::get('/test', function () {
    return view('livewire.prueba');
});
Route::get('/cuenta', Cuenta::class)->name('cuenta');
Route::get('/taller', Talleres::class)->name('talleres');
