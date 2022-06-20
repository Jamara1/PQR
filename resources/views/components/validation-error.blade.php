@props(['name' => 'name-default'])

@if ($errors->has($name))
    <div class="text-danger mx-2">
        <p>* {{ $errors->first($name) }}</p>
    </div>
@endif
