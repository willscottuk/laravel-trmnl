@props(['pixel' => false])
<div class="content" {{if($pixel) ? 'data-pixel-perfect="true"' : ''}}>
    {{ $slot }}
</div>