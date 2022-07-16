<?php
$class = $this->router->class;
?>
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
  <link rel="stylesheet" href="<?=base_url()?>assets/cms/libs/@fortawesome/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
  <!-- Page CSS -->
  <link rel="stylesheet" href="<?=base_url()?>assets/cms/libs/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/cms/libs/@fancyapps/fancybox/dist/jquery.fancybox.min.css" id="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>assets/cms/libs/bootstrap-slider/bootstrap-slider.min.css" id="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>assets/cms/libs/select2/dist/css/select2.min.css" id="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>assets/cms/libs/select2/select2-bootstrap4.min.css" id="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>assets/cms/libs/flatpickr/dist/flatpickr.min.css" id="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>assets/cms/libs/quill/dist/quill.core.css" id="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>assets/cms/libs/sweetalert2/dist/sweetalert2.min.css" id="stylesheet">
  <!-- Beruang CSS -->
  <link rel="stylesheet" href="<?=base_url()?>assets/cms/css/purpose.css" id="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>assets/cms/css/style.css?a=<?=md5(strtotime('now'))?>" id="stylesheet">
</head>

<body class="application application-offset">
  <!-- Application container -->
  <div class="container-fluid container-application">
    <!-- Sidenav -->
    <div class="sidenav" id="sidenav-main">
      <!-- Sidenav header -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="<?=base_url('cms')?>">
          <img src="<?=base_url('assets/img/LogoYayasan-removebg.png')?>" class="navbar-brand-img" style="height: 60px; border-radius: 100%;">
        </a>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler sidenav-toggler-dark d-md-none" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line bg-white"></i>
              <i class="sidenav-toggler-line bg-white"></i>
              <i class="sidenav-toggler-line bg-white"></i>
            </div>
          </div>
        </div>
      </div>
      <!-- User mini profile -->
      <div class="sidenav-user d-flex flex-column align-items-center justify-content-between text-center">
        <!-- Avatar -->
        <div>
          <a href="#" class="avatar rounded-circle avatar-xl">
            <img alt="Image placeholder" src="<?=base_url();?>assets/img/user.png" class="">
          </a>
          <div class="mt-4">
            <h5 class="mb-0 text-white"><?=$this->session->userdata('admin')->name?></h5>
            <span class="d-block text-sm text-white opacity-8 mb-3"><?=$this->session->userdata('admin')->role=='1'?'Super Admin':($this->session->userdata('admin')->role=='2'?'Pengisi Konten':'Viewer')?></span>
              <a href="<?=base_url()?>" target="_blank" class="btn btn-sm btn-secondary btn-icon rounded-pill shadow hover-translate-y-n3">
                  <span class="btn-inner--icon"><i class="fas fa-globe"></i></span>
                  <span class="btn-inner--text">Preview</span>
              </a>
              <a href="<?=base_url('cms/auth/do-logout')?>" class="btn btn-sm btn-white btn-icon rounded-pill shadow hover-translate-y-n3">
                  <span class="btn-inner--icon"><i class="fas fa-sign-out-alt"></i></span>
                  <span class="btn-inner--text">Logout</span>
              </a>

          </div>
        </div>

      </div>
      <!-- Application nav -->
      <div class="nav-application clearfix">
        <?php if($this->session->userdata('admin')->role==1||$this->session->userdata('admin')->role==2){?>
        <a href="<?=base_url('cms')?>" class="btn btn-square text-sm <?=$class=='main'?'active':''?>">
          <span class="btn-inner--icon d-block"><i class="fas fa-home fa-2x"></i></span>
          <span class="btn-inner--icon d-block pt-2">Home</span>
        </a>
        <a href="<?=base_url('cms/events')?>" class="btn btn-square text-sm <?=$class=='events'?'active':''?>">
            <span class="btn-inner--icon d-block"><i class="fas fa-calendar fa-2x"></i></span>
            <span class="btn-inner--icon d-block pt-2">Events</span>
        </a>
        <?php }?>

        <?php if($this->session->userdata('admin')->role==1||$this->session->userdata('admin')->role==2){?>

        <a href="<?=base_url('cms/news')?>" class="btn btn-square text-sm <?=$class=='news'?'active':''?>">
          <span class="btn-inner--icon d-block"><i class="fas fa-newspaper fa-2x"></i></span>
          <span class="btn-inner--icon d-block pt-2">News</span>
        </a>
        <a href="<?=base_url('cms/gallerys')?>" class="btn btn-square text-sm <?=$class=='gallerys'?'active':''?>">
          <span class="btn-inner--icon d-block"><i class="fas fa-images fa-2x"></i></span>
          <span class="btn-inner--icon d-block pt-2">Gallery</span>
        </a>
        <a href="<?=base_url('cms/testimonys')?>" class="btn btn-square text-sm <?=$class=='testimonys'?'active':''?>">
          <span class="btn-inner--icon d-block"><i class="fas fa-file-alt fa-2x"></i></span>
          <span class="btn-inner--icon d-block pt-2">Testimony</span>
        </a>
        <a href="<?=base_url('cms/quotes')?>" class="btn btn-square text-sm <?=$class=='quotes'?'active':''?>">
          <span class="btn-inner--icon d-block"><i class="fas fa-file-alt fa-2x"></i></span>
          <span class="btn-inner--icon d-block pt-2">Profile Pengajar</span>
        </a>
        <?php }?>
        <?php if($this->session->userdata('admin')->role==1){?>
        <a href="<?=base_url('cms/users')?>" class="btn btn-square text-sm <?=$class=='users'?'active':''?>">
          <span class="btn-inner--icon d-block"><i class="fas fa-users fa-2x"></i></span>
          <span class="btn-inner--icon d-block pt-2">Users</span>
        </a>
        <?php }?>
      </div>
      <!-- Misc area -->

    </div>
    <!-- Content -->
    <div class="main-content position-relative">
      <!-- Main nav -->
      <nav class="navbar navbar-main navbar-expand-lg navbar-dark bg-primary navbar-border" id="navbar-main">
        <div class="container-fluid">
          <!-- Brand + Toggler (for mobile devices) -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-main-collapse" aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <!-- User's navbar -->
          <div class="navbar-user d-lg-none ml-auto">
            <ul class="navbar-nav flex-row align-items-center">
              <li class="nav-item d-none d-sm-block">
                <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin" data-target="#sidenav-main"><i class="fas fa-bars"></i></a>
              </li>
              <li class="nav-item dropdown dropdown-animate ">
                <a class="nav-link pr-lg-0 " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="<?=base_url();?>assets/img/user.png">
                  </span>
                </a>
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                  <h6 class="dropdown-header px-0">Hi, <?=$this->session->userdata('admin')->name?>!</h6>
                  <?php if($this->session->userdata('admin')->role==1||$this->session->userdata('admin')->role==2){?>
                  <a href="<?=base_url('cms')?>" class="dropdown-item">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                  </a>
                  <?php }?>

                  <div class="dropdown-divider"></div>
                  <a href="<?=base_url('cms/auth/do-logout')?>" class="dropdown-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                  </a>
                </div>
              </li>
            </ul>
          </div>
          <!-- Navbar nav -->
          <div class="collapse navbar-collapse navbar-collapse-fade" id="navbar-main-collapse">
            <ul class="navbar-nav align-items-lg-center">
              <!-- Overview  -->
              <?php if($this->session->userdata('admin')->role==1||$this->session->userdata('admin')->role==2){?>
              <li class="nav-item d-lg-none ">
                <a class="nav-link" href="<?=base_url('cms')?>">
                  Dashboard
                </a>
              </li>
              <li class="border-top opacity-2 my-2"></li>
              <!-- Home  -->
              <li class="nav-item d-none d-sm-block">
                <a class="nav-link pl-lg-0" href="<?=base_url('cms')?>">
                  Home
                </a>
              </li>
              <?php }?>
              <!-- Application menu -->
              <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Menu
                </a>
                <div class="dropdown-menu dropdown-menu-arrow p-lg-0">
                  <!-- Top dropdown menu -->
                  <div class="p-lg-4">

                      <?php if($this->session->userdata('admin')->role==1||$this->session->userdata('admin')->role==2){?>

                      <div class="dropdown dropdown-animate dropdown-item" data-toggle="hover">
                          <a href="<?=base_url('cms/events')?>" class="dropdown-item" role="button">
                              Events
                          </a>
                      </div>
                      <div class="dropdown dropdown-animate dropdown-item" data-toggle="hover">
                          <a href="<?=base_url('cms/news')?>" class="dropdown-item" role="button">
                              News
                          </a>
                      </div>
                      <div class="dropdown dropdown-animate dropdown-item" data-toggle="hover">
                          <a href="<?=base_url('cms/testimonys')?>" class="dropdown-item" role="button">
                              Testimony
                          </a>
                      </div>
                      <div class="dropdown dropdown-animate dropdown-item" data-toggle="hover">
                          <a href="<?=base_url('cms/quotes')?>" class="dropdown-item" role="button">
                              Profile Pengajar
                          </a>
                      </div>
                      <div class="dropdown dropdown-animate dropdown-item" data-toggle="hover">
                          <a href="<?=base_url('cms/gallerys')?>" class="dropdown-item" role="button">
                              Gallery
                          </a>
                      </div>
                      <?php }?>
                      <?php if($this->session->userdata('admin')->role==1){?>
                      <div class="dropdown dropdown-animate dropdown-item mb-2" data-toggle="hover">
                          <a href="<?=base_url('cms/users')?>" class="dropdown-item" role="button">
                              Users Management
                          </a>
                      </div>
                      <?php }?>
                  </div>
                </div>
              </li>
              <?php if($this->session->userdata('admin')->role==1||$this->session->userdata('admin')->role==2){?>
                <li class="nav-item dropdown dropdown-animate" data-toggle="hover">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pages & Contents
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow p-lg-0">
                        <!-- Top dropdown menu -->
                        <div class="p-lg-4">
<!--                            <div class="dropdown dropdown-animate dropdown-item" data-toggle="hover">-->
<!--                                <a href="--><?//=base_url('cms/about')?><!--" class="dropdown-item" role="button">-->
<!--                                    Tentang Kami-->
<!--                                </a>-->
<!--                            </div>-->
                            <div class="dropdown dropdown-animate dropdown-item" data-toggle="hover">
                                <a href="<?=base_url('cms/terms')?>" class="dropdown-item" role="button">
                                    Term & Condition
                                </a>
                            </div>
                            <div class="dropdown dropdown-animate dropdown-item" data-toggle="hover">
                                <a href="<?=base_url('cms/privacy')?>" class="dropdown-item" role="button">
                                    Privacy Policy
                                </a>
                            </div>
                            <div class="dropdown dropdown-animate dropdown-item" data-toggle="hover">
                                <a href="<?=base_url('cms/faq')?>" class="dropdown-item" role="button">
                                    FAQ
                                </a>
                            </div>
                            <div class="dropdown dropdown-animate dropdown-item" data-toggle="hover">
                                <a href="<?=base_url('cms/banners')?>" class="dropdown-item" role="button">
                                    Banners
                                </a>
                            </div>
                        </div>

                    </div>
                </li>
                <?php }?>


              <li class="border-top opacity-2 my-2"></li>
              <!-- Docs menu -->
            </ul><!-- Right menu -->
            <ul class="navbar-nav ml-lg-auto align-items-center d-none d-lg-flex">
              <li class="nav-item">
                <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin" data-target="#sidenav-main"><i class="fas fa-bars"></i></a>
              </li>
              <li class="nav-item dropdown dropdown-animate">
                <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="media media-pill align-items-center">
                    <span class="avatar rounded-circle">
                      <img alt="Image placeholder" src="<?=base_url();?>assets/img/user.png">
                    </span>
                    <div class="ml-2 d-none d-lg-block">
                      <span class="mb-0 text-sm  font-weight-bold"><?=$this->session->userdata('admin')->name?></span>
                    </div>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                  <h6 class="dropdown-header px-0">Hi, <?=$this->session->userdata('admin')->name?></h6>
                  <?php if($this->session->userdata('admin')->role==1||$this->session->userdata('admin')->role==2){?>
                  <a href="<?=base_url('cms')?>" class="dropdown-item">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                  </a>
                  <?php }?>
                  <a href="#" data-target="#modalUpdateProfile" data-toggle="modal" class="dropdown-item">
                    <i class="fas fa-cog"></i>
                    <span>Profile</span>
                  </a>
                  <a href="https://www.beruangstudio.com/contact" target="_blank" class="dropdown-item">
                    <i class="fas fa-question-circle"></i>
                    <span>Support</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="<?=base_url('cms/auth/do-logout')?>" class="dropdown-item">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                  </a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
