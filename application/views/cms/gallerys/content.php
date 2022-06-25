<?php $this->load->view('cms/template/header');?>
<div class="page-content">

    <div class="page-title actions-toolbar">
        <form class="actions-search text-muted" id="actions-search">
            <div class="input-group input-group-merge input-group-flush">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-transparent">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
                <input type="text" name="q" class="form-control form-control-flush text-muted" value="<?=$this->input->get('q')?>" placeholder="Type a name of event and hit enter" value="" autocomplete="off">
                <div class="input-group-append">
                    <a href="#" class="input-group-text bg-transparent" data-action="search-close" data-target="#actions-search"><i class="fas fa-times"></i></a>
                </div>
            </div>
        </form>

        <div class="row justify-content-between align-items-center pt-2 pb-2">
            <div class="col-md-6 col-6 d-flex align-items-center justify-content-between justify-content-md-start">
                <div class="d-inline-block">
                    <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Gallery</h5>
                    <br>
                    <span class="text-white opacity-7 mr-1">Total:</span>
                    <strong class="text-white mr-1"><?=$total_photos?></strong>
                    <span class="text-white opacity-7">Images</span>
                    <strong class="text-white mr-2 ml-2">|</strong>
                    <strong class="text-white mr-1"><?=$total_videos?></strong>
                    <span class="text-white opacity-7">Videos</span>
                </div>

                <div class="align-items-center d-inline-flex mt-1">

                </div>
            </div>
            <div class="col-md-6 col-6 d-flex align-items-right justify-content-md-end justify-content-end">
                <div class="actions actions-dark d-lg-block d-none">
                    <a href="#" data-toggle="modal" data-target="#modalCreateVid" class="btn btn-xs btn-secondary btn-icon rounded-pill ">
                        <span class="btn-inner--icon"><i class="uil uil-plus"></i>Add New Video</span>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#modalUpdateStatus" class="btn btn-xs btn-secondary btn-icon rounded-pill">
                        <span class="btn-inner--icon"><i class="uil uil-plus"></i>Add New Image</span>
                    </a>
                    <a href="#" class="action-item ml-3" data-action="search-open" data-target="#actions-search">
                        <i class="fas fa-search mr-2"></i>
                        <span class="pl-0 d-none d-sm-none d-md-inline">Search</span>
                    </a>
                </div>
                <div class="actions actions-dark d-inline-block d-none d-lg-none ">
                    <a href="#" data-toggle="modal" data-target="#modalCreateVid" class="btn btn-xs btn-secondary rounded-circle btn-icon-only">
                        <span class="btn-inner--icon"><i class="fas fa-video"></i></span>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#modalUpdateStatus" class="btn btn-xs btn-secondary rounded-circle btn-icon-only">
                        <span class="btn-inner--icon"><i class="fas fa-image "></i></span>
                    </a>
                    <a href="#" class="btn btn-xs btn-secondary rounded-circle btn-icon-only " data-action="search-open" data-target="#actions-search">
                        <i class="fas fa-search"></i>
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
                        <?php if($row['type']=='P'){ $images = json_decode($row['media']);foreach ($images as $idx => $item) {if($idx==0){?>
                            <a href="<?=$item?>" target="_blank" class="group-item image-square" data-fancybox="img<?=$row['id']?>">
                                <img alt="" src="<?=$item?>" class="" style="width: 100%;">
                            </a>
                            <?php } else {?>
                            <a href="<?=$item?>" target="_blank" class="group-item image-square d-none" data-fancybox="img<?=$row['id']?>"></a>
                        <?php }}} else{?>
                        <a href="https://www.youtube.com/embed/<?=$row['media']?>?autoplay=0" target="_blank" class="group-item image-square" data-fancybox="vid<?=$row['id']?>">
                            <img alt="" src="https://img.youtube.com/vi/<?=$row['media']?>/hqdefault.jpg" class="" style="width: 100%;">
                        </a>
                        <?php }?>
                    </div>
                    <div class="card-body text-center">
                        <h5><?=$row['title']?></h5>
                    </div>
                    <div class="card-footer delimiter-top">
                        <div class="row">
                            <div class="col text-center">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item pr-1 ">
                                        <a href="#" data-index='<?=$key?>' class="editb">
                                            <span data-toggle="tooltip" data-original-title="Edit this content">
                                                <i class="fas fa-pencil-alt"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" data-id="<?=$row['id']?>" class="text-muted deleteb">
                                            <span data-toggle="tooltip" title="" data-original-title="Delete this content">
                                                <i class="fas fa-trash text-danger"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <span class="mr-1 ml-1"> | </span>
                                    <li class="list-inline-item pr-1">
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
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form class="modal-content form-package" action="<?php echo base_url('cms/gallerys/save'); ?>" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Gallery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="st-address">Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <!-- <div class="form-group">
                    <label for="st-content">Description</label>
                    <div data-toggle="quill" data-quill-placeholder="Description"></div>
                    <textarea name="Description" class="form-control" style="display:none;" rows="4"></textarea>
                </div> -->
                <div class="form-group">
                    <label for="st-address">Images</label>
                    <div>
                        <input type="file" name="fileImg[]" id="file-1" class="custom-input-file" data-multiple-caption="{count} files selected" multiple required/>
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

