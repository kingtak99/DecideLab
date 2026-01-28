<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanSimulationController;
use App\Http\Controllers\JobChangeController;
use App\Http\Controllers\LifeShockController;
use App\Models\User;

// Home routes with language support
Route::get('/', function () {
    $locale = session('locale', config('app.locale', 'ar'));
    return redirect("/{$locale}");
})->name('home');

Route::prefix('{locale}')->where(['locale' => 'en|ar'])->group(function () {
    Route::get('/', function ($locale) {
        App::setLocale($locale);
        return view('home', compact('locale'));
    })->name('home.locale');

    // Loan Simulation Routes
    Route::get('/loan/simulation', [LoanSimulationController::class, 'showLoanSimulation'])->name('loan.simulation');
    Route::post('/loan/simulation/calculate', [LoanSimulationController::class, 'calculateLoan'])->name('loan.simulation.calculate');

    // Job Change Routes
    Route::get('/job-change/simulation', [JobChangeController::class, 'showJobChangeSimulation'])->name('job.change.simulation');
    Route::post('/job-change/calculate', [JobChangeController::class, 'calculateJobChange'])->name('job.change.calculate');

    // Life Shock Routes
    Route::get('/life-shock/simulation', [LifeShockController::class, 'showLifeShockSimulation'])->name('life.shock.simulation');
    Route::post('/life-shock/calculate', [LifeShockController::class, 'calculateLifeShock'])->name('life.shock.calculate');

    Route::get('/loan/housing', [LoanController::class, 'showHousingForm'])->name('loan.housing');
    Route::post('/loan/housing/calculate', [LoanController::class, 'calculateHousingLoan'])->name('loan.housing.calculate');
});

// Language switching route
Route::get('/lang/{locale}', [LanguageController::class, 'switchLanguage'])->name('language.switch');

// Redirect localized auth routes to root auth routes
Route::get('/{locale}/login', function ($locale) {
    return redirect('/login');
})->where('locale', 'en|ar')->name('login.redirect');

Route::get('/{locale}/register', function ($locale) {
    return redirect('/register');
})->where('locale', 'en|ar')->name('register.redirect');

Route::get('/{locale}/admin/dashboard', function ($locale) {
    return redirect('/admin/dashboard');
})->where('locale', 'en|ar')->name('admin.dashboard.redirect');

// Location routes
Route::get('/location/detect', [LocationController::class, 'detectLocation'])->name('location.detect');
Route::get('/location/current', [LocationController::class, 'getCurrentLocation'])->name('location.current');
Route::get('/location/countries', [LocationController::class, 'getCountries'])->name('location.countries');
Route::post('/location/change/{countryId}', [LocationController::class, 'changeLocation'])->name('location.change');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Check email availability
Route::post('/check-email', function (Request $request) {
    $exists = User::where('email', $request->email)->exists();
    return response()->json([
        'exists' => $exists
    ]);
})->name('check.email');

// Admin Routes
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Footer Pages with Language Prefixes
Route::prefix('{locale}')->where(['locale' => 'en|ar'])->group(function () {
    Route::get('/about', function ($locale) {
        App::setLocale($locale);
        return view('footer.about');
    })->name('footer.about.locale');

    Route::get('/how-it-works', function ($locale) {
        App::setLocale($locale);
        return view('footer.how-it-works');
    })->name('footer.how-it-works.locale');

    // Financial Articles
    Route::get('/financial-planning', function ($locale) {
        App::setLocale($locale);
        return view('articles.financial-planning');
    })->name('article.financial-planning');

    Route::get('/understanding-interest-rates', function ($locale) {
        App::setLocale($locale);
        return view('articles.understanding-interest-rates');
    })->name('article.understanding-interest-rates');

    Route::get('/loan-types-guide', function ($locale) {
        App::setLocale($locale);
        return view('articles.loan-types-guide');
    })->name('article.loan-types-guide');

    Route::get('/job-change-finance', function ($locale) {
        App::setLocale($locale);
        return view('articles.job-change-finance');
    })->name('article.job-change-finance');

    Route::get('/housing-loan-tips', function ($locale) {
        App::setLocale($locale);
        return view('articles.housing-loan-tips');
    })->name('article.housing-loan-tips');

    Route::get('/life-insurance-guide', function ($locale) {
        App::setLocale($locale);
        return view('articles.life-insurance-guide');
    })->name('article.life-insurance-guide');

    Route::get('/privacy-policy', function ($locale) {
        App::setLocale($locale);
        return view('footer.privacy-policy');
    })->name('footer.privacy-policy.locale');

    Route::get('/terms-of-service', function ($locale) {
        App::setLocale($locale);
        return view('footer.terms-of-service');
    })->name('footer.terms-of-service.locale');

    Route::get('/contact-us', function ($locale) {
        App::setLocale($locale);
        return view('footer.contact-us');
    })->name('footer.contact-us.locale');

    Route::get('/countries-data-sources', function ($locale) {
        App::setLocale($locale);
        return view('footer.countries-data-sources');
    })->name('footer.countries-data-sources.locale');
});

// Default Footer Pages (redirect based on language)
Route::get('/about', function () {
    $locale = session('locale', 'en');
    return redirect("/{$locale}/about");
})->name('footer.about');

Route::get('/how-it-works', function () {
    $locale = session('locale', 'en');
    return redirect("/{$locale}/how-it-works");
})->name('footer.how-it-works');

Route::get('/privacy-policy', function () {
    $locale = session('locale', 'en');
    return redirect("/{$locale}/privacy-policy");
})->name('footer.privacy-policy');

Route::get('/terms-of-service', function () {
    $locale = session('locale', 'en');
    return redirect("/{$locale}/terms-of-service");
})->name('footer.terms-of-service');

Route::get('/contact-us', function () {
    $locale = session('locale', 'en');
    return redirect("/{$locale}/contact-us");
})->name('footer.contact-us');

Route::get('/countries-data-sources', function () {
    $locale = session('locale', 'en');
    return redirect("/{$locale}/countries-data-sources");
})->name('footer.countries-data-sources');

// 📊 Analytics Routes - Admin Only
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/analytics/dashboard', [\App\Http\Controllers\AnalyticsController::class, 'dashboard'])
        ->name('analytics.dashboard');
    Route::get('/analytics/bots', [\App\Http\Controllers\AnalyticsController::class, 'detectedBots'])
        ->name('analytics.detected-bots');
});

// 📊 API Routes
Route::get('/api/stats', [\App\Http\Controllers\AnalyticsController::class, 'apiStats'])
    ->name('api.stats');

require __DIR__ . '/auth.php';
