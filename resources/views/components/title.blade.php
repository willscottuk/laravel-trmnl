@props(['size', 'pixel' => false])
<span class="title @if(isset($size) && $size === " small") title--small @endif" {{ $pixel ? 'data-pixel-perfect="true"' : '' }}>
    {{ $slot }}
</span>