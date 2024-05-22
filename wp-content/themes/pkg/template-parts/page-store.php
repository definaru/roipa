<?php
    /**
    * Template name: Store
    */
    get_header();
    
    global $post;

    $posts = get_posts( [
        'posts_per_page' => 6,
        'category_name' => 'book',
        'orderby'     => 'date',
        'order'       => 'DESC',        
        'post_type' => 'post',
    ]);
    $link = array_reverse(explode('/', $_SERVER['REQUEST_URI']))[0];
    $page = get_post(get_the_ID());
?>
<section class="bg-white mt-5" id="post-<?php the_ID(); ?>">
    <nav class="bg-primary jumbotron m-0 pt-5">
        <div class="container px-3 pb-3">
            <ol class="breadcrumb rounded-0 mb-0">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item text-muted" aria-current="page"><?=$page->post_title;?></li>
            </ol>              
        </div>
    </nav>
    <div class="container py-5">
        <div class="row pt-5">
            <div class="col-12 text-center intro">
                <h2 class="fw-bold"><?=$page->post_title;?></h2>
            </div>
        </div>
        

        <div class="row mt-5">
            <?php 
                foreach( $posts as $post ) { 
                $user = get_user_by('id', $post->post_author);
            ?>
                <div class="col-md-4 mb-3 info">
                    <a 
                        href="<?php the_permalink(); ?>" 
                        class="d-flex justify-content-center book shadow mx-5" 
                        style="background-image: url(<?=get_the_post_thumbnail_url( $post->ID, 'full' );?>);background-size: cover;background-position: top;background-repeat: no-repeat;" 
                        title="<?php the_title(); ?>"
                    >
                    </a>
                    <div class="d-flex flex-wrap  justify-content-center align-content-center mt-3 px-4">
                        <p><a href="/person/<?=$user->user_nicename;?>" class="text-info"><?=$user->display_name;?></a></p>
                        <h5 class="fw-bold text-center">
                            <a href="<?php the_permalink(); ?>">
                                <?=formatHeaderBook($post->post_title); ?>
                            </a>
                        </h5>
                        <p class="w-100 text-center">
                            <span class="material-symbols-outlined text-warning">star</span>
                            <span class="material-symbols-outlined text-warning">star</span>
                            <span class="material-symbols-outlined text-warning">star</span>
                            <span class="material-symbols-outlined text-warning">star</span>
                            <span class="material-symbols-outlined text-warning">star</span>
                        </p>
                        <p class="w-100 text-center"><b><?=number_format(strip_tags($post->post_excerpt));?> ₽</b></p>
                    </div>
                    <pre><?php // var_dump($post);?></pre>
                </div>
            <?php }  ?>            
        </div>
        <div class="row">
            <div class="col-12">
                <?=$page->post_content;?>
            </div>
        </div>


    </div>
</section>
<hr />
<?php get_footer();?>