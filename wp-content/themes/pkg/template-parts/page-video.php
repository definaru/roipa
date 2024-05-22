<?php
    /* 
     * Template Name: Видео
     */
    get_header();
    $dir = get_template_directory_uri();
    $current_user = wp_get_current_user();
    $page = get_post(get_the_ID());
    $videolist = get_posts([
        'posts_per_page' => -1,
        'category_name'  => 'video',
        'orderby'        => 'date'
    ]);
?>
<section id="post" class="mt-5 bg-white">
    <nav class="bg-primary jumbotron m-0 pt-md-5 pt-3">
        <div class="container px-3 pb-3">
            <ol class="breadcrumb rounded-0 mb-0">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item text-muted" aria-current="page">
                    <?=$page->post_title;?>
                </li>
            </ol>              
        </div>
    </nav> 
    <div class="container py-5">
        <div class="row pt-5">
            <div class="col-12 text-center intro">
                <h2 class="fw-bold"><?=$page->post_title;?></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-5">
                <p><?=$page->post_content;?></p>
                <?php edit_post_link('ред.', '', '', $page->ID, '');?>
            </div>
        </div>
        <div class="row"> 
            <?php foreach($videolist as $post) { ?>
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header p-0 position-relative">
                        <a href="/video/<?=$post->post_name;?>">
                            <div class="play position-absolute d-flex align-items-center justify-content-center h-100 w-100" style="background: #0000005e">
                                <span class="material-symbols-outlined text-white" style="font-size: 6.5rem">
                                    play_circle
                                </span>
                            </div>
                        </a>
                        <img 
                            src="<?=currentImagePost($post->ID);?>" 
                            class="rounded-top w-100 blog-image" 
                            alt="<?=htmlspecialchars($post->post_title);?>"
                        />
                    </div> 
                    <div class="card-body text-center" style="height: 100px">
                        <h6 class="fw-bold m-0"><?=$post->post_title;?></h6>
                    </div> 
                    <div class="d-grid card-footer border-0" style="background:#fff">
                        <a href="/video/<?=$post->post_name;?>" class="btn btn-info text-white fw-bold">
                           Посмотреть
                        </a>
                    </div>
                </div>
            </div>            
            <?php } ?>
        </div>
        <pre><?php //var_dump($videolist);?></pre>
    </div>
</section>
<?php get_footer(); ?>