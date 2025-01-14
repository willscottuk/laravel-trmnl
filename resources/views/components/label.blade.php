@props(['variant', 'size'])
<span class="label @if(isset($size) && $size === "small") label--small @endif @if(isset($variant)) label--{{$variant}}@endif">
    {{ $slot }}
</span>
