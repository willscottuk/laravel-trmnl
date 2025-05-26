@props(['variant' => null, 'size' => null, 'pixel' => false])
<span {{ $attributes->merge(['class' => 'label' . (isset($size) ? ' label--' . $size : '') . (isset($variant) ? ' label--' . $variant : '')]) }} {{if($pixel) ? 'data-pixel-perfect="true"' : ''}}>
    {{ $slot }}
</span>