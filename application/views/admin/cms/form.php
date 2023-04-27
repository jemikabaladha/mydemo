<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header ">
                <h4 class="card-title d-inline-block"><?php echo $pagename ?></h4>
                <a class="btn btn-primary pull-right" href="<?php echo $page['url'] ?>"> Back </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form method="post" id="form" action="<?php echo $page['url'] ?>/set">
                            <input type="hidden" name="id" value="<?php echo isset($data->id)?$data->id:"" ?>">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name"  value="<?php echo isset($data->name)?$data->name:"" ?>">
                            </div>
                            <div class="form-group">
                                <label>Key</label>
                                <input type="text" class="form-control" name="key"  value="<?php echo isset($data->key)?$data->key:"" ?>">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea type="text" class="form-control" name="description" id="editor"><?php echo isset($data->description)?$data->description:"" ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="1" <?php echo isset($data->status) && $data->status == '1' ? 'selected' : '' ?>>Active</option>
                                    <option value="0" <?php echo isset($data->status) && $data->status == '0' ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-fill btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	$("#form").validate({
		rules: {
			name: {
				required: true,
				normalizer: function(value) {
					return $.trim(value);
				},
			},
			key: {
				required: true,
				normalizer: function(value) {
					return $.trim(value);
				},
			},
            description: {
				required: true,
				normalizer: function(value) {
					return $.trim(value);
				},
			},
		},
		messages: {
            name: {
				required: "Please enter name",
			},
            key: {
				required: "Please enter cms key",
			},
            description: {
				required: "Please enter description",
			},
		},
    });
    CKEDITOR.replace('editor');
</script>