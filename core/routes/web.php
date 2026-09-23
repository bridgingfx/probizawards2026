<?php

use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaPartnerController;
use App\Http\Controllers\ProBizPageController;

use App\Http\Controllers\Dashboard\NominationController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SiteMapController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/
Route::get('/', [ProBizPageController::class, 'home'])->name('probiz');
Route::get('/about', [ProBizPageController::class, 'about'])->name('probiz.about');
Route::get('/award-categories', [ProBizPageController::class, 'categories'])->name('probiz.categories');
Route::get('/award-categories/{slug}', [ProBizPageController::class, 'pillar'])->name('probiz.pillar');
Route::get('/awards/{slug}', [ProBizPageController::class, 'award'])->name('probiz.award');
Route::get('/restaurant-awards', [ProBizPageController::class, 'restaurantAwards'])->name('probiz.restaurant-awards');
Route::get('/how-it-works', [ProBizPageController::class, 'howItWorks'])->name('probiz.how-it-works');
Route::get('/nominate', function () {
    return view('frontEnd.nomination', [
        'event' => config('probiz.event'),
        'images' => config('probiz.images'),
        'pillars' => config('probiz.pillars'),
        'restaurantAwards' => config('probiz.restaurant_awards'),
    ]);
})->name('nominate');
Route::get('/nomination', fn() => redirect('/nominate', 301))->name('nomination');
Route::get('/finalist-package', [ProBizPageController::class, 'finalistPackage'])->name('probiz.finalist-package');
Route::get('/finalists', [ProBizPageController::class, 'finalists'])->name('probiz.finalists');
Route::get('/vote', [ProBizPageController::class, 'vote'])->name('probiz.vote');
Route::get('/winners', [ProBizPageController::class, 'winners'])->name('probiz.winners');
Route::get('/judging-and-voting', [ProBizPageController::class, 'judging'])->name('probiz.judging');
Route::get('/judges', [ProBizPageController::class, 'judges'])->name('probiz.judges');
Route::get('/sponsors', [ProBizPageController::class, 'sponsors'])->name('probiz.sponsors');
Route::get('/media-partners', [ProBizPageController::class, 'mediaPartners'])->name('probiz.media-partners');
Route::get('/gallery', [ProBizPageController::class, 'gallery'])->name('Gallery');
Route::get('/gala-night', [ProBizPageController::class, 'gala'])->name('probiz.gala');
Route::get('/contact', [ProBizPageController::class, 'contact'])->name('probiz.contact');
Route::get('/faq', [ProBizPageController::class, 'faq'])->name('probiz.faq');
Route::get('/terms-and-conditions', [ProBizPageController::class, 'terms'])->name('probiz.terms');
Route::get('/privacy-policy', [ProBizPageController::class, 'privacy'])->name('probiz.privacy');

Route::get('/financial', fn() => redirect(url('/award-categories'), 301))->name('financial');
Route::get('/Categories', fn() => redirect(url('/award-categories'), 301))->name('CategoriesFx');
Route::get('/categoriesaward', fn() => redirect(url('/award-categories'), 301))->name('categoriesAwards');
Route::get('/educationalAcademy', fn() => redirect(url('/award-categories'), 301))->name('educationalAcademy');
Route::get('/fintech', fn() => redirect(url('/award-categories'), 301))->name('fintech');
Route::get('/influencer', fn() => redirect(url('/award-categories'), 301))->name('Influencer');
Route::get('/winner', fn() => redirect(url('/winners'), 301))->name('winner');
Route::get('/event', fn() => redirect(url('/sponsors'), 301))->name('Event');
Route::get('/media', fn() => redirect(url('/media-partners'), 301))->name('media');
Route::get('/award', fn() => abort(410))->name('award');
Route::get('/previewsevent', fn() => abort(410))->name('previewsevent');



// Language Route
Route::post('/lang', [LanguageController::class, 'index'])->middleware('LanguageSwitcher')->name('lang');
// For Language direct URL link
Route::get('/lang/{lang}', [LanguageController::class, 'change'])->middleware('LanguageSwitcher')->name('langChange');
Route::get('/locale/{lang}', [LanguageController::class, 'locale'])->middleware('LanguageSwitcher')->name('localeChange');
// .. End of Language Route

// Not Found
Route::get('/{lang?}/404', [HomeController::class, 'page_404'])->name('NotFound');


// RSS Feed Routes
if (config('smartend.rss_status')) {
    Route::feeds();
}

// Social Auth
Route::get('/oauth/{driver}', [SocialAuthController::class, 'redirectToProvider'])->name('social.oauth');
Route::get('/oauth/{driver}/callback', [SocialAuthController::class, 'handleProviderCallback'])->name('social.callback');

Route::Group(['prefix' => config('smartend.backend_path')], function () {
    Auth::routes();
});

// Add your custom routes here


// Start of Frontend Routes
// - site map
Route::get('/sitemap.xml', [SiteMapController::class, 'siteMap'])->name('siteMap');
Route::get('/{lang}/sitemap', [SiteMapController::class, 'siteMap'])->name('siteMapByLang');

// - Public form submit
Route::post('/form-submit', [HomeController::class, 'form_submit'])->name('formSubmit');

// - Newsletter form submit
Route::post('/subscribe', [HomeController::class, 'subscribe_submit'])->name('subscribeSubmit');

// - Comment form submit
Route::post('/comment', [HomeController::class, 'comment_submit'])->name('commentSubmit');

// - Order form submit
Route::post('/order', [HomeController::class, 'order_submit'])->name('orderSubmit');


// - Contact page form submit
Route::post('/contact-submit', [HomeController::class, 'contact_submit'])->name('contactPageSubmit');
Route::post('/', [HomeController::class, 'contact_submited'])->name('contactPageSubmited');

// - Nominations
Route::post('nominations/store', [NominationController::class, 'store'])->name('nominations.store');
Route::post('media-partners/store', [MediaPartnerController::class, 'store'])->name('mediaPartners.store');




// - Tags
Route::get('/tag/{tag_slug?}', [HomeController::class, 'tag'])->name('tag');

// - All Other slugs
Route::get('/{part1?}/{part2?}/{part3?}/{part4?}/{part5?}/{part6?}', [HomeController::class, 'seo'])->name("frontendRoute");
// End of Frontend Route
