<?php

namespace App\Providers\Filament;

use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use App\Filament\Resources\CategoryResource\Widgets\TotalCategoriesStats;
use App\Filament\Resources\CityResource\Widgets\TotalCitiesStats;
use App\Filament\Resources\CustomerResource\Widgets\TotalCustomerStats;
use App\Filament\Resources\CustomRoleResource;
use App\Filament\Resources\NoneResource\Widgets\AccountWidget;
use App\Filament\Resources\ServiceProviderRequestResource\Widgets\TotalJoinUsStats;
use App\Filament\Resources\ServiceProviderResource\Widgets\TotalServiceProviderStats;
use App\Filament\Resources\StateResource\Widgets\TotalStatesStats;
use App\Filament\Widgets\Notifications;
use Filament\Facades\Filament;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\UserMenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget as WidgetsAccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Filament\Widgets\Widget;
use Hardikkhorasiya09\ChangePassword\ChangePasswordPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Kenepa\TranslationManager\TranslationManagerPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('filament/admin/auth')
            ->authGuard('admin')
            ->login()
            ->colors([
                'primary' => Color::hex('#6B21A8'),
            ])

            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')

            ->widgets([
                WidgetsAccountWidget::class,
                FilamentInfoWidget::class,
                TotalCustomerStats::class,
                TotalStatesStats::class,
                TotalCitiesStats::class,
                TotalCategoriesStats::class,
                TotalJoinUsStats::class,
                TotalServiceProviderStats::class,
                Notifications::class,
            ])

            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])

            ->plugins([
                ChangePasswordPlugin::make(),
                FilamentEditProfilePlugin::make()
                    ->shouldShowAvatarForm()
                    ->shouldShowDeleteAccountForm(false)
                    ->shouldShowEditPasswordForm(false)
                    ->shouldShowBrowserSessionsForm(false),
                TranslationManagerPlugin::make(),
                FilamentSpatieRolesPermissionsPlugin::make()

            ])

            ->resources([
                CustomRoleResource::class,
            ]);

    }

    public function boot(): void
{
    Filament::serving(function () {
        config(['session.cookie' => 'admin_session']);
    });
}


}
