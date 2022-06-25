<?php $this->load->view('template/header'); ?>
<div class="main-content">
    <div id="headers-header-14" title="headers/header-14.html">
        <section class="slice slice-lg bg-gradient-primary" data-offset-top="#header-main">
            <!-- SVG background -->
            <div class="bg-absolute-cover bg-size--contain d-flex align-items-center">
                <figure class="w-100 d-none d-lg-block">
                    <img alt="Image placeholder" src="assets/img/svg/backgrounds/bg-3.svg" class="svg-inject">
                </figure>
            </div>
            <div class="container position-relative zindex-100">
                <div class="row row-grid justify-content-between align-items-center">
                    <div class="col-lg-6 align-self-end">
                        <div class="py-6 py-lg-8 text-center text-lg-left">
                            <h2 class="h1 text-white mb-4"><?=$banner['title']?></h2>
                            <p class="lead lh-180 text-white"><?=$banner['description']?></p>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="d-none d-lg-block">
                            <img alt="Image placeholder" src="<?=$banner['image']?>" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
            <div class="shape-container" data-shape-position="bottom">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1600 220" preserveAspectRatio="none" class="ie-shape-wave-3">
                    <path d="M918.34,99.41C388.23,343.6,47.11,117.12,0,87.54V220H1600V87.54C1378.72-76.71,1077.32,27.41,918.34,99.41Z"></path>
                </svg>
            </div>
        </section>
    </div>
    <section class="slice slice-lg delimiter-top bg-gray-100">
        <div class="container">
            <div class="row justify-content-between align-items-center mb-5">
                <div class="col">
                    <h5 class="mb-1">Events Updates</h5>
                    <p class="text-sm text-muted mb-0"><?php
                        echo date('l, d-m-Y');
                        ?></p>
                </div>
                <div class="col text-right">
                    <div class="actions">
                        <a href="#" class="action-item mr-2" data-action="omnisearch-open" data-target="#omnisearch"><i class="fa fa-search text-primary"></i></a>
                        <div class="dropdown mr-2">
                            <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-filter text-primary"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(21px, 35px, 0px);">
                                <a class="dropdown-item <?=$this->input->get('sort')==1||$this->input->get('sort')==''?'active':''?>" href="<?=base_url('events?query='.$this->input->get('query').'&sort=1')?>">
                                    <i class="fa fa-sort-amount-down"></i>Newest
                                </a>
                                <a class="dropdown-item <?=$this->input->get('sort')==2?'active':''?>" href="<?=base_url('events?query='.$this->input->get('query').'&sort=2')?>">
                                    <i class="fa fa-sort-amount-up"></i>Oldest
                                </a>
                                <a class="dropdown-item <?=$this->input->get('sort')==3?'active':''?>" href="<?=base_url('events?query='.$this->input->get('query').'&sort=3')?>">
                                    <i class="fa fa-sort-alpha-down"></i>From A-Z
                                </a>
                                <a class="dropdown-item <?=$this->input->get('sort')==4?'active':''?>" href="<?=base_url('events?query='.$this->input->get('query').'&sort=4')?>">
                                    <i class="fa fa-sort-alpha-up"></i>From Z-A
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row customhome">
                <?php if(is_array($data)){foreach ($data as $key => $value) {?>
                <div class="col-lg-4">
                    <div class="card card-overlay card-hover-overlay">
                        <figure class="figure">
                            <img alt="Image placeholder" src="<?=$value['image']?>" class="img-fluid" style="height: 450px;">
                        </figure>
                        <div class="card-img-overlay d-flex flex-column align-items-center p-0">
                            <div class="overlay-text w-75 mt-auto p-4">
                                <!-- <p class="lead">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> -->
                            </div>
                            <div class="overlay-actions w-100 card-footer mt-auto">
                                <div class="text-center">
                                    <a href="<?=base_url('events/detail/'.$value['slug'])?>" class="h6 mb-0"><?=$value['title']?></a>
                                </div>
                                <div class="text-center mt-1">
                                    <span class="text-muted" style="font-size: 14px"><?=$value['location']?><br> <span class="getDate" data-date="<?=$value['start_at']?>" data-format='LLLL'></span></span>
                                </div>
                                <div class="text-center mt-3">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item pr-4">
                                            <span class="text-muted" style="font-size: 14px;">Share:</span>
                                        </li>
                                        <li class="list-inline-item pr-4">
                                            <a href="http://www.facebook.com/sharer.php?u=<?=base_url('events/detail/'.$value['slug'])?>" target="_blank" class="text-muted"><i class="fa fa-facebook mr-1 text-muted"></i></a>
                                        </li>
                                        <li class="list-inline-item pr-4">
                                            <a href="https://twitter.com/share?url=<?=base_url('events/detail/'.$value['slug'])?>" target="_blank" class="text-muted"><i class="fa fa-twitter mr-1 text-muted"></i></a>
                                        </li>
                                        <li class="list-inline-item pr-4">
                                            <a href="https://wa.me/?text=<?=$value['title'].'%0D%0A%0D%0A'.base_url('events/detail/'.$value['slug'])?>" target="_blank" class="text-muted"><i class="fa fa-whatsapp mr-1 text-muted"></i></a>
                                        </li>
                                        <li class="list-inline-item pr-4">
                                            <a href="#" class="text-muted copytext" data-text="<?=base_url('events/detail/'.$value['slug'])?>"><i class="fas fa-link mr-1 text-muted"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }} ?>
            </div>
            <div class="mt-4 mb-4 d-flex align-items-center">
                <div class="m-auto">
                    <?php echo $paging; ?>
                <div>
            </div>
        </div>
    </section>
    <!-- Call to action (v5) -->
    <?php $this->load->view('template/before_footer'); ?> 
</div>
<!-- Omnisearch -->
<div id="omnisearch" class="omnisearch">
    <div class="container">
      <!-- Search form -->
      <form class="omnisearch-form">
        <input type="hidden" name="sort" value="<?=$this->input->get('sort')?>">
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
<?php $this->load->view('template/footer'); ?> 

