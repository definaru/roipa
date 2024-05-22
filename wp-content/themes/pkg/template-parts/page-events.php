<?php
    /* 
     * Template Name: Мероприятия
     */
    get_header();
    $dir = get_template_directory_uri();
    $current_user = wp_get_current_user();
    $page = get_post(get_the_ID());
    
    
    $events = get_posts( [
        'posts_per_page' => -1,
        'category_name' => 'events',
        'orderby'     => 'date',
        'order'       => 'DESC',        
        'post_type' => 'post',
    ]);
?>
<section class="mt-5 bg-white">
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
    <div id="order" class="container py-5">
        <div class="row pt-5">
            <div class="col-12 text-center pt-5 intro">
                <h2 class="fw-bold"><?=$page->post_title;?></h2>
            </div>
        </div>
        <div class="row py-5">
            <?php 
                foreach($events as $post) { 
                $user = get_user_by('id', $post->post_author);
            ?>
                <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header p-0 position-relative">
                        <a href="/activity/<?=$post->post_name;?>">
                            <img 
                                src="<?=currentImagePost($post->ID);?>" 
                                class="rounded-top w-100 blog-image" 
                                alt="<?=htmlspecialchars($post->post_title);?>"
                            />
                        </a>
                    </div> 
                    <div class="card-body text-center">
                        <p>
                            <a 
                                class="text-info"
                                href="/author/<?=$user->user_nicename;?>" 
                                target="_blank"
                            >
                                <?=$user->display_name;?>
                            </a>
                        </p>
                        <hr />
                        <h6 class="fw-bold m-0 pt-3">
                            <?=$post->post_title;?>
                        </h6>
                    </div> 
                    <div class="d-grid card-footer border-0">
                        <a href="/activity/<?=$post->post_name;?>" class="btn btn-info text-white fw-bold">
                           Подробнее &rarr;
                        </a>
                    </div>
                </div>
            </div>            
            <?php } ?>
            
            <?php if(count($events) === 0) { ?>
            <div class="col-md-12">
                <div class="jumbotron p-5 bg-light">
                    <h1 class="display-4 mt-5">Ближайшие мероприятия</h1>
                    <p class="lead">
                    В настоящий момент нет ни одного нового ближайшего мероприятия.
                    </p>
                    <hr class="my-4">
                    <div class="d-flex align-items-center gap-3 mb-5">
                        <a class="submit px-4 py-3" href="/" role="button">На главную</a>
                        <a class="btn btn-warning px-4 py-3" href="/lectory" role="button">График лекций</a>                        
                    </div>
                </div>                
            </div>
            <?php } ?>
        
            <pre><?php // var_dump($events);?></pre>
            <pre><?php // $page->post_content;?></pre>
        </div>
    </div>
</section>
<?php get_footer(); ?>