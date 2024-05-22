<?php
    /**
     * The template for displaying comments
     *
     * This is the template that displays the area of the page that contains both the current comments
     * and the comment form.
     *
     * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
     *
     * @package pkg
     */

    /*
    * If the current post is protected by a password and
    * the visitor has not yet entered the password we will
    * return early without loading the comments.
    */
    if ( post_password_required() ) {
        return;
    }
?>

<div id="comments" class="comments-area jumbotron mb-0 rounded-0">
    <?php if ( have_comments() ) : ?>
    <div>
        <h2 class="comments-title">
            <?php
                $pkg_comment_count = get_comments_number();
                if ( '1' === $pkg_comment_count ) {
                    printf(
                        esc_html__( 'Комментарии к &ldquo;%1$s&rdquo;', 'pkg' ),
                        '<span>' . get_the_title() . '</span>'
                    );
                } else {
                    printf(
                        //esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $pkg_comment_count, 'comments title', 'pkg' ) ),
                        //number_format_i18n( $pkg_comment_count ),
                        //'<span>' . get_the_title() . '</span>'
                    );
                }
            ?>
        </h2>        
    </div>


		<?php the_comments_navigation(); ?>

		<ul class="comment-list ml-0 pl-0">
			<?php
			wp_list_comments( array(
                'style'       => 'li',
                'short_ping'  => true,
                'avatar_size' => 145,
                'reply_text' => 'Ответить на комментарий',
			) );
			?>
		</ul><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'pkg' ); ?></p>
			<?php
		        endif;
	                endif; // Check for have_comments().

	    comment_form();
	?>
</div>