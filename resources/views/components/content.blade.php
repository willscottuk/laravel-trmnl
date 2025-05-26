@props(['pixel' => false])
<div class="content" {{ $pixel ? 'data-pixel-perfect="true"' : '' }}>
    {{ $slot }}
</div>