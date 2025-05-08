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
    
        // ✅ No pongas Fortify::username() aquí. No es necesario.
    
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input('username')) . '|' . $request->ip());
            return Limit::perMinute(5)->by($throttleKey);
        });
    
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    
        Fortify::authenticateUsing(function (Request $request) {
            $username = trim($request->username);
        
            if (!$username || !$request->password) {
                session()->flash('error', 'Todos los campos son obligatorios.');
                return null;
            }
        
            if (!preg_match('/^[a-z0-9]+$/i', $username)) {
                session()->flash('error', 'El nombre de usuario solo puede contener letras o números sin espacios.');
                return null;
            }
            
            
            $user = User::where('username', $username)->first();
        
            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }
        
            session()->flash('error', 'Usuario o contraseña incorrectos. Verifica tus datos.');
            return null;
        });
        
    }
    
    
    
}
