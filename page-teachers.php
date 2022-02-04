<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Yantra2
 */

get_header();
?>

<main id="primary-teachers">

    <?php
    while (have_posts()) :
        the_post();
    ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="background-repeat: round; background-image: url('<?php echo get_the_post_thumbnail_url() ?>')">
            <header>
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
            </header>

            <div class="entry-content">
                <?php
                the_content();

                // wp_link_pages(
                //     array(
                //         'before' => '<div>' . esc_html__('Pages:', 'yantra2'),
                //         'after'  => '</div>',
                //     )
                // );
                ?>
            </div>

            <?php if (get_edit_post_link()) : ?>
                <footer>
                    <?php
                    // edit_post_link(
                    //     sprintf(
                    //         wp_kses(
                    //             /* translators: %s: Name of current post. Only visible to screen readers */
                    //             __('Edit <span>%s</span>', 'yantra2'),
                    //             array(
                    //                 'span' => array(
                    //                     'class' => array(),
                    //                 ),
                    //             )
                    //         ),
                    //         wp_kses_post(get_the_title())
                    //     ),
                    //     '<span>',
                    //     '</span>'
                    // );
                    ?>
                </footer>
            <?php endif; ?>
        </article><!-- #post-<?php the_ID(); ?> -->
    <?php

    // If comments are open or we have at least one comment, load up the comment template.
    // if (comments_open() || get_comments_number()) :
    //     comments_template();
    // endif;

    endwhile; // End of the loop.
    ?>
    <div class="filters">
        <div class="sort">
            <div>Sort By:</div>
            <div>Country</div>
            <div>Language</div>
            <div>Style</div>
        </div>
        <div class="search">
            <div>View the full list</div>
            <div>Search</div>
            <div><input /></div>
            <div>Loop</div>
        </div>
    </div>
    <div class="teacher-list">
        <?php
        $user_query = new WP_User_Query(array('role' => 'Subscriber'));

        // User Loop
        if (!empty($user_query->get_results())) {
            foreach ($user_query->get_results() as $user) {
        ?>
                <div class="teacher-item">
                    <div class="teacher-image">
                        <?php echo get_avatar($user->ID, '100'); ?>
                    </div>
                    <div class="teacher-name">
                        <?php echo $user->display_name; ?>
                    </div>
                    <div class="teacher-level">
                        <?php if ($user->level) {
                            echo $user->level['name'];
                        } else {
                            echo 'N/A';
                        } ?>
                    </div>
                </div>
        <?php
            }
        } else {
            echo 'No users found.';
        }
        ?>
    </div>
</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
