<?php

use Bnussbau\LaravelTrmnl\TrmnlUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

if (config('trmnl.plugin_type') === 'public') {
    Route::prefix('trmnl')->group(function () {
        Route::get('/', function (Request $request) {
            return response()->json([
                'success' => true,
            ]);
        })->name('trmnl.index');

        Route::get('/auth/create', function (Request $request) {
            $callbackUrl = $request->query('installation_callback_url');
            $code = $request->query('code');

            $oauthRes = Http::post('https://usetrmnl.com/oauth/token', [
                'code' => $code,
                'client_id' => '9d8pdimsq5fiivixxjujgw',
                'client_secret' => '9h-djaymlsfgdx8bijbtfq',
                'grant_type' => 'authorization_code',
            ]);
            $accessToken = $oauthRes->json('access_token');

            return redirect($callbackUrl);
        })->name('trmnl.auth.create');

        Route::post('/auth/install', function (Request $request) {
            $user = $request->json('user');

            TrmnlUser::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'tz' => $user['tz'],
                'uuid' => $user['uuid'],
                //'access_token' => $user['access_token'],
            ]);

            return response()->json([
                'success' => true,
            ]);
        })->name('trmnl.auth.install');

        Route::get('/manage', function (Request $request) {
            $uuid = $request->query('uuid');
            $user = TrmnlUser::where('uuid', $uuid)->first();

            return response()->json([
                'success' => true,
                'user' => $user,
            ]);
        })->name('trmnl.manage');

        Route::post('/auth/destroy', function (Request $request) {
            $uuid = $request->json('user_uuid');
            TrmnlUser::where('uuid', $uuid)->delete();
            return response()->json([
                'success' => true,
            ]);
        })->name('trmnl.auth.destroy');

        Route::get('/docs', function (Request $request) {
            return response()->json([
                'success' => true,
            ]);
        })->name('trmnl.docs');

    });
}
