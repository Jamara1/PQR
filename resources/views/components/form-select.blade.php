@props(['label' => 'Label default', 'name' => 'name-default', 'data', 'dataShow' => []])

<label for="{{ $name }}" class="form-label">{{ __($label) }}</label>
<select name="{{ $name }}" class="form-select">
    <option value="0" selected>{{ __('Select') }}</option>
    @foreach ($data as $element)
        <option value="{{ $element->id }}"
            {{ old($name) == $element->id ? 'selected' : (empty($dataShow) ? '' : ($dataShow[$name] == $element->id ? 'selected' : '')) }}>
            {{ $element->name }}
        </option>
    @endforeach
</select>

<x-validation-error :name=$name></x-validation-error>
