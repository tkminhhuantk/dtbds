<div class="text-white mb-4">
    @if($h1)
        <h1 class="text-2xl font-bold">{{ $title }}</h1>
    @else
        <h2 class="text-2xl font-bold">{{ $title }}</h2>
    @endif
    <p>{{ $text }}</p>
</div>