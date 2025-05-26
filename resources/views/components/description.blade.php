@props(['pixel' => false])
<span class="description" {{if($pixel) ? 'data-pixel-perfect="true"' : ''}}>{{ $slot }}</span>