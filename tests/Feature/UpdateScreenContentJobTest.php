<?php

use Bnussbau\LaravelTrmnl\Jobs\UpdateScreenContentJob;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    config()->set('trmnl.data_strategy', 'webhook');
    config()->set('trmnl.webhook_url', 'https://api.trmnl.com/webhook');
});

it('sends content to webhook URL', function () {
    Http::fake();
    
    $content = ['key' => 'value'];
    UpdateScreenContentJob::dispatch($content);
    
    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.trmnl.com/webhook' &&
            $request['merge_variables']['key'] === 'value';
    });
});

it('requires webhook strategy to be configured', function () {
    config()->set('trmnl.data_strategy', 'polling');
    
    $content = ['test' => 'data'];
    
    expect(fn () => UpdateScreenContentJob::dispatch($content))
        ->toThrow('Aborting Job. Data strategy is not webhook.');
});

it('requires webhook URL to be set', function () {
    config()->set('trmnl.webhook_url', null);
    
    $content = ['test' => 'data'];
    
    expect(fn () => UpdateScreenContentJob::dispatch($content))
        ->toThrow('Aborting Job. Webhook URL not set.');
}); 