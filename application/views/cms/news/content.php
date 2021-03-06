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
            <div class="col-md-6 col-5 d-flex align-items-center justify-content-between justify-content-md-start">
                <div class="d-inline-block">
                    <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">News</h5>
                    <br>
                    <span class="text-white opacity-7 mr-1">Total:</span>
                    <strong class="text-white mr-1"><?=$total_data?></strong>
                    <span class="text-white opacity-7">News</span>
                </div>

                <div class="align-items-center d-inline-flex mt-1">

                </div>
            </div>
            <div class="col-md-6 col-7 d-flex align-items-right justify-content-md-end justify-content-end">
                <div class="actions actions-dark d-inline-block">
                    <a href="#" data-toggle="modal" data-target="#modalUpdateStatus" id="showAddMdl" class="ml-n4 btn btn-xs btn-secondary btn-icon rounded-pill">
                        <span class="btn-inner--icon"><i class="uil uil-plus"></i>Add New</span>
                    </a>
                    <a href="#" class="action-item ml-3" data-action="search-open" data-target="#actions-search">
                        <i class="fas fa-search mr-2"></i>
                        <span class="pl-0 d-none d-sm-none d-md-inline">Search</span>
                    </a>


                </div>
            </div>
        </div>
    </div>

<?php if (isset($data) && is_array($data) && count($data)): ?>

    <div class="container-fluid masonry-container">
        <div class="row masonry mt-4">


<!--    <div class="row list-dresses mt-4">-->
        <?php if(is_array($data)) foreach ($data as $key => $row): ?>
            <div class="masonry-item col-xl-4 col-lg-4 col-sm-6 item">
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
                    <div class="card-body text-center">
                        <h5 class="text-center"><?=$row['title']?></h5>
                        <div>
                            <div class="mt-1 mb-2">
                            <?php $tags = explode(',', $row['tags']); foreach ($tags as $idx => $itm) {?>
                                <span class="badge badge-secondary badge-pill "><?=$itm?></span>
                            <?php }?>
                            </div>
                        </div>
                        <div class="mt-1">
                            <label class="form-control-label mr-3">Author: </label>
                            <span class="mr-1 ml-1"><?=$row['author_name']?></span>
                        </div>
                        <div class="mt-1">
                            <label class="form-control-label mr-3">Published: </label>
                            <span class="mr-1 ml-1 getDate" data-date="<?=$row['published_at']?>" data-format='LL'></span>
                        </div>
                    </div>
                    <div class="card-footer delimiter-top ">
                        <div class="row ">
                            <div class="col text-center ">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item pr-1 ml-n3">
                                        <a href="#" data-index='<?=$key?>' class="editb" data-toggle="modal" data-target="#modalUpdateData">
                                            <span data-toggle="tooltip" data-original-title="Edit this news">
                                                <i class="fas fa-pencil-alt"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" data-id="<?=$row['id']?>" class="text-muted deleteb">
                                            <span data-toggle="tooltip" title="" data-original-title="Delete this news">
                                                <i class="fas fa-trash text-danger"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <span class="mr-1 ml-1"> | </span>
                                    <li class="list-inline-item pr-1">
                                        <div class="d-flex">
                                            <label class="form-control-label mr-3">Publish</label>
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
<!--    </div>-->
        </div>
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
        <form class="modal-content" id="form-package" action="<?php echo base_url('cms/news/save'); ?>" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add News</h5>
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
                    <label for="st-message">Content</label>
                    <div data-toggle="quill" data-quill-placeholder="Content" id="crtncontent"></div>
                    <textarea name="content" class="form-control" style="display:none;" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="st-address">Image</label>
                    <div>
                        <input type="file" name="fileImg" id="file-1" class="custom-input-file" required/>
                        <label for="file-1">
                            <i class="fa fa-upload"></i>
                            <span>Choose a file???</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="st-address">Image Source</label>
                    <input type="text" name="image_source" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="st-address">Publish Date</label>
                    <input type="text" name="published_at" class="form-control" data-toggle="date" readonly required>
                </div>
                <div class="form-group">
                    <label for="st-address">Tags</label>
                    <input type="text" name="tags" class="form-control" data-toggle="tags"/>
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
        <form class="modal-content" action="<?php echo base_url('cms/news/update'); ?>" id="updateb" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" id="idb">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="st-address">Title</label>
                    <input type="text" name="title" id="ntitle" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="st-message">Content</label>
                    <div data-toggle="quill" data-quill-placeholder="Content" id="ncontent"></div>
                    <textarea name="content" class="form-control" style="display:none;" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="st-address">Image</label>
                    <div class="mb-2">
                        <input type="file" name="fileImg" id="file-2" class="custom-input-file"/>
                        <label for="file-2">
                            <i class="fa fa-upload"></i>
                            <span>Choose a file???</span>
                        </label>
                    </div>
                    <span>Don't select the file if you don't want to change the image</span>
                </div>
                <div class="form-group">
                    <label for="st-address">Image Source</label>
                    <input type="text" name="image_source" id="nisource" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="st-address">Publish Date</label>
                    <input type="text" name="published_at" id="ncreated" class="form-control" data-toggle="date" readonly required>
                </div>
                <div class="form-group">
                    <label for="st-address">Tags</label>
                    <input type="text" name="tags" id="ntags" class="form-control" data-toggle="tags"/>
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
    $('#form-package').submit(function(e){
        e.preventDefault();

        $('.ql-editor').each(function(){
            $(this).closest('.form-group').find('textarea').val($(this).html())
        })
        let formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('cms/news/save'); ?>",
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function(data) {
                if(data.error){
                    Swal.fire({
                        title: 'Error',
                        text: "Error to save data",
                    })
                }else{
                    Cookies.remove('newsContent')
                    swal.fire({
                        title: "Success!",
                        text: "Success to save news!",
                        // confirmButtonColor: '#c6b187'
                    }).then(function() {
                        window.location.reload()
                    });
                }
            }
        });
    })
    $(function () {
        $('#crtncontent .ql-editor').on('DOMSubtreeModified', function(){
            Cookies.set('newsContent', $(this).html())
        })
        $('#showAddMdl').click(function(){
            $('#crtncontent .ql-editor').html(Cookies.get('newsContent'))
        })
        $('.publishb').click(function(e){
            e.preventDefault()
            let id = $(this).data('id'),status =$(this).data('status')
            $.ajax({
                url: "<?php echo base_url('cms/news/publish'); ?>",
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
                url: "<?php echo base_url('cms/news/mark'); ?>",
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
            $('#ntitle').val(tableData[index].title)
            $('#ntags').tagsinput('removeAll')
            $('#nisource').val(tableData[index]['image_source'])
            tableData[index].tags.split(',').map(item=> {
                $('#ntags').tagsinput('add', item)
            })
            $('#ncreated').flatpickr({
                defaultDate: new Date(tableData[index].published_at)
            })
            $('#ncontent .ql-editor').html(tableData[index].content)
         })

        // delete item
        $('.deleteb').bind("click", function(e){
            e.preventDefault();

            let $item = $(this).closest(".item"),
                id = $(this).data("id");

            MessageBox.confirm({
                message: "Are you sure you want to delete this news?",
                callback: function(btn) {
                    if(btn === "Y") {

                        $.ajax({
                            url: "<?php echo base_url('cms/news/delete'); ?>",
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
                url: "<?php echo base_url('cms/news/update'); ?>",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    swal.fire({
                        title: "Success!",
                        text: "Success to save update news!",
                        // confirmButtonColor: '#c6b187'
                    }).then(function() {
                        window.location.reload()
                    });
                }
            });
        });


    });
</script>