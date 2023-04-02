<?php

declare(strict_types=1);

use App\Orchid\Screens\AboutUs\AboutAchievementsCreateScreen;
use App\Orchid\Screens\AboutUs\AboutUsEditScreen;
use App\Orchid\Screens\AboutUs\AboutUsListScreen;
use App\Orchid\Screens\Achievements\AchievementsEditScreen;
use App\Orchid\Screens\Achievements\AchievementsListScreen;
use App\Orchid\Screens\Achievements\AchievementsScreen;
use App\Orchid\Screens\Advantages\AdvantagesEditScreen;
use App\Orchid\Screens\Advantages\AdvantagesList;
use App\Orchid\Screens\Banners\BannersEdit;
use App\Orchid\Screens\Banners\BannersList;
use App\Orchid\Screens\Contacts\ContactsEditScreen;
use App\Orchid\Screens\Contacts\ContactsListScreen;
use App\Orchid\Screens\Contacts\SocialsCreateScreen;
use App\Orchid\Screens\Gallery\GalleryListScreen;
use App\Orchid\Screens\History\HistoryEditScreen;
use App\Orchid\Screens\History\HistoryListScreen;
use App\Orchid\Screens\Investments\InvestmentEditScreen;
use App\Orchid\Screens\Manifesto\ManifestoEditScreen;
use App\Orchid\Screens\Manifesto\ManifestoListScreen;
use App\Orchid\Screens\Manifesto\ManifestoMainScreenn;
use App\Orchid\Screens\PagesEditScreen;
use App\Orchid\Screens\PagesScreen;
use App\Orchid\Screens\Partners\PartnersEditScreen;
use App\Orchid\Screens\Partners\PartnersListScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Pages
Route::screen("pages", PagesScreen::class)->name('platform.pages');
Route::screen('pages/{id}/edit', PagesEditScreen::class)
    ->name('platform.pages.edit');
// Gallery
Route::screen("gallery", GalleryListScreen::class)->name('platform.gallery.list');
// Banners
Route::screen("banners", BannersList::class)->name('platform.banners.list');
// Route::screen("banners/{name}", Banners::class)->name('platform.banners');
Route::screen("banners/create", BannersEdit::class)->name('platform.banners.create');
Route::screen('banners/{banner}/edit', BannersEdit::class)
    ->name('platform.banners.edit');


// Achievements
Route::screen('achievements', AchievementsScreen::class)->name('platform.achievements.list');
Route::screen('achievements/create', AchievementsEditScreen::class)
    ->name('platform.achievements.create');

Route::screen('achievements/{id}/edit', AchievementsEditScreen::class)
    ->name('platform.achievements.edit');


//Advantages
Route::screen('advantages', AdvantagesList::class)->name('platform.advantages.list');
Route::screen('advantages/create', AdvantagesEditScreen::class)
    ->name('platform.advantages.create');
Route::screen('advantages/{id}/edit', AdvantagesEditScreen::class)
    ->name('platform.advantages.edit');


// History
Route::screen('history', HistoryListScreen::class)->name('platform.history.list');
Route::screen('history/create', HistoryEditScreen::class)
    ->name('platform.history.create');
Route::screen('history/{id}/edit', HistoryEditScreen::class)
    ->name('platform.history.edit');


// Manifesto
Route::screen('manifestos/{id}/edit', ManifestoEditScreen::class)
    ->name('platform.manifestos.edit');


// Partners
Route::screen('partners', PartnersListScreen::class)->name('platform.partners.list');
Route::screen('partners/create', PartnersEditScreen::class)
    ->name('platform.partners.create');
Route::screen('partners/{id}/edit', PartnersEditScreen::class)
    ->name('platform.partners.edit');


    // AboutUs
Route::screen('about-us', AboutUsListScreen::class)->name('platform.about-us.list');
Route::screen('about-us/create', AboutUsEditScreen::class)
    ->name('platform.about-us.create');
Route::screen('about-us/{id}/about_achievement/create', AboutAchievementsCreateScreen::class)
    ->name('platform.about_achievements.create');
Route::screen('about-us/{id}/edit', AboutUsEditScreen::class)
    ->name('platform.about-us.edit');


        // Contacts
Route::screen('contacts/social/create', SocialsCreateScreen::class)
    ->name('platform.social.create');
Route::screen('contacts/{id}/edit', ContactsEditScreen::class)
    ->name('platform.contacts.edit');


        // Investments
Route::screen('investments/{id}/edit', InvestmentEditScreen::class)
    ->name('platform.investments.edit');
    
// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));
