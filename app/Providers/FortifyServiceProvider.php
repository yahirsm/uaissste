<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // ✅ Límite de intentos de inicio de sesión (5 intentos por minuto)
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());
            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // ✅ Validación personalizada de inicio de sesión
        Fortify::authenticateUsing(function (Request $request) {
            // ✅ Validar si los campos están vacíos
            if (!$request->email || !$request->password) {
                session()->flash('error', 'Todos los campos son obligatorios.');
                return null;
            }

            // ✅ Validar formato del correo electrónico
            if (!filter_var($request->email, FILTER_VALIDATE_EMAIL) || !preg_match('/@.+\.(com|mx|org|net)$/', $request->email)) {
                session()->flash('error', 'El correo electrónico debe tener un formato válido (por ejemplo, usuario@dominio.com).');
                return null;
            }

            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user; 
            }

            session()->flash('error', 'Correo o contraseña incorrectos. Verifica tus datos.');
            return null;
        });
    }
}
