@props(['label' => 'Label default', 'name' => 'name-default', 'data'])

<label for="{{ $name }}" class="form-label">{{ __($label) }}</label>
<select name="{{ $name }}" class="form-select">
    <option selected>{{ __('Select') }}</option>
    @foreach ($data as $element)
        <option value="{{ $element->id }}">{{ $element->name }}</option>
    @endforeach
</select>
