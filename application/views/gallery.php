<?php $this->load->view('template/header'); ?>
<div class="main-content">
    <div id="headers-header-14" title="headers/header-14.html">
        <section class="slice slice-lg bg-gradient-primary" data-offset-top="#header-main">
            <!-- SVG background -->
            <div class="bg-absolute-cover bg-size--contain d-flex align-items-center">
                <figure class="w-100 d-none d-lg-block">
                    <img alt="Image placeholder" src="assets/img/svg/backgrounds/bg-4.svg" class="svg-inject">
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
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" x="0px" y="0px" viewBox="0 0 1000 300" style="enable-background:new 0 0 1000 300;" xml:space="preserve" class="ie-shape-wave-1 fill-primary">
                <path d="M 0 246.131 C 0 246.131 31.631 250.035 47.487 249.429 C 65.149 248.755 82.784 245.945 99.944 241.732 C 184.214 221.045 222.601 171.885 309.221 166.413 C 369.892 162.581 514.918 201.709 573.164 201.709 C 714.375 201.709 772.023 48.574 910.547 21.276 C 939.811 15.509 1000 24.025 1000 24.025 L 1000 300.559 L -0.002 300.559 L 0 246.131 Z" />
            </svg>
            </div>
        </section>
    </div>

    <section class="slice slice-lg delimiter-top bg-gray-100">
        <div class="container">
            <div class="row justify-content-between align-items-center mb-5">
                <div class="col-4">
                    <h5 class="mb-1">Galeri Foto & Video</h5>
                </div>
                <div class="col-8 text-right">
                    <a href="<?=base_url('gallery')?>" class="btn btn-sm btn-primary rounded-pill">
                        All
                    </a>
                    <a href="<?=base_url('gallery?type=P')?>" class="btn btn-sm btn-primary rounded-pill">
                        Photos
                    </a>
                    <a href="<?=base_url('gallery?type=V')?>" class="btn btn-sm btn-primary rounded-pill">
                        Videos
                    </a>
                </div>
            </div>
            <div class="row customhome">
                <?php if(is_array($data)){foreach ($data as $key => $value) {?>
                <div class="col-lg-6">
                    <div class="card card-overlay card-hover-overlay">
                        <figure class="figure">
                            <img alt="Image placeholder" src="<?=$value['type']=='P'?json_decode($value['media'])[0]:'https://img.youtube.com/vi/'.$value['media'].'/hqdefault.jpg'?>" class="img-fluid">
                        </figure>
                        <div class="card-img-overlay d-flex flex-column align-items-center p-0">
                            <div class="overlay-text w-75 mt-auto p-4">
                                <!-- <p class="lead">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p> -->
                            </div>
                            <div class="overlay-actions w-100 card-footer mt-auto d-flex justify-content-between align-items-center">
                                <div>
                                    <?php if($value['type']=='P'){ $images = json_decode($value['media']);foreach ($images as $idx => $item) {if($idx==0){?>
                                        <a href="<?=$item?>" class="h6 mb-0" data-fancybox="img<?=$value['id']?>" data-caption="<?=$value['title']?>">
                                            <?=$value['title']?>
                                            <br>
                                            <span class="text-muted text-sm mb-2 getDate" data-date="<?=$value['created_at']?>" data-format='LL'></span>
                                        </a>
                                        <?php } else {?>
                                        <a href="<?=$item?>" class="d-none" data-fancybox="img<?=$value['id']?>"></a>
                                    <?php }}} else{?>
                                    <a href="https://www.youtube.com/embed/<?=$value['media']?>?autoplay=0" class="h6 mb-0" data-fancybox="vid<?=$value['id']?>" data-caption="<?=$value['title']?>">
                                        <?=$value['title']?>
                                        <br>
                                        <span class="text-muted text-sm mb-2 getDate" data-date="<?=$value['created_at']?>" data-format='LL'></span>
                                    </a>
                                    <?php }?>  
                                </div>
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }} ?>
            </div>
            <!-- Load more -->
            <div class="mt-4 mb-4 d-flex align-items-center">
                <div class="m-auto">
                    <?php echo $paging; ?>
                <div>
            </div>
        </div>
    </section>

    <!-- Call to action (v10) -->
    <?php $this->load->view('template/before_footer'); ?> 
</div>
<?php $this->load->view('template/footer'); ?> 

