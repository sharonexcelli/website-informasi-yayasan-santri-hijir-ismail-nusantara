      <!-- Footer -->
      <div class="footer pt-5 pb-4 footer-light" id="footer-main">
        <div class="row text-center text-sm-left align-items-sm-center">
          <div class="col-sm-6">
            <p class="text-sm mb-0">&copy; 2022 <a href="<?=base_url()?>" class="h6 text-sm" target="_blank">Yayasan Santri Hijir Ismail Nusantara</a>. All rights reserved.</p>
          </div>
          <div class="col-sm-6 mb-md-0">
            <ul class="nav justify-content-center justify-content-md-end">
              <li class="nav-item">
                <a class="nav-link" href="#" target="_blank">Support</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Terms</a>
              </li>
              <li class="nav-item">
                <a class="nav-link pr-0" href="#">Privacy</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalUpdateProfile" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" id="updateProfile" data-url="<?php echo base_url('cms/profile/update');?>" action="<?php echo base_url('cms/profile/update'); ?>" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="st-address">User Name</label>
                    <input type="text" name="name" class="form-control" value="<?=$this->session->userdata('admin')->name?>" required>
                </div>
                <div class="form-group">
                    <label for="st-address">User Password. <span class="text-muted">Don't insert password if not want update it.</span></label>
                    <input type="password" name="password" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="st-address">Image Avatar. <span class="text-muted">Don't insert image if not want update it.</span></label>
                    <div>
                        <input type="file" name="fileImg" id="file-imgavtr" class="custom-input-file"/>
                        <label for="file-imgavtr">
                            <i class="fa fa-upload"></i>
                            <span>Choose a file…</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save!</button>
            </div>
        </form>
    </div>
</div>
  <!-- Scripts -->
  <!-- Core JS - includes jquery, bootstrap, popper, in-view and sticky-kit -->
  <script src="<?=base_url()?>assets/cms/js/purpose.core.js"></script>
  <!-- Page JS -->
  <script src="<?=base_url()?>assets/cms/libs/progressbar.js/dist/progressbar.min.js"></script>
  <script src="<?=base_url()?>assets/cms/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment-with-locales.min.js"></script>
  <script src="<?=base_url()?>assets/cms/libs/fullcalendar/dist/fullcalendar.min.js"></script>

  <script src="<?=base_url()?>assets/cms/libs/@fancyapps/fancybox/dist/jquery.fancybox.min.js"></script>
  <script src="<?=base_url()?>assets/cms/libs/bootstrap-slider/bootstrap-slider.min.js"></script>
  <script src="<?=base_url()?>assets/cms/libs/select2/select2.full.min.js"></script>
  <script src="<?=base_url()?>assets/cms/libs/flatpickr/dist/flatpickr.min.js"></script>
  <script src="<?=base_url()?>assets/cms/libs/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script src="<?=base_url()?>assets/cms/libs/quill/dist/quill.min.js"></script>
  <script src="<?=base_url()?>assets/cms/libs/sweetalert2/dist/sweetalert2.min.js"></script>
  <script src="<?=base_url()?>assets/cms/libs/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script src="<?=base_url()?>assets/cms/js/MessageBox.js"></script>
  <script type="text/javascript" src="//unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/js-cookie@2.2.1/src/js.cookie.min.js"></script>
  <!-- Purpose JS -->
  <script src="<?=base_url()?>assets/cms/js/purpose.js"></script>
  <!-- Demo JS - remove it when starting your project -->
  <script src="<?=base_url()?>assets/cms/js/demo.js"></script>
  <script src="<?=base_url()?>assets/cms/js/script.js?a=<?=md5(strtotime('now'))?>"></script>

</body>

</html>
