<?php $this->load->view('template/header'); ?>
<div class="main-content">
    <!-- Header (v1) -->
    <section class="header-1 section-rotate bg-section-secondary" data-offset-top="#header-main">
        <div class="section-inner bg-gradient-primary"></div>
        <!-- SVG illustration -->
        <div class="pt-7 position-absolute middle right-0 col-lg-7 col-xl-6 d-none d-lg-block" style="top: 37%">
            <figure class="w-100" style="max-width: 1000px;">
                <img alt="Image placeholder" src="<?=base_url()?>assets/img/icon-santrti.png" class="img-fluid">
            </figure>
        </div>

        <div class="container py-5 pt-lg-6 d-flex align-items-center position-relative zindex-100">
            <div class="col ml-md-n3">
                <div class="row">
                    <div class="col-lg-6 col-xl-6 text-center text-lg-left">
                        <div>
                            <h1 class="text-white mb-4">
                                <span class="text-md-large text-sm-large"><?=$banner['title']?></span>
                            </h1>
                            <p class="lead text-white"><?=$banner['description']?></p>
                            <div class="mt-5">
                                <a href="<?=base_url('aboutus')?>" class="btn btn-white rounded-pill hover-translate-y-n3 btn-icon mr-sm-4 scroll-me">
                                    <span class="btn-inner--text">Baca Lebih Lanjut</span>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>








    <section class="slice slice-lg bg-section-white overflow-hidden">
        <div class="container position-relative zindex-100">
            <div class="mb-5  text-center">
              <h1 class="">Berita Terkini</h1>
            </div>


            <div class="row customhome">
                <?php if(is_array($news)){ foreach ($news as $key => $value) {?>
                <div class="col-lg-4">
                    <div class="mb-5 mb-lg-0" data-animate-hover="1">
                        <div class="animate-this">
                            <a href="<?=base_url('news/detail/'.$value['slug'])?>">
                                <img alt="Image placeholder" class="img-fluid rounded shadow" src="<?= $value['image']?>">
                            </a>
                        </div>
                        <div class="pt-4">
                            <small class="text-uppercase getDate" data-date="<?=$value['published_at']?>" data-format='LL'></small>
                            <a href="<?=base_url('news/detail/'.$value['slug'])?>">
                                <h5><?= $value['title']?></h5>
                            </a>
                        </div>
                    </div>
                </div>
                <?php }} ?>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center mt-6">
                    <a href="<?=base_url('news')?>" class="btn btn-warning rounded-pill btn-icon hover-translate-y-n3 mb-4 mb-md-0">

                        <span class="btn-inner--text">Lihat Lebih Lanjut</span>
                    </a>
                </div>
            </div>

        </div>
    </section>


  <?php /*  <section class="slice slice-lg bg-warning overflow-hidden">
        <div class="container position-relative zindex-100">
            <div class="mb-5 px-3 text-center">
          <span class="badge badge-soft-secondary badge-pill badge-lg text-dark">
          AGENDA dan ACARA
          </span>
            </div>
            <div class="row customhome">
                <?php if(is_array($events)){foreach ($events as $key => $value) {?>
                <div class="col-lg-4">
                    <div class="card card-overlay card-hover-overlay">
                        <figure class="figure">
                            <img alt="Image placeholder" src="<?= $value['image']?>" class="img-fluid" style="height: 450px;">
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
                                    <span class="text-muted" style="font-size: 14px;"><?=$value['location']?>. <br> <span class="getDate" data-date="<?=$value['start_at']?>" data-format='LLLL'></span></span>
                                </div>
                                <div class="text-center mt-3">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item pr-4 h6">
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

            <div class="row">
                <div class="col-lg-12 text-center mt-6">
                    <a href="<?=base_url('events')?>" class="btn btn-secondary rounded-pill btn-icon hover-translate-y-n3 mb-4 mb-md-0">
                        <span class="btn-inner--text">Lihat Lebih Lanjut</span>
                    </a>
                </div>
            </div>

        </div>
    </section> */ ?>




    <!-- Features (v5) -->
    <section class="slice slice-xl has-floating-items bg-gradient-primary" id=sct-call-to-action><a
                href="#sct-call-to-action" class="tongue tongue-up tongue-warning" data-scroll-to>
            <i class="fas fa-angle-up"></i>
        </a>
        <div class="container text-center">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-white">Program Pendidikan</h1>
                    <div class="row justify-content-center mt-4">

                        <div class="col-md-6">
                        <div class="card bg-warning-light shadow hover-shadow-lg border-0 position-relative zindex-100">
                        <div class="card-body py-5">
                        <div class="d-flex align-items-start">

                        <div class="icon-text">
                        <h3 class="text-dark h4">UMUM</h3>
                        <p class="text-dark mb-0 text-justify" style="min-height:85px">Pendidikan Umum terdiri dari Pendidikan Anak Usia Dini (PAUD), Madrasah Ibtidaiyah (MI), Madrasah Tsanawiyah (MTs) dan Madrasah Aliyah (MA).
                        </p>
                        <div class="mt-2">
