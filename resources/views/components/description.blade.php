@props(['pixel' => false])
<span class="description" {{ $pixel ? 'data-pixel-perfect="true"' : '' }}>{{ $slot }}</span>