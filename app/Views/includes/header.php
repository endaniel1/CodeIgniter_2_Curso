<?php //bloque php
$db = \Config\Database::connect(); //Cargamos la conexion a ala BD
//Hacemos una consulta a la tabla categories
$query  = $db->query("SELECT * FROM categories");
$result = $query->getResult(); //Obtemos lo resultados de la consulta Y Guardamos en una variable
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Wordsmith</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="<?=base_url()?>/public/assets/css/base.css">
    <link rel="stylesheet" href="<?=base_url()?>/public/assets/css/vendor.css">
    <link rel="stylesheet" href="<?=base_url()?>/public/assets/css/main.css">

    <!-- script
    ================================================== -->
    <script src="<?=base_url()?>/public/assets/js/modernizr.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="<?=base_url()?>/public/assets/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?=base_url()?>/public/assets/images/favicon.ico" type="image/x-icon">
    <?php //Comprobamos si exite la vista uploadPost?>
    <?php if ($view == "uploadPost"): ?>
        <!-- Java Script
        ================================================== -->
        <script src="<?=base_url()?>/public/assets/js/jquery-3.2.1.min.js"></script>
        <script src="<?=base_url()?>/public/assets/js/plugins.js"></script>
        <script src="<?=base_url()?>/public/assets/js/main.js"></script>

        <!-- include libraries(bootstrap) -->

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!-- include summernote css/js -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.js"></script>
    <?php endif?>
</head>

<body id="top">

    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader" class="dots-fade">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>


    <!-- header
    ================================================== -->
    <header class="s-header header">

        <div class="header__logo">
            <a class="logo" href="index.html">
                <img src="<?=base_url()?>/public/assets/images/logo.svg" alt="Homepage">
            </a>
        </div> <!-- end header__logo -->

        <a class="header__search-trigger" href="#0"></a>
        <div class="header__search">

            <form role="search" method="get" class="header__search-form" action="#">
                <label>
                    <span class="hide-content">Search for:</span>
                    <input type="search" class="search-field" placeholder="Type Keywords" value="" name="s" title="Search for:" autocomplete="off">
                </label>
                <input type="submit" class="search-submit" value="Search">
            </form>

            <a href="#0" title="Close Search" class="header__overlay-close">Close</a>

        </div>  <!-- end header__search -->

        <a class="header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>
        <nav class="header__nav-wrap">

            <h2 class="header__nav-heading h6">Navigate to</h2>

            <ul class="header__nav">
                <li class="current"><a href="<?=base_url()?>" title="">Home</a></li>
                <li class="has-children">
                    <a href="#0" title="">Categories</a>
                    <ul class="sub-menu">
                        <?php //Hacemos un foreach para obtener los resultados de las categorias?>
                        <?php foreach ($result as $category): ?>
                            <li><a href="<?=base_url()?>/dashboard/category/<?=$category->id?> "><?=$category->name?></a></li>
                        <?php endforeach?>
                    </ul>
                </li>
                <li class="">
                    <a href="<?=base_url()?>/dashboard/blog" title="">Blog</a>
                </li>
            </ul> <!-- end header__nav -->

            <a href="#0" title="Close Menu" class="header__overlay-close close-mobile-menu">Close</a>

        </nav> <!-- end header__nav-wrap -->

    </header> <!-- s-header -->
