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
                <input type="hidden" name="ds" value="<?=$this->input->get('ds')?>">
                <input type="hidden" name="de" value="<?=$this->input->get('de')?>">
                <input type="text" name="q" class="form-control form-control-flush text-muted" value="<?=$this->input->get('q')?>" placeholder="Type a name of event and hit enter" value="" autocomplete="off">
                <div class="input-group-append">
                    <a class="input-group-text bg-transparent" data-action="search-close" data-target="#actions-search"><i class="fas fa-times"></i></a>
                </div>
            </div>
        </form>

        <div class="row justify-content-between align-items-center pt-2 pb-2">
            <div class="col-md-6 col-5 d-flex align-items-center justify-content-between justify-content-md-start">
                <div class="d-inline-block">
                    <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Events</h5>
                    <br>
                    <span class="text-white opacity-7 mr-1">Total:</span>
                    <strong class="text-white mr-1"><?=$total_data?></strong>
                    <span class="text-white opacity-7">Events</span>
                </div>

                <div class="align-items-center d-inline-flex mt-1">

                </div>
            </div>
            <div class="col-md-6 col-7 d-flex align-items-right justify-content-md-end justify-content-end">
                <div class="actions actions-dark d-inline-block">
                    <a href="#" data-toggle="modal" data-target="#modalUpdateStatus" class="ml-n4 btn btn-xs btn-secondary btn-icon rounded-pill">
                        <span class="btn-inner--icon"><i class="uil uil-plus"></i>Add New</span>
                    </a>
                    <a href="#" class="action-item ml-3" data-action="search-open" data-target="#actions-search">
                        <i class="fas fa-search mr-2"></i>
                        <span class="pl-0 d-none d-sm-none d-md-inline">Search</span>
                    </a>
                    <a href="#" class="action-item ml-3" data-toggle="modal" data-target="#modalFilter">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        <span class="pl-0 d-none d-sm-none d-md-inline">Filter by Date</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

