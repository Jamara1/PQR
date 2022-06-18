@props(['title' => 'Title default'])

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">{{ __($title) }}</div>
            <div class="card-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
