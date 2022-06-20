@props(['title' => 'Title default', 'showCreate' => false, 'showReturn' => false, 'routeCreate' => 'home', 'routeReturn' => 'home'])

<div class="row justify-content-center">
    <div class="col-md-11">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-10 mt-2">
                        {{ __($title) }}
                    </div>

                    @if ($showCreate)
                        <div class="col-sm-2 text-end">
                            <a class="btn btn-warning fw-bold" href="{{ route($routeCreate) }}">
                                {{ __('New') }}
                            </a>
                        </div>
                    @endif

                    @if ($showReturn)
                        <div class="col-sm-2 text-end">
                            <a class="btn btn-danger text-white" href="{{ route($routeReturn) }}">
                                {{ __('Return') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
