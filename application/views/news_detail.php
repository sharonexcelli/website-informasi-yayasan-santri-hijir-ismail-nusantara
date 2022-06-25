<?php $this->load->view('template/header'); ?>
<div class="main-content">
    <section class="slice slice-lg bg-dark-light" data-offset-top="#header-main">
        <div class="container pt-6">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <h1 class="lh-150 mb-3 text-white"><?=$data['title']?></h1>
                     <div class="media align-items-center mt-5">
                        <div>
                            <a href="#" class="avatar rounded-circle mr-3">
                                <img alt="Image placeholder" src="<?=$data['author_image']?>" style="width: 50px;height: 50px;">
                            </a>
                        </div>
                        <div class="media-body">
                            <span class="d-block h6 mb-0 text-white"><?=$data['author_name']?></span>
                            <span class="text-sm text-muted getDate" data-date="<?=$data['published_at']?>" data-format="LL"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-cover bg-size--cover" style="height: 600px; background-image: url('<?=$data['image']?>'); background-position: center center;background-position: center top;background-color: #3a4d64;background-size: contain;"></section>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <span class="text-muted ">Sumber: <?=$data['image_source']?></span>
            </div>
        </div>
    </div>
    <section class="slice">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <!-- Article body -->
                    <article>
                        <?=$data['content']?>
                    </article>


                    <div class="row">
                        <div class="col text-left">
                            <ul class="list-inline mb-0">
                                <?php $tags = explode(',', $data['tags']); foreach ($tags as $idx => $itm) {?>
                                    <li class="list-inline-item pr-1">
                                        <a href="<?=base_url('news?tag='.$itm)?>" target="_blank"><span class="badge badge-secondary badge-pill "><?=$itm?></span></a>
                                    </li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col text-center">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item pr-4">
                                    <span class="text-muted" style="font-size: 14px;">Share:</span>
                                </li>
                                <li class="list-inline-item pr-4">
                                    <a href="http://www.facebook.com/sharer.php?u=<?=base_url('news/detail/'.$data['slug'])?>" target="_blank" class="text-muted"><i class="fa fa-facebook mr-1 text-muted"></i></a>
                                </li>
                                <li class="list-inline-item pr-4">
                                    <a href="https://twitter.com/share?url=<?=base_url('news/detail/'.$data['slug'])?>" target="_blank" class="text-muted"><i class="fa fa-twitter mr-1 text-muted"></i></a>
                                </li>
                                <li class="list-inline-item pr-4">
                                    <a href="https://wa.me/?text=<?=$data['title'].'%0D%0A%0D%0A'.base_url('news/detail/'.$data['slug'])?>" target="_blank" class="text-muted"><i class="fa fa-whatsapp mr-1 text-muted"></i></a>
                                </li>
                                <li class="list-inline-item pr-4">
                                    <a href="#" class="text-muted copytext" data-text="<?=base_url('news/detail/'.$data['slug'])?>"><i class="fas fa-link mr-1 text-muted"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog (v4) -->
    <section class="slice slice-lg bg-section-secondary delimiter-top delimiter-bottom">
        <div class="container">
            <div class="mb-5 text-center">
                <h3 class=" mt-4">Berita Lainnya</h3>
            </div>
            <div class="row">
                <?php if(is_array($others)){foreach ($others as $key => $value) {?>
                <div class="col-lg-4">
                    <div class="card hover-shadow-lg hover-translate-y-n10">
                        <a href="<?=base_url('news/detail/'.$value['slug'])?>">
                            <img alt="Image placeholder" src="<?=$value['image']?>" class="card-img-top">
                        </a>
                        <div class="card-body py-5 text-center">
                            <a href="<?=base_url('news/detail/'.$value['slug'])?>" class="d-block h5 lh-150"><?=$value['title']?> </a>
                            <h6 class="text-muted mt-4 mb-0 getDate" data-date="<?=$value['published_at']?>" data-format='LL'></h6>
                        </div>
                        <div class="card-footer delimiter-top">
                            <div class="row">
                                <div class="col text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item pr-4">
                                            Share:
                                        </li>
                                        <li class="list-inline-item pr-4">
                                            <a href="http://www.facebook.com/sharer.php?u=<?=base_url('news/detail/'.$value['slug'])?>" target="_blank" class="text-muted"><i class="fa fa-facebook mr-1 text-muted"></i></a>
                                        </li>
                                        <li class="list-inline-item pr-4">
                                            <a href="https://twitter.com/share?url=<?=base_url('news/detail/'.$value['slug'])?>" target="_blank" class="text-muted"><i class="fa fa-twitter mr-1 text-muted"></i></a>
                                        </li>
                                        <li class="list-inline-item pr-4">
                                            <a href="https://wa.me/?text=<?=$value['title'].'%0D%0A%0D%0A'.base_url('news/detail/'.$value['slug'])?>" target="_blank" class="text-muted"><i class="fa fa-whatsapp mr-1 text-muted"></i></a>
                                        </li>
                                        <li class="list-inline-item pr-4">
                                            <a href="#" class="text-muted copytext" data-text="<?=base_url('news/detail/'.$value['slug'])?>"><i class="fas fa-link mr-1 text-muted"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }}?>
            </div>
        </div>
    </section>
    <?php $this->load->view('template/before_footer'); ?> 
</div>
<?php $this->load->view('template/footer'); ?> 

