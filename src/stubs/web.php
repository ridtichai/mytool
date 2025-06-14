/**************** add route ********************/

Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/callback', [AuthController::class, 'login'])->name('callback');