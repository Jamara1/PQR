@props(['headers', 'data'])

<table id="dataTable" class="display" style="width:100%">
    <thead>
        <tr>
            @foreach ($headers as $header)
                <th>{{ $header }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        <x-table-body :data=$data></x-table-body>
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="{!! asset('js/datatable.js') !!}"></script>
