<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ohc
 */

?>


<div class="key-document-detail" id="post-<?php the_ID(); ?>" style="border-bottom: 2px solid #269acd;max-width: 100%;">

                <div class="document-detail search_text">
                    <?php
                    $post_type = get_post_type();
                    $status = 0;
                    $category_detail=get_the_category(get_the_ID());//$post->ID

                    foreach($category_detail as $cd){
                    // echo $cd->slug;
                    if( $cd->slug == 'ohio-memory'){
                        $status = 1;
                    }
                    }
                    // print_r(in_array('', get_the_category()));
                    // print_r(get_the_category(get_the_ID()));
                    ?>
                    <?php if($status == 1){
                         ?>
                        <h4><a href="<?php echo get_field('external_redirect', get_the_ID()); ?>" target="_blank"><?php the_title(); ?></a><span><?php if($post_type == 'post'){ echo get_the_date(); } ?></span></h4>
                    <?php }else {?>
                        <h4><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a><span><?php if($post_type == 'post'){ echo get_the_date(); } ?></span></h4>
                    <?php } ?>
                        <!-- <p> -->
                        <?php
                        global $post;
                        if($status == 1)
                        echo '<p>'.get_field('external_redirect', get_the_ID()).'</p>';
                        else
                            echo '<p>'.get_the_permalink().'</p>';
                        
                            if (get_field('description')) {
                                echo '<p>'.get_field('description').'</p>';
                            } else {
                                echo '<p>'.get_the_excerpt().'</p>';
                            }
            ?>
                        <!-- </p> -->

                </div>
    </div>
    <style type="text/css">
        .search_text h4, .search_text a{
            color: #269acd;
            font-size: 25px !important;
            font-weight: 400;
        }
        .search_text span{
            margin-left: 25px;
    font-size: 16px;
        }
    </style>
