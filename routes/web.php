<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CapabilitiesController;
use App\Http\Controllers\CaseStudyController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\InsightsController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AttorneysController;
use App\Http\Controllers\AttorneyDetailController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\HomePageSettingController;
use App\Http\Controllers\Admin\ContactSettingController;
use App\Http\Controllers\Admin\AttorneyController;
use App\Http\Controllers\Admin\CapabilityController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\FooterSettingController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Admin\StaticPageController as AdminStaticPageController;
use App\Http\Controllers\Admin\SeoSettingController;
use App\Http\Controllers\Admin\AttorneyTitleController;
use App\Http\Controllers\Admin\AttorneyTaxonomyController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/attorneys', [AttorneysController::class, 'index'])->name('attorneys');
Route::get('/attorneys/{attorney:slug}/contact.vcf', [AttorneyDetailController::class, 'vcard'])->name('attorneys.vcard');
Route::get('/attorneys/{attorney:slug}/profile.pdf', [AttorneyDetailController::class, 'pdf'])->name('attorneys.pdf');
Route::get('/attorneys/{attorney:slug}', [AttorneyDetailController::class, 'show'])->name('attorneys.detail');
Route::get('/capabilities', [CapabilitiesController::class, 'index'])->name('capabilities');
Route::get('/capabilities/{capability}', [CapabilitiesController::class, 'show'])->name('capabilities.show');
Route::view('/commercial-transactions', 'commercial-transactions');
Route::get('/about', [AboutController::class, 'index']);
Route::get('/about-us', [AboutController::class, 'index']);
Route::get('/case-study', [CaseStudyController::class, 'index']);
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{blog:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/insights', [InsightsController::class, 'index']);
Route::get('/detail', [DetailController::class, 'index']);
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact-us', [ContactController::class, 'submit'])->name('contact.submit');
Route::post('/quick-contact', [ContactController::class, 'quickSubmit'])->name('contact.quick');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/pages/{page:slug}', [StaticPageController::class, 'show'])->name('static-pages.show');
Route::redirect('/attorney-detail', '/attorneys');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.attempt');

    Route::middleware('admin')->group(function () {
        Route::get('/', function () {
            $published = fn ($type) => \App\Models\BlogPost::where('content_type', $type)
                ->where('status', 'published')
                ->where(function ($query) {
                    $query->whereNull('published_at')->orWhereDate('published_at', '<=', now());
                })->count();

            return view('admin.dashboard', [
                'attorneyCount' => \App\Models\Attorney::count(),
                'caseStudyCount' => $published('case_study'),
                'blogCount' => $published('blog'),
                'insightCount' => $published('insight'),
            ]);
        })->name('dashboard');
        Route::get('/home-page-settings', [HomePageSettingController::class, 'edit'])->name('home-settings.edit');
        Route::put('/home-page-settings', [HomePageSettingController::class, 'update'])->name('home-settings.update');
        Route::post('/home-page-settings/hero-slides', [HomePageSettingController::class, 'createSlide'])->name('home-settings.slides.create');
        Route::delete('/home-page-settings/hero-slides/{heroSlide}', [HomePageSettingController::class, 'destroySlide'])->name('home-settings.slides.destroy');
        Route::get('/contact-settings', [ContactSettingController::class, 'edit'])->name('contact-settings.edit');
        Route::put('/contact-settings', [ContactSettingController::class, 'update'])->name('contact-settings.update');
        Route::get('/footer-settings', [FooterSettingController::class, 'edit'])->name('footer-settings.edit');
        Route::put('/footer-settings', [FooterSettingController::class, 'update'])->name('footer-settings.update');
        Route::get('/seo-settings', [SeoSettingController::class, 'edit'])->name('seo-settings.edit');
        Route::put('/seo-settings', [SeoSettingController::class, 'update'])->name('seo-settings.update');
        Route::get('/static-pages/create', [AdminStaticPageController::class, 'create'])->name('static-pages.create');
        Route::post('/static-pages', [AdminStaticPageController::class, 'store'])->name('static-pages.store');
        Route::get('/static-pages/{page}/edit', [AdminStaticPageController::class, 'edit'])->name('static-pages.edit');
        Route::put('/static-pages/{page}', [AdminStaticPageController::class, 'update'])->name('static-pages.update');
        Route::get('/attorneys/create', [AttorneyController::class, 'create'])->name('attorneys.create');
        Route::get('/attorney-titles', [AttorneyTitleController::class, 'index'])->name('attorney-titles.index');
        Route::post('/attorney-titles', [AttorneyTitleController::class, 'store'])->name('attorney-titles.store');
        Route::delete('/attorney-titles/{title}', [AttorneyTitleController::class, 'destroy'])->name('attorney-titles.destroy');
        Route::get('/attorney-options', [AttorneyTaxonomyController::class, 'index'])->name('attorney-options.index');
        Route::post('/attorney-options', [AttorneyTaxonomyController::class, 'store'])->name('attorney-options.store');
        Route::put('/attorney-options/{taxonomy}', [AttorneyTaxonomyController::class, 'update'])->name('attorney-options.update');
        Route::delete('/attorney-options/{taxonomy}', [AttorneyTaxonomyController::class, 'destroy'])->name('attorney-options.destroy');
        Route::get('/attorney-page', [AttorneyController::class, 'details'])->name('attorneys.details');
        Route::post('/attorneys', [AttorneyController::class, 'store'])->name('attorneys.store');
        Route::get('/attorneys/{attorney}/edit', [AttorneyController::class, 'edit'])->name('attorneys.edit');
        Route::put('/attorneys/{attorney}', [AttorneyController::class, 'update'])->name('attorneys.update');
        Route::delete('/attorneys/{attorney}', [AttorneyController::class, 'destroy'])->name('attorneys.destroy');
        Route::get('/capabilities', [CapabilityController::class, 'index'])->name('capabilities.index');
        Route::get('/capability-pages', [CapabilityController::class, 'pages'])->name('capabilities.pages');
        Route::post('/capabilities', [CapabilityController::class, 'store'])->name('capabilities.store');
        Route::get('/capabilities/{capability}/edit', [CapabilityController::class, 'edit'])->name('capabilities.edit');
        Route::get('/capabilities/{capability}/card-edit', [CapabilityController::class, 'cardEdit'])->name('capabilities.card-edit');
        Route::put('/capabilities/{capability}/card-edit', [CapabilityController::class, 'cardUpdate'])->name('capabilities.card-update');
        Route::put('/capabilities/{capability}', [CapabilityController::class, 'update'])->name('capabilities.update');
        Route::delete('/capabilities/{capability}', [CapabilityController::class, 'destroy'])->name('capabilities.destroy');
        Route::get('/blog', [AdminBlogController::class, 'index'])->name('blog.index');
        Route::get('/blog/create', [AdminBlogController::class, 'create'])->name('blog.create');
        Route::post('/blog', [AdminBlogController::class, 'store'])->name('blog.store');
        Route::get('/blog/{blog}/edit', [AdminBlogController::class, 'edit'])->name('blog.edit');
        Route::put('/blog/{blog}', [AdminBlogController::class, 'update'])->name('blog.update');
        Route::delete('/blog/{blog}', [AdminBlogController::class, 'destroy'])->name('blog.destroy');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});
