@props(['label' => 'Label default', 'row' => 10, 'data' => 'Data default'])

<h4 class="fw-bold shadow-lg px-2 pt-4 pb-3 bg-secondary bg-opacity-25 rounded">{{ __($label) }}</h4>
<hr class="shadow-lg p-1 bg-success rounded mt-0">
<p class="px-2">{{ $data }}</p>
