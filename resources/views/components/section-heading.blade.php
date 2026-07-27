@props(['title', 'subtitle' => null, 'center' => true])
<div class="{{ $center ? 'text-center' : '' }} mx-auto max-w-2xl">
    <h2 class="section-title">{{ $title }}</h2>
    @if($subtitle)
        <p class="mt-3 text-brown-800/70">{{ $subtitle }}</p>
    @endif
</div>
