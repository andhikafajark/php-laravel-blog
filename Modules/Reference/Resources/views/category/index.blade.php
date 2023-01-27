@extends('components.tailwindcss.templates.admin')

@push('styles')

    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css" rel="stylesheet">

@endpush

@section('content')

    <h1 class="text-3xl font-bold text-gray-900 my-4">{{ $title }}</h1>
    <a href="{{ route($route . 'create') }}"
       class="inline-block text-blue-400 hover:text-white border border-blue-400 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-3 text-center dark:border-blue-300 dark:text-blue-300 dark:hover:text-white dark:hover:bg-blue-400 dark:focus:ring-blue-900">
        <i class="fas fa-pen"></i> Create
    </a>
    <div class="w-full px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50">
        <table id="table" class="stripe">
            <thead>
            <tr>
                <th>No</th>
                <th>Type</th>
                <th>Title</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
    </div>

@endsection

@push('scripts')

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function () {
            init()
            handler()
        });

        function init() {
            window.filterDataTable = {}

            datatables()
        }

        function datatables() {
            if (window.dataTable !== undefined) window.dataTable.destroy()

            window.dataTable = $('#table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: '{{ route( $route. 'index' ) }}',
                    data: {filter: window.filterDataTable}
                },
                columns: [
                    {data: 'DT_RowIndex', orderable: false, searchable: false, className: 'dt-center'},
                    {data: 'type'},
                    {data: 'title'},
                    {data: 'action', orderable: false, searchable: false}
                ]
            });
        }

        function handler() {
            $('#table').on('click', '.delete', function () {
                const url = $(this).data('url')

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        apiCall({
                            url,
                            type: 'delete',
                            success: function (response) {
                                if (response?.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: response?.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    })

                                    datatables()
                                }
                            }
                        })
                    }
                })
            })
        }
    </script>

@endpush
