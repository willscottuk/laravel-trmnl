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
        return HtmlDomParser::str_get_html($renderedView)->findOne('div.screen')->innerHtml();
    }

    /**
     * @throws \Throwable
     */
    public static function renderScreen(?string $viewMarkupFull = null,
        ?string $viewMarkupHalfHorizontal = null,
        ?string $viewMarkupHalfVertical = null,
        ?string $viewMarkupQuadrant = null): array
    {
        return [
            'markup' => self::stripMarkup(view($viewMarkupFull)->render()),
            'markup_half_horizontal' => self::stripMarkup(view($viewMarkupHalfHorizontal)->render()),
            'markup_half_vertical' => self::stripMarkup(view($viewMarkupHalfVertical)->render()),
            'markup_quadrant' => self::stripMarkup(view($viewMarkupQuadrant)->render()),
        ];
    }
}
