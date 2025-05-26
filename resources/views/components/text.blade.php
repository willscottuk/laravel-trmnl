@props(['alignment' => 'left', 'pixel' => false])
<p class="text--{{ $alignment }}" {{if($pixel) ? 'data-pixel-perfect="true"' : ''}}>
    {{ $slot }}
</p>