<div class="modal fade" id="modalCreateVid" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form class="modal-content form-package" action="<?php echo base_url('cms/gallerys/save_vidio'); ?>" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Gallery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="st-address">Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <!-- <div class="form-group">
                    <label for="st-content">Description</label>
                    <div data-toggle="quill" data-quill-placeholder="Description"></div>
                    <textarea name="Description" class="form-control" style="display:none;" rows="4"></textarea>
                </div> -->
                <div class="form-group">
                    <label for="st-address">Youtube Embed Code</label>
                    <input type="text" name="media" class="form-control" required>
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
        <form class="modal-content" action="<?php echo base_url('cms/gallerys/update'); ?>" id="updateb" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" id="idb">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit Gallery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="st-address">Title</label>
                    <input type="text" name="title" id="gtitle" class="form-control" required>
                </div>
                <!-- <div class="form-group">
                    <label for="st-content">Description</label>
                    <div data-toggle="quill" data-quill-placeholder="Description" id="gdescription"></div>
                    <textarea name="Description" class="form-control" style="display:none;" rows="4"></textarea>
                </div> -->
                <div class="form-group">
                    <label for="st-address">Image Logo</label>
                    <div class="mb-2">
                        <input type="file" name="fileImg[]" id="file-2" class="custom-input-file" data-multiple-caption="{count} files selected" multiple/>
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
<div class="modal fade" id="modalUpdateDataVid" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" action="<?php echo base_url('cms/gallerys/update_video'); ?>" id="updatebv" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" id="idbv">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit Gallery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="st-address">Title</label>
                    <input type="text" name="title" id="gtitlev" class="form-control" required>
                </div>
                <!-- <div class="form-group">
                    <label for="st-content">Description</label>
                    <div data-toggle="quill" data-quill-placeholder="Description" id="gdescriptionv"></div>
                    <textarea name="Description" class="form-control" style="display:none;" rows="4"></textarea>
                </div> -->
                <div class="form-group">
                    <label for="st-address">Youtube Embed Code</label>
                    <input type="text" name="media" id="gcode" class="form-control" required>
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
        // $('.form-package').submit(function(e){
        //     $('.ql-editor').each(function(){
        //         $(this).closest('.form-group').find('textarea').val($(this).html())
        //     })
        // })
        $('.publishb').click(function(e){
            e.preventDefault()
            let id = $(this).data('id'),status =$(this).data('status')
            // console.log(status) 
            $.ajax({
                url: "<?php echo base_url('cms/gallerys/publish'); ?>",
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
            let data = tableData[$(this).data('index')];
            if(data.type == 'P'){
                $('#idb').val(data.id)
                $('#gtitle').val(data.title)
                $('#gdescription .ql-editor').html(data.description)
                $('#modalUpdateData').modal('toggle')
            }else{
                $('#idbv').val(data.id)
                $('#gtitlev').val(data.title)
                $('#gcode').val(data.media)
                $('#gdescriptionv .ql-editor').html(data.description)
                $('#modalUpdateDataVid').modal('toggle')
            }
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
                            url: "<?php echo base_url('cms/gallerys/delete'); ?>",
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
            // $('.ql-editor').each(function(){
            //     $(this).closest('.form-group').find('textarea').val($(this).html())
            // })

            let formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('cms/gallerys/update'); ?>",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    swal.fire({
                        title: "Success!",
                        text: "Success to save update gallerys!",
                        // confirmButtonColor: '#c6b187'
                    }).then(function() {
                        window.location.reload()
                    });
                }
            });
        });

        $('#updatebv').submit(function(e){
            e.preventDefault();
            // $('.ql-editor').each(function(){
            //     $(this).closest('.form-group').find('textarea').val($(this).html())
            // })

            let formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('cms/gallerys/update_video'); ?>",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    swal.fire({
                        title: "Success!",
                        text: "Success to save update gallerys!",
                        // confirmButtonColor: '#c6b187'
                    }).then(function() {
                        window.location.reload()
                    });
                }
            });
        });


    });
</script>