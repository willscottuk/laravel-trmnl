<?php

use Bnussbau\LaravelTrmnl\Facades\LaravelTrmnl;

it('strips markup correctly for private plugins', function () {
    config()->set('trmnl.plugin_type', 'private');

    $html = '<body class="environment trmnl"><div class="screen"><div class="view view--full"><div class="layout">test content</div></div></div>';
    $stripped = LaravelTrmnl::stripMarkup($html);

    expect($stripped)->toBe('<div class="layout">test content</div>');
});

it('strips markup correctly for public plugins', function () {
    config()->set('trmnl.plugin_type', 'public');

    $html = '<body class="environment trmnl"><div class="screen"><div class="view view--full"><div class="layout">test content</div></div></div>';
    $stripped = LaravelTrmnl::stripMarkup($html);

    expect($stripped)->toBe('<div class="view view--full"><div class="layout">test content</div></div>');
});
