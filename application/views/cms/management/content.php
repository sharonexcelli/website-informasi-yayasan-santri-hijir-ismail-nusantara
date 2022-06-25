<?php $this->load->view('cms/template/header');?>
<div class="page-content">
<div class="page-title">
    <div class="row justify-content-between align-items-center">
        <div class="col-md-6 col-6 d-flex align-items-center justify-content-between justify-content-md-start">
            <div class="d-inline-block">
                <h5 class="h4 d-inline-block font-weight-400 mb-0 text-white">Data Pengurus</h5>
                <br>
                <span class="text-white opacity-7 mr-1">Total:</span>
                <strong class="text-white mr-1"><?=$total_data?></strong>
                <span class="text-white opacity-7">Pengurus</span>
            </div>
        </div>
        <div class="col-md-6 col-6 d-flex align-items-center justify-content-end justify-content-md-end">
            <div class="actions actions-dark d-inline-block">
                <a href="#" data-toggle="modal" data-target="#modalUpdateStatus" class="ml-n4 btn btn-xs btn-secondary btn-icon rounded-pill">
                    <span class="btn-inner--icon"><i class="uil uil-plus"></i>Add New</span>
                </a>
                <a href="#" class="action-item ml-lg-3 ml-md-3 ml-1" data-toggle="modal" data-target="#modalFilter">
                    <i class="fas fa-filter mr-2"></i>
                    <span class="pl-0 d-none d-sm-none d-md-inline">Filter By</span>
                </a>
                <a href="#" id="export" class="action-item ml-lg-3 ml-md-3 ml-1" data-toggle="modal" data-target="#modalDressCategory">
                    <i class="fas fa-download mr-2"></i>
                    <span class="pl-0 d-none d-sm-none d-md-inline">Export Data</span>
                </a>
            </div>
        </div>
    </div>
