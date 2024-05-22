<?php
    /* 
     * Template Name: Blog
     */
    get_header();
    $dir = get_template_directory_uri();
    $current_user = wp_get_current_user();
    $page = get_post(get_the_ID());
    $postslist = get_posts([
        'posts_per_page' => 9,
        'category_name'  => 'blog',
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
            <div class="col-md-12 mb-5">
                <p><?=$post->post_content;?></p>
            </div>
        </div>
        <div class="row">
            <?php foreach($postslist as $post) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header p-0 position-relative">
                            <div class="position-absolute m-3 d-flex flex-wrap gap-2">
                                <?=getTagBlog($post->ID);?>
                            </div>
                            <a href="/blog/<?=$post->post_name;?>">
                                <img 
                                    src="<?=currentImagePost($post->ID);?>" 
                                    class="rounded-top w-100 blog-image" 
                                    alt="<?=$post->post_title;?>"
                                />                              
                            </a>
                        </div>
                        <div class="card-body bg-white info pb-0">
                            <div class="d-flex justify-content-between text-muted mb-2">
                                <div  class="d-flex gap-2">
                                    <i class="material-symbols-outlined">calendar_month</i>
                                    <i><?=getFormatBlogDate($post->post_date);?></i>  
                                </div>
                                <div>
                                    <?php edit_post_link('ред.', '', '', $post->ID, '');?> 
                                </div>                                        
                            </div>
                            <div class="blog_header">
                                <a href="/blog/<?=$post->post_name;?>" class="crop_header">
                                    <h4 class="fw-bold text-primary my-3" title="<?=$post->post_title;?>">
                                        <?=$post->post_title;?>
                                    </h4>
                                </a>                            
                            </div>
                            <p class="crop_descriptoin" style="height: 70px"><?=$post->post_excerpt;?></p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <div class="d-flex gap-5 mb-2">
                                <div class="d-flex align-items-center gap-2 text-muted">
                                    <i class="material-symbols-outlined">visibility</i>
                                    <b><?=rand(5, 1500)?></b>                             
                                </div>
                                <a href="/blog/<?=$post->post_name;?>#comments" class="d-flex align-items-center gap-2 text-muted">
                                    <i class="material-symbols-outlined">chat</i>                       
                                    <b><?=$post->comment_count;?></b>  
                                </a>                        
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>