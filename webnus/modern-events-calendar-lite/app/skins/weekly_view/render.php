<?php
/** no direct access **/
defined('MECEXEC') or die();

/** @var MEC_skin_weekly_view $this */

$has_events = array();
$settings = $this->main->get_settings();
$this->localtime = isset($this->skin_options['include_local_time']) ? $this->skin_options['include_local_time'] : false;
$display_label = isset($this->skin_options['display_label']) ? $this->skin_options['display_label'] : false;
$reason_for_cancellation = isset($this->skin_options['reason_for_cancellation']) ? $this->skin_options['reason_for_cancellation'] : false;
?>
<ul class="mec-weekly-view-dates-events abc">
    <?php foreach($this->events as $date=>$events): $week = $this->week_of_days[$date]; ?>
    <?php
        if(!isset($has_events[$week]))
        {
            foreach($this->weeks[$week] as $weekday) if(isset($this->events[$weekday]) and count($this->events[$weekday])) $has_events[$week] = true;
        }
    ?>
    <?php if(count($events)): ?>
    <li class="mec-weekly-view-date-events mec-util-hidden mec-calendar-day-events mec-clear mec-weekly-view-week-<?php echo esc_attr($this->id); ?>-<?php echo esc_attr($this->year.$this->month.$week); ?>" id="mec_weekly_view_date_events<?php echo esc_attr($this->id); ?>_<?php echo date('Ymd', strtotime($date)); ?>" data-week-number="<?php echo esc_attr($week); ?>">
        <?php foreach($events as $event): ?>
            <?php
                $location_id = $this->main->get_master_location_id($event);
                $location = ($location_id ? $this->main->get_location_data($location_id) : array());

                $start_time = (isset($event->data->time) ? $event->data->time['start'] : '');
                $end_time = (isset($event->data->time) ? $event->data->time['end'] : '');
                $event_color = isset($event->data->meta['mec_color']) && !empty($event->data->meta['mec_color']) ? '<span class="event-color" style="background: #'.esc_attr($event->data->meta['mec_color']).'"></span>' : '';
                $event_start_date = !empty($event->date['start']['date']) ? $event->date['start']['date'] : '';

                $mec_data = $this->display_custom_data($event);
                $custom_data_class = !empty($mec_data) ? 'mec-custom-data' : '';

                // MEC Schema
                do_action('mec_schema', $event);
            ?>
            <?php do_action('mec_weekly_view_content', $event); ?>
            <?php  
                $postId = $event->data->ID;
                $thumb = get_field('thumbnail', $postId);
                if (!empty($thumb) && isset($thumb['url'])) {
                    $thumb = $thumb['url'];
                }
                if (empty($thumb)) {
                    $thumb = get_the_post_thumbnail_url($postId);
                }
                if (empty($thumb)) {
                    $site = get_field('site', $postId);
                    if (!empty($site)) {
                        if(get_field('thumbnail_image', $site->ID)){
                            $thumb = get_field('thumbnail_image', $site->ID)['url'];
                        }
                    } else if(get_the_terms($postId, 'mec_location')){ // try location
                        $location_terms = get_the_terms($postId, 'mec_location');
                        $mec_thumbs = get_term_meta($location_terms[0]->term_id, 'thumbnail');
                        if (isset($mec_thumbs[0])) {
                            $thumb = $mec_thumbs[0];
                        }
                    }
                }
                if(empty($thumb)){
                    $thumb = get_stylesheet_directory_uri().'/images/default-img.png';
                }

            ?>
            <article class="<?php echo (isset($event->data->meta['event_past']) and trim($event->data->meta['event_past'])) ? 'mec-past-event ' : ''; ?>mec-event-article <?php echo esc_attr($this->get_event_classes($event)); ?> <?php echo esc_attr($custom_data_class); ?>" style="background-image: url('<?php echo $thumb; ?>');">
                <div class="mec-event-left-side">
                    <div class="mec-event-list-weekly-date mec-color"><span class="mec-date-day"><?php echo esc_html($this->main->date_i18n('d', strtotime($event->date['start']['date']))); ?></span><?php echo esc_html($this->main->date_i18n('F', strtotime($event->date['start']['date']))); ?></div>
                    <!-- <div class="mec-event-image"><?php //echo MEC_kses::element($event->data->thumbnails['thumbnail']); ?></div> -->
                    <div class="mec-event-image"><img src="<?php echo $thumb; ?>" height="<?php echo get_option( 'thumbnail_size_h' ); ?>" width="<?php echo get_option( 'thumbnail_size_w' ); ?>" /></div>
                    <?php echo MEC_kses::element($this->get_label_captions($event)); ?>
                </div>
                <div class="mec-event-right-side">
                    <?php if($this->display_detailed_time and $this->main->is_multipleday_occurrence($event)): ?>
                    <div class="mec-event-detailed-time mec-event-time mec-color"><i class="mec-sl-clock-o"></i> <?php echo MEC_kses::element($this->display_detailed_time($event)); ?></div>
                    <?php elseif(trim($start_time)): ?>
                    <div class="mec-event-time mec-color"><i class="mec-sl-clock-o"></i> <?php echo esc_html($start_time.(trim($end_time) ? ' - '.$end_time : '')); ?>
                    </div>
            <div class="mec-event-date t mec-color">
                <?php
                $ex = wp_get_post_terms( $event->ID, 'mec_category', array( 'fields' => 'all' ));
                if($ex != null && $ex[0]->slug == 'exhibit'){
             
                    // start custom date 
                    $eventID = $event->ID;
                    $output = '';
                    // if (get_field('custom_date', $eventID)) {
                        // $output .= get_field('custom_date',$eventID);
                    // } else {
                        $start_date = get_post_meta($eventID, 'mec_start_date',true);
                        $end_date = get_post_meta($eventID, 'mec_end_date',true);

                        $mec_start_date = new DateTime($start_date);
                        $mec_end_date = new DateTime($end_date);
                        $ex = wp_get_post_terms( $eventID, 'mec_category', array( 'fields' => 'all' ));

                        
                        if( $ex != null && $ex[0]->slug == 'exhibit'){
                            // print_r($ex);
                            echo 'Daily';
                        }
                        else{
                            $output .= date('F j, Y',$mec_start_date->format('U'));
                            if (date('F j, Y',$mec_start_date->format('U')) != date('F j, Y',$mec_end_date->format('U'))){
                                $output .= ' - ' . date('F j, Y',$mec_end_date->format('U')); }
                        }
                    // }
                    // end
                    $repeat_label = '<span class="mec-repeating-label">'.$output.'</span>';
                        $output .= $repeat_label;
                }
                else{
                    ?>
                        <?php 
                           // if (date('M d Y',$event->date['start']['timestamp']) != date('M d Y',$event->date['end']['timestamp'])){
                        $eventID = $event->ID;
                        // if($this->main->is_multipleday_occurrence($event, true)){
                            // echo date('M. d Y', $event->date['start']['timestamp']);
                        // }
                        // elseif (get_field('custom_date', $eventID)) {
                               // echo '<i class="mec-sl-calendar"></i>'. get_field('custom_date', $eventID); ?>
                        <?php
                        // }
                        // else{
                            echo date('M. d Y',$event->date['start']['timestamp']);
                        //    if (date('M d Y',$event->date['start']['timestamp']) != date('M d Y',$event->date['end']['timestamp'])){
                        //        echo ' - ' . date('M. d Y',$event->date['end']['timestamp']); }
                        //        $eventID = $event->ID;
                        // echo $this->main->is_multipleday_occurrence($event);
                        // }
                    } ?>
                         
            </div>
                    <?php else: ?>
                     
                    <div class="mec-event-date  mec-color">
                    <?php
                    echo date('M. d Y',$event->date['start']['timestamp']);
                    ?>
                    </div>
                    <?php //echo $output; ?>
                    <?php endif; ?>
                    <?php
                    $ex = wp_get_post_terms( $event->ID, 'mec_category', array( 'fields' => 'all' ));?>
            
                    <h4 class="mec-event-title"><div class="<?php if( $ex != null && $ex[0]->slug == 'exhibit'){ echo 'hide'; } ?>"><?php echo MEC_kses::element($this->display_link($event)); ?><?php echo MEC_kses::element($this->display_custom_data($event)); ?><?php echo MEC_kses::element($this->main->get_flags($event).$event_color.$this->main->get_normal_labels($event, $display_label).$this->main->display_cancellation_reason($event, $reason_for_cancellation)); ?><?php do_action('mec_shortcode_virtual_badge', $event->data->ID ); ?></div></h4>
                    <?php if($this->localtime) echo MEC_kses::full($this->main->module('local-time.type3', array('event' => $event))); ?>
                    <div class="mec-event-detail">
                        <?php $des = get_field('description',$postId); ?>
                        <div class="mec-event-small-description"><?php echo $des; ?></div>
                        <?php 
                            $site = get_field('site',$postId); 
                            $address = get_event_address($postId, false);
                            $location_terms = get_the_terms($postId, 'mec_location');
                            if ($site) {
                                $siteAddress = get_field('address', $site->ID);
                                $locationName = $site->post_title;
                            } elseif (isset($location_terms[0])) {
                                $locationName = $location_terms[0]->name;
                            }
                        ?>
                        <div class="mec-event-loc-place">
                            <?php //echo (isset($location['name']) ? esc_html($location['name']) : ''); ?>
                            <?php echo (!empty($locationName) ? '<span>Location : </span> '.$locationName : ''); ?>
                        </div>
                        <div class="mec-event-loc-address">
                            <?php echo (!empty($address) ? '<span>Address : </span> '.$address : ''); ?>
                        </div>
                    </div>
                    <?php echo MEC_kses::element($this->display_categories($event)); ?>
                    <?php echo MEC_kses::element($this->display_organizers($event)); ?>
                    <?php echo MEC_kses::element($this->display_cost($event)); ?>
                    <?php echo MEC_kses::form($this->booking_button($event)); ?>
                </div>
            </article>
        <?php endforeach; ?>
    </li>
    <?php elseif(!isset($has_events[$week])): $has_events[$week] = 'printed'; ?>
    <li class="mec-weekly-view-date-events mec-util-hidden mec-calendar-day-events mec-clear mec-weekly-view-week-<?php echo esc_attr($this->id); ?>-<?php echo date('Ym', strtotime($date)).$week; ?>" id="mec_weekly_view_date_events<?php echo esc_attr($this->id); ?>_<?php echo date('Ymd', strtotime($date)); ?>" data-week-number="<?php echo esc_attr($week); ?>">
        <article class="mec-event-article"><h4 class="mec-event-title"><?php esc_html_e('No Events', 'modern-events-calendar-lite'); ?></h4><div class="mec-event-detail"></div></article>
    </li>
    <?php endif; ?>
    <?php endforeach; ?>
</ul>
<div class="mec-event-footer"></div>