</div>

    <div class="card">
        <div class="card-header actions-toolbar border-0">
            <div class="actions-search" id="actions-search">
                <form class="w-100">
                <div class="input-group input-group-merge input-group-flush">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent"><i class="uil uil-search"></i></span>
                    </div>
                    <input type="text" name="q" class="form-control form-control-flush" value="<?=$this->input->get('q')?>" placeholder="Type and hit enter ...">
                    <input type="hidden" name="s" value="<?=$this->input->get('s')?>">
                    <input type="hidden" name="pt" value="<?=$this->input->get('pt')?>">
                    <input type="hidden" name="p" value="<?=$this->input->get('p')?>">
                    <input type="hidden" name="pp" value="<?=$this->input->get('pp')?>">
                    <div class="input-group-append">
                        <a href="#" class="input-group-text bg-transparent" data-action="search-close" data-target="#actions-search"><i class="uil uil-times"></i></a>
                    </div>
                </div>
                </form>
            </div>
            <div class="row justify-content-between align-items-center">
                <div class="col">
                    <h6 class="d-inline-block mb-0">Table Data Pengurus</h6>
                </div>
                <div class="col text-right">
                    <div class="actions">
                        <a href="#" class="action-item mr-3" data-action="search-open" data-target="#actions-search"><i class="fas fa-search"></i></a>
                        <div class="dropdown mr-3">
                            <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-sort"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-164px, 25px, 0px);">
                                <a class="dropdown-item <?=$this->input->get('s')=='1'||$this->input->get('s')==''?'active':''?>" href="<?= base_url('cms/management?q='.$this->input->get('q').'&s=1&pt='.$this->input->get('pt').'&p='.$this->input->get('p').'&pp='.$this->input->get('pp'))?>">
                                    <i class="uil uil-sort-amount-down"></i>Newest
                                </a>
                                <a class="dropdown-item <?=$this->input->get('s')=='2'?'active':''?>" href="<?= base_url('cms/management?q='.$this->input->get('q').'&s=2&pt='.$this->input->get('pt').'&p='.$this->input->get('p').'&pp='.$this->input->get('pp'))?>">
                                    <i class="uil uil-sort-amount-up"></i>Oldest
                                </a>
                                <a class="dropdown-item <?=$this->input->get('s')=='3'?'active':''?>" href="<?= base_url('cms/management?q='.$this->input->get('q').'&s=3&pt='.$this->input->get('pt').'&p='.$this->input->get('p').'&pp='.$this->input->get('pp'))?>">
                                    <i class="fa fa-sort-alpha-down"></i>From A-Z
                                </a>
                                <a class="dropdown-item <?=$this->input->get('s')=='4'?'active':''?>" href="<?= base_url('cms/management?q='.$this->input->get('q').'&s=4&pt='.$this->input->get('pt').'&p='.$this->input->get('p').'&pp='.$this->input->get('pp'))?>">
                                    <i class="fa fa-sort-alpha-up"></i>From Z-A
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (isset($data) && is_array($data) && count($data)): ?>
        <div class="table-responsive">
            <table class="table align-items-center ">
                <thead>
                    <tr>
                        <th width="35px">No</th>
                        <th width="25%">Name</th>
                        <th width="15%">Address</th>
                        <th width="25%">Position</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($data))foreach($data as $key => $v){ ?>
                    <tr>
                        <td class="text-center"><?=(($page-1)*$limit)+($key+1);?></td>
                        <td class="text-left">
                            <div class="d-flex align-items-center">
                                <div>
                                    <img class="avatar bg-primary text-white rounded-circle" src="<?=$v['image']?>" alt="">
                                </div>
                                <div class="flex-fill ml-3">
                                    <div class="h6 text-sm mb-0"><?=$v['name'];?></div>
                                    <p class="text-sm lh-140 mb-0">
                                        <i class="fas fa-phone"></i> <?=$v['phone'];?><br>
                                        <i class="fa fa-linkedin"></i> <?=$v['social_linkedin'];?><br>
                                        <i class="fa fa-twitter"></i> <?=$v['social_twitter'];?>
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="text-left"><?=$v['address']?></td>
                        <td class="text-left">
                            <?php if($v['position_central_office']!=''&&$v['position_central_office']!=0){?>
                                <span>Kantor Pusat : <?=$v['position_central_name'];?></span><br>
                            <?php } if($v['position_regional_office']!=''&&$v['position_regional_office']!=null){?>
                                <span>Kantor Wilayah : <?=$v['position_regional_name'];?></span><br>
                                <span>Alamat Kantor Wilayah : <?=$v['reginal_address_name'];?></span>
                            <?php } ?>
                        </td>
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
                                    <a href="#" data-index='<?=$key?>' class="editb" data-toggle="modal" data-target="#modalUpdateData">
                                        <span data-toggle="tooltip" data-original-title="Edit this term">
                                            <i class="fas fa-pencil-alt"></i>
                                        </span>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" data-id="<?=$v['id']?>" class="text-muted deleteb">
                                        <span data-toggle="tooltip" title="" data-original-title="Delete this term">
                                            <i class="fas fa-trash text-danger"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
            <div class="mt-3 text-center">
                <i class="fas fa-exclamation-triangle fa-2x"></i>
                <div class="text-muted mt-2">No data found</div>
            </div>
            <div style="height: 200px"></div>
        <?php endif; ?>
    </div>
    <div class="mt-4 mb-4 d-flex align-items-center">
        <div class="m-auto">
            <?php echo $paging; ?>
        </div>
    </div>


<div class="modal fade" id="modalUpdateStatus" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" id="submitformadd" action="<?php echo base_url('cms/management/save'); ?>" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Data Pengurus</h5>
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
                    <label for="st-address">Phone</label>
                    <input type="tel" name="phone" class="form-control" required>
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
                    <label for="st-address">Social Linkedin</label>
                    <input type="text" name="social_linkedin" class="form-control">
                </div>
                <div class="form-group">
                    <label for="st-address">Social Twitter</label>
                    <input type="text" name="social_twitter" class="form-control">
                </div>
                <div class="form-group">
                    <label for="st-address">Address</label>
                    <textarea name="address" rows="3" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="st-address">Jabatan Kantor Pusat</label>
                    <!-- <input type="text" id="pcoa" name="position_central_office" class="form-control"> -->
                    <select name="position_central_office" id="pcoa" class="form-control" data-toggle="select">
                        <option value="">--select data--</option>
                        <?php foreach ($position as $key => $value) {?>
                        <option value="<?=$value['id']?>"><?=$value['name']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="st-address">Jabatan Kantor Wilayah</label>
                    <!-- <input type="text" id="proa" name="position_regional_office" class="form-control"> -->
                    <select name="position_regional_office" id="proa" class="form-control" data-toggle="select">
                        <option value="">--select data--</option>
                        <?php foreach ($position_region as $key => $value) {?>
                        <option value="<?=$value['id']?>"><?=$value['name']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="st-address">Alamat Kantor Wilayah</label>
                    <!-- <textarea id="aroa" name="address_regional_office" rows="3" class="form-control" ></textarea> -->
                    <select name="province_regional_office" id="aroa" class="form-control" data-toggle="select">
                        <option value="">--select data--</option>
                        <?php foreach ($address_region as $key => $value) {?>
                        <option value="<?=$value['id']?>"><?=$value['name']?></option>
                        <?php } ?>
                    </select>
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
        <form class="modal-content" action="<?php echo base_url('cms/management/update'); ?>" id="updateb" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" id="idb">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit Data Pengurus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="form-group">
                    <label for="st-address">Name</label>
                    <input type="text" id="mname" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="st-address">Phone</label>
                    <input type="tel" id="mphone" name="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="st-address">Image</label>
                    <div>
                        <input type="file" name="fileImg" id="file-2" class="custom-input-file"/>
                        <label for="file-2">
                            <i class="fa fa-upload"></i>
                            <span>Choose a file…</span>
                        </label>
                    </div>
                    <span>Don't select the file if you don't want to change the image</span>
                </div>
                <div class="form-group">
                    <label for="st-address">Social Linkedin</label>
                    <input type="text" id="mlinkedin" name="social_linkedin" class="form-control">
                </div>
                <div class="form-group">
                    <label for="st-address">Social Twitter</label>
                    <input type="text" id="mtwitter" name="social_twitter" class="form-control">
                </div>
                <div class="form-group">
                    <label for="st-address">Address</label>
                    <textarea name="address" id="maddress" rows="3" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="st-address">Jabatan Kantor Pusat</label>
                    <!-- <input type="text" id="mpcoa" name="position_central_office" class="form-control"> -->
                    <select name="position_central_office" id="mpcoa" class="form-control" data-toggle="select">
                        <option value="">--select data--</option>
                        <?php foreach ($position as $key => $value) {?>
                        <option value="<?=$value['id']?>"><?=$value['name']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="st-address">Jabatan Kantor Wilayah</label>
                    <!-- <input type="text" id="mproa" name="position_regional_office" class="form-control"> -->
                    <select name="position_regional_office" id="mproa" class="form-control" data-toggle="select">
                        <option value="">--select data--</option>
                        <?php foreach ($position_region as $key => $value) {?>
                        <option value="<?=$value['id']?>"><?=$value['name']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="st-address">Alamat Kantor Wilayah</label>
                    <!-- <textarea id="maroa" name="address_regional_office" rows="3" class="form-control" ></textarea> -->
                    <select name="province_regional_office" id="maroa" class="form-control" data-toggle="select">
                        <option value="">--select data--</option>
                        <?php foreach ($address_region as $key => $value) {?>
                        <option value="<?=$value['id']?>"><?=$value['name']?></option>
                        <?php } ?>
                    </select>
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
                <input type="hidden" name="s" value="<?=$this->input->get('s')?>">
                <div class="form-group">
                    <label for="st-address">Jenis Jabatan</label>
                    <select name="pt" id="fpt" class="form-control">
                        <option value="">--select data--</option>
                        <option value="1">Pusat</option>
                        <option value="2">Wilayah</option>
                    </select>
                </div>
                <div class="form-group fdivc my-none">
                    <label for="st-address">Jabatan Kantor Pusat</label>
                    <select name="p" id="fspc" class="form-control" data-toggle="select">
                        <option value="">--select data--</option>
                        <?php foreach ($position as $key => $value) {?>
                        <option value="<?=$value['id']?>"><?=$value['name']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group fdivw my-none">
                    <label for="st-address">Jabatan Kantor Wilayah</label>
                    <select name="p" id="fspr" class="form-control" data-toggle="select">
                        <option value="">--select data--</option>
                        <?php foreach ($position_region as $key => $value) {?>
                        <option value="<?=$value['id']?>"><?=$value['name']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group fdivw my-none">
                    <label for="st-address">Alamat Kantor Wilayah</label>
                    <select name="pp" id="fsppr" class="form-control" data-toggle="select">
                        <option value="">--select data--</option>
                        <?php foreach ($address_region as $key => $value) {?>
                        <option value="<?=$value['id']?>"><?=$value['name']?></option>
                        <?php } ?>
                    </select>
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
    let filter = {
        'p'     : '<?=$this->input->get('p');?>',
        'pp'    : '<?=$this->input->get('pp');?>'
    };
    $('document').ready(function(){
        <?php if($this->session->flashdata('success')==true){?>
            Swal.fire({
                title: 'Success',
                text: "Success to save data",
            })
        <?php }?>
    })
    $(function () {
        $('#submitformadd').submit(function(e){
            let status = false
            if(($('#pcoa').val()==''&&$('#proa').val()=='') || ($('#proa').val()!=''&&$('#aroa').val()=='')){
                status  = true
            }
            if(status){
                e.preventDefault()
                swal.fire({
                    title: "Error!",
                    type: 'error',
                    text: "Silahkan isi data pengurus dengan benar!.",
                    // confirmButtonColor: '#c6b187'
                })
            }
        })

        $('.publishb').click(function(e){
            e.preventDefault()
            let id = $(this).data('id'),status =$(this).data('status')
            // console.log(status) 
            $.ajax({
                url: "<?php echo base_url('cms/management/publish'); ?>",
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
            $('#mname').val(tableData[index].name)
            $('#mphone').val(tableData[index].phone)
            $('#mlinkedin').val(tableData[index]['social_linkedin'])
            $('#mtwitter').val(tableData[index]['social_twitter'])
            $('#maddress').val(tableData[index].address)
            if(tableData[index].position_central_office!=null && tableData[index].position_central_office!=''){
                $('#mpcoa').val(tableData[index].position_central_office).trigger('change.select2');
            }else{
                $('#mpcoa').val('').trigger('change.select2');
            }
            if(tableData[index].position_regional_office!=null && tableData[index].position_regional_office!=''){
                $('#mproa').val(tableData[index].position_regional_office).trigger('change.select2');
            }else{
                $('#mproa').val('').trigger('change.select2');
            }
            if(tableData[index].province_regional_office!=null && tableData[index].province_regional_office!=''){
                $('#maroa').val(tableData[index].province_regional_office).trigger('change.select2');
            }else{
                $('#maroa').val('').trigger('change.select2');
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
                            url: "<?php echo base_url('cms/management/delete'); ?>",
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

            let status = false
            if(($('#mpcoa').val()==''&&$('#mproa').val()=='') || ($('#mproa').val()!=''&&$('#maroa').val()=='')){
                status  = true
            }
            if(status){
                swal.fire({
                    title: "Error!",
                    type: 'danger',
                    text: "Silahkan isi data pengurus dengan benar!.",
                    // confirmButtonColor: '#c6b187'
                })
            }

            let formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('cms/management/update'); ?>",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    swal.fire({
                        title: "Success!",
                        text: "Success to save update Data Pengurus!",
                        // confirmButtonColor: '#c6b187'
                    }).then(function() {
                        window.location.reload()
                    });
                }
            });
        });

        $('#fpt').change(function(e){
            if($(this).val()==1){
                $('.fdivc').show()
                $('.fdivw').hide()
                $('#fspr').val('').trigger('change.select2');
                $('#fsppr').val('').trigger('change.select2');
            }else if($(this).val()==2){
                $('.fdivc').hide()
                $('.fdivw').show()
                $('#fspc').val('').trigger('change.select2');
            }else{
                $('.fdivc').hide()
                $('.fdivw').hide()
                $('#fspr').val('').trigger('change.select2');
                $('#fsppr').val('').trigger('change.select2');
                $('#fspc').val('').trigger('change.select2');
            }
        })

        $('#export').click(()=>{
            $.get("<?=base_url('cms/management/excel')?>", function(res,status){
            if(status=='success'){
                let createXLSLFormatObj = [];
                let xlsHeader = [], wscols = []
                xlsHeader = ["Name", "Phone", "Address", "Central Office Position", "Regional Office Position", "Regional Office Address","Created at"];
                wscols = [{wch:25}, {wch:15},{wch:45},{wch:45},{wch:45},{wch:20},{wch:15}];
                let xlsRows = res
                createXLSLFormatObj.push(xlsHeader);
                $.each(xlsRows, function(index, value) {
                    let innerRowData = [];
                    $.each(value, function(ind, val) {
                        innerRowData.push(val);
                    });
                    createXLSLFormatObj.push(innerRowData);
                });
                let date = new Date()
                let filename = "Management_Data_"+(date.getMonth() + 1) + date.getDate() +  date.getFullYear()+".xlsx";
                let ws_name = "Management_Data";
                let wb = XLSX.utils.book_new(),
                    ws = XLSX.utils.aoa_to_sheet(createXLSLFormatObj);
                ws['!cols'] = wscols;
                XLSX.utils.book_append_sheet(wb, ws, ws_name);
                XLSX.writeFile(wb, filename);
            }
            });
        })
    });
    $(document).ready(function(){
        <?php if($this->input->get('pt')!=''){?>
            $('#fpt').val('<?=$this->input->get('pt')?>').trigger('change')
            <?php if($this->input->get('pt')==1){?>
                $('#fspc').val('<?=$this->input->get('p')?>').trigger('change.select2');
            <?php }else{?>
                $('#fspr').val('<?=$this->input->get('p')?>').trigger('change.select2');
                $('#fsppr').val('<?=$this->input->get('pp')?>').trigger('change.select2');
            <?php }?>
        <?php }?>
    })
</script>