<?php $this->load->view('template/header'); ?>
<div class="main-content">
    <section class="slice bg-dark-light">
        <div class="container pt-6">
        </div>
    </section>
    <section></section>
    <section class="slice">
        <div class="container">

        </div>
        <div class="container">
            <div class="row row-grid">
                <div class="col-lg-6">
                    <div data-toggle="sticky" data-sticky-offset="30" class="" style="">
                        <a href="<?=$data['image']?>" data-fancybox>
                            <img alt="Image placeholder" src="<?=$data['image']?>" class="img-fluid">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="pl-lg-5">
                        <!-- Product title -->
                        <h4 class="h4 mb-3"><?=$data['title']?></h4>
                        <div class="pt-4 pb-3 border-top">
                            <h6 class="text-sm">Description:</h6>
                            <p class="text-sm mb-0"><?=$data['description']?></p>
                        </div>
                        <div class=" pt-4 pb-3 border-top border-bottom">
                            <h6 class="text-sm">Waktu & Tempat</h6>
                            <div class="btn-group-toggle btn-group-options row mx-0 mt-3 mb-5" data-toggle="buttons">
                                <div class="col-12 mb-2 text-left text-sm p-3 bdetail">
                                    <table>
                                        <tr>
                                            <td><i class="uil uil-clock"></i> <span class="getDate" data-date="<?=$data['start_at']?>" data-format="LLLL"></span> - <span class="getDate" data-date="<?=$data['end_at']?>" data-format="LLLL"></span></td>
                                        </tr>
                                        <tr>
                                            <td><i class="uil uil-location-point"></i> <?=$data['location']?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center pt-4 pb-4">
                            <div class="col-6 ">
                                <h6 class="text-sm text-muted">Informasi lebih lanjut:</h6>
                            </div>
                            <div class="col-6 text-sm-right">
                                <a href="<?=base_url('contactus')?>" target="_blank" class="btn btn-primary btn-icon">
                                    <span class="btn-inner--icon"><i class="fas fa-envelope-open-text"></i></span>
                                    <span class="btn-inner--text">Hubungi Kami</span>
                                </a>
                            </div>
                        </div>
                        <div class="row border-top align-items-left pt-4">

                            <div class="col-lg-4 col-4">
                                <div class="media align-items-center mb-3">
                                    <div>
                                        <a href="#" class="avatar rounded-circle mr-3">
                                            <img alt="Image placeholder" src="<?=$data['author_image']?>">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <span class="d-block h6 mb-0"><?=$data['author_name']?></span>
                                        <span class="text-sm text-muted getDate" data-date="<?=$data['created_at']?>" data-format="LL"></span>
                                    </div>
                                </div>

                            </div>


                            <div class="col-lg-8 col-8 text-right">
                                <ul class="list-inline mb-0 mt-3">
                                    <li class="list-inline-item pr-3 h6">
                                        <span class="text-muted" style="font-size: 14px;">Share:</span>
                                    </li>
                                    <li class="list-inline-item pr-2">
                                        <a href="http://www.facebook.com/sharer.php?u=<?=base_url('events/detail/'.$data['slug'])?>" target="_blank" class="text-muted"><i class="fa fa-facebook mr-1 text-muted"></i></a>
                                    </li>
                                    <li class="list-inline-item pr-2">
                                        <a href="https://twitter.com/share?url=<?=base_url('events/detail/'.$data['slug'])?>" target="_blank" class="text-muted"><i class="fa fa-twitter mr-1 text-muted"></i></a>
                                    </li>
                                    <li class="list-inline-item pr-2">
                                        <a href="https://wa.me/?text=<?=$data['title'].'%0D%0A%0D%0A'.base_url('events/detail/'.$data['slug'])?>" target="_blank" class="text-muted"><i class="fa fa-whatsapp mr-1 text-muted"></i></a>
                                    </li>
                                    <li class="list-inline-item pr-2">
                                        <a href="#" class="text-muted copytext" data-text="<?=base_url('events/detail/'.$data['slug'])?>"><i class="fas fa-link mr-1 text-muted"></i></a>
                                    </li>
                                </ul>
                            </div>
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
                <h3 class=" mt-4">Agenda Events Lainnya</h3>
            </div>
            <div class="row">
                <?php if(is_array($others)){foreach ($others as $key => $value) {?>
                <div class="col-lg-4">
                    <div class="card hover-shadow-lg hover-translate-y-n10">
                        <a href="<?=base_url('events/detail/'.$value['slug'])?>">
                            <img alt="Image placeholder" src="<?=$value['image']?>" class="card-img-top">
                        </a>
                        <div class="card-body py-5 text-center">
                            <a href="<?=base_url('events/detail/'.$value['slug'])?>" class="d-block h5 lh-150"><?=$value['title']?> </a>
                            <h6 class="text-muted mt-4 mb-0 getDate" data-date="<?=$value['created_at']?>" data-format='LL'></h6>
                        </div>
                        <div class="card-footer delimiter-top">
                            <div class="row">
                                <div class="col text-center">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item pr-4">
                                            Share:
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
                <?php }}?>
            </div>
        </div>
    </section>
    <?php $this->load->view('template/before_footer'); ?> 
</div>
<?php $this->load->view('template/footer'); ?> 

