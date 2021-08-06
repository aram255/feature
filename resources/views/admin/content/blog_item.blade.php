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
                    <div class="form-group">
                        <span class="el_item">
                            <label style="font-weight:normal;">Image</label>
                            <div class="image-upload-container" id="cover">
                                <div class="image-part">
                                    <img class="thumbnail" src="@if($item->image) {{$item->image->path}} @else {!! asset('backend/img/no_image.png') !!} @endif" alt=""/>
                                </div>
                                <div class="image-action @if($item->image) fileExist @else fileNotExist @endif">
                                    <div class="img-not-exist">
                                        <input type="file" />
                                    </div>
                                    <div class="img-exist">
                                        <input type="hidden" name="file" class="uploaded_file_id" value="@if($item->image) {{$item->image->id}} @endif" />
                                        <button class="btn btn-danger remove-image" type="button">Remove</button>
                                    </div>
                                </div>
                            </div>

                            <div id="progress"></div>
                            <div id="progressBar"></div>
                        </span>
                    </div>
                    <div class="my-2"></div>
                    <div class="form-group">
                        <span class="el_item">Slug (url):
                            <input type="text" name="system_name" value="{{$item->system_name}}" class="form-control" />
                        </span>
                    </div>
                    <div class="my-2"></div>
                    <div class="form-group">
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
                    <div class="form-group">
                        <span >Description:
                            <textarea id="" name="description" class="form-control" rows="4" cols="50">{{$item->description}}</textarea>
                        </span>
                    </div>
                    <div class="my-2"></div>
                    <div class="form-group">
                        <span >Text:
                            <textarea id="" name="text" class="form-control " rows="4" cols="50">{{$item->text}}</textarea>
                        </span>
                    </div>
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
    tinymce.triggerSave();
    tinymce.remove('.mytextarea');

    var data = $('#save-item-form').serializeFormJSON();

    $.ajax({
        type: "POST",
        url: "{{route('adminBlogSave')}}",
        data: data,
        dataType: 'json',
        success: function(response){
            if(response.status == 0){
                toastr['error'](response.message, 'Error');
            }
            if(response.status == 1){
                tinymce.execCommand('mceRemoveControl', true, '.mytextarea');
                toastr['success']('Saved.', 'Success');
                @if($mode == 'add') dataTable.ajax.reload(); @else dataTable.ajax.reload(null, false); @endif
                itemPopup.close();
            }
            Loading.remove($('#saveItemBtn'));
        }
    });
}
$(document).ready(function(){

      tinymce.init({
        selector: '.mytextarea',
        height: 400,
      });

    //   $('.modal#add-item').on('hide.bs.modal', function (e) {
    //     tinymce.execCommand('mceRemoveControl', true, '.mytextarea');
    //   })

    $('input[type=file]').change(function(){

        $(this).simpleUpload("{{route('adminUploadImage')}}", {
            start: function(file){
                $('#progress').html("");
                $('#progressBar').width(0);
            },
            progress: function(progress){
                $('#progress').html("Progress: " + Math.round(progress) + "%");
                $('#progressBar').width(progress + "%");
            },
            success: function(data){
                if (data.status == 1) {
                    $('.uploaded_file_id').val(data.imageId)
                    $('.image-upload-container').find('.image-part img').attr('src',data.path);
                    $('#progress').html("");
                    $('.image-upload-container').find('.image-action').removeClass('fileNotExist').addClass('fileExist');
				} else {
					var error = data.message;
					$('#progress').html(error);
				}
            },
            error: function(error){
                $('#progress').html("Failure!<br>" + error.name + ": " + error.message);
            }
        });
    });

    $('.remove-image').click(function() {
        uploadImageContainer = $('.image-upload-container');
        removeImageId = $('.uploaded_file_id').val();

        owner_id = uploadImageContainer.parents("form").find('#id').val();
        owner_type = 'blog';

        $.ajax({
            type: "POST",
            url: "{{route('adminRemoveImage')}}",
            dataType: 'JSON',
            data:{imageId:removeImageId,owner_id:owner_id,owner_type:owner_type},
            success: function(response){
                uploadImageContainer.find('.image-part img').attr('src','/backend/img/no_image.png');
                uploadImageContainer.find('.uploaded_file_id').val('');
                uploadImageContainer.find('.image-action').removeClass('fileExist').addClass('fileNotExist');
            }
        });
    });
});
</script>
