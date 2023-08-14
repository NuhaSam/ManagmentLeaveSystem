@include('layouts.header')

<div>
    <h1>Image Display</h1>
    <h1>Image {{ $fileContent }}</h1>
    <h1>Image {{ public_path('') }}</h1>
    <h1>{{ public_path($fileContent) }}</h1>

    <img src="{{ public_path($fileContent) }}" alt="Image">
</div>