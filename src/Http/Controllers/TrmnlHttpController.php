<?php

namespace Bnussbau\LaravelTrmnl\Http\Controllers;

use Bnussbau\LaravelTrmnl\Models\TrmnlUser;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class TrmnlHttpController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
        ]);
    }

    public function create(Request $request)
    {
        $callbackUrl = $request->query('installation_callback_url');
        $code = $request->query('code');

        $oauthRes = Http::post(config('trmnl.server.base_url').'/oauth/token', [
            'code' => $code,
            'client_id' => config('trmnl.oauth_client_id'),
            'client_secret' => config('trmnl.oauth_client_secret'),
            'grant_type' => 'authorization_code',
        ]);

        $accessToken = $oauthRes->json('access_token');

        TrmnlUser::create([
            'access_token' => $accessToken,
            'user_id' => Auth::id(),
        ]);

        return redirect($callbackUrl);
    }

    public function install(Request $request)
    {
        $user = $request->json('user');
        $access_token = str_replace('Bearer ', '', $request->header('Authorization'));

        TrmnlUser::where('access_token', $access_token)
            ->where('uuid', null)
            ->update([
                'name' => $user['name'],
                'email' => $user['email'],
                'tz' => $user['tz'],
                'uuid' => $user['uuid'],
            ]);

        return response()->json([
            'success' => true,
        ]);
    }

    public function destroy(Request $request)
    {
        $access_token = str_replace('Bearer ', '', $request->header('Authorization'));

        $trmnlUser = TrmnlUser::where('access_token', $access_token)
            ->where('uuid', $request->input('user_uuid'))
            ->first();

        if (! $trmnlUser) {
            \Log::warning('TRMNL uninstall request received, but user not found in database', [
                'user_uuid' => $request->input('user_uuid'),
            ]);

            // Returning an error may prevent uninstalls
            // which are not present in the database
            return response()->json([
                'success' => true,
            ]);
        }

        $trmnlUser->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    public function manage(Request $request)
    {
        $uuid = $request->query('uuid');
        $trmnlUser = TrmnlUser::where('uuid', $uuid)->first();

        if (! $uuid || ! $trmnlUser) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid UUID',
            ], 404);
        }

        return response('The plugin is connected successfully, but the publisher has not yet implemented a view to configure settings.');
    }

    public function docs()
    {
        return response('The publisher of the TRMNL plugin has not yet published docs.');
    }
}
