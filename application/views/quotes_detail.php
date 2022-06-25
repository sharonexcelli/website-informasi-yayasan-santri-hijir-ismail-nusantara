<?php $this->load->view('template/header'); ?>
<div class="main-content">
    <!-- Header (account) -->
    <section class="header-account-page bg-primary d-flex align-items-end" data-offset-top="#header-main">
        <!-- Header container -->
        <div class="container pt-4 pt-lg-0">
            <div class="row justify-content-end">
                <div class=" col-lg-8">
                    <!-- Salute + Small stats -->
                    <div class="row align-items-center mb-4">
                        <div class="col-lg-8 col-xl-12 mb-4 mb-md-0 text-md-left text-center">
                            <span class="h2 mb-0 text-white d-block"><?=$data['name']?></span>
                            <span class="text-white"> <?= $data['profession']?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-5 pt-lg-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div style="margin-top: -90px;!important;">
                        <div class="card overflow-hidden" data-animate-hover="2">
                            <div class="overflow-hidden">
                                <div class="animate-this">
                                    <a href="#">
                                        <img alt="Image placeholder" src="<?=$data['image']?>" class="card-img-top">

                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mt-lg-5">
                    <!-- Timeline -->
                    <div class="card">
                        <div class="card-header pt-4 pb-2">
                            <div class="d-flex align-items-center">
                                <div class="avatar-content">
                                    <h6 class="mb-3">Tentang Alumni</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-2">
                                <span class="quote"></span>
                                <div class="quote-text">
                                    <p class="font-italic lh-170 text-dark"><?= $data['message']?></p>
                                </div>
                            </blockquote>
                            <p><?=$data['content']?></p>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col text-left">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item pr-4">
                                            <span class="text-muted" style="font-size: 14px;">Share:</span>
                                        </li>
                                        <li class="list-inline-item pr-4">
                                            <a href="http://www.facebook.com/sharer.php?u=<?=base_url('profile-alumni/detail/'.$data['slug'])?>" target="_blank" class="text-muted"><i class="fa fa-facebook mr-1 text-muted"></i></a>
                                        </li>
                                        <li class="list-inline-item pr-4">
                                            <a href="https://twitter.com/share?url=<?=base_url('profile-alumni/detail/'.$data['slug'])?>" target="_blank" class="text-muted"><i class="fa fa-twitter mr-1 text-muted"></i></a>
                                        </li>
                                        <li class="list-inline-item pr-4">
                                            <a href="https://wa.me/?text=<?=$data['name'].'%0D%0A%0D%0A'.base_url('profile-alumni/detail/'.$data['slug'])?>" target="_blank" class="text-muted"><i class="fa fa-whatsapp mr-1 text-muted"></i></a>
                                        </li>
                                        <li class="list-inline-item pr-4">
                                            <a href="#" class="text-muted copytext" data-text="<?=base_url('profile-alumni/detail/'.$data['slug'])?>"><i class="fas fa-link mr-1 text-muted"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="slice slice-lg bg-section-secondary delimiter-top delimiter-bottom">
        <div class="container">
            <div class="mb-5 text-center">
                <h3 class=" mt-4">Profile Lainnya</h3>
            </div>
            <div class="row">
                <?php if(is_array($others)){foreach ($others as $key => $value) {?>
                    <div class="col-lg-4">
                        <div class="card hover-shadow-lg hover-translate-y-n10">
                            <a href="<?=base_url('profile-alumni/detail/'.$value['slug'])?>">
                                <img alt="Image placeholder" src="<?=$value['image']?>" class="card-img-top">
                            </a>
                            <div class="card-body">
                                <blockquote class="blockquote">
                                    <span class="quote"></span>
                                    <div class="quote-text">
                                        <p class="font-italic lh-170 text-dark"><?= $value['message']?></p>
                                        <footer class="text-muted blockquote-footer">
                                            <?= $value['name']?> <cite title="Source Title"><br><?= $value['profession']?></cite>
                                        </footer>
                                    </div>
                                </blockquote>
                            </div>
                            <div class="card-footer delimiter-top">
                                <div class="row">
                                    <div class="col text-center">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item pr-4">
                                                Share:
                                            </li>
                                            <li class="list-inline-item pr-4">
                                                <a href="http://www.facebook.com/sharer.php?u=<?=base_url('profile-alumni/detail/'.$value['slug'])?>" target="_blank" class="text-muted"><i class="fa fa-facebook mr-1 text-muted"></i></a>
                                            </li>
                                            <li class="list-inline-item pr-4">
                                                <a href="https://twitter.com/share?url=<?=base_url('profile-alumni/detail/'.$value['slug'])?>" target="_blank" class="text-muted"><i class="fa fa-twitter mr-1 text-muted"></i></a>
                                            </li>
                                            <li class="list-inline-item pr-4">
                                                <a href="https://wa.me/?text=<?=$value['name'].'%0D%0A%0D%0A'.base_url('profile-alumni/detail/'.$value['slug'])?>" target="_blank" class="text-muted"><i class="fa fa-whatsapp mr-1 text-muted"></i></a>
                                            </li>
                                            <li class="list-inline-item pr-4">
                                                <a href="#" class="text-muted copytext" data-text="<?=base_url('profile-alumni/detail/'.$value['slug'])?>"><i class="fas fa-link mr-1 text-muted"></i></a>
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

