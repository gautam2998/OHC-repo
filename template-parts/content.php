<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ohc
 */

 $url = get_the_permalink();
$target = '';
if (get_field('external_redirect')) {
    $url = get_field('external_redirect');
    $target = '_blank';
}
$thumbnail = get_blog_thumbnail(get_the_ID());
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('col-md-6 col-12 mt-5'); ?>>
     <a href="<?php echo $url; ?>" target="<?php echo $target; ?>" class="blog-post-detail b-post-page">
        <span><img src="<?php echo $thumbnail; ?>" alt="blog-image"/></span>
        <div class="blog-content-detail">
             <small><?php echo get_the_date(); ?></small>
            <h4><?php the_title(); ?></h4>
            <?php if (get_field('description')) {
    echo '<p>'.get_field('description').'</p>';
} else {
    echo '<p>'.get_the_excerpt().'</p>';
} ?>
        </div>
    </a>
</div>
