<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GithubAuthController extends Controller
{
    
    public function redirect()
    {
        return Socialite::driver('github')
            ->scopes(['read:user', 'user:email']) 
            ->redirect();
    }

    public function callback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();

            Log::info('GitHub User Data:', [
                'id' => $githubUser->id,
                'name' => $githubUser->name ?? $githubUser->nickname,
                'email' => $githubUser->email,
            ]);

            // Проверяем, существует ли пользователь с такой электронной почтой
            $existingUser = User::where('email', $githubUser->email)->first();

            if ($existingUser) {
                // Если пользователь существует, обновляем его github_id
                $existingUser->update([
                    'github_id' => $githubUser->id,
                ]);
                $user = $existingUser;
            } else {
                // Если пользователя нет, создаем нового
                $user = User::create([
                    'github_id' => $githubUser->id,
                    'name' => $githubUser->name ?? $githubUser->nickname,
                    'email' => $githubUser->email,
                    'password' => bcrypt(Str::random(12)), // Генерируем случайный пароль
                ]);
            }

            Auth::login($user);

            Log::info('Пользователь залогинен:', ['id' => $user->id, 'email' => $user->email]);

            return redirect()->route('dashboard')
                ->with('success', 'Вы успешно вошли через GitHub!');
        } catch (\Exception $e) {
            Log::error('Ошибка при обработке входа через GitHub: ' . $e->getMessage());
            return redirect('/')
                ->with('error', 'Произошла ошибка при входе через GitHub.');
        }
    }
}