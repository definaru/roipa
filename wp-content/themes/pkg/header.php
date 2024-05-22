<!doctype html>
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WPHeader">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php
    $page = get_post(get_the_ID());
    $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $description = trim(preg_replace('/[\t\n\r\s]+/', ' ', strip_tags($page->post_content)));
    $description = substr($description, 0, 200);
    $description = (is_home()) ? get_bloginfo('description', 'display') : str_replace('&nbsp;', ' ', $description);
    //$description = html_entity_decode($description);
    $title = (is_home()) ? get_bloginfo( 'name', 'display' ) : $page->post_title;
    $image = (is_home()) ? 'https://roipa.ru/wp-content/themes/pkg/img/atlantida.jpg' : currentImagePost($page->ID);
?>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="theme-color" content="#ffc107"/>
<meta name="msapplication-navbutton-color" content="#ffc107"/>
<meta name="apple-mobile-web-app-status-bar-style" content="#ffc107"/>
<?=wp_actions();?>
<title itemprop="headline"><?=$title; ?></title>

<meta name="keywords" content="РОИПА, атлантида, сообщество" />
<meta name="description" content="<?=$description;?>" />
<meta property="og:title" content="<?=$title; ?>" />
<meta property="og:description" content="<?=$description;?>"/>
<meta property="og:type" content="website" />
<meta property="og:image" content="<?=$image;?>" />
<meta property="og:site_name" content="РОИПА" />
<meta property="og:locale" content="ru_RU" />
<meta property="og:url" content="<?=$url;?>" />     

<?php wp_site_icon();?>

<link rel="apple-touch-icon" href="<?=get_template_directory_uri();?>/img/apple-touch.jpg" />
<?=add_wp_style();?>
</head>
<body itemscope itemtype="http://schema.org/Organization">
    <div id="app" class="<?=$page->ID;?>">
    <header id="navigation" class="shadow fixed-top <?=isIndexHome();?>">
        <nav class="navbar navbar-expand-lg container align-items-center<?=$_SERVER['REQUEST_URI'] === '/' ? '' : ' py-0';?>">
            <a href="/" id="logo">
                <img src="<?=get_template_directory_uri();?>/img/logo-roipa.svg" alt="РОИПА" />
                <span class="d-none" itemprop="name">РОИПА</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#navbarContent">
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <?php 
                    wp_nav_menu( array(
                        'menu' => 'Primary',
                        //'fallback_cb' => '__return_empty_string',
                        'container' => 'ul',
                        'menu_class' => 'd-flex flex-column flex-lg-row gap-4 mx-auto my-lg-0 my-4',
                        'container_class' => 'sex',
                        'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                        'depth' => 10,
                    ) );
                ?>
                    
                <div class="h-100 d-flex justify-content-center">
                    <?=isUserLogin();?>
                </div>
            </div>
        </nav>
    </header>