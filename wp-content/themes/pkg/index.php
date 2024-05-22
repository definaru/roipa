<?php 
    get_header();
    $page = get_post('680');
    $slider = get_posts([
        'posts_per_page' => -1,
        'order'          => 'ASC',
        'category_name'  => 'slider',
        'orderby'        => 'date'
    ]);
    
    $events = get_posts( [
        'posts_per_page' => 3,
        'category_name'  => 'events',
        'orderby'        => 'date',
        'order'          => 'DESC',        
        'post_type'      => 'post',
    ]);
    
    $videolist = get_posts([
        'posts_per_page' => 6,
        'category_name'  => 'video',
        'orderby'        => 'date',
        'order'          => 'DESC',        
        'post_type'      => 'post',
    ]);
	$postslist = get_posts([
        'posts_per_page' => 9,
        'category_name'  => 'blog',
        'orderby'        => 'date'
    ]);
?>
<section class="bg-dark">
    <div id="carousel" class="carousel slide">
        <div class="carousel-inner">
            <?php foreach($slider as $get) { ?>
            <div class="carousel-item <?=$get->ID === 118 ? 'active' : ''?>" style="height: 100vh;">
                <img src="<?=currentImagePost($get->ID);?>" class="d-block w-100" alt="<?=$get->post_title;?>" />
                <div class="carousel-caption d-flex position-absolute align-items-center justify-content-center vh-100 w-100" style="
    background: rgb(0 0 0 / 71%);
    flex-direction: column;
    top: 0;
    left: 0;
">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <div class="d-grid gap-4">
                                    <h1 class="display-1"><?=$get->post_title;?></h1>
                                    <div><?=$get->post_content;?></div>
                                    <div class="d-flex justify-content-center">
                                        <a 
                                            data-fancybox data-type="iframe" 
                                            href="<?=$get->post_excerpt;?>" 
                                            class="d-flex justify-content-center justify-content-xl-start d-lg-block"
                                        >
                                            <button class="d-flex justify-content-center align-items-center gap-2 btn btn-lg btn-outline-warning px-5 mt-lg-3 mt-5">
                                                <span class="material-symbols-outlined">arrow_forward</span>
                                                Подробнее
                                            </button>                                             
                                        </a>                                        
                                    </div>
                                </div>                                
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    

    <?php if(count($events) !== 0) { ?>
    <section class="bg-white py-5">
        <?php if(wp_count_posts('events')) { ?>
        <div class="container">
            <div class="row pt-4">
                <div class="col-12 text-center pt-3 intro">
                    <h2 class="fw-bold">
                        Ближайшие мероприятия
                    </h2>
                </div>
            </div>
        </div> 
        <div class="container">
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
    		</div>
        </div>
        <?php } ?>
    </section>
    <?php } ?>
    
    <section class="bg-body-tertiary py-5">
        <div class="container">
            <div class="row py-5">
                <div class="col-12 text-center intro">
                    <h2 class="fw-bold">
                        Видео материалы
                    </h2>
                </div>
            </div>
            <div class="row g-3 mb-5 pb-5"> 
                <?php foreach($videolist as $post) { ?>
                <div class="col-md-4">
                    <div class="card shadow rounded h-100">
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
                                class="rounded-top w-100 blog-image rounded-top" 
                                alt="<?=htmlspecialchars($post->post_title);?>"
                            />
                        </div> 
                        <div class="card-body bg-body text-center">
                            <h6 class="fw-bold m-0"><?=$post->post_title;?></h6>
							<?php edit_post_link('ред.', '', '', $post->ID, '');?>
                        </div> 
                        <div class="d-grid bg-body border-0 p-2">
                            <a href="/video/<?=$post->post_name;?>" class="btn btn-info text-white fw-bold">
                               Посмотреть
                            </a>
                        </div>
                    </div>
                </div>            
                <?php } ?>
            </div>
        </div>
    </section>    
    	
    <section class="bg-white py-5">	
        <div class="container my-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="index-column">
						<?php foreach($postslist as $key => $post) { ?>
                        <div class="card border-0 item-col-<?=$key+1;?> shadow">
                            <div class="card-header border-0 p-0 h-100">
                                <div class="d-flex gap-2 h-100 position-relative rounded">
                                    <img 
										 src="<?=currentImagePost($post->ID);?>" 
										 alt="<?=$post->post_title;?>" 
										 class="rounded w-100 blog-image h-100" 
										 style="object-position: center center;"
									/> 
                                    <div class="position-absolute card-body rounded h-100 d-flex flex-wrap align-content-center" style="background: rgba(0, 0, 0, 0.68);">
                                        <div class="d-flex justify-content-between text-light w-100">
                                            <div class="d-flex gap-2 pt-4">
												<i class="material-symbols-outlined">calendar_month</i> 
												<i><?=getFormatBlogDate($post->post_date);?></i>
											</div>
                                            <div class="edit">
												<?php edit_post_link('ред.', '', '', $post->ID, '');?>
											</div>
                                        </div>
                                        <div class="blog_header h-auto">
                                            <a href="/blog/<?=$post->post_name;?>" class="crop_header">
                                                <h4 
													title="<?=$post->post_title;?>" 
													class="fw-bold my-3 text-warning"
												>
                                                    <?=$post->post_title;?>                                    
                                                </h4>
                                            </a>
                                        </div>
                                        <p class="crop_descriptoin text-white">
                                            <?=$post->post_excerpt;?>
                                        </p>
										<div class="w-100 text-light mb-3">
											<small><b>Автор:</b> <u><?=get_user_by('id', $post->post_author)->display_name;?></u></small> 
										</div>
                                        <div class="d-flex gap-5 mb-2 w-100">
                                            <div class="d-flex align-items-center gap-2 text-light">
												<i class="material-symbols-outlined">visibility</i> 
												<b><?=rand(1, 1000);?></b>
											</div>
                                            <a 
											   href="/blog/dolorem-eum-magni-eos-aperiam-quia#comments" 
											   class="d-flex align-items-center gap-2 text-light"
											>
												<i class="material-symbols-outlined">chat</i> 
												<b><?=$post->comment_count;?></b>
											</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php /*
<div class="jumbotron">
    <div class="row">
        <div class="col-md-12 text-center mb-5">
            <h2><?php bloginfo( 'description' ); ?></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
            <?=getMenuItem();?>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
            <?=getMenuItem(3);?>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
            <?=getMenuItem(4);?>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
            <?=getMenuItem(5);?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 mt-3 col-sm-6">
            <button class="btn btn-primary btn-block btn-lg rounded-0" data-toggle="modal" data-target="#addservis">Заказать консультацию</button>
        </div>
        <div class="col-md-3 mt-3 col-sm-6">
            <a href="/calculator" class="btn btn-primary btn-block btn-lg rounded-0">Расчет стоимости</a>
        </div>
        <div class="col-md-3 mt-3 col-sm-6">
            <button class="btn btn-primary btn-block btn-lg rounded-0" data-toggle="modal" data-target="#addservis">Скачать заявку</button>
        </div>
        <div class="col-md-3 mt-3 col-sm-6">
            <a href="#!" class="btn btn-primary btn-block btn-lg rounded-0">Портал обучения</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-4 text-center">
            <p>Заполнить и отправить ЗАЯВКУ можно по адресу <a href="mailto:info@pkg-edu.ru">info@pkg-edu.ru</a></p>
        </div>
    </div>
</div>
<section class="bg-primary">
	<div class="container py-5">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center intro pt-5">
				<h3 class="fw-bold text-white mt-5"><?=$page->post_title;?></h3>
			</div>
		</div>
		<div class="row my-5">
			<div class="col-md-12 mb-5">
				<div class="text-light">
					<?=$page->post_content;?>
				</div>
			</div>	
		</div>
	</div>	
</section>
*/ ?>


<?php get_footer();?>