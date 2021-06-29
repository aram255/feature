@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Clients</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>
    <!-- Modal -->
    <!-- <button type="button" class="btn btn-info openPopup" data-toggle="modal" data-href="{{route('practitionersEdit')}}">Upload file</button> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Phone number</th>
                            <th>Email</th>
                            <th>Created</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('css')
    <link href="/backend/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@push('script')
    <script src="/backend/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/backend/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Init table
            var dataTable = $('#dataTable').DataTable({
                "processing": true,
                "serverSide": true,
                'searching': false,
                "ajax": {
                    "url": "{{ route('clientsData') }}",
                    "data": function(data){
                        data['sort_field'] = data.columns[data.order[0].column].name;
                        data['sort_dir'] =  data.order[0].dir;

                        delete data.columns;
                        delete data.order;
                        delete data.search;

                        // var filter_status = $('#filter_status').val();
                        // data.filter_status = filter_status;
                    }
                },
                "columns": [
                    { "data": 'id', 'name': 'users.id',"orderable": true},
                    { "data": "first_name", "name":'first_name', "orderable": true },
                    { "data": "last_name", "name":'last_name', "orderable": true },
                    { "data": "phone_number", "name":'phone_number', "orderable": true },
                    { "data": "email", "name":'email', "orderable": true },
                    { "data": "created_at", "name":'created_at', "orderable": true },
                    { "data": "id", "name":'edit', "orderable": false, "sClass": "content-middel", 
	            	render: function ( data, type, row, meta) {
	            	    return '<a href="javascript:;" edit_item_id="'+row.id+'" class="btn btn-success item_edit btn-sm btn-circle"><i class="fas fa-edit"></i></a>';
	                }},
                ],
                "columnDefs": [
                    {"width": "5%", "targets": 0},
                    {"width": "15%", "targets": 1},
                    {"width": "15%", "targets": 2},
                    {"width": "25%", "targets": 3},
                    {"width": "20%", "targets": 4},
                    {"width": "15%", "targets": 5},
                    {"width": "5%", "targets": 6},
                ],
                "order": [
                    ['0', "desc"]
                ]
            });

            // $('#filter_status').change(function(){
            //     dataTable.draw();
            // });

            // Edit modal
            var itemPopup = new Popup;
                itemPopup.init({
                    size:'modal-lg',
                    identifier:'add-item',
                    minHeight: '200',
                })
                window.itemPopup = itemPopup;

                $('#dataTable').on('click', '.item_edit', function (e) {
                    editId = $(this).attr('edit_item_id');
                    itemPopup.setTitle('Edit client');
                    itemPopup.load("{{route('clientsEdit')}}?id="+editId, function () {
                        this.open();
                    });
                });
        });
    </script>
@endpush
@endsection