@props(['label' => 'Label default', 'name' => 'name-default', 'row' => 10, 'data', 'dataShow' => []])

<label for="{{ $name }}" class="form-label">{{ __($label) }}</label>
<textarea name="{{ $name }}" class="form-control" placeholder="{{ __($label) }}" rows="{{ $row }}">{{ old($name) ?? (empty($dataShow) ? old($name) : $dataShow[$name]) }}</textarea>

<x-validation-error :name=$name></x-validation-error>