<a href="/pendidikan-umum" class="btn btn-white rounded-pill hover-translate-y-n3 btn-icon mr-sm-4 scroll-me">
<span class="btn-inner--text">Baca Lebih Lanjut</span>
</a>
</div>
                        </div>
                        </div>

                        </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="card bg-warning-light shadow hover-shadow-lg border-0 position-relative zindex-100">
                        <div class="card-body py-5">
                        <div class="d-flex align-items-start">

                        <div class="icon-text">
                        <h5 class="h4 text-dark">KHUSUS</h5>
                        <p class="mb-0 text-dark text-justify" style="min-height:85px">Pendidikan Khusus yang ada didalam Pondok Pesantren Hijir Ismail adalah Rumah Hafidz dan Majelis Hijir Ismail.</p>
                        <div class="mt-2">
<a href="/pendidikan-khusus" class="btn btn-white rounded-pill hover-translate-y-n3 btn-icon mr-sm-4 scroll-me">
<span class="btn-inner--text">Baca Lebih Lanjut</span>
</a>
</div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="container floating-items">
            <div class="icon-floating bg-white floating">
                <span></span>
                <img alt="Image placeholder" src="<?=base_url()?>assets/img/education/icon-01.png" class="svg-inject w-50">
            </div>
            <div class="icon-floating icon-lg bg-white floating">
                <span></span>
                <img alt="Image placeholder" src="<?=base_url()?>assets/img/education/icon-02.png" class="svg-inject">
            </div>
            <div class="icon-floating icon-sm bg-white floating">
                <span></span>
                <img alt="Image placeholder" src="<?=base_url()?>assets/img/education/icon-03.png" class="svg-inject">
            </div>
            <div class="icon-floating icon-lg bg-white floating">
                <span></span>
                <img alt="Image placeholder" src="<?=base_url()?>assets/img/education/icon-04.png" class="svg-inject">
            </div>
            <div class="icon-floating bg-white floating">
                <span></span>
                <img alt="Image placeholder" src="<?=base_url()?>assets/img/education/icon-05.png" class="svg-inject w-50">
            </div>
            <div class="icon-floating icon-sm bg-white floating">
                <span></span>
                <img alt="Image placeholder" src="<?=base_url()?>assets/img/education/icon-06.png" class="svg-inject">
            </div>
        </div>
    </section>
    <!-- Testimonials (v1) -->
    <section class="slice slice-lg bg-section-secondary">
        <div class="container">
            <div class="mb-5 text-center">
          <h1 class="">Kata Santri</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <div class="swiper-js-container overflow-hidden">
                        <div class="swiper-container" data-swiper-items="1" data-swiper-space-between="0" data-swiper-sm-items="2"
                             data-swiper-xl-items="3">
                            <div class="swiper-wrapper">
                                <?php if(is_array($testimonys)){foreach ($testimonys as $key => $value) {?>
                                <div class="swiper-slide p-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <img alt="Image placeholder" src="<?=$value['image']?>"
                                                         class="avatar  rounded-circle">
                                                </div>
                                                <div class="pl-3">
                                                    <h5 class="h6 mb-0"><?=$value['name']?></h5>
                                                    <small class="d-block text-muted"><?=$value['profession']?></small>
                                                </div>
                                            </div>
                                            <p class="mt-4 lh-180"><?=$value['message']?></p>

                                        </div>
                                    </div>
                                </div>
                                <?php }}?>
                            </div>
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination w-100 mt-4 d-flex align-items-center justify-content-center"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features (v7) -->



    <?php $this->load->view('template/before_footer'); ?>
</div>
<?php $this->load->view('template/footer'); ?>
<?php if($this->input->get('directquote')=='true'){?>
<script>
$(document).ready(function(){
    $("html, body").animate({ scrollTop: $('#quotediv').offset().top }, 1000);
})
</script>
<?php }?>
