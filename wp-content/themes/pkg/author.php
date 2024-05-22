<?php 
    /**
    * Template name: Автор
    */
    get_header();

    $words = explode('/', $_SERVER['REQUEST_URI']);
    $return = $words[2];

    $dir = get_template_directory_uri();
    $current_user = wp_get_current_user();
    $page = get_post(get_the_ID());
    $user = get_user_by('slug', $return);
    $author = get_user_meta($user->ID);

?>
<section class="bg-white mt-5">
    <nav class="bg-primary jumbotron m-0 pt-5">
        <div class="container px-3 pb-3">
            <ol class="breadcrumb rounded-0 mb-0">
                <li class="breadcrumb-item"><a href="/" class="text-white">Главная</a></li>
                <li class="breadcrumb-item"><a href="/person">Лица проекта</a></li>
                <li class="breadcrumb-item text-muted" aria-current="page">
                    <?=$author["first_name"][0];?> <?=$author["last_name"][0];?>
                </li>
            </ol>              
        </div>
    </nav>
    <div class="container py-5">
        <div class="row py-5">
            <div class="col-md-4">
                <img 
                    src="<?=$author["userimg"][0];?>" 
                    alt="<?=$author["first_name"][0];?>"
                    class="w-100"
                />                
            </div>
            <div class="col-md-8 d-flex align-items-center">
                <div>
                    <h2><?=$user->display_name; ?></h2>
                    <p><?=$user->birthdate; ?> г. р.</p>
                    <div class="py-4"><?=$user->user_description; ?></div>                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <hr/>
                <h2 class="mt-3">Связанные материалы:</h2>            
                <ul>
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <li class="card mb-2">
                            <div class="card-body info d-flex justify-content-between">
                                <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
                                    <?php the_title(); ?>
                                </a>
                                <div>
                                    <?php the_time('d M Y'); ?> in #<?php the_category(', ');?>                                     
                                </div>
                               
                            </div>
                        </li>
                        <?php endwhile; else: ?>
                        <p><?php _e('No posts by this author.'); ?></p>
                    <?php endif; ?>
                </ul>                
            </div>

        </div>
    </div>
</section>

<?php get_footer(); ?>