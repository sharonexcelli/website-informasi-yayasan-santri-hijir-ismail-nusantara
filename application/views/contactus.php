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
                            <h1 class="text-white"><?=$banner['title']?></h1>
                            <p class="lead text-white mt-4"><?=$banner['description']?></p>
                            <a href="#sct_contact_form" class="btn btn-secondary rounded-pill btn-icon hover-translate-y-n3 mt-4" data-scroll-to data-scroll-to-offset="140">
                                <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                <span class="btn-inner--text">Kirim Pesan</span>
                            </a></div>
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
    <section id="sct_contact_form" class="slice slice-lg bg-section-secondary" data-delimiter-before="1">
        <div class="container">
            <div class="row row-grid align-items-center">
                <div class="col-lg-6">
                    <h3>Hubungi Kami</h3>
                    <p class="lead">Silahkan mengisi pada form yang telah kami sediakan.</p>
                    <form action="<?=base_url('send-contactus')?>" method="post" id="submit-form" class="mt-5">
                        <div class="form-group">
                            <label class="sr-only">Nama Lengkap</label>
                            <input class="form-control form-control-lg" name="name" placeholder="Nama Lengkap" type="text" required>
                        </div>
                        <div class="form-group">
                            <label class="sr-only">Email</label>
                            <input class="form-control form-control-lg" name="email" placeholder="Email " type="text" required>
                        </div>
                        <div class="form-group">
                            <label class="sr-only">Pesan Anda</label>
                            <textarea class="form-control form-control-lg textarea-autosize" name="message" rows="5" placeholder="Pesan Anda" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary rounded-pill mt-4" id="sbmtbtn">Kirim Pesan</button>
                        <div id='recaptcha' class="g-recaptcha" data-sitekey="<?=__CLIENT_CAPTCHA__?>" data-callback="onSubmit" data-size="invisible"></div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <div class="card bg-dark opacity-container text-white overflow-hidden shadow border-0">
                        <a href="#" data-fancybox data-type="iframe" data-src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.2996573239006!2d106.80402861454924!3d-6.483683065195137!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c398d5dd2b8d%3A0x6b911018bddac824!2sMajelis%20Taklim%20Hijir%20Ismail!5e0!3m2!1sen!2sid!4v1644497203176!5m2!1sen!2sid">
                            <div class="card-img-bg" style="background-image: url('/assets/img/Yayasan.jpeg');"></div>
                            <span class="mask bg-gradient-primary opacity-7 opacity-8--hover"></span>
                            <div class="card-body px-5 py-5">
                                <div style="min-height: 250px;">
                                    <h2 class="h2 text-white font-weight-bold mb-4">Pondok Hijir Ismail</h2>
                                    <p class="text-white"> Jl. Bambu Kuning Dalam RT 05/13 Kec. Bojonggede Kab. Bogor </p>
                                    <p class="h6 text-white mt-4 mb-2"><i class="fas fa-envelope"></i> WhatsApp +62 853-1111- 1674 </p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php $this->load->view('template/before_footer'); ?>
</div>
<?php $this->load->view('template/footer'); ?>
<script>
function onSubmit(token) {
    $('#submit-form').submit();
}
$('document').ready(function(){
    $('#submit-form').submit(function(event) {
      if (!grecaptcha.getResponse()) {
          event.preventDefault();
          grecaptcha.execute();
      }
    });
    <?php if($this->session->flashdata('success')==true){?>
        Swal.fire({
            title: 'Success',
            text: "Terima kasih telah mengirimkan pesan kepada Kami. Mohon tunggu kami akan segera membalas pesan Anda.",
        })
    <?php }?>
    <?php if($this->session->flashdata('error')==true){?>
        Swal.fire({
            title: 'Error',
            text: "E-Captcha not valid.",
        })
    <?php }?>
})
</script>
