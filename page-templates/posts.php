<?php
/**
 * Template Name: Posts
 */
__( 'Posts', 'ttoc' );
get_header();

$query = TTOC()->tools->util->getPosts();
?>

<div class="container">

	<?php if ( $query->have_posts() ) { ?>
        <div class="posts-wrapper">
	        <?php
                while ($query->have_posts()) {
                    $query->the_post();
                    ?>
                    <div class="card single-post">
                        <img
                            src="<?php echo get_the_post_thumbnail_url( get_the_ID() ); ?>"
                            class="card-img-top"
                            alt="<?php echo esc_attr( get_the_title() ); ?>"
                        />
                        <div class="card-body">
                            <h5 class="card-title">
	                            <?php the_title(); ?>
                            </h5>
                            <p class="card-text">
				                <?php the_excerpt(); ?>
                            </p>
                            <a class="d-inline-block btn btn-outline-dark mt-2" href="<?php the_permalink(); ?>">
				                <?php _ex( 'Read More ...', 'Stack', 'stack' ) ?>
                            </a>
                        </div>
                    </div>
                    <?php
                }
                wp_reset_query();
                wp_reset_postdata();
            ?>
        </div>
	<?php } ?>

    <div class="text-center mt-3">
        <button class="btn btn-primary ttoc-load-more-posts">
			<?php _ex( 'Load More ...', 'ttoc', 'ttoc' ); ?>
        </button>
    </div>

    <input type="hidden" class="ttoc-has-more-posts" value="yes"/>
    <input type="hidden" class="ttoc-current-page" value="2"/>
</div>

<?php get_footer(); ?>
