<?php $this->load->view('template/header'); ?>
<div class="main-content">
    <!-- Header (coming-soon) -->
    <section class="slice bg-primary spotlight" data-spotlight>
      <div class="spotlight-holder py-6 py-md-9">
        <div class="container pb-md-8 position-relative zindex-100">
          <div class="col px-0">
            <div class="row justify-content-center">
              <div class="col-lg-7 text-center">
                <figure class="mx-auto mb-3" style="width: 70%;">
                  <img class="img-fluid" src="<?=base_url()?>assets/kta/img/card-image-01.png" alt="SVG">
                </figure>
                <h6 class="h1 my-4 text-white">COMING SOON</h6>
                <p class="px-md-5 text-white mb-5">
                    Universitas Islam Indonesia, sebagai pionir pendidikan tinggi di Indonesia sudah memiliki lebih dari 100.000 alumni. <br>

                    Ikatan Keluarga Alumni UII (IKA UII) berupaya membuat data base alumni yang kini tersebar di seluruh wilayah Indonesia, bahkan manca negara. Tujuannya adalah untuk mempererat silaturahmi antar alumni.
                    <br/>UII JAYA, ALUMNI HEBAT.

                </p>
                <!-- Countdown -->
                <div class="countdown countdown-hero countdown-hero-dark" data-countdown-date="9/30/2020"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="shape-container" data-shape-position="bottom">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" x="0px" y="0px" viewBox="0 0 1000 300" style="enable-background:new 0 0 1000 300;" xml:space="preserve" class="ie-shape-wave-1">
          <path d="M 0 246.131 C 0 246.131 31.631 250.035 47.487 249.429 C 65.149 248.755 82.784 245.945 99.944 241.732 C 184.214 221.045 222.601 171.885 309.221 166.413 C 369.892 162.581 514.918 201.709 573.164 201.709 C 714.375 201.709 772.023 48.574 910.547 21.276 C 939.811 15.509 1000 24.025 1000 24.025 L 1000 300.559 L -0.002 300.559 L 0 246.131 Z" />
        </svg>
      </div>
    </section>
    <!-- Call to action -->
    <?php $this->load->view('template/before_footer'); ?>
</div>
<?php $this->load->view('template/footer'); ?> 