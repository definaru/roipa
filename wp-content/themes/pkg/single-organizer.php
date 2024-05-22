<?php 
	/*
	 Template Name: Single Organizer
	 */
	get_header();
	$page = get_post(get_the_ID());
	$organizer = new WP_Query;
	$ecwd_organizer = $organizer->query(array('post_type' => 'ecwd_organizer'));
?>
<section class="mt-5 bg-white">
    <nav class="bg-light jumbotron m-0 pt-5">
        <div class="container px-3 pb-3">
            <ol class="breadcrumb rounded-0 mb-0">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item text-muted" aria-current="page">
                    <?=$post->post_title;?>
                </li>
            </ol>              
        </div>
    </nav>  
    <?php require get_template_directory().'/organizer/list-organizer.php';?>
</section>
<hr />
<?php get_footer();?>