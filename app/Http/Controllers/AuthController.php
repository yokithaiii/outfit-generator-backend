<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->all();

        if (!$this->verifyTelegramData($data)) {
            return response()->json(['error' => 'Invalid Telegram data'], 403);
        }

        $user = User::where('tg_link', $data['id'])->first();

        if (!$user) {
            $user = User::query()->create([
                'name' => $data['first_name'] ?? $data['username'] ?? 'Без имени',
                'phone' => '',
                'avatar' => $data['photo_url'] ?? null,
                'tg_link' => $data['id'],
            ]);
        }

        $token = $user->createToken('telegram')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    private function verifyTelegramData($data)
    {
        $check_hash = $data['hash'];
        unset($data['hash']);
        ksort($data);

        $data_check_string = collect($data)
            ->map(fn($v, $k) => "$k=$v")
            ->implode("\n");

        $secret_key = hash('sha256', env('TELEGRAM_BOT_TOKEN'), true);
        $hash = hash_hmac('sha256', $data_check_string, $secret_key);

        return hash_equals($hash, $check_hash);
    }
}
