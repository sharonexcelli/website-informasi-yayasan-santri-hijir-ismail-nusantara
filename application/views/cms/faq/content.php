<?php $this->load->view('cms/template/header');?>
<div class="page-content">
<div class="page-title">
    <div class="row justify-content-between align-items-center">
        <div class="col-md-6 col-6 d-flex align-items-center justify-content-between justify-content-md-start">
            <div class="d-inline-block">
                <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">FAQ</h5>
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
    <div class="card">
        <div class="table-responsive">
            <table class="table align-items-center ">
                <thead>
                    <tr>
                        <th width="35px">Order</th>
                        <th width="80%">Subject</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($data)foreach($data as $key => $v){ $badge = $v['status']=="1"?'<span class="badge badge-success">publish</span>':'<span class="badge badge-secondary">unpublish</span>';?>
                    <tr>
                        <td class="text-center"><?=$v['order'];?></td>
                        <td class="text-left"><?=$v['subject'];?></td>
                        <td><?=$badge;?></td>
                        <td class="text-center">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item pr-1">
                                    <div class="d-flex">
                                        <div data-id="<?=$v['id']?>" data-status="<?=$v['status']?>"  class="custom-control custom-switch publishb" data-toggle="tooltip" title="" data-original-title="Publish/Unpublish">
                                            <input type="checkbox" class="custom-control-input" <?= $v['status']?'checked':'' ?>>
                                            <label class="custom-control-label" for="hijab"></label>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-inline-item pr-1 ml-n3">
                                    <a href="#" data-index="<?=$key?>" class="editb" data-toggle="modal" data-target="#modalUpdateData">
                                        <span data-toggle="tooltip" data-original-title="Edit this content">
                                            <i class="fas fa-pencil-alt"></i>
                                        </span>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" data-id="<?=$v['id']?>" class="text-muted deleteb">
                                        <span data-toggle="tooltip" title="" data-original-title="Delete this content">
                                            <i class="fas fa-trash text-danger"></i>
                                        </span>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="<?=base_url('cms/faq/edit/'.$v['id'])?>" class="btn btn-xs btn-primary btn-icon rounded-pill">
                                        <span class="btn-inner--icon"><i class="fas fa-edit"></i></span>
                                        <span class="btn-inner--text">List</span>
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
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
        <div class="text-muted mt-2">Na
<?php endif; ?>

<div class="modal fade" id="modalUpdateStatus" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" action="<?php echo base_url('cms/faq/save'); ?>" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add FAQ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="st-address">Subject</label>
                    <input type="text" name="subject" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="st-address">Order</label>
                    <input type="number" name="order" class="form-control" required>
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
        <form class="modal-content" action="<?php echo base_url('cms/faq/update'); ?>" id="updateb" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" id="idb">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit FAQ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="st-address">Subject</label>
                    <input type="text" name="subject" id="stitle" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="st-address">Order</label>
                    <input type="number" name="order" id="sorder" class="form-control" required>
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
                url: "<?php echo base_url('cms/faq/publish'); ?>",
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

            $('#idb').val(data.id)
            $('#stitle').val(data.subject)
            $('#sorder').val(data.order)
         })

        // delete item
        $('.deleteb').bind("click", function(e){
            e.preventDefault();

            let $item = $(this).closest(".item"),
                id = $(this).data("id");

            MessageBox.confirm({
                message: "Are you sure you want to delete this content?",
                callback: function(btn) {
                    if(btn === "Y") {

                        $.ajax({
                            url: "<?php echo base_url('cms/faq/delete'); ?>",
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
                url: "<?php echo base_url('cms/faq/update'); ?>",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    swal.fire({
                        title: "Success!",
                        text: "Success to save update FAQ!",
                        // confirmButtonColor: '#c6b187'
                    }).then(function() {
                        window.location.reload()
                    });
                }
            });
        });


    });
</script>