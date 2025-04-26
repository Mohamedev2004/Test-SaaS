<?php

use App\Http\Controllers\AdminBrandController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminInfluencerController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ChangeDefaultPasswordController;
use App\Http\Controllers\CollaborationController;
use App\Http\Controllers\ContactBrandController;
use App\Http\Controllers\ContactInfluencerController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\InfluencerController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PackController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CountdownController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;






Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        // this route is responsible for changing the user default password if the account is created by the admin
        Route::middleware(['auth'])->group(function () {
            Route::get('/change-password', [ChangeDefaultPasswordController::class, 'show'])->name("change_default_password.show");
            Route::post('/change-password', [ChangeDefaultPasswordController::class, 'update'])->name('change_default_password.update');
        });

        // this route is responsible for email verification for brands and influencers
        Route::middleware(['auth'])->group(function () {
            Route::get('/verify-email', [EmailVerificationController::class, 'show'])->name("emailverification.show");
            Route::get('/verify-email/{id}', [EmailVerificationController::class, 'verify'])->name('emailverification.verify')->middleware('signed');
            Route::post('/email/resend', [EmailVerificationController::class, 'resend'])->name('emailverification.resend');
        });

        // countdown for everyone
        Route::get('/countdown', [CountdownController::class, 'show'])->name('countdown');

        Route::get('/terms-and-conditions', [GuestController::class, 'terms'])->name('terms-conditions');

        // newsletter
        Route::post('/newsletter',[NewsletterController::class,'store'])->name('newsletter.subscribe');

        Route::get('/Press', [GuestController::class, 'press'])->name('relation');



        // Guest routes
        Route::middleware('countdown')->group(function () {
            Route::middleware('guest')->group(function () {
                Route::get('/', [GuestController::class, 'index'])->name('welcome');
                Route::get('/show/brand/{id}', [GuestController::class, 'show_brand'])->name('show_brand_guest');
                Route::get('/show/influencer/{id}', [GuestController::class, 'show_influencer'])->name('show_influencer_guest');
                // Route::view('/Brand-Profil', 'pages.brand-profile')->name('brandprofile');
                Route::get('influencers', [InfluencerController::class, 'latests_influencers'])->name('latests_influencers');
                // Route::view('/influencers', 'pages.influencer')->name('influencers');
                Route::get('/pack', [GuestController::class, 'pack'])->name('pack');
                Route::get('/brands', [BrandController::class, 'latests_brands'])->name('latests_brands');
                Route::get('/sponsoring', [GuestController::class, 'sponsoring'])->name('sponsoring');
                Route::post('/sponsoring', [GuestController::class, 'sponsoring_store'])->name('sponsoring_store');
                // Route::view('/sponsoring', 'forms.sponsor')->name('sponsoring');
                // Route::get('/All-Influencers', [InfluencerController::class, 'filter'])->name('allinfluencers');
                Route::get('/All-Brands', [BrandController::class, 'filter'])->name('allbrands');
                Route::get('/Demande-Demo', [GuestController::class, 'demoRequest'])->name('demo.request');
                Route::post('/meetings', [GuestController::class, 'meeting_store'])->name('meetings.store');

                
            });
        });

        // Admin routes
        Route::prefix('/admin')->middleware(['auth', 'admin'])->group(function () {


            Route::post('/brandpack/renew/{brand}', [AdminBrandController::class, 'renewPack'])->name('brandpack.renew');
            Route::get('/brandpack', [AdminBrandController::class, 'packShow'])->name('brandpack.show');


            Route::get('/Dashboard', [AdminController::class, 'index'])->name('admindashboard');
            // add new users
            Route::get('/dashboard/users/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/dashboard/users', [UserController::class, 'store'])->name('users.store');

            // get new users
            Route::get('/New/Influencers', [AdminInfluencerController::class, 'new'])->name('newinfluencerregistration');
            Route::get('/New/Brands', [AdminBrandController::class, 'new'])->name('newbrandregistration');

            // countdown
            Route::get('/dashboard/countdown', [CountdownController::class, 'adminView'])->name('countdownView');
            Route::post('/dashboard/countdown', [CountdownController::class, 'extendTime'])->name('admin.countdown.extend');
            Route::post('/dashboard/countdown/update-original-time', [CountdownController::class, 'updateOriginalTime'])->name('countdown.updateOriginalTime');

            Route::get('/Dashboard/Influencer-List', [AdminInfluencerController::class, 'index'])->name('influencerlist');
            Route::delete('/Dashboard/Influencer-List/{id}', [AdminInfluencerController::class, 'destroy'])->name('influencers.destroy');
            Route::get('/Dashboard/Influencer-Status/{id}', [AdminInfluencerController::class, 'showStatusForm'])->name('influencerstatus');
            Route::put('/Dashboard/Influencer-Status/{id}', [AdminInfluencerController::class, 'updateStatus'])->name('influencerstatus.update');




            Route::get('/Dashboard/Brand-List', [AdminBrandController::class, 'index'])->name('brandlist');
            Route::delete('/admin/brands/{id}', [AdminBrandController::class, 'destroy'])->name('brands.destroy');
            Route::get('/Dashboard/Brand-Status/{id}', [AdminBrandController::class, 'showStatusForm'])->name('brandstatus');
            Route::put('/Dashboard/Brand-Status/{id}', [AdminBrandController::class, 'updateStatus'])->name('brandstatus.update');


            Route::get('/Admin/Dashboard/Collaboration-List', [CollaborationController::class, 'index'])->name('collaborationlist');
            Route::delete('/admin/collaborations/{id}', [CollaborationController::class, 'destroy'])->name('collaborationdelete');
            Route::get('/admin/collaboration/add', [CollaborationController::class, 'add'])->name('collaborationadd');
            Route::post('/admin/collaboration/store', [CollaborationController::class, 'store'])->name('collaborationstore');
            Route::get('/Dashboard/Collaboration-Edit/{id}', [CollaborationController::class, 'showCollaborationEditForm'])->name('collaborationedit');
            Route::put('/Dashboard/Collaboration-Edit/{id}', [CollaborationController::class, 'update'])->name('collaborationupdate');

            Route::get('/Dashboard/Sponsors', [SponsorController::class, 'index'])->name('sponsormessage');
            Route::get('/Dashboard/Meetings', [MeetingController::class, 'index'])->name('meetings');

            Route::get('/Dashboard/Brand-messages', [ContactBrandController::class, 'index'])->name('brandmessage');
            Route::get('/Dashboard/Influencer-messages', [ContactInfluencerController::class, 'index'])->name('influencermessage');

            Route::get('/Dashboard/Sector-List', [SectorController::class, 'index'])->name('sectorlist');
            Route::delete('/admin/sectors/{id}', [SectorController::class, 'destroy'])->name('sectordestroy');
            Route::get('/sector/add', [SectorController::class, 'add'])->name('sectoradd');
            Route::post('/sector/store', [SectorController::class, 'store'])->name('sectorstore');
            Route::get('/Dashboard/sector-Edit/{id}', [SectorController::class, 'showSectorEditForm'])->name('sectoredit');
            Route::put('/Dashboard/sector-Edit/{id}', [SectorController::class, 'update'])->name('sectorupdate');

            Route::get('/Dashboard/Pack-list', [PackController::class, 'index'])->name('packlist');
            Route::delete('/Dashboard/Packs/{id}', [PackController::class, 'destroy'])->name('packdestroy');
            Route::post('/Dashboard/Packs', [PackController::class, 'store'])->name('packstore');
            Route::get('/Dashboard/Packs/Add', [PackController::class, 'create'])->name('packadd');
            Route::get('/edit/{id}', [PackController::class, 'edit'])->name('packedit');
            Route::put('/update/{id}', [PackController::class, 'update'])->name('packupdate');



            Route::get('/Dashboard/Feature-list', [FeatureController::class, 'index'])->name('featurelist'); // List all features
            Route::delete('/Dashboard/Features/{id}', [FeatureController::class, 'destroy'])->name('featuredestroy'); // Delete a feature
            Route::post('/Dashboard/Features', [FeatureController::class, 'store'])->name('featurestore'); // Store a new feature
            Route::get('/Dashboard/Features/Add', [FeatureController::class, 'create'])->name('featureadd'); // Show add feature form
            Route::get('/Dashboard/Features/Edit/{id}', [FeatureController::class, 'edit'])->name('featureedit'); // Show edit feature form
            Route::put('/Dashboard/Features/Update/{id}', [FeatureController::class, 'update'])->name('featureupdate'); // Update feature
    

            Route::fallback(function () {
                return redirect()->route('admindashboard');
            });
        });



        // Influencer routes
        Route::middleware('countdown')->group(function () {
            Route::prefix('/influencer')->middleware(['auth', 'checkemailverification', 'influencer', 'checkpasswordchange'])->group(function () {
                


                Route::get('/', [GuestController::class, 'index'])->name('influencer_welcome');
                Route::get('/single-profile/{id}', [GuestController::class, 'single_influencer_profile'])->name('influencer_single_profile_page');
                Route::get('/dashboard', [InfluencerController::class, 'dashboard'])->name('influencer_dashboard');
                // Route::get('/dash', [InfluencerController::class, 'display'])->name('influencer_display');
                Route::get('/pack', [GuestController::class, 'pack'])->name('pack_influencer');
                Route::get('/show/brand/{id}', [GuestController::class, 'show_brand'])->name('show_brand_auth_influencer');
                Route::get('/show/influencer/{id}', [GuestController::class, 'show_influencer'])->name('show_influencer_auth_influencer');
                Route::get('/influencers', [InfluencerController::class, 'latests_influencers'])->name('latests_influencers_auth_influencer');
                Route::get('/brands', [BrandController::class, 'latests_brands'])->name('latests_brands_auth_influencer');
                Route::post('/profile', [InfluencerController::class, 'store'])->name('influencer.store');
                Route::get('/edit/{id}', [InfluencerController::class, 'edit'])->name('influencer.edit');

                Route::get('/sponsoring', [GuestController::class, 'sponsoring'])->name('sponsoring_influencer');
                Route::post('/sponsoring', [GuestController::class, 'sponsoring_store'])->name('sponsoring_store_influencer');
                Route::put('/update/{id}', [InfluencerController::class, 'update'])->name('influencer.update');
                Route::post('/media/remove', [InfluencerController::class, 'removeMedia'])->name('influencer.media.remove');
                Route::get('/password/form', [PasswordController::class, 'show'])->name('password_update_show_form_influencer');
                // Route::get('/All-Influencers', [InfluencerController::class, 'filter'])->name('filter_influnecers_auth_influencer');
                Route::get('/All-Brands', [BrandController::class, 'filter'])->name('filter_brands_auth_influencer');
                Route::post('/contact-influencer', [ContactInfluencerController::class, 'store'])->name('contact.influencer.store');
                Route::fallback(function () {
                    return redirect()->route('influencer_welcome');
                });
            });
        });

        // Brand routes
        Route::middleware('countdown')->group(function () {
            Route::prefix('/brand')->middleware(['auth', 'checkemailverification', 'brand', 'checkpasswordchange'])->group(function () {



                Route::get('/', [GuestController::class, 'index'])->name('brand_dashboard');
                Route::get('/profile', [BrandController::class, 'dashboard'])->name('brand_display');
                Route::get('/single-profile/{id}', [GuestController::class, 'single_brand_profile'])->name('brand_single_profile_page');
                Route::get('/show/{id}', [GuestController::class, 'show_brand'])->name('show_brand_auth_brand');
                Route::get('/show/influencer/{id}', [GuestController::class, 'show_influencer'])->name('show_influencer_auth_brand');
                Route::get('/influencers', [InfluencerController::class, 'latests_influencers'])->name('latests_influencers_auth_brand');
                Route::get('/brands', [BrandController::class, 'latests_brands'])->name('latests_brands_auth_brand');
                Route::post('/profile/store', [BrandController::class, 'store'])->name('brand.store');
                Route::put('/profile/update/{id}', [BrandController::class, 'update'])->name('brand.update');
                Route::get('/pack', [GuestController::class, 'pack'])->name('pack_brand');
                Route::post('/contact-brand', [ContactBrandController::class, 'store'])->name('contact.brand.store');
                Route::get('/sponsoring', [GuestController::class, 'sponsoring'])->name('sponsoring_brand');
                Route::post('/sponsoring', [GuestController::class, 'sponsoring_store'])->name('sponsoring_store_brand');
                Route::get('/All-Influencers', [InfluencerController::class, 'filter'])->name('filter_influnecers_auth_brand');
                Route::get('/All-Brands', [BrandController::class, 'filter'])->name('filter_brands_auth_brand');

                Route::get('/password/form', [PasswordController::class, 'show'])->name('password_update_show_form_brand');
                Route::delete('/remove-image/{imageName}', [PostController::class, 'removeImage']);
                Route::fallback(function () {
                    return redirect()->route('brand_dashboard');
                });
            });
        });

        Route::get('/type', function () {
            return view('forms.type');
        })->name('type_selection_page');

        Route::get('/register-brand', function () {
            return view('forms.register-brand');
        })->name('register-brand');



        Route::middleware('auth')->group(function () {
            // Route::get('/show/{id}', [GuestController::class, 'show_brand'])->name('show_brand_auth');
        });

        require __DIR__ . '/auth.php';
        // Fallback route for authenticated users
        Route::fallback(function () {
            if (auth()->check()) {
                // Redirect based on user's role
                $user = auth()->user();
                if ($user->isAdmin()) {
                    return redirect()->route('admindashboard');
                } elseif ($user->isInfluencer()) {
                    return redirect()->route('influencer_welcome');
                } elseif ($user->isBrand()) {
                    return redirect()->route('brand_dashboard');
                }
            }

            // If not authenticated, redirect to the guest welcome page
            return redirect()->route('welcome');
        });

        // Authentication Routes
    }
);
