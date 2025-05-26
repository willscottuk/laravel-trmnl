@props(['size', 'pixel' => false])
<span class="title @if(isset($size) && $size === " small") title--small @endif" {{if($pixel) ? 'data-pixel-perfect="true"' : ''}}>
    {{ $slot }}
</span>