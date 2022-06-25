<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Ikatan Keluarga Alumni Universitas Islam Indonesia">
  <meta name="author" content="IKA UII">
  <title>CMS - Yayasan Santri Hijir Ismail Nusantara</title>
  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="57x57" href="<?=base_url()?>assets/img/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?=base_url()?>assets/img/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?=base_url()?>assets/img/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?=base_url()?>assets/img/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?=base_url()?>assets/img/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?=base_url()?>assets/img/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?=base_url()?>assets/img/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?=base_url()?>assets/img/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url()?>assets/img/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="<?=base_url()?>assets/img/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url()?>assets/img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?=base_url()?>assets/img/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url()?>assets/img/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?=base_url()?>assets/img/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="<?=base_url()?>assets/img/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <!-- Font Awesome 5 -->
  <link rel="stylesheet" href="<?=base_url()?>assets/cms/libs/@fortawesome/fontawesome-free/css/all.min.css"><!-- Purpose CSS -->
  <link rel="stylesheet" href="<?=base_url()?>assets/cms/libs/sweetalert2/dist/sweetalert2.min.css" id="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>assets/cms/css/purpose.css" id="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>assets/cms/css/style.css?a=<?=md5(strtotime('now'))?>" id="stylesheet">
</head>

<body class="application application-offset">
  <!-- Application container -->
  <div class="container-fluid container-application">
    <!-- Sidenav -->
    <!-- Content -->
    <div class="main-content position-relative">
      <!-- Main nav -->
      <!-- Page content -->
      <div class="page-content">
        <div class="min-vh-100 py-5 d-flex align-items-center">
          <div class="w-100">
            <div class="row justify-content-center">
              <div class="col-sm-8 col-lg-4">
                <div class="card shadow zindex-100 mb-0">
                  <div class="card-body px-md-5 py-5">
                    <div class="mb-5">
                        <img src="<?=base_url('assets/img/LogoYayasan-removebg.png')?>" id="navbar-logo"  style="width: 150px; border-radius: 100%; height:auto; display: block; margin: 0 auto;">
                      <p class="text-muted mb-0 mt-3 text-center">Sign in to your account to continue.</p>
                    </div>
                    <span class="clearfix"></span>
                    <form role="form" method="post" id="formid" action="<?=base_url('cms/auth/do-login')?>">
                      <div class="form-group">
                        <label class="form-control-label">Username</label>
                        <div class="input-group input-group-merge">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                          </div>
                          <input type="email" name="username" class="form-control" id="input-email" placeholder="Your Email" required>
                        </div>
                      </div>
                      <div class="form-group mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                          <div>
                            <label class="form-control-label">Password</label>
                          </div>
                          <div class="mb-2">
                            <!-- <a href="#!" class="small text-muted text-underline--dashed border-primary">Lost password?</a> -->
                          </div>
                        </div>
                        <div class="input-group input-group-merge">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                          </div>
                          <input type="password" name="password" class="form-control" id="input-password" placeholder="Password" required>
                          <div class="input-group-append">
                            <span class="input-group-text">
                              <a href="#" data-toggle="password-text" data-target="#input-password">
                                <i class="fas fa-eye"></i>
                              </a>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="mt-4">
                        <button type="submit" class="btn btn-sm btn-primary btn-icon rounded-pill" id="sbmtbtn">
                          <span class="btn-inner--text">Sign in</span>
                          <span class="btn-inner--icon"><i class="fas fa-long-arrow-alt-right"></i></span>
                        </button>
                        <div id='recaptcha' class="g-recaptcha" data-sitekey="<?=__CLIENT_CAPTCHA__?>" data-callback="onSubmit" data-size="invisible"></div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
    </div>
  </div>
  <!-- Scripts -->
  <!-- Core JS - includes jquery, bootstrap, popper, in-view and sticky-kit -->
  <script src="<?=base_url()?>/assets/cms/js/purpose.core.js"></script>
  <script src="<?=base_url()?>assets/cms/libs/sweetalert2/dist/sweetalert2.min.js"></script>
  <!-- Purpose JS -->
  <script src="<?=base_url()?>/assets/cms/js/purpose.js"></script>
  <!-- Demo JS - remove it when starting your project -->
  <script src="https://www.google.com/recaptcha/api.js"></script>
  <script src="<?=base_url()?>/assets/cms/js/demo.js"></script>
  <script>
    // function onSubmit(token) {
    //   $('#formid').submit();
    // }
    $(document).ready(function(){
    // $('#formid').submit(function(event) {
    //   if (!grecaptcha.getResponse()) {
    //       event.preventDefault();
    //       grecaptcha.execute();
    //   }
    // });
    <?php if($this->session->flashdata('error')){?>
      Swal.fire({
          title: 'Error',
          type: 'error',
          text: "Error to login, please check your account is correct",
      })
    <?php }?>
    })
  </script>
</body>

</html>
