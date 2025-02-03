{{-- <form {{ $attributes(["class" => "max-w-2xl mx-auto space-y-6", "method" => "GET"]) }}>
    @if ($attributes->get('method', 'GET') !== 'GET')
        @csrf
        @method($attributes->get('method'))
    @endif
    {{ $slot }}
</form> --}}

<!-- resources/views/components/forms/form.blade.php -->
<form {{ $attributes->merge(['class' => 'max-w-2xl mx-auto space-y-6']) }} method="{{ $attributes->get('method', 'GET') }}">
    @csrf <!-- Always include CSRF token -->
    @if ($attributes->get('method') !== 'GET')
        @method($attributes->get('method')) <!-- Handle PUT/PATCH/DELETE if needed -->
    @endif
    {{ $slot }}
</form>