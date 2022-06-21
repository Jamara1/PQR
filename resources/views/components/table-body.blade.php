@props(['data'])

@foreach ($data as $element)
    <tr>
        <td class="fw-bold">{{ $loop->index + 1 }}</td>
        @foreach ($element as $key => $elem)
            @if (is_array($elem))
                <td>
                    @foreach ($elem as $option)
                        @switch($option)
                            @case($option['name'] == 'edit')
                                @can('pqr.edit')
                                    <a class="btn btn-success pb-0 m-1" href="{{ $option['route'] }}">
                                        <span class="material-icons">
                                            edit
                                        </span>
                                    </a>
                                @endcan
                            @break

                            @case($option['name'] == 'show')
                                <a class="btn btn-primary pb-0 m-1" href="{{ $option['route'] }}">
                                    <span class="material-icons">
                                        visibility
                                    </span>
                                </a>
                            @break

                            @case($option['name'] == 'destroy')
                                @can('user.delete')
                                    <div class="m-1">
                                        <form action="{{ $option['route'] }}" method="post">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                            <button class="btn btn-danger pb-0" type="submit">
                                                <span class="material-icons">
                                                    delete
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                @endcan
                            @break
                        @endswitch
                    @endforeach
                </td>
            @else
                <td>{{ $elem }}</td>
            @endif
        @endforeach
    </tr>
@endforeach
