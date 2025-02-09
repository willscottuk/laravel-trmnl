<?php

namespace Bnussbau\LaravelTrmnl\Auth;

use Bnussbau\LaravelTrmnl\Models\TrmnlUser;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class TrmnlGuard implements Guard
{
    use GuardHelpers;

    protected $request;

    protected $provider;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function user()
    {
        $token = str_replace('Bearer ', '', $this->request->header('Authorization'));

        if (! $token) {
            return null;
        }

        return TrmnlUser::where('access_token', $token)->first()->user()->first();
    }

    public function validate(array $credentials = [])
    {
        $token = str_replace('Bearer ', '', $this->request->header('Authorization'));

        if (! $token) {
            return false;
        }

        return TrmnlUser::where('access_token', $token)->exists();
    }
}
