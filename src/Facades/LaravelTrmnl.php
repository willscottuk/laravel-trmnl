<?php

namespace Bnussbau\LaravelTrmnl\Facades;

use Illuminate\Support\Facades\Facade;
use voku\helper\HtmlDomParser;

/**
 * @see \Bnussbau\LaravelTrmnl\LaravelTrmnl
 */
class LaravelTrmnl extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Bnussbau\LaravelTrmnl\LaravelTrmnl::class;
    }

    public static function stripMarkup(string $renderedView): string
    {
        if (config('trmnl.plugin_type') === 'public') {
            return HtmlDomParser::str_get_html($renderedView)->findOne('div.screen')->innerHtml();
        }

        return HtmlDomParser::str_get_html($renderedView)->findOne('div.view')->innerHtml();
    }

    /**
     * @throws \Throwable
     */
    public static function renderScreen(?string $viewMarkupFull = null,
        ?string $viewMarkupHalfHorizontal = null,
        ?string $viewMarkupHalfVertical = null,
        ?string $viewMarkupQuadrant = null,
        $data = []
    ): array {
        return [
            'markup' => self::stripMarkup(view($viewMarkupFull, $data)->render()),
            'markup_half_horizontal' => self::stripMarkup(view($viewMarkupHalfHorizontal, $data)->render()),
            'markup_half_vertical' => self::stripMarkup(view($viewMarkupHalfVertical, $data)->render()),
            'markup_quadrant' => self::stripMarkup(view($viewMarkupQuadrant, $data)->render()),
        ];
    }
}
