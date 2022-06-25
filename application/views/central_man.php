<?php $this->load->view('template/header'); ?>
<div class="main-content">
    <!-- Header (account) -->
    <section class="header-account-page bg-primary d-flex align-items-end" data-offset-top="#header-main">
        <!-- Header container -->
        <div class="container pt-6">
            <div class="row">
                <div class=" col-lg-12">
                    <!-- Salute + Small stats -->
                    <div class="row align-items-center mb-4">
                        <div class="col-md-5 mb-4 mb-md-0">
                            <span class="h2 mb-0 text-white d-block mt-3">Pengurus Pusat</span>
                            <span class="text-white h6">Susunan Pengurus Ikatan Keluarga Alumni</span><br>
                            <span class="text-white h6">Universitas Islam Indonesia, Periode 2015-2020</span>
                        </div>
                    </div>
                    <!-- Account navigation -->
                    <div class="d-flex">
                        <div class="btn-group btn-group-nav shadow ml-auto" role="group" aria-label="Basic example">
                            <div class="btn-group" role="group">
                                <button id="btn-group-settings" type="button" class="btn btn-neutral btn-icon" data-action="omnisearch-open" data-target="#omnisearch">
                                    <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
                                    <span class="btn-inner--text d-none d-sm-inline-block">Search</span>
                                </button>
                            </div>
                            <div class="btn-group" role="group">
                                <button id="btn-group-boards" type="button" class="btn btn-neutral btn-icon" data-toggle="modal" data-target="#modalFilter">
                                    <span class="btn-inner--icon"><i class="fa fa-filter"></i></span>
                                    <span class="btn-inner--text d-none d-sm-inline-block">Position</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="slice bg-section-secondary">
        <div class="container">
            <div class="mb-4">
                    <?php 
                    $jbt = '';
                    $sts = false;
                    $total = is_array($data)?count($data):0;
                    if(is_array($data)){
                    foreach ($data as $key => $value) {
                        if(($key>0 && $jbt != $value['position_central_office']) || ( $key==0)){
                            $jbt = $value['position_central_office'];
                            $sts = true;
                        }else{
                            $sts = false;
                        }
                    ?>
                    <?php  
                        if(($sts && $key>0) || $total==1){
                    ?>
                        </div>
                    <?php
                        }
                        if($key==0 || $sts){?>
                            <div class="actions-toolbar py-2 mb-4 text-center">
                                <h5 class="mb-1"><?=$value['position_central_name']?></h5>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-xl-3 col-lg-4 col-md-6">
                                    <div class="card hover-shadow-lg hover-translate-y-n10">
                                        <div class="card-body text-center">
                                            <div class="avatar-parent-child">
                                                <a href="#" class="avatar avatar-lg rounded-circle">
                                                    <img alt="Image placeholder" src="<?=$value['image']?>">
                                                </a>
                                                
                                            </div>
                                            <h6 class="mt-3 mb-0"><?=$value['name']?></h6>
                                            <!-- <span class=" mb-0 " style="font-size: 12px;"><?=$value['position_central_name']?></span> -->
                                            <!-- <a href="#" class="d-block text-sm text-muted mb-3">Jabatan</a> -->
                                        </div>

                                        <div class="card-footer">
                                            <div class="actions d-flex justify-content-center px-4">
                                                <a href="<?=$value['social_linkedin']!=''?$value['social_linkedin']:'#'?>" class="action-item mr-1 ml-1" <?=$value['social_linkedin']!=''?'target="_blank"':'#'?>>
                                                    <i class="fab fa-linkedin"></i>
                                                </a>
                                                <a href="<?=$value['social_twitter']!=''?$value['social_twitter']:'#'?>" class="action-item mr-1 ml-1" <?=$value['social_linkedin']!=''?'target="_blank"':'#'?>>
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    <?php 
                        } else {
                    ?>
                                <div class="col-xl-3 col-lg-4 col-md-6">
                                    <div class="card hover-shadow-lg hover-translate-y-n10">
                                        <div class="card-body text-center">
                                            <div class="avatar-parent-child">
                                                <a href="#" class="avatar avatar-lg rounded-circle">
                                                    <img alt="Image placeholder" src="<?=$value['image']?>">
                                                </a>
                                                
                                            </div>
                                            <h6 class="mt-3 mb-0"><?=$value['name']?></h6>
                                            <!-- <span class=" mb-0 " style="font-size: 12px;"><?=$value['position_central_name']?></span> -->
                                            <!-- <a href="#" class="d-block text-sm text-muted mb-3">Jabatan</a> -->
                                        </div>

                                        <div class="card-footer">
                                            <div class="actions d-flex justify-content-center px-4">
                                                <a href="<?=$value['social_linkedin']!=''?$value['social_linkedin']:'#'?>" class="action-item mr-1 ml-1" <?=$value['social_linkedin']!=''?'target="_blank"':'#'?>>
                                                    <i class="fab fa-linkedin"></i>
                                                </a>
                                                <a href="<?=$value['social_twitter']!=''?$value['social_twitter']:'#'?>" class="action-item mr-1 ml-1" <?=$value['social_linkedin']!=''?'target="_blank"':'#'?>>
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    <?php } } }?>
                </div>
                <!-- Load more -->
                <!-- <div class="mt-4 text-center">data-toggle="modal" data-target="#modalFilter"
                    <a href="#" class="btn btn-sm btn-neutral rounded-pill shadow hover-translate-y-n3">Load more ...</a>
                </div> -->
                <div class="mt-4 mb-4 d-flex align-items-center">
                    <div class="m-auto">
                    <div>
                </div>
            </div>
        </div>
    </section>
    <?php $this->load->view('template/before_footer'); ?> 
</div>
<!-- Omnisearch -->
<div id="omnisearch" class="omnisearch">
    <div class="container">
      <!-- Search form -->
      <form class="omnisearch-form">
        <input type="hidden" name="position" value="<?=$this->input->get('position')?>">
        <div class="form-group">
          <div class="input-group input-group-merge input-group-flush">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
            <input type="text" name="query" class="form-control" value="<?=$this->input->get('query')?>" placeholder="Type and hit enter ...">
          </div>
        </div>
      </form>
    </div>
</div>

<div class="modal fade" id="modalFilter" role="dialog" data-backdrop="static" aria-labelledby="modalFilter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFilterLabel">Position Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="query" value="<?=$this->input->get('query')?>">
                <div class="form-group fdivc my-none">
                    <label for="st-address">Jabatan Kantor Pusat</label>
                    <select name="position" id="fspc" class="form-control" data-toggle="select">
                        <option value="">--select data--</option>
                        <?php foreach ($position as $key => $value) {?>
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
<?php $this->load->view('template/footer'); ?>
<script>
    $('document').ready(function(){
        <?php if($this->input->get('position')!=''){?>
        $('#fspc').val(<?=$this->input->get('position')?>).trigger('change.select2');
        <?php }?>
    })
</script>

