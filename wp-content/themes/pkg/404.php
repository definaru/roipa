<?php get_header();?>
<div id="primary" class="content-area mt-5 bg-white">
	<main id="main" class="container py-5">

		<section class="error-404 not-found my-5 py-5">
			<header class="page-header text-center my-5">
				<h1 class="page-title">
				    Эта страница не может быть найдена.
			    </h1>
				<p>
				Похоже, в этом месте ничего не найдено. <br />
				Может быть, попробовать одну из ссылок ниже или поиск?
				</p>	
				<a href="/" class="btn btn-info text-white px-4">На главную</a>
			</header>

			<div class="page-content">

				<?php /*
				<?php
					get_search_form();
					the_widget( 'WP_Widget_Recent_Posts' );
				?>

				<div class="widget widget_categories">
					<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'pkg' ); ?></h2>
					<ul>
						<?php
						wp_list_categories( array(
							'orderby'    => 'count',
							'order'      => 'DESC',
							'show_count' => 1,
							'title_li'   => '',
							'number'     => 10,
						) );
						?>
					</ul>
				</div>				
				*/ ?>


				<?php
					// $pkg_archive_content = '
					// 	<p>' . 
					// 		sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'pkg' ), 
					// 		convert_smilies( ':)' ) ) . '
					// 	</p>';
					// the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$pkg_archive_content" );
					// the_widget( 'WP_Widget_Tag_Cloud' );
				?>

			</div>
		</section>

	</main>
</div>
<?php get_footer();?>