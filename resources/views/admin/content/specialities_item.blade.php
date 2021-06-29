<form id="save-item-form" method="post">
    <div class="row">
        @csrf
        <input type="hidden" name="id" id="id" value="{{$item->id}}" />
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Content</h6>
                </div>
                <div class="card-body">
                    <div class="form-group el_item">
                        <span class="el_item">Title:
                            <input type="text" name="title" value="{{$item->title}}" class="form-control" />
                        </span>
                    </div>
                    <div class="my-2"></div>   
                    <div class="form-group">
                        <span class="el_item">Published:
                            <select class="form-select form-control" name="published" aria-label="Default select example">
                                <option @if($item->published == 1) selected @endif value="1">Published</option>
                                <option @if($item->published == 0) selected @endif value="0">Unpublished</option>
                            </select>
                        </span>
                    </div>
                    <div class="my-2"></div>   
                </div>
            </div>
        </div>
    </div>
</form>
<div class="modal-buttons">
    <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" onclick="save()"  id="saveItemBtn" class="btn btn-success" data-dismiss="modal">Save</button>
</div>
<script>
        function save(){
            Loading.add($('#saveItemBtn'));

            var data = $('#save-item-form').serializeFormJSON();
            
            $.ajax({
                type: "POST",
                url: "{{route('adminSaveSpecialities')}}",
                data: data,
                dataType: 'json',
                success: function(response){
                    if(response.status == 0){
                        toastr['error'](response.message, 'Error');
                    }
                    if(response.status == 1){
                        toastr['success']('Saved.', 'Success');
                        @if($mode == 'add') dataTable.ajax.reload(); @else dataTable.ajax.reload(null, false); @endif
                        itemPopup.close();
                    }
                    Loading.remove($('#saveItemBtn'));
                }
            });  
        }
</script>