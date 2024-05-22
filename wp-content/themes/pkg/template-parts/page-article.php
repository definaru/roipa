<?php
    /**
    * Template name: Публикации
    */
    get_header();
    $page = get_post(get_the_ID());
    $posts = get_posts([
        'posts_per_page' => 50,
        'category_name' => 'article',
        'orderby'     => 'date',
        'order'       => 'ASC',        
        'post_type' => 'post',
    ] );
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
            <div class="col-12 text-center mt-4 text-secondary">
                <?=$page->post_content;?>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-3 mb-5">
            <div class="col-md-9">
                <div class="row">
                    <?php foreach( $posts as $item ) { ?>
                        <div class="col-md-4 mt-3 info">
                            <a href="/article/<?=$item->post_name; ?>" class="card shadow-sm border-0">
                                <div class="card-header text-center border-0 bg-white p-0 overflow-hidden">
                                    <img 
                                        src="<?=get_the_post_thumbnail_url( $item->ID, 'full' );?>" 
                                        style="height:350px"
                                        class="shadow" 
                                        alt="<?php the_title(); ?>" 
                                    />
                                </div>
                                <div class="card-body text-center px-1 py-2">
                                    <?php
                                        $data = $item->post_title;
                                        list($header, $title) = explode(":", $data);
                                        echo '<p class="m-0"><small class="fw-bold">'.$header.'</small><br />';
                                        echo $title ? '<small class="text-muted"><small>'.$title.'</small></small></p>' : 
                                        '<small class="text-muted">...</small></p>';
                                        //echo '<small> - '.$item->post_excerpt.'</small>';
                                    ?>
                                </div>
                            </a>
                        </div>
                    <?php } ?> 
                </div>                
            </div>
        </div>
    </div>
</section>
<hr />
<?php get_footer();?>