<?php
    /* 
     * Template Name: Photo
     */
    get_header();
    $dir = get_template_directory_uri();
    $current_user = wp_get_current_user();
    $page = get_post(get_the_ID());
    $photo = get_posts([
        'posts_per_page' => -1,
        'category_name'  => 'photo',
        'orderby'        => 'date'
    ]);
?>
<section id="post" class="mt-5 bg-white">
    <nav class="bg-primary jumbotron m-0 pt-5">
        <div class="container px-3 pb-3">
            <ol class="breadcrumb rounded-0 mb-0">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item text-muted" aria-current="page">
                    <?=$post->post_title;?>
                </li>
            </ol>              
        </div>
    </nav> 
    <div class="container py-5">
        <div class="row pt-5">
            <div class="col-12 text-center intro">
                <h2 class="fw-bold"><?=$post->post_title;?></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-5 text-center">
                <p><?=$post->post_content;?></p>
            </div>
        </div>
        <pre><?php //var_dump($photo);?></pre>
        <div class="row g-3 mb-5">   
            <?php foreach($photo as $post) { ?>
            <div class="col-lg-4 col-12">
                <div class="card border-0 shadow h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <a 
                                href="<?=currentImagePost($post->ID);?>" 
                                data-fancybox="gallery" 
                                data-caption="<?=$post->post_title;?>" 
                                class="d-flex align-items-center bg-dark rounded"
                                style="height: 600px"
                            >
                                <img src="<?=currentImagePost($post->ID);?>" alt="<?=$post->post_title;?>" class="w-100" />
                            </a> 
                            <strong class="d-block my-3"><?=$post->post_title;?></strong>
                        </div>

                        <div class="d-flex flex-column">
                            <?=$post->post_content;?><?php edit_post_link('ред.', '<u>', '</u>', $post->ID, '');?>
                            <div class="d-flex gap-2 align-items-center fs-6 text-muted">
                                <i class="material-symbols-outlined">calendar_month</i>
                                <span><?=getFormatBlogDate($post->post_date);?></span> 
                            </div>  
                            <?php if(getTagBlog($post->ID)) { ?>
                            <div class="d-flex gap-2 mt-2">
                                <?=getTagBlog($post->ID);?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>