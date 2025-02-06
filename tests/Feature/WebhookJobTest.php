<?php

use Bnussbau\LaravelTrmnl\Jobs\UpdateScreenContentJob;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    Config::set('trmnl.data_strategy', 'webhook');
    Config::set('trmnl.webhook_url', 'https://api.example.com/webhook');
});

it('sends content update to webhook URL', function () {
    Http::fake([
        'api.example.com/*' => Http::response(['status' => 'success'], 200),
    ]);

    $content = ['key' => 'value'];
    UpdateScreenContentJob::dispatch($content);

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.example.com/webhook' &&
            $request['merge_variables']['key'] === 'value';
    });
});

it('throws exception when webhook strategy is not configured', function () {
    Config::set('trmnl.data_strategy', 'polling');

    $content = ['key' => 'value'];

    expect(fn () => UpdateScreenContentJob::dispatch($content))
        ->toThrow(Exception::class, 'Aborting Job. Data strategy is not webhook.');
});

it('throws exception when webhook URL is not set', function () {
    Config::set('trmnl.webhook_url', null);

    $content = ['key' => 'value'];

    expect(fn () => UpdateScreenContentJob::dispatch($content))
        ->toThrow(Exception::class, 'Aborting Job. Webhook URL not set.');
}); 