@props(['label' => 'Label default', 'name' => 'name-default', 'dataShow' => []])

<label for="{{ $name }}" class="form-label">{{ __($label) }}</label>
<input name="{{ $name }}" class="form-control"
    value="{{ old($name) ?? (empty($dataShow) ? old($name) : $dataShow[$name]) }}" placeholder="{{ __($label) }}"
    {{ $attributes }} autocomplete="off" />

<x-validation-error :name=$name></x-validation-error>
