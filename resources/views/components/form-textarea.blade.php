@props(['label' => 'Label default', 'name' => 'name-default', 'row' => 10, 'data'])

<label for="{{ $name }}" class="form-label">{{ __($label) }}</label>
<textarea name="{{ $name }}" class="form-control" placeholder="{{ __($label) }}" rows="{{ $row }}"></textarea>
