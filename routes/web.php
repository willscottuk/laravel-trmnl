<?php

use Bnussbau\LaravelTrmnl\Models\TrmnlUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

            TrmnlUser::create([
                'access_token' => $accessToken,
                'user_id' => Auth::id(),
            ]);

            return redirect($callbackUrl);
        })->name('trmnl.auth.create');

        Route::post('/auth/install', function (Request $request) {
            $user = $request->json('user');
            // get header Authorization
            $access_token = str_replace('Bearer ', '', $request->header('Authorization'));

            TrmnlUser::where('access_token', $access_token)
                ->where('uuid', null)
                ->update(
                    [
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'tz' => $user['tz'],
                        'uuid' => $user['uuid'],
                    ]
                );

            return response()->json([
                'success' => true,
            ]);
        })->name('trmnl.auth.install');

        Route::get('/manage', function (Request $request) {
            $uuid = $request->query('uuid');
            $user = TrmnlUser::where('uuid', $uuid)->firstOrFail();

            return response()->json([
                'success' => true,
                'authenticated' => $user->email,
            ]);
        })->name('trmnl.manage');

        Route::post('/auth/destroy', function (Request $request) {
            $access_token = str_replace('Bearer ', '', $request->header('Authorization'));

            $uuid = $request->json('user_uuid');
            TrmnlUser::where('uuid', $uuid)
                ->where('access_token', $access_token)
                ->delete();

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