<?php if (isset($data) && is_array($data) && count($data)): ?>
    <div class="row list-dresses mt-4">
        <?php foreach ($data as $key => $row): ?>
            <div class="col-xl-4 col-lg-4 col-sm-6 item">
                <div class="card overflow-hidden">
                    <div class="item-image-group p-2">
                        <a href="<?=$row['image']?>" target="_blank" class="group-item image-square" data-fancybox="a1">
                            <img alt="" src="<?=$row['image']?>" class="" style="width: 100%;">
                        </a>
                        <a href="#" data-id="<?=$row['id']?>" data-mark="<?=$row['mark']?>"
                           data-toggle="tooltip" title="" data-original-title="Mark/UnMark"
                           class="markb item-mark <?php echo($row['mark'] == '1' ? 'active' : ''); ?>">
                            <i class="fas fa-thumbtack"></i>
                        </a>
                    </div>
                    <div class="card-body text-left">
                        <h5 class="text-center"><?=$row['title']?></h5>
                        <div class="row align-items-center">
                            <div class="col">
                                <span class="text-sm mb-0 text-muted">Start Date</span>
                            </div>
                            <div class="col-auto">
                                <span class="text-sm text-muted"><?=date_format(date_create($row['start_at']),'j M y H:i')?></span>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col">
                                <span class="text-sm mb-0 text-muted">End Date</span>
                            </div>
                            <div class="col-auto">
                                <span class="text-sm text-muted"><?=date_format(date_create($row['end_at']),'j M y H:i')?></span>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="row">
                            <div class="col">
                                <i class="fa fa-map-marker mr-1"></i>
                                <span class="text-sm text-muted"><?=$row['location']?></span>
                            </div>
                        </div>
                        <div class="mt-1">
                            <label class="form-control-label mr-3">Author: </label>
                            <span class="mr-1 ml-1"><?=$row['author_name']?></span>
                        </div>
                    </div>
                    <div class="card-footer delimiter-top ">
                        <div class="row ">
                            <div class="col text-center ">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item pr-1 ml-n3">
                                        <a href="#" data-index='<?=$key?>' class="editb" data-toggle="modal" data-target="#modalUpdateData">
                                            <span data-toggle="tooltip" data-original-title="Edit this event">
                                                <i class="fas fa-pencil-alt"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" data-id="<?=$row['id']?>" class="text-muted deleteb">
                                            <span data-toggle="tooltip" title="" data-original-title="Delete this event">
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
        <form class="modal-content" id="form-package" action="<?php echo base_url('cms/events/save'); ?>" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="st-address">Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="st-message">Description</label>
                    <div data-toggle="quill" data-quill-placeholder="Description"></div>
                    <textarea name="description" class="form-control" style="display:none;" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="st-address">Image</label>
                    <div>
                        <input type="file" name="fileImg" id="file-1" class="custom-input-file" required/>
                        <label for="file-1">
                            <i class="fa fa-upload"></i>
                            <span>Choose a file…</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="st-address">Location</label>
                    <input type="text" name="location" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="st-address">Start Date</label>
                            <input type="text" name="start_at" class="form-control" data-toggle="datetime" readonly required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="st-address">End Date</label>
                            <input type="text" name="end_at" class="form-control" data-toggle="datetime" readonly required>
                        </div>
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
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form class="modal-content" action="<?php echo base_url('cms/events/update'); ?>" id="updateb" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" id="idb">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="st-address">Title</label>
                    <input type="text" name="title" id="etitle" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="st-message">Description</label>
                    <div data-toggle="quill" data-quill-placeholder="Description" id="edescription"></div>
                    <textarea name="description" class="form-control" style="display:none;" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="st-address">Image</label>
                    <div class="mb-2">
                        <input type="file" name="fileImg" id="file-2" class="custom-input-file"/>
                        <label for="file-2">
                            <i class="fa fa-upload"></i>
                            <span>Choose a file…</span>
                        </label>
                    </div>
                    <span>Don't select the file if you don't want to change the image</span>
                </div>
                <div class="form-group">
                    <label for="st-address">Location</label>
                    <input type="text" name="location" id="elocation" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="st-address">Start Date</label>
                            <input type="text" name="start_at" id="estart" class="form-control" data-toggle="datetime" readonly required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="st-address">End Date</label>
                            <input type="text" name="end_at" id="eend" class="form-control" data-toggle="datetime" readonly required>
                        </div>
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
<div class="modal fade" id="modalFilter" role="dialog" data-backdrop="static" aria-labelledby="modalFilter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFilterLabel">Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="q" value="<?=$this->input->get('q')?>">
                <div class="form-group">
                    <label for="st-address">Start Date</label>
                    <input type="number" name="ds" id="ds" class="form-control" data-toggle="date" readonly>
                </div>
                <div class="form-group">
                    <label for="st-address">End Date</label>
                    <input type="number" name="de" id="de" class="form-control" data-toggle="date" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Filter!</button>
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
    $('#form-package').submit(function(e){
        $('.ql-editor').each(function(){
            $(this).closest('.form-group').find('textarea').val($(this).html())
        })
    })
    $(function () {
        <?php if($this->input->get('ds')!=''){?>
            $('#ds').flatpickr({
                defaultDate: new Date('<?=$this->input->get('ds')?>')
            })
        <?php }?>
        <?php if($this->input->get('de')!=''){?>
            $('#de').flatpickr({
                defaultDate: new Date('<?=$this->input->get('de')?>')
            })
        <?php }?>

        $('.publishb').click(function(e){
            e.preventDefault()
            let id = $(this).data('id'),status =$(this).data('status')
            $.ajax({
                url: "<?php echo base_url('cms/events/publish'); ?>",
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

        $('.markb').click(function(e){
            e.preventDefault()
            let id = $(this).data('id'),mark =$(this).data('mark')
            $.ajax({
                url: "<?php echo base_url('cms/events/mark'); ?>",
                type: "post",
                data: {
                    id: id,
                    mark: !mark?1:0
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
            $('#etitle').val(tableData[index].title)
            $('#elocation').val(tableData[index].location)
            $('#estart').flatpickr({
                enableTime: true,
                defaultDate: new Date(tableData[index].start_at)
            })
            $('#eend').flatpickr({
                enableTime: true,
                defaultDate: new Date(tableData[index].end_at)
            })
            $('#edescription .ql-editor').html(tableData[index].description)
         })

        // delete item
        $('.deleteb').bind("click", function(e){
            e.preventDefault();

            let $item = $(this).closest(".item"),
                id = $(this).data("id");

            MessageBox.confirm({
                message: "Are you sure you want to delete this event?",
                callback: function(btn) {
                    if(btn === "Y") {

                        $.ajax({
                            url: "<?php echo base_url('cms/events/delete'); ?>",
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
            $('.ql-editor').each(function(){
                $(this).closest('.form-group').find('textarea').val($(this).html())
            })
            let formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('cms/events/update'); ?>",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    swal.fire({
                        title: "Success!",
                        text: "Success to save update events!",
                        // confirmButtonColor: '#c6b187'
                    }).then(function() {
                        window.location.reload()
                    });
                }
            });
        });


    });
</script>