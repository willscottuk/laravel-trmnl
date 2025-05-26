@props(['size', 'pixel' => false])
<span {{ $attributes->merge(['class' => 'value' . (isset($size) ? ' value--' . $size : '')]) }} {{ $pixel ? 'data-pixel-perfect="true"' : '' }}>
    {{ $slot }}
</span>