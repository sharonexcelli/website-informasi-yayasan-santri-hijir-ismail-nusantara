<?php $this->load->view('template/header'); ?>
<div class="main-content">
    <!-- Spotlight -->
    <section class="slice slice-lg bg-gradient-primary" data-offset-top="#header-main">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-8">
                    <h3 class="display-5 text-white">SYARAT DAN KETENTUAN</h3>
                    <h6 class="mb-4 text-white">Ikatan Keluarga Alumni Universitas Islam Indonesia</h6>
                </div>
            </div>
        </div>
        <a href="#sct-faq" class="tongue tongue-bottom tongue-section-primary scroll-me">
            <i class="fas fa-angle-down"></i>
        </a>
    </section>
    <section class="slice slice-lg bg-section-secondary" id="sct-faq">
        <div class="container">
            <div class="row row-grid">
                <div class="col-lg-3">
                    <!-- Side menu -->
                    <div data-toggle="sticky" data-sticky-offset="30">
                        <div class="card">
                            <div class="list-group list-group-flush">
                                <?php if(is_array($terms)){foreach($terms as $item){?>
                                <a href="#term<?=$item['id']?>" data-scroll-to data-scroll-to-offset="50" class="list-group-item list-group-item-action d-flex justify-content-between">
                                    <div>
                                        <span><?=$item['subject']?></span>
                                    </div>
                                    <div>
                                        <i class="fas fa-angle-right"></i>
                                    </div>
                                </a>
                                <?php }}?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 ml-lg-auto">
                    <!-- Theme integration -->
                    <?php if(is_array($terms)){foreach($terms as $item){?>
                    <div class="mb-5">
                        <h4 class="mb-4" id="term<?=$item['id']?>"><?=$item['subject']?></h4>
                        <!-- Accordion -->
                        <div id="accordion-<?=$item['id']?>" class="accordion accordion-spaced">
                            <!-- Accordion card 1 -->
                            <?php if(is_array($item['content'])){foreach($item['content'] as $itm){?>
                            <div class="card">
                                <div class="card-header py-4" id="heading-<?=$item['id']?>-<?=$itm['id']?>" data-toggle="collapse" role="button" data-target="#collapse-<?=$item['id']?>-<?=$itm['id']?>" aria-expanded="false" aria-controls="collapse-<?=$item['id']?>-<?=$itm['id']?>">
                                    <h6 class="mb-0"><?=$itm['question']?></h6>
                                </div>
                                <div id="collapse-<?=$item['id']?>-<?=$itm['id']?>" class="collapse" aria-labelledby="heading-<?=$item['id']?>-<?=$itm['id']?>" data-parent="#accordion-<?=$item['id']?>">
                                    <div class="card-body">
                                        <p><?=$itm['answer']?></p>
                                    </div>
                                </div>
                            </div>
                            <?php }}?>
                        </div>
                        <!-- Scroll to top -->
                        <div class="text-right py-4">
                            <a href="#term<?=$item['id']?>" data-scroll-to data-scroll-to-offset="50" class="text-sm font-weight-bold">Back to top<i class="fas fa-long-arrow-alt-up ml-2"></i></a>
                        </div>
                    </div>
                    <?php }}?>
                </div>
            </div>
        </div>
    </section>
    <?php $this->load->view('template/before_footer'); ?>
</div>
<?php $this->load->view('template/footer'); ?> 

