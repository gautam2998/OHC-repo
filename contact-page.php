<?php /* Template Name: Contact Template */ ?>
<html <?php language_attributes(); ?> class="no-js">

<?php require get_template_directory() . '/partials/head.php'; ?>

<body <?php body_class(); ?>>


<?php get_header(); ?>

<?php 
$hero = get_field('hero_section');
// if( $hero ): 
	// print_r($hero['background']);
	// $type = $hero['background'];
	while ( have_rows( 'hero_section' ) ) {
        the_row();

        $image = '';
        $video = '';
		while ( have_rows('background') ) : the_row();
				// echo 'a';
			if( get_row_layout() == 'back_image' ):
				$image = get_sub_field('image');
			endif;
			if(get_row_layout() == 'video_url'):
				$video = get_sub_field('video');
			endif;
		endwhile;
	// endif;
		}
	// echo $data;
	?>
	<?php if($video != ''){

	} ?>
	<div class="inner-background <?php if($hero['overlay'] == '#fff'){ echo 'white-transparant mt-5';}?>" style="background-image: url('<?php echo $image; ?>')">
        <div class="container">
            <div class="inner-bg-text">
                <h2><?php echo $hero['heading']; ?></h2>
                <span><?php echo $hero['content']; ?></span>
            </div>
        </div>
    </div>
	<?php
// endif;
// Check value exists.
// if( have_rows($hero['']) ):

// 	// Loop through rows.
//     while ( have_rows('content') ) : the_row();
    	
//     	// Case: Paragraph layout.
//     	if( get_row_layout() == 'paragraph' ):
// 			$text = get_sub_field('text');
// 			// Do something...
		
// 		// Case: Download layout.
//         elseif( get_row_layout() == 'download' ): 
//         	$file = get_sub_field('file');
//         	// Do something...

//         endif;
    
//     // End loop.
//     endwhile;

// // No value.
// else :
// 	// Do something...
// endif;
?>


    <!-- inner background end -->

    <!-- breadcrumbs start -->

    <!-- <div class="breadcrumb-detail mt-lg-5 mt-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Contact Us
                    </li>
                </ol>
            </nav>
        </div>
    </div> -->

    <!-- breadcrumbs end -->

    <!-- contact detail start -->

    <!-- <div class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="l-connect">
                        <h4>Let's Connect!</h4>
                    </div>
                    <div class="c-info-detail">
                        <div class="info-title">
                            <h4>Contact Information</h4>
                            <ul>
                                <li>
                                    <a href="#"><img src="images/c-call-icon.svg" alt="call" />614.297.2300</a>
                                </li>
                                <li>
                                    <a href="#"><img src="images/c-call-icon.svg" alt="call" />800.686.6124</a>
                                </li>
                                <li>
                                    <a href="#"><img src="images/c-mail-icon.svg" alt="call" />info@ohiohistory.org</a>
                                </li>
                            </ul>
                        </div>
                        <div class="info-title">
                            <h4>Location Information</h4>
                            <address>
                  Ohio History Center<br />
                  800 E. 17th Ave., Columbus, OH 43211
                </address>
                        </div>
                        <div class="follow-us">
                            <span>Follow Us</span>
                            <ul>
                                <li>
                                    <a href="#"><img src="images/c-facebook-icon.svg" alt="facebook" /></a>
                                </li>
                                <li>
                                    <a href="#"><img src="images/c-insta-icon.svg" alt="instagram" /></a>
                                </li>
                                <li>
                                    <a href="#"><img src="images/c-youtube-icon.svg" alt="youtube" /></a>
                                </li>
                                <li>
                                    <a href="#"><img src="images/c-twitter-icon.svg" alt="twitter" /></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="form-detail">
                        <span>(*Required Fields)</span>
                        <form>
                            <div class="row d-flex align-items-end">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name*</label>
                                        <input type="text" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name*</label>
                                        <input type="text" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State</label>
                                        <select>
                        <option>State</option>
                        <option>State</option>
                        <option>State</option>
                        <option>State</option>
                        <option>State</option>
                      </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email*</label>
                                        <input type="email" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Department for Contact</label>
                                        <select>
                        <option>Department for Contact</option>
                        <option>Department for Contact</option>
                        <option>Department for Contact</option>
                        <option>Department for Contact</option>
                        <option>Department for Contact</option>
                      </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Email*</label>
                                        <textarea rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="captcha">
                                            <img src="images/g-captcha.png" alt="google captcha" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                      Submit
                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

      <?php
  // Start the loop.
  while ( have_posts() ) : the_post();
    // Include the page content template.
    the_content();
    // End of the loop.
  endwhile;
  ?>

    <!-- contact detail end -->
<?php get_footer();?>