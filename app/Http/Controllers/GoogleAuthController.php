<?php

namespace App\Http\Controllers;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
        ->scopes(['email', 'profile']) // Необязательно, но рекомендуется
        ->with([
            'prompt' => 'select_account',
        ])
        ->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            Log::info('Google User Data:', [
                'id' => $googleUser->id,
                'name' => $googleUser->name,
                'email' => $googleUser->email,
            ]);

            // Проверяем, существует ли пользователь с такой электронной почтой
            $existingUser = User::where('email', $googleUser->email)->first();

            if ($existingUser) {
                // Если пользователь существует, обновляем его google_id
                $existingUser->update([
                    'google_id' => $googleUser->id,
                ]);
                $user = $existingUser;
            } else {
                // Если пользователя нет, создаем нового
                $user = User::create([
                    'google_id' => $googleUser->id,
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => bcrypt(Str::random(12)),
                ]);
            }

            Auth::login($user);

            Log::info('Пользователь залогинен:', ['id' => $user->id, 'email' => $user->email]);

            return redirect()->route('dashboard')
                ->with('success', 'Вы успешно вошли через Google!');
        } catch (\Exception $e) {
            Log::error('Ошибка при обработке входа через Google: ' . $e->getMessage());
            return redirect('/')
                ->with('error', 'Произошла ошибка при входе через Google.');
        }
    }

}
