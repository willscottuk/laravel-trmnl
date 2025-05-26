@props(['alignment' => 'left', 'pixel' => false])
<p class="text--{{ $alignment }}" {{ $pixel ? 'data-pixel-perfect="true"' : '' }}>
    {{ $slot }}
</p>