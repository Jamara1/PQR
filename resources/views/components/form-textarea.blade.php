@props(['label' => 'Label default', 'name' => 'name-default', 'row' => 10, 'data', 'dataEdit' => []])

<label for="{{ $name }}" class="form-label">{{ __($label) }}</label>
<textarea name="{{ $name }}" class="form-control" placeholder="{{ __($label) }}" rows="{{ $row }}">{{ old($name) ?? (empty($dataEdit) ? old($name) : $dataEdit->subject) }}</textarea>

<x-validation-error :name=$name></x-validation-error>
