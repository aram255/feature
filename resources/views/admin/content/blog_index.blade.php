@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Blog</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>
    <!-- Modal -->
    <!-- <button type="button" class="btn btn-info openPopup" data-toggle="modal" data-href="">Upload file</button> -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button class="btn btn-primary" id="add_item" type="button">Add</button>
            <button class="btn btn-danger" id="remove_item" type="button">Remove</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="table-checkbox content-middel">
                                <input class="group-checkable sb-checkbox" type="checkbox" data-set="#items .checkboxes">
                            </th>
                            <th>Title</th>
                            <th>Edit</th>
                            <th>Published</th>
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
    <script src="/backend/vendor/datatables/datatable.types.js"></script>
    <script src="/backend/vendor/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $(document).ready(function() {
            // Init table
            var dataTable = $('#dataTable').DataTable({
                "processing": true,
                "serverSide": true,
                'searching': false,
                "ajax": {
                    "url": "{{ route('adminBlogData') }}",
                    "data": function(data){
                        data['sort_field'] = data.columns[data.order[0].column].name;
                        data['sort_dir'] =  data.order[0].dir;

                        delete data.columns;
                        delete data.order;
                        delete data.search;
                    }
                },
                "columns": [
                    { "data": 'id', 'name': 'blog.id',"orderable": false, "sClass": "content-middel",
                        render: function ( data, type, row, meta) {
                        return DataTypes.Checkbox.format(row);
                    }},
                    { "data": "title", "name":'blog.title', "orderable": true },
                    { "data": "id", "name":'edit', "orderable": false, "sClass": "content-middel",
	            	    render: function ( data, type, row, meta) {
	            	    return '<a href="javascript:;" edit_item_id="'+row.id+'" class="btn btn-success item_edit btn-sm btn-circle"><i class="fas fa-edit"></i></a>';
	                }},
                    { "data": "published", "name":'blog.published', "orderable": true, "sClass": "content-middel",
                        render: function ( data, type, row, meta) {
                        return DataTypes.Published.format(data,row);
                    }}
                ],
                "columnDefs": [
                    {"width": "5%", "targets": 0},
                    {"width": "75%", "targets": 1},
                    {"width": "10%", "targets": 2},
                    {"width": "10%", "targets": 3}
                ],
                "order": [
                    ['1', "asc"]
                ]
            });

            window.dataTable = dataTable;

            // Edit modal
            var itemPopup = new Popup;
            itemPopup.init({
                size:'modal-xl',
                identifier:'add-item',
                class: 'modal',
                minHeight: '200',
            })
            window.itemPopup = itemPopup;

            $('#dataTable').on('click', '.item_edit', function (e) {
                editId = $(this).attr('edit_item_id');
                itemPopup.setTitle('Edit blog');
                itemPopup.load("{{route('adminBlogGet')}}?id="+editId, function () {
                    this.open();
                });
            });

            $('#add_item').click(function() {
                itemPopup.setTitle('Add blog');
                itemPopup.load("{{route('adminBlogGet')}}", function () {
                    this.open();
                });
            });

            $('#dataTable').on('click', '.group-checkable', function (e) {
                var set = $('.sb-checkbox', $('#dataTable'));
                var checked = $(this).prop('checked');
                $(set).each(function () {
                    $(this).prop('checked', checked);
                });
            });
            ///
            $("#dataTable").on('click', '.item_published', function (e) {
                pubItemId = $(this).attr('pub_item_id');
                var $item = $(this);
                $.ajax({
                    type: "GET",
                    url: "{{route('adminBlogPublish')}}",
                    dataType: 'JSON',
                    data:{_token: "<?php echo csrf_token(); ?>", pubItemId:pubItemId},
                    success: function(response){
                        if(response.status == 1){
                            if(response.published == 1){
                                $item.removeClass('btn-dark').addClass('btn-success');
                                $item.find('.fa').removeClass('fa-exclamation-triangle').addClass('fa-check');
                            }else{
                                $item.removeClass('btn-success').addClass('btn-dark');
                                $item.find('.fa').removeClass('fa-check').addClass('fa-exclamation-triangle');
                            }
                        }
                    }
                });
            });

            // remove
            $('#remove_item').click(function() {

                var rows = [];
                $('.sb-checkbox:checked', $('#dataTable')).each(function () {
                    rows.push($(this).val());
                });

                if(rows.length < 1){
                    toastr['info']("Please select item", 'Information');
                }else{
                    ids = rows;
                    bootbox.confirm("Are you sure?", function(result) {
                        if(result){
                            $.ajax({
                            type: "POST",
                            url: "{{route('adminBlogRemove')}}",
                            dataType: 'JSON',
                            data:{_token: "<?php echo csrf_token(); ?>", ids:ids},
                                success: function(response){
                                    if(response.status == 1){
                                        if(response.status == 1){
                                            dataTable.ajax.reload(null, false);
                                        }else{
                                            toastr['error'](response.message, 'Error');
                                        }
                                    }
                                }
                            });
                        }
                    });
                }
            });
            ///

        });
    </script>
@endpush
@endsection
