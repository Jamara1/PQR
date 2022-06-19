@props(['title' => 'Title default', 'showCreate' => false, 'routeCreate' => 'home'])

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-10 mt-1">
                        {{ __($title) }}
                    </div>

                    @if ($showCreate)
                        <div class="col-sm-2 text-end">
                            <a class="btn btn-dark pb-0 px-2 pt-1" href="{{ route($routeCreate) }}">
                                <span class="material-icons fs-5">
                                    add
                                </span>
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
