<?php

namespace Bnussbau\LaravelTrmnl\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class UpdateScreenContentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public array $content,
        public ?string $webhook_url = null,
    ) {}

    public function handle(): void
    {
        if (config('trmnl.data_strategy') !== 'webhook') {
            throw new \Exception('Aborting Job. Data strategy is not webhook. Set TRMNL_DATA_STRATEGY=webhook in your .env.');
        }
        if ($this->webhook_url === null && config('trmnl.webhook_url') === null) {
            throw new \Exception('Aborting Job. Webhook URL not set. Set TRMNL_WEBHOOK_URL in your .env.');
        }

        $url = $this->webhook_url ?? config('trmnl.webhook_url');
        Http::post($url, [
            'merge_variables' => $this->content,
        ]);
    }
}
