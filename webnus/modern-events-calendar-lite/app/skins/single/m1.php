<?php
/** no direct access **/
defined('MECEXEC') or die();

/** @var MEC_skin_single $this */

$booking_options = get_post_meta($event->data->ID, 'mec_booking', true);
if (!is_array($booking_options)) {
    $booking_options = array();
}

$event_link = MEC_feature_occurrences::param($event->ID, $event->date['start']['timestamp'], 'read_more', (isset($event->data->meta['mec_read_more']) ? $event->data->meta['mec_read_more'] : ''));

$more_info = (isset($event->data->meta['mec_more_info']) and trim($event->data->meta['mec_more_info']) and $event->data->meta['mec_more_info'] != 'http://') ? $event->data->meta['mec_more_info'] : '';
if (isset($event->date) and isset($event->date['start']) and isset($event->date['start']['timestamp'])) {
    $more_info = MEC_feature_occurrences::param($event->ID, $event->date['start']['timestamp'], 'more_info', $more_info);
}

$more_info_target = MEC_feature_occurrences::param($event->ID, $event->date['start']['timestamp'], 'more_info_target', (isset($event->data->meta['mec_more_info_target']) ? $event->data->meta['mec_more_info_target'] : '_self'));
$more_info_title = MEC_feature_occurrences::param($event->ID, $event->date['start']['timestamp'], 'more_info_title', ((isset($event->data->meta['mec_more_info_title']) and trim($event->data->meta['mec_more_info_title'])) ? $event->data->meta['mec_more_info_title'] : __('Read More', 'modern-events-calendar-lite')));

$location_id = $this->main->get_master_location_id($event);
$location = ($location_id ? $this->main->get_location_data($location_id) : array());

$organizer_id = $this->main->get_master_organizer_id($event);
$organizer = ($organizer_id ? $this->main->get_organizer_data($organizer_id) : array());
?>
<div class="mec-wrap <?php echo $event_colorskin; ?> clearfix <?php echo $this->html_class; ?> mec-modal-wrap" id="mec_skin_<?php echo $this->uniqueid; ?>">
    <article class="mec-single-event mec-single-modern mec-single-modal m1">

        <div class="row align-items-top">
                <div class="col-lg-6 col-12 col-md-6">
                  <div class="alert-content">
                    <h4><?php echo get_the_title($event->data->ID); ?></h4>
                    <p>
                     <?php echo get_field('description', $event->data->ID); ?>
                    </p>
                    <div class="modal-event-location">
                <?php
                if (isset($event->data->meta['mec_date']['start']) and !empty($event->data->meta['mec_date']['start'])) {
                    $midnight_event = $this->main->is_midnight_event($event);
                    if ($midnight_event): ?>
                        <span>When: <?php echo $this->main->dateify($event, $this->date_format1); ?></span>
                    <?php else: ?>
                        <span>When: <?php echo $this->main->date_label((trim($occurrence) ? array('date'=>$occurrence) : $event->date['start']), (trim($occurrence_end_date) ? array('date'=>$occurrence_end_date) : (isset($event->date['end']) ? $event->date['end'] : null)), $this->date_format1, ' - ', true, 0, $event); ?>
                        </span>

                    <?php endif; ?>
                      <!-- <span>When: Tuesday, December 14, 2021</span> -->
                <?php
                }
                 $address = get_event_address($event->data->ID);

                 $members = get_field('admission_details', $event->data->ID);
                 // $mem[] = array();

                 if (isset($address)) { ?>
                      <span>Where: <?php echo $address; ?></span>
              <?php }
               foreach ($members as $key => $value) {
                   $mem[] = $value['admission_type'];
               }
                 ?>
                    </div>
                    <?php  if ($mem) {
                     ?>
                    <p>
                      Who usually attends: <?php echo implode(',', $mem); ?>
                    </p>
                <?php
                 } ?>
                    <a href="<?php echo get_permalink($event->data->ID); ?>" class="button-link btn-blue w-200 mt-5"
                      >Read More
                      <img
                        src="<?php echo get_stylesheet_directory_uri(); ?>/images/button-right-arrow-white.svg"
                        alt="image"
                    /></a>
                  </div>
                </div>
                <div class="col-lg-6 col-12 col-md-6">
                <?php $image = get_event_thumbnail($event->data->ID); ?>
                <?php if (!empty($image)) {?>
                  <div class="alert-img">
                    <span
                      ><img src="<?php echo $image; ?>" alt="alert"
                    /></span>
                  </div>
              <?php } ?>
                </div>
              </div>




    <!-- </div> -->
    </article>
</div>
<script>
jQuery(".mec-speaker-avatar a").on('click', function(e)
{
    e.preventDefault();

    var id =  jQuery(this).attr('href');
    var instance = lity(id);
    jQuery(document).on('lity:close', function(event, instance)
    {
        jQuery( ".mec-hourly-schedule-speaker-info" ).addClass('lity-hide');
    });
});
</script>
