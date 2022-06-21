@props(['headers', 'data'])

<table id="dataTable" class="table table-striped dt-responsive nowrap" style="width:100%">
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
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>

<script src="{!! asset('js/datatable.js') !!}"></script>
