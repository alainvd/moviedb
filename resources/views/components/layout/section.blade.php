<section class="my-8">
    @if (isset($title))
        <h2 class="text-xl leading-tight font-medium">{{ $title }}</h2>
    @endif
    {{ $slot }}
</section>
