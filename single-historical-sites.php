<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package OHC
 */
?>

<html <?php language_attributes(); ?> class="no-js">

<?php require get_template_directory() . '/partials/head.php'; ?>

<body <?php body_class(); ?>>


<?php get_header(); ?>
<?php
while ( have_posts() ) :
    the_post();
    ?>
<!-- inner banner start -->

    <section class="inner-banner" style="background-image: url(images/site-template-banner.png)">
        <div class="container">
            <div class="title-section">
                <h3>Lorem ipsum dolor sit amet, consetetur sadipscing</h3>
                <span>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
            nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
            erat, sed diam voluptua. At vero eos et accusam et justo duo
            dolores.</span
          >
        </div>
      </div>
    </section>

    <!-- inner banner end -->

    <!-- breadcrumbs start -->

    <div class="breadcrumb-detail mt-lg-5 mt-4">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Visit</a></li>
            <li class="breadcrumb-item">
              <a href="#">Museum & Historic Sit Locator</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              Lorem ipsum dolor sit…
            </li>
          </ol>
        </nav>
      </div>
    </div>

    <!-- breadcrumbs end -->

    <!-- accordian start -->

    <div class="accordian-part">
      <div class="container">
        <div class="accodian-box">
          <div class="ac-box">
            <div class="accordian-title">
              <a href="javascript:void(0)">
                <span>Address</span>
                <img class="arrow" src="images/g-right-arrow-magento.svg" alt="image" /></a>
            </div>
            <div class="accordian-content">
                <span>Museum and Fort Open</span>
                <span>April - October</span>
                <span>Wednesday - Saturday, 9:30 a.m.–5 p.m.</span>
                <span>Sunday, noon–5 p.m.</span>
            </div>
        </div>
        <div class="ac-box">
            <div class="accordian-title">
                <a href="javascript:void(0)">
                    <span>Contact</span>
                    <img class="arrow" src="images/g-right-arrow-magento.svg" alt="image" /></a>
            </div>
            <div class="accordian-content">
                <span>Museum and Fort Open</span>
                <span>April - October</span>
                <span>Wednesday - Saturday, 9:30 a.m.–5 p.m.</span>
                <span>Sunday, noon–5 p.m.</span>
            </div>
        </div>
        <div class="ac-box">
            <div class="accordian-title">
                <a href="javascript:void(0)">
                    <span>Hours</span>
                    <img class="arrow" src="images/g-right-arrow-magento.svg" alt="image" /></a>
            </div>
            <div class="accordian-content">
                <span>Museum and Fort Open</span>
                <span>April - October</span>
                <span>Wednesday - Saturday, 9:30 a.m.–5 p.m.</span>
                <span>Sunday, noon–5 p.m.</span>
                <span class="mt-4">Masks are required of all guests during your visit.</span
              >
              <span class="mt-4">Museum Open*</span>
                <span>The reconstructed fort is CLOSED during these months.</span>
                <span>November–December</span>
                <span>Wednesday - Saturday, 9:30 a.m.–5 p.m.</span>
                <span>Sunday, Noon–5 p.m.</span>
                <span class="mt-4">January–March</span>
                <span>Friday & Saturday, 9:30 a.m. to 5:00 p.m.</span>
                <span>Sunday, noon to 5:00 p.m.</span>
                <span class="mt-4">Tours available year-round, Wednesday–Sunday, by
                appoiintment</span
              >
              <span class="mt-4">Holiday Hours</span>
                <span>Open: Memorial Day, Noon–5 p.m. </span>
                <span>Closed: Thanksgiving, Christmas Eve, Christmas Day, New Year's
                Day</span
              >
            </div>
          </div>
          <div class="ac-box">
            <div class="accordian-title">
              <a href="javascript:void(0)">
                <span>Admission</span>
                <img class="arrow" src="images/g-right-arrow-magento.svg" alt="image" /></a>
            </div>
            <div class="accordian-content">
                <span>Museum and Fort Open</span>
                <span>April - October</span>
                <span>Wednesday - Saturday, 9:30 a.m.–5 p.m.</span>
                <span>Sunday, noon–5 p.m.</span>
            </div>
        </div>
        <div class="ac-box">
            <div class="accordian-title">
                <a href="javascript:void(0)">
                    <span>What’s Nearby</span>
                    <img class="arrow" src="images/g-right-arrow-magento.svg" alt="image" /></a>
            </div>
            <div class="accordian-content">
                <span>Museum and Fort Open</span>
                <span>April - October</span>
                <span>Wednesday - Saturday, 9:30 a.m.–5 p.m.</span>
                <span>Sunday, noon–5 p.m.</span>
            </div>
        </div>
        </div>
        </div>
        </div>

        <!-- accordian end -->

        <!-- accordian start -->

        <!-- <div class="site-accordian">
      <div class="container">
        <div id="accordion" class="accordion-container">
          <h4 class="accordion-title js-accordion-title">Accordion Title1</h4>
          <div class="accordion-content">
            <p>Accordion Content1</p>
          </div>
          <h4 class="accordion-title js-accordion-title">Accordion Title2</h4>
          <div class="accordion-content">
            <p>Accordion Content2</p>
          </div>
          <h4 class="accordion-title js-accordion-title">Accordion Title3</h4>
          <div class="accordion-content">
            <p>
              Accordion Content3 Accordion Content3 Content3 Accordion Content3
              Content3 Accordion Content3
            </p>
          </div>
        </div>
      </div>
    </div> -->

        <!-- accordian end -->

        <!-- site detail start -->

        <section class="site-detail-section">
            <div class="container">
                <div class="site-detail">
                    <h4>Lorem ipsum dolor sit amet, consetetur sadipscing</h4>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quiepakis nostrud exercitation ullamco laboris nsi ut aliquip ex ea comepmodo consetquat. Duis aute irure
                        dolor in reprehenderit in voluptate velit esse cfgillum dolore eutpe fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt inpeku culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis
                        unde omnis iste natus error sit voluptatem accusantium poeyi doloremque laudantium, totam rem aperiam, eaque ipsa quae apsb illo inventore veritatis et quasi architecto beiatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem
                        quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, seprid
                        quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliqueam quaerat voluptatem.
                    </p>
                    <h3>Visit</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quiepakis nostrud exercitation ullamco laboris nsi ut aliquip ex ea comepmodo consetquat. Duis aute irure
                        dolor in reprehenderit in voluptate velit esse cfgillum dolore eutpe fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt inpeku culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <p>
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium poeyi doloremque laudantium, totam rem aperiam, eaque ipsa quae apsb illo inventore veritatis et quasi architecto beiatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem
                        quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, seprid
                        quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliqueam quaerat voluptatem.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quiepakis nostrud exercitation ullamco laboris nsi ut aliquip ex ea comepmodo consetquat. Duis aute irure
                        dolor in reprehenderit in voluptate velit esse cfgillum dolore eutpe fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt inpeku culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <h3>History</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quiepakis nostrud exercitation ullamco laboris nsi ut aliquip ex ea comepmodo consetquat. Duis aute irure
                        dolor in reprehenderit in voluptate velit esse cfgillum dolore eutpe fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt inpeku culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <p>
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium poeyi doloremque laudantium, totam rem aperiam, eaque ipsa quae apsb illo inventore veritatis et quasi architecto beiatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem
                        quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, seprid
                        quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliqueam quaerat voluptatem.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quiepakis nostrud exercitation ullamco laboris nsi ut aliquip ex ea comepmodo consetquat. Duis aute irure
                        dolor in reprehenderit in voluptate velit esse cfgillum dolore eutpe fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt inpeku culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>
                <div class="site-image">
                    <img src="images/site-detail-image.jpg" alt="site-image" />
                </div>
                <div class="site-visit-detail">
                    <ul>
                        <li>Historical Topics: <a href="#">Lorem Ipsum, Lorem Ipsum</a></li>
                        <li>Audiences: <a href="#">Lorem Ipsum, Lorem Ipsum</a></li>
                        <li>Regions: <a href="#">Lorem Ipsum, Lorem Ipsum</a></li>
                        <li>Site Activities: <a href="#">Lorem Ipsum, Lorem Ipsum</a></li>
                        <li>
                            Museum & Site Type: <a href="#">Lorem Ipsum, Lorem Ipsum</a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- site detail end -->

        <!-- exhibits and events section start -->

        <section class="exhibits-and-events-section">
            <div class="container">
                <div class="center-line">
                    <h4>Exhibits & Events at this Site</h4>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="box-exhibits">
                            <span><img src="images/exhibits-image.jpg" alt="image" /></span>
                            <h5>Excepteur sint occaecat.</h5>
                            <p>
                                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="box-exhibits">
                            <span><img src="images/exhibits-image.jpg" alt="image" /></span>
                            <h5>Excepteur sint occaecat.</h5>
                            <p>
                                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="box-exhibits">
                            <span><img src="images/exhibits-image.jpg" alt="image" /></span>
                            <h5>Excepteur sint occaecat.</h5>
                            <p>
                                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="box-exhibits">
                            <span><img src="images/exhibits-image.jpg" alt="image" /></span>
                            <h5>Excepteur sint occaecat.</h5>
                            <p>
                                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim.
                            </p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="see-more-btn">
                            <button>See More</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- exhibits and events section end -->

        <!-- newslatter start -->
        <div class="call-to-action cta-five mt-5 pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-content">
                            <h4>eNewsletter Sign-Up</h4>
                        </div>
                        <div class="newsletter-form">
                            <label>*All Fields Required</label>
                            <form>
                                <div class="form-group w-318 mb-0">
                                    <input type="text" class="form-control" placeholder="First Name*" />
                                </div>
                                <div class="form-group w-318 mb-0">
                                    <input type="text" class="form-control" placeholder="Last Name*" />
                                </div>
                                <div class="form-group w-318 mb-0">
                                    <input type="text" class="form-control" placeholder="Email*" />
                                </div>
                                <div class="form-group w-152 mb-0">
                                    <input type="text" class="form-control" placeholder="Zip Code*" />
                                </div>
                                <div class="form-group w-120 mb-0">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- newslatter end -->

        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/general.js"></script>
        <script>
            $(function() {
                $(".accordion-content:not(:first-of-type)").css("display", "none");
                $(".js-accordion-title:first-of-type").addClass("open");

                $(".js-accordion-title").click(function() {
                    $(".open").not(this).removeClass("open").next().slideUp(300);
                    $(this).toggleClass("open").next().slideToggle(300);
                });
            });
            $(".accordian-title a").click(function() {
                $(".accordian-content").slideUp();
                $(".accordian-title a").removeClass("active");
                $(this).toggleClass("active arrow");
                $(this)
                    .closest(".ac-box")
                    .find(".accordian-content")
                    .stop()
                    .slideToggle();
            });
        </script>

<?php get_footer(); ?>
