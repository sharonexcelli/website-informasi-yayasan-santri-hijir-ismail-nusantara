<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Yayasan Santri Hijir Ismail Nusantara">
  <meta name="author" content="Hijir Ismail">
  <title>Yayasan Santri Hijir Ismail Nusantara</title>
  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url()?>assets/img/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url()?>assets/img/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url()?>assets/img/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url()?>assets/img/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url()?>assets/img/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url()?>assets/img/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url()?>assets/img/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url()?>assets/img/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url()?>assets/img/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="<?= base_url()?>assets/img/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url()?>assets/img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url()?>assets/img/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url()?>assets/img/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?= base_url()?>assets/img/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="<?= base_url()?>assets/img/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <!-- Font Awesome 5 -->
  <link rel="stylesheet" href="<?= base_url()?>assets/libs/@fortawesome/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
  <!-- Page CSS -->
  <!-- <link rel="stylesheet" href="<?= base_url()?>assets/libs/flatpickr/dist/flatpickr.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.6/flatpickr.min.css" integrity="sha512-OtwMKauYE8gmoXusoKzA/wzQoh7WThXJcJVkA29fHP58hBF7osfY0WLCIZbwkeL9OgRCxtAfy17Pn3mndQ4PZQ==" crossorigin="anonymous" />
  <link rel="stylesheet" href="<?= base_url()?>assets/libs/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/libs/swiper/dist/css/swiper.min.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/libs/@fancyapps/fancybox/dist/jquery.fancybox.min.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/libs/sweetalert2/dist/sweetalert2.min.css">
  <!-- Beruang Purpose CSS -->
  <link rel="stylesheet" href="<?= base_url()?>assets/css/purpose-blue-light.css" id="stylesheet">
  <link rel="stylesheet" href="<?= base_url()?>assets/css/style.css?a=<?=md5(strtotime('now'))?>" id="stylesheet">
  <?php if(isset($meta)){?>
    <meta property="og:title" content="<?=$meta['title']?>" />
    <meta property="og:type" content="<?=$meta['type']?>" />
    <meta property="og:image" content="<?=$meta['image']?>" />
    <meta property="og:url" content="<?=$meta['url']?>" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?=$meta['url']?>">
    <meta name="twitter:title" content="<?=$meta['title']?>">
    <meta name="twitter:image" content="<?=$meta['image']?>">
  <?php }?>
</head>

<body>
<header class="header header-transparent" id="header-main">
    <!-- Main navbar -->
    <nav class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-dark bg-primary-dark" id="navbar-main">
      <div class="container px-lg-0">
        <!-- Logo -->
        <a class="navbar-brand mr-lg-5 d-none d-md-block" href="<?= base_url()?>">
          <img alt="Image placeholder" src="<?=base_url()?>assets/img/LogoYayasan-removebg.png" id="navbar-logo" style="height: 100px;border-radius:100%;">
        </a>

        <!-- Logo -->
        <a class="navbar-brand mr-lg-5  d-md-block d-lg-none" href="<?= base_url()?>">
            <img alt="Image placeholder" src="<?=base_url()?>assets/img/LogoYayasan-removebg.png" id="navbar-logo" style="height: 100px;">
        </a>

        <!-- Navbar collapse trigger -->
        <button class="navbar-toggler pr-0" type="button" data-toggle="collapse" data-target="#navbar-main-collapse"
          aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar nav -->
        <div class="collapse navbar-collapse" id="navbar-main-collapse">

          <ul class="navbar-nav align-items-lg-center ml-lg-auto">

            <li class="nav-item d-lg-none d-xl-block">
              <a class="nav-link" href="<?= base_url()?>">HOME</a>
            </li>
            <li class="nav-item d-lg-none d-xl-block">
              <a class="nav-link" href="<?= base_url()?>aboutus">TENTANG PONDOK</a>
            </li>
            <li class="nav-item d-lg-none d-xl-block">
              <a class="nav-link" href="<?= base_url()?>profile-pengajar">PROFIL PENGAJAR</a>
            </li>
            <li class="nav-item d-lg-none d-xl-block">
              <a class="nav-link" href="<?= base_url()?>news">BERITA</a>
            </li>
            <li class="nav-item d-lg-none d-xl-block">
              <a href="<?= base_url()?>contactus"   class="btn btn-sm btn-white rounded-pill btn-icon rounded-pill d-none d-lg-inline-flex">

              <span class="btn-inner--text">KONTAK</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
