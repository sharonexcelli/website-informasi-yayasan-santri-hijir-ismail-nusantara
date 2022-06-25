<footer id="footer-main">
    <div class="footer footer-dark bg-gradient-primary footer-rotate">
      <div class="container">
        <div class="row pt-md">
          <div class="col-lg-4 mb-5 mb-lg-0 text-center text-lg-left">
            <a href="<?= base_url()?>">
              <img src="<?=base_url('assets/img/LogoYayasan-removebg.png')?>" class="ml-md-n2 mb-3" alt="Footer logo"
                style="height: 140px;border-radius:100%;">
            </a>
              <h6 class="text-sm text-white">Pondok Hijir Ismail</h6>
              <h6 class="text-sm text-white"> <i class="fas fa-map-marker-alt"></i>
Jl. Bambu Kuning Dalam RT 05/13 Kec. Bojonggede Kab. Bogor</h6>

          </div>
          <div class="col-lg-2 col-4 col-sm-4 ml-lg-auto mb-5 mb-lg-0">
            <h6 class="heading mb-3">Pondok</h6>
            <ul class="list-unstyled">
              <li class="text-sm"><a href="<?= base_url()?>aboutus">Profil</a></li>
              <li class="text-sm"><a href="<?= base_url()?>profile-pengajar">Pengajar</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-4 col-sm-4 mb-5 mb-lg-0">
            <h6 class="heading mb-3">Tautan</h6>
            <ul class="list-unstyled text-small">
              <li class="text-sm"><a href="/news"  >Berita</a></li>
              <li class="text-sm"><a href="/pendidikan-umum"  >Pendidikan Umum</a></li>
              <li class="text-sm"><a href="/pendidikan-khusus" >Pendidikan Khusus</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-4 col-sm-4 mb-5 mb-lg-0">
            <h6 class="heading mb-3">Tentang Website</h6>
            <ul class="list-unstyled">
              <!-- <li class="text-sm"><a href="<?= base_url()?>terms-and-condition">SYARAT DAN KETENTUAN</a></li> -->
              <!-- <li class="text-sm"><a href="<?= base_url()?>frequently-asked-questions">FAQ</a></li> -->
              <!-- <li class="text-sm"><a href="<?= base_url()?>privacy-and-policy">KEBIJAKAN PRIVASI</a></li> -->
              <li class="text-sm"><a href="<?= base_url()?>contactus">Kontak</a></li>
            </ul>
          </div>
        </div>
        <div class="row align-items-center justify-content-md-between py-4 mt-4 delimiter-top">
          <div class="col-md-6">
            <div class="copyright text-sm font-weight-bold text-center text-md-left">
              &copy; 2022 <a href="#" class="font-weight-bold" target="_blank">Pondok Hijril Ismail</a>. All rights reserved.
            </div>
          </div>
          <div class="col-md-6">
            <ul class="nav justify-content-center justify-content-md-end mt-3 mt-md-0">
              <li class="nav-item">
                  <a href="https://yayasan-santri.beruangstudio.com/#" class="nav-link" target="_blank">
                      <i class="fab fa-youtube"></i>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="https://www.instagram.com/ismailhijir/" class="nav-link" target="_blank">
                      <i class="fab fa-instagram"></i>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="https://www.facebook.com/hijir.ismail.5686" class="nav-link" target="_blank">
                      <i class="fab fa-facebook"></i>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="https://wa.me/6285311111674" class="nav-link" target="_blank">
                      <i class="fab fa-whatsapp"></i>
                  </a>
              </li>

            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Core JS - includes jquery, bootstrap, popper, in-view and sticky-kit -->
  <script src="<?= base_url()?>assets/js/purpose.core.js"></script>
  <!-- Page JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment-with-locales.min.js"></script>
  <!-- <script src="<?= base_url()?>assets/libs/flatpickr/dist/flatpickr.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.6/flatpickr.min.js" integrity="sha512-Nc36QpQAS2BOjt0g/CqfIi54O6+UWTI3fmqJsnXoU6rNYRq8vIQQkZmkrRnnk4xKgMC3ESWp69ilLpDm6Zu8wQ==" crossorigin="anonymous"></script>
  <script src="<?= base_url()?>assets/libs/select2/dist/js/select2.min.js"></script>
  <script src="<?= base_url()?>assets/libs/swiper/dist/js/swiper.min.js"></script>
  <script src="<?= base_url()?>assets/libs/sweetalert2/dist/sweetalert2.min.js"></script>
  <script src="<?= base_url()?>assets/libs/@fancyapps/fancybox/dist/jquery.fancybox.min.js"></script>
  <script src="<?= base_url()?>assets/libs/jquery-countdown/dist/jquery.countdown.min.js"></script>
  <!-- Purpose JS -->
  <script src="<?= base_url()?>assets/js/purpose.js"></script>
  <!-- Demo JS - remove it when starting your project -->
  <script src="<?= base_url()?>assets/js/demo.js"></script>
  <script src="https://www.google.com/recaptcha/api.js"></script>

  <script src="<?= base_url()?>assets/js/script.js?a=<?=md5(strtotime('now'))?>"></script>
</body>

</html>
