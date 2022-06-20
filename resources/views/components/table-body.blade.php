@props(['data'])

@foreach ($data as $element)
    <tr>
        @foreach ($element as $elem)
            @if (is_array($elem))
                <td>
                    @foreach ($elem as $option)
                        @switch($option)
                            @case($option['name'] == 'edit')
                                @can('pqr.edit')
                                    <a class="btn btn-success pb-0 my-1" href="{{ $option['route'] }}">
                                        <span class="material-icons">
                                            edit
                                        </span>
                                    </a>
                                @endcan
                            @break

                            @case($option['name'] == 'show')
                                <a class="btn btn-primary pb-0 my-1" href="{{ $option['route'] }}">
                                    <span class="material-icons">
                                        visibility
                                    </span>
                                </a>
                            @break

                            @case($option['name'] == 'destroy')
                                @can('pqr.delete')
                                    <a class="btn btn-danger pb-0 my-1">
                                        <span class="material-icons">
                                            delete
                                        </span>
                                    </a>
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
