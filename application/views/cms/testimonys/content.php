<?php $this->load->view('cms/template/header');?>
<div class="page-content">
<div class="page-title">
    <div class="row justify-content-between align-items-center">
        <div class="col-md-6 col-6 d-flex align-items-center justify-content-between justify-content-md-start">
            <div class="d-inline-block">
                <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Testimony</h5>
            </div>
        </div>
        <div class="col-md-6 col-6 d-flex align-items-center justify-content-end justify-content-md-end">
            <div class="actions actions-dark d-inline-block">
                <a href="#" data-toggle="modal" data-target="#modalUpdateStatus" class="ml-n4 btn btn-xs btn-secondary btn-icon rounded-pill">
                    <span class="btn-inner--icon"><i class="uil uil-plus"></i>Add New</span>
                </a>
            </div>
        </div>
    </div>
</div>

<?php if (isset($data) && is_array($data) && count($data)): ?>
    <div class="row list-dresses mt-4">
        <?php foreach ($data as $key => $row): ?>
            <div class="col-xl-3 col-lg-4 col-sm-6 item">
                <div class="card overflow-hidden">
                    <div class="item-image-group p-2">
                        <a href="<?=$row['image']?>" target="_blank" class="group-item image-square" data-fancybox="a1">
                            <img alt="" src="<?=$row['image']?>" class="" style="width: 100%;">
                        </a>
                    </div>
                    <div class="card-body text-center">
                        <h5><?=$row['name']?></h5>
                        <span class="text-sm text-muted"><?=$row['profession']?></span>
                        <p><?=$row['message']?></p>
                    </div>
                    <div class="card-footer delimiter-top">
                        <div class="row">
                            <div class="col text-center">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item pr-1">
                                        <a href="#" data-index='<?=$key?>' class="editb" data-toggle="modal" data-target="#modalUpdateData">
                                            <span data-toggle="tooltip" data-original-title="Edit this testimony">
                                                <i class="fas fa-pencil-alt"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" data-id="<?=$row['id']?>" class="text-muted deleteb">
                                            <span data-toggle="tooltip" title="" data-original-title="Delete this testimony">
                                                <i class="fas fa-trash text-danger"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <span class="mr-1 ml-1"> | </span>
                                    <li class="list-inline-item">
                                        <div class="d-flex">
                                            <label class="form-control-label mr-2 ">Publish:</label>
                                            <div data-id="<?=$row['id']?>" data-status="<?=$row['status']?>"  class="custom-control custom-switch publishb" data-toggle="tooltip" title="" data-original-title="Publish/Unpublish">
                                                <input type="checkbox" class="custom-control-input" <?= $row['status']?'checked':'' ?>>
                                                <label class="custom-control-label" for="hijab"></label>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="mt-4 mb-4 d-flex align-items-center">
        <div class="m-auto">
            <?php echo $paging; ?>
        </div>
    </div>
<?php else: ?>
    <div class="mt-3 mb-3 bg-white border border-warning rounded p-4 text-center">
        <i class="fas fa-exclamation-triangle fa-2x"></i>
        <div class="text-muted mt-2">No data found</div>
    </div>
    <div style="height: 200px"></div>
<?php endif; ?>

<div class="modal fade" id="modalUpdateStatus" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" action="<?php echo base_url('cms/testimonys/save'); ?>" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Testimony</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="st-address">Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="st-address">Profession</label>
                    <input type="text" name="profession" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="st-message">Message</label>
                    <textarea name="message" class="form-control" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="st-address">Image Avatar</label>
                    <div>
                        <input type="file" name="fileImg" id="file-1" class="custom-input-file" required/>
                        <label for="file-1">
                            <i class="fa fa-upload"></i>
                            <span>Choose a file…</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save!</button>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="modalUpdateData" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" action="<?php echo base_url('cms/testimonys/update'); ?>" id="updateb" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" id="idb">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit Testimony</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="st-address">Name</label>
                    <input type="text" name="name" id="tname" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="st-address">Profession</label>
                    <input type="text" name="profession" id="tprofession" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="st-message">Message</label>
                    <textarea name="message" id="tmessage" class="form-control" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="st-address">Image Avatar</label>
                    <div class="mb-2">
                        <input type="file" name="fileImg" id="file-2" class="custom-input-file"/>
                        <label for="file-2">
                            <i class="fa fa-upload"></i>
                            <span>Choose a file…</span>
                        </label>
                    </div>
                    <span>Don't select the file if you don't want to change the image</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save!</button>
            </div>
        </form>
    </div>
</div>
</div>
<?php $this->load->view('cms/template/footer');?> 
<script>
    let tableData = <?=json_encode($data);?>;
    $('document').ready(function(){
        <?php if($this->session->flashdata('success')==true){?>
            Swal.fire({
                title: 'Success',
                text: "Success to save data",
            })
        <?php }?>
    })
    $(function () {
        $('.publishb').click(function(e){
            e.preventDefault()
            let id = $(this).data('id'),status =$(this).data('status')
            // console.log(status) 
            $.ajax({
                url: "<?php echo base_url('cms/testimonys/publish'); ?>",
                type: "post",
                data: {
                    id: id,
                    status: !status?1:0
                },
                dataType: "json",
                success: function (resp) {
                    window.location.reload()
                }
            });
        })

        $('.editb').click(function(e){
            e.preventDefault()
            let index = $(this).data('index');

            $('#idb').val(tableData[index].id)
            $('#tname').val(tableData[index].name)
            $('#tprofession').val(tableData[index].profession)
            $('#tmessage').html(tableData[index].message)
         })

        // delete item
        $('.deleteb').bind("click", function(e){
            e.preventDefault();

            let $item = $(this).closest(".item"),
                id = $(this).data("id");

            MessageBox.confirm({
                message: "Are you sure you want to delete this item?",
                callback: function(btn) {
                    if(btn === "Y") {

                        $.ajax({
                            url: "<?php echo base_url('cms/testimonys/delete'); ?>",
                            type: "post",
                            data: {id: id},
                            dataType: "json",
                            success: function (resp) {
                                window.location.reload()
                            }
                        });
                    }
                }
            });
        });

        $('#updateb').submit(function(e){
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('cms/testimonys/update'); ?>",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    swal.fire({
                        title: "Success!",
                        text: "Success to save update testimony!",
                        // confirmButtonColor: '#c6b187'
                    }).then(function() {
                        window.location.reload()
                    });
                }
            });
        });


    });
</script>