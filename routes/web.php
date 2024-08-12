<?php

use App\Http\Controllers\Auth\AuthController;
use App\Livewire\Categories\CategoryPage;
use App\Livewire\Customer\CustomerIndex;
use App\Livewire\Dashboard;
use App\Livewire\Menu\MenuIndex;
use App\Livewire\Reports\ExcelReport;
use App\Livewire\Setting\UserSetting;
use App\Livewire\Transactions\Invoice;
use App\Livewire\Transactions\TransactionIndex;
use App\Livewire\Transactions\TransactionsDetail;
use App\Livewire\Transactions\TransactionsHistory;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/menu', MenuIndex::class)->name('menu');
    Route::get('/categories', CategoryPage::class)->name('categories'); // ini boleh diakses role kasir
    Route::get('/customers', CustomerIndex::class)->name('customers');
    Route::get('/users', UserSetting::class)->name('user.setting');
    Route::get('/history', TransactionsHistory::class)->name('orders.history');
    Route::get('/history/detail/{invoice_number}', TransactionsDetail::class)->name('orders.detail');
    Route::get('/report', ExcelReport::class)->name('report');
});



Route::get('/dashboard/orders', TransactionIndex::class)->name('orders')->middleware(['auth', 'role:kasir']);

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index']);
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


Route::get('/transactions/{id}/invoice', [TransactionIndex::class, 'generateInvoicePDF'])->name('transactions.invoice')->middleware('role:kasir'); // ini boleh diakses role kasir
Route::get('/transactions/{id}/print', [TransactionsDetail::class, 'generateInvoicePDF'])->name('transactions.invoice.detail');
