<?php 
    /*
    Template Name: Video Blog
    Template Post Type: post
    */
    get_header();

    $page = get_post(get_the_ID());
    $author = get_user_meta($page->post_author);
	$user = get_user_by('id', $page->post_author);
	$videos = get_posts( array(
		'order'          => 'DESC',
		'exclude'        => array($page->ID),
        'posts_per_page' => -1,
        'category_name'  => 'video',
        'orderby'        => 'date'
	));
	$temp = explode('/', $post->post_excerpt);
	$youtube = end($temp);
?>
<section id="blog" class="mt-5 bg-white">
    <nav class="bg-primary jumbotron m-0 pt-md-5 pt-3">
        <div class="container px-3 pb-3 table-responsive">
            <ol class="breadcrumb rounded-0 mb-0" style="width: 1200px">
                <li class="breadcrumb-item"><a href="/" class="text-white">Главная</a></li>
                <li class="breadcrumb-item"><a href="/video">Видео материалы</a></li>
                <li class="breadcrumb-item text-muted" aria-current="page">
                    <?=$page->post_title;?>
                </li>
            </ol>              
        </div>
    </nav> 
    
    <div class="container pt-1 pb-5">
        <div class="row pt-3">
            <div class="col-md-8">
                <div class="ratio ratio-16x9 mb-3">
                    <iframe src="https://www.youtube.com/embed/<?=$youtube;?>" class="rounded w-100" title="YouTube video" allowfullscreen></iframe>
                </div>
                <h3 class="fw-bold"><?=$page->post_title;?></h3>
				<div class="d-flex align-items-center gap-5 mb-4">
					<i class="d-flex align-items-center gap-2 text-muted">
						<span class="material-symbols-outlined fs-5">calendar_month</span>
						<?=$page->post_date;?>
					</i> 
					<span><?=$page->comment_count;?> комментариев</span>	
					<?php edit_post_link('ред.', '', '', $page->ID, '');?>
				</div>
				<div class="mt-3">
					<?=$page->post_content;?>
				</div>
				<pre><?php //var_dump($videos);?></pre>
				<hr />
				<div class="d-flex align-items-center gap-3 py-3">
					<img 
						 src="<?=get_user_meta($user->ID)["userimg"][0];?>" 
						 alt="<?=$user->display_name;?>" 
						 class="rounded-circle"
						 style="width:60px;height:60px;object-fit: cover;"
					/>
					<div class="d-flex flex-column w-75 overflow-hidden">
						<a href="/author/<?=$user->user_nicename;?>" class="text-primary fw-bold fs-5 text-truncate">
							<?=$user->display_name;?>
						</a>
						<a href="mailto:<?=$user->user_email;?>"><?=$user->user_email;?></a>
					</div>
				</div>
				<hr />
                <?php if ( comments_open() || get_comments_number() ) : ?>
                <section class="bg-light mt-4 rounded">
                    <div class="container py-5">
                        <div class="row">
                            <div class="col-md-12 mb-5">
                                <?php comments_template(); ?>
                            </div>               
                        </div>         
                    </div>
                </section>
                <?php endif; ?>
            </div>
            <div class="col-md-4 mt-4 mt-md-0">
				<?php foreach($videos as $v) { ?>
				<a href="/video/<?=$v->post_name;?>" class="row g-2 text-info mb-4 mb-md-3">
				    <div class="col-md-6">
				        <div class="ratio ratio-16x9 overflow-hidden rounded">
				            <span 
				                class="material-symbols-outlined text-white position-absolute d-flex justify-content-center align-items-center" 
				                style="font-size: 3rem;z-index: 1"
				            >
				                play_circle
			                </span>
        					<img 
        						 src="<?=currentImagePost($v->ID);?>"
        						 alt="<?=htmlspecialchars($v->post_title);?>"
        						 style="height: 200px;object-fit: cover;object-position: center -35px"
        						 class="rounded"
        					/>				            
				        </div>
				    </div>
				    <div class="col-md-6">
						<h6 class="fw-bold line-clamp" title="<?=htmlspecialchars($v->post_title);?>"><?=htmlspecialchars($v->post_title);?></h6>
						<div class="d-flex flex-md-column flex-row gap-2 justify-content-md-start justify-content-between">
    						<i class="text-muted fs-6"><?=date("d.m.Y / H:i", strtotime($v->post_date));?></i>
    						<span class="fs-6 d-block text-dark"><?=$v->comment_count;?> комментариев</span>							    
						</div>
				    </div>
				</a>
				<?php } ?>
            </div>
            
            
        </div>
    </div>
</section>

<?php get_footer();?>