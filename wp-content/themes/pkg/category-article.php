<?php 
    /*
    Template Name: Публикации
    Template Post Type: post
    */
    get_header();

    $page = get_post(get_the_ID());
    registerCssStyle('
        .fancybox__carousel 
        .fancybox__slide.has-pdf 
        .fancybox__content {
            width: 100%;
            height: 94% !important;
            margin-bottom: -40px !important;
        }
    ');
    $fields = CFS()->get( 'section' );
?>
<section id="blog" class="mt-5 bg-white">
    <nav class="bg-primary jumbotron m-0 pt-5">
        <div class="container px-3 pb-3">
            <ol class="breadcrumb rounded-0 mb-0">
                <li class="breadcrumb-item"><a href="/" class="text-white">Главная</a></li>
                <li class="breadcrumb-item"><a href="/article">Публикации</a></li>
                <li class="breadcrumb-item text-muted" aria-current="page">
                    <?=$page->post_title;?>
                </li>
            </ol>              
        </div>
    </nav> 
    
    <div class="container pt-1 pb-5">
        <div class="row pt-5 pb-5">
            <div class="col-md-4">
                <img 
                    src="<?=get_the_post_thumbnail_url( $page->ID, 'full' );?>" 
                    class="w-100 shadow"
                    alt="<?=$post->post_title;?>" 
                />
            </div>
            <div class="col-md-8 info">
                <div class="ms-5">
                    <h3 class="fw-bold text-primary m-0"><?=$page->post_title;?></h3>
                    <?=$page->post_content;?>
                    <p class="text-muted"><?=$page->post_excerpt?></p>
                    <pre><?php //var_dump($page);?></pre>
                    <?php foreach ( $fields as $key => $field ) { ?>
                        <?php foreach($field['header'] as $item) { ?>
                            <h5 class="fw-bold mt-5 mb-3"><?=$item['header_name'];?></h5>
                            <?php foreach($item['subname'] as $list) { ?>
                                <p class="mb-1 text-muted"><?=$list['author'];?></p>
                                <a data-fancybox="pdf" data-type="pdf" href="<?=$list['file'];?>" class="d-flex gap-2">
                                    <i class="fa fa-file-pdf text-danger"></i> 
                                    <h6 class="text-decoration-underline"><?=$list['name'];?></h6>
                                </a>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>                      
                </div>
            </div>

        </div>
    </div>
</section>
<hr />
<?php get_footer();?>