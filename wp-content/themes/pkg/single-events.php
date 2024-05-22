<?php
 /*
 Template Name: Мероприятия
 Template Post Type: post
 */
global $post;
global $wp;
global $ecwd_options;
global $wp_query;

$post_id = $post->ID;
$meta = get_post_meta($post_id);
$user = get_user_by('id', $post->post_author);

$date_format = 'Y-m-d';
$time_format = 'H:i';
$ecwd_social_icons = false;
if (isset($ecwd_options['date_format']) && $ecwd_options['date_format'] != '') {
  $date_format = $ecwd_options['date_format'];
}
if (isset($ecwd_options['time_format']) && $ecwd_options['time_format'] != '') {
  $time_format = $ecwd_options['time_format'];
}
$time_format .= (isset($ecwd_options['time_type']) ? ' ' . $ecwd_options['time_type'] : '');
if (isset($ecwd_options['time_type']) && $ecwd_options['time_type'] != '') {
  $time_format = str_replace('H', 'g', $time_format);
  $time_format = str_replace('h', 'g', $time_format);
}
if (isset($ecwd_options['social_icons']) && $ecwd_options['social_icons'] != '') {
  $ecwd_social_icons = $ecwd_options['social_icons'];
}


$ecwd_event = $post;
$ecwd_event_metas = get_post_meta($ecwd_event->ID, '', true);

if(isset($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_date_from'][0])) {
  $ecwd_event_date_from = $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_date_from'][0];
  $ecwd_event_date_to = $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_date_to'][0];

  $is_default_dates = false;
}else{
  $today = date('Y-m-d H:i');

  $ecwd_event_date_from = date('Y/m/d H:i', strtotime($today . "+1 days"));
  $ecwd_event_date_to = date('Y/m/d H:i', strtotime($ecwd_event_date_from . "+1 hour"));

  $is_default_dates = true;
}

if (!isset($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_url'])) {
  $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_url'] = array(0 => '');
}
if (!isset($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_location'])) {
  $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_location'] = array(0 => '');
}
if (!isset($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_lat_long'])) {
  $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_lat_long'] = array(0 => '');
}
if (!isset($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_date_to'])) {
  $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_date_to'] = array(0 => '');
}
if (!isset($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_date_from'])) {
  $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_date_from'] = array(0 => '');
}

$permalink = get_the_permalink($ecwd_event->ID);
$this_event = $events[$ecwd_event->ID] = new ECWD_Event($ecwd_event->ID, '', $ecwd_event->post_title, $ecwd_event->post_content, $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_location'][0], $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_date_from'][0], $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_date_to'][0], $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_url'][0], $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_lat_long'][0], $permalink, $ecwd_event, '', $ecwd_event_metas);
$d = new ECWD_Display('');
if (isset($_GET['eventDate']) || isset($wp_query->query_vars['eventDate'])) {
  $fromDate = isset($_GET['eventDate']) ? sanitize_text_field($_GET['eventDate']) : $wp_query->query_vars['eventDate'];

  $eventdayslong = $d->dateDiff($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_date_from'][0], $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_date_to'][0]);
  $toDate = date('Y-m-d', strtotime((date("Y-m-d", (strtotime($fromDate))) . " +" . ($eventdayslong + 2) . " days")));
  $this_event_dates = $d->get_event_days(array($ecwd_event->ID => $this_event), 1, $fromDate, $toDate);
  if (isset($this_event_dates[0]['from']) && strtotime($fromDate) == strtotime($this_event_dates[0]['from'])) {
    $ecwd_event_date_from = $this_event_dates[0]['from'] . ' ' . $this_event_dates[0]['starttime'];
    $ecwd_event_date_to = $this_event_dates[0]['to'] . ' ' . $this_event_dates[0]['endtime'];
  }
}


$ecwd_event_location = isset($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_location'][0]) ? esc_html($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_location'][0]) : '';
$ecwd_event_latlong = isset($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_lat_long'][0]) ? esc_html($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_lat_long'][0]) : '';
//$ecwd_event_zoom = isset($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_map_zoom'][0]) ? $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_map_zoom'][0] : '';
$ecwd_event_show_map = isset($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_show_map'][0]) ? esc_html($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_show_map'][0]) : 0;
if ($ecwd_event_show_map == '') {
  $ecwd_event_show_map = 1;
}


$ecwd_event_organizers = isset($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_organizers'][0]) ? esc_html($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_organizers'][0]) : '';


$ecwd_event_url = isset($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_url'][0]) ? esc_url($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_url'][0]) : '';
$ecwd_event_url = ECWD::add_http($ecwd_event_url);
$ecwd_event_video = isset($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_video'][0]) ? esc_html($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_video'][0]) : '';
$ecwd_all_day_event = isset($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_all_day_event'][0]) ? esc_html($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_all_day_event'][0]) : 0;
$venue = '';
$venue_permalink = '';
$venue_post_id = isset($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_venue'][0]) ? $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_venue'][0] : 0;

$ecwd_event_zoom = "";
if ($venue_post_id) {
  $venue_post = get_post($venue_post_id);
  if ($venue_post) {
    $venue = $venue_post->post_title;
    $venue_permalink = get_permalink($venue_post->ID);
    $ecwd_event_zoom = get_post_meta($venue_post->ID, 'ecwd_map_zoom', true);
  }
}

if (!$ecwd_event_zoom) {
  $ecwd_event_zoom = 17;
}

$venue_meta_template = '<div class="%s"><span>%s:</span><span>%s</span></div>';
$venue_meta_link_template = '<div class="%s"><span>%s:</span><a href="%s">%s</a></div>';

if (is_numeric($venue_post_id)) {
  $ecwd_venue_phone = esc_html(get_post_meta($venue_post_id, 'ecwd_venue_meta_phone', true));
  $ecwd_venue_website = esc_url(get_post_meta($venue_post_id, 'ecwd_venue_meta_website', true));
  $ecwd_venue_website = ECWD::add_http($ecwd_venue_website);
} else {
  $ecwd_venue_phone = $ecwd_venue_website = "";
}


$organizers = array();
$ecwd_event_organizers = maybe_unserialize($ecwd_event_organizers);
if (is_array($ecwd_event_organizers) || is_object($ecwd_event_organizers)) {
  foreach ($ecwd_event_organizers as $ecwd_event_organizer) {
    $temp = get_post($ecwd_event_organizer, ARRAY_A);
    if ($temp !== null) {
      $organizers[] = $temp;
    }

  }
}

$featured_image = '';
if (has_post_thumbnail()) {
  $featured_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID, 'full', false));
}

$category_and_tags = false;

if (isset($ecwd_options['category_and_tags']) && $ecwd_options['category_and_tags'] != '') {
  $category_and_tags = $ecwd_options['category_and_tags'];
}
$args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
$event_tags = wp_get_post_terms($post->ID, 'ecwd_event_tag', $args);
$event_categories = wp_get_post_terms($post->ID, 'ecwd_event_category', $args);

$default_calendar = get_option('ecwd_default_calendar');
$calendars_id = get_post_meta($post_id, 'ecwd_event_calendars', true);

get_header();

?>
<section id="ecwd-events-content" id="post" class="mt-5 bg-white ecwd-events-single hentry site-content">
    <nav class="bg-primary jumbotron m-0 pt-md-5 pt-3">
        <div class="container px-3 pb-3 table-responsive">
            <ol class="breadcrumb rounded-0 mb-0" style="width: 1000px">
                <li class="breadcrumb-item"><a href="/" class="text-white">Главная</a></li>
                <li class="breadcrumb-item"><a href="/video">Мероприятия</a></li>
                <li class="breadcrumb-item text-muted" aria-current="page">
                    <?=$post->post_title;?>
                </li>
            </ol>              
        </div>
    </nav>
    
    <div class="container py-5">
        <div class="row pt-5">
            <div class="col-12 text-center intro">
                <h2 class="fw-bold"><?=$post->post_title;?></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-1">
                <p><?=$page->post_content;?></p>
                <?php edit_post_link('ред.', '', '', $page->ID, '');?>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-8 offset-md-2">
                <div class="col-12 mb-4">
                    <img 
                        src="<?=$featured_image;?>" 
                        class="w-100 mb-4 rounded"
                        alt="<?=$post->post_title;?>" 
                    />
                    <?php 
                    if($post->post_excerpt === '') {
                        echo '<div class="btn btn-warning w-100">Вход бесплатный</div>';
                    } else {
                       echo '<div class="btn btn-success w-100">Вход платный: <b>'.$post->post_excerpt.' ₽</b></div>'; 
                    }?>
                </div>  
                <?php /*
                <div class="d-flex align-items-center gap-3 justify-content-start bg-light p-3 mb-4 rounded">
                    <img 
                        src="<?=get_user_meta($user->ID)["userimg"][0];?>" 
                        style="width: 50px; height: 50px; object-fit: cover;" 
                        alt="<?=$user->display_name;?>" 
                        class="rounded-circle" 
                    />
                    <div class="d-grid">
                        <a 
                            class="text-info fw-bold h5 m-0"
                            href="/author/<?=$user->user_nicename;?>" 
                            target="_blank"
                        >
                            <?=$user->display_name;?>
                        </a> 
                        <span>Спикер мероприятия</span>
                    </div>
                </div>                
                */ ?>

                
			<?php while (have_posts()) : the_post(); ?>
			<div class="ecwd-event" itemscope itemtype="http://schema.org/Event">

				<?php if ( ! post_password_required() ) ?>
					<div class="event-detalis info">
					    <?php /*
						<?php if ($featured_image && $featured_image !== '') { ?>
							<div class="event-featured-image mt-5">
								<img src="<?php echo $featured_image; ?>" />
							</div>
						<?php } ?>
						*/ ?>
						<div class="ecwd-event-details">
						    <?php /*
							<div class="event-detalis-date">
								<label class="ecwd-event-date-info" title="<?php _e('Date', 'event-calendar-wd'); ?>"></label>
								<span class="ecwd-event-date text-muted" itemprop="startDate"
									content="<?=date('Y-m-d', strtotime($ecwd_event_date_from)) . 'T' . date('H:i', strtotime($ecwd_event_date_from)) ?>">
									<?=ECWD::get_ecwd_event_date_view($ecwd_event_date_from, $ecwd_event_date_to, $ecwd_all_day_event); ?>
								</span>
							</div>						    
						    */ ?>


							<?php if (isset($ecwd_options['show_repeat_rate']) && !$is_default_dates) {
							$repeat_rate_text = $d->get_repeat_rate($post_id, '', $date_format);
							if ($repeat_rate_text != '') : ?>
							<div class="ecwd_repeat_rate_text">
								<span>
									<?=$d->get_repeat_rate($post_id, '', $date_format); ?>
								</span>
							</div>
							<?php endif; } ?>

							<?php if ($ecwd_event_url) { ?>
								<div class="ecwd-url">
									<a href="<?=$ecwd_event_url; ?>" target="_blank">
										<label class="ecwd-event-url-info" title="<?php _e('Url', 'event-calendar-wd'); ?>"></label>
										<?=$ecwd_event_url; ?>
									</a>
								</div>
							<?php } if (count($organizers) > 0) { ?>
							<div class="event-detalis-org">
								<label class="ecwd-event-org-info" title="<?php _e('Organizers', 'event-calendar-wd'); ?>"></label>
								<?php if (count($organizers) > 1) { ?>
								<?php foreach ($organizers as $organizer) { ?>
									<span itemprop="organizer">
										<a href="<?=get_permalink($organizer['ID']) ?>">
											<?=$organizer['post_title'] ?>
										</a>
									</span>

								<?php } 
								} else { $organizer = $organizers[0]; ?>

								<span itemprop="organizer">
								  <a href="<?=get_permalink($organizer['ID']) ?>">
									<?=$organizer['post_title'] ?>
								   </a>
								</span>

								<?php
								$organizer_phone = esc_html(get_post_meta($organizer['ID'], 'ecwd_organizer_meta_phone', true));
								$organizer_website = esc_url(get_post_meta($organizer['ID'], 'ecwd_organizer_meta_website', true));
								$organizer_website = ECWD::add_http($organizer_website);

								if (!empty($organizer_phone)) { ?>
								  <div class="ecwd_organizer_phone">
									<span><?php _e('Phone', 'event-calendar-wd'); ?>:</span>
									<span><?=$organizer_phone; ?></span>
								  </div>
								<?php }
								if (!empty($organizer_website)) { ?>
								  <div class="ecwd_organizer_website">
									<span><?php _e('Website', 'event-calendar-wd'); ?>:</span>
									<a href="<?=$organizer_website; ?>">
									  <?=$organizer_website; ?>
									</a>
								  </div>
								<?php }
							  } ?>
							</div>
						  <?php } ?>

						  <div class="event-venue" itemprop="location" itemscope itemtype="http://schema.org/Place">
							<?php if ($venue_post_id) { ?>
							  <label class="ecwd-venue-info" title="<?php _e('Venue', 'event-calendar-wd'); ?>"></label>
							  <span itemprop="name">
								<a
								  <?php
								  if (isset($_GET['iframe']) && intval($_GET['iframe']) == 1) {
									$venue_permalink = add_query_arg('venue', '1', $venue_permalink);
								  }
								  ?>
								  href="<?=$venue_permalink ?>"><?=$venue;?></a>
							  </span>

							  <?php

							  if (!empty($ecwd_venue_phone)) {
								echo sprintf($venue_meta_template, "ecwd_venue_phone", __('Phone', 'event-calendar-wd'), $ecwd_venue_phone);
							  }

							  if (!empty($ecwd_venue_website)) {
								echo sprintf($venue_meta_link_template, "ecwd_venue_website", __('Website', 'event-calendar-wd'), $ecwd_venue_website, $ecwd_venue_website);
							  }

							  if (!empty($ecwd_event_location)) {
								?>
								<div class="address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
								  <span><?php _e('Address:', 'event-calendar-wd'); ?></span>
								  <span><?=$ecwd_event_location; ?></span>
								</div>
								<?php
							  }
							  ?>

							<?php } elseif ($ecwd_event_location) { ?>
							  <span class="ecwd_hidden" itemprop="name"><?=$ecwd_event_location; ?></span>
							  <label class="ecwd-venue-info"
									 title="<?php _e('Location', 'event-calendar-wd'); ?>"></label>
							  <span class="address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
								<?=$ecwd_event_location; ?>
							  </span>
							<?php } ?>
						  </div>

						  <?php do_action('ecwd_view_ext'); ?>
						</div>
					  </div>
					  <?php if ($ecwd_social_icons) { ?>

						<div class="ecwd-social">
						  <span class="share-links">
							  <a href="https://twitter.com/home?status=<?=get_permalink($post_id) ?>"
								 class="ecwd-twitter"
								 target="_blank" data-original-title="Tweet It">
								  <span class="visuallyhidden">Twitter</span></a>
							  <a href="https://www.facebook.com/sharer.php?u=<?=get_permalink($post_id) ?>"
								 class="ecwd-facebook"
								 target="_blank" data-original-title="Share on Facebook">
								  <span class="visuallyhidden">Facebook</span></a>
							  <a href="https://plus.google.com/share?url=<?=get_permalink($post_id) ?>"
								 class="ecwd-google-plus"
								 target="_blank" data-original-title="Share on Google+">
								  <span class="visuallyhidden">Google+</span></a>
						  </span>
						</div>
					  <?php }
					  if ($ecwd_event_show_map == 1 && $ecwd_event_latlong) {
						$map_events = array();
						$map_events[0]['latlong'] = explode(',', $ecwd_event_latlong);
						if ($ecwd_event_location != '') {
						  $map_events[0]['location'] = $ecwd_event_location;
						}
						$map_events[0]['zoom'] = $ecwd_event_zoom;
						$map_events[0]['infow'] = '<div class="ecwd_map_event">';
						$map_events[0]['infow'] .= '<span class="location">' . $ecwd_event_location . '</span>';
						$map_events[0]['infow'] .= '</div>';
						$map_events[0]['infow'] .= '<div class="event-detalis-date">
							<label class="ecwd-event-date-info" title="' . __('Date', 'event-calendar-wd') . '"></label>
							  <span class="ecwd-event-date" itemprop="startDate" content="' . date('Y-m-d', strtotime($ecwd_event_date_from)) . 'T' . date('H:i', strtotime($ecwd_event_date_from)) . '">';
						$map_events[0]['infow'] .= ECWD::get_ecwd_event_date_view($ecwd_event_date_from, $ecwd_event_date_to, $ecwd_all_day_event);

						$map_events[0]['infow'] .= '</span></div>';
						$markers = json_encode($map_events);
						?>
						<div class="ecwd-show-map">
							<div class="ecwd_map_div"></div>
							<textarea class="hidden ecwd_markers" style="display: none;"><?=$markers;?></textarea>
						</div>
					  <?php } ?>
					  <div class="clear"></div>

					  <?php if (!empty($ecwd_event_video)) { ?>
						<div class="ecwd-event-video">
						  <?php if (strpos($ecwd_event_video, 'youtube') > 0) {
							parse_str(parse_url($ecwd_event_video, PHP_URL_QUERY), $video_array_of_vars);
							if (isset($video_array_of_vars['v']) && $video_array_of_vars['v']) { ?>
								<object data="https://www.youtube.com/v/<?=$video_array_of_vars['v'] ?>" type="application/x-shockwave-flash" width="400" height="300">
									<param name="src" value="https://www.youtube.com/v/<?=$video_array_of_vars['v'] ?>"/>
								</object>
							  <?php
							}
						  } elseif (strpos($ecwd_event_video, 'vimeo') > 0) {
							$videoID = explode('/', $ecwd_event_video);
							$videoID = $videoID[count($videoID) - 1];
							if ($videoID) { ?>
							  <iframe src="https://player.vimeo.com/video/<?=$videoID;?>?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff"
								width="" height="" frameborder="0" webkitAllowFullScreen mozallowfullscreen
								allowFullScreen></iframe>
							  <?php
							}
						  }
						  ?>
						</div>
					  <?php } ?>

		<?php $event_content = get_the_content();
				  if (!empty($event_content)) { ?>
					<div class="entry-content info"><?php the_content(); ?></div>
				  <?php } ?>

				  <?php if ( ! post_password_required() ) { ?>
					  <?php if ($category_and_tags == 1) { ?>
						<div class="event_cageory_and_tags">

						  <?php if (!empty($event_categories)) { ?>
							<ul class="event_categories">
							  <?php foreach ($event_categories as $category) {
								$metas = get_option("ecwd_event_category_$category->term_id");
								?>
								<li class="event_category event-details-title">
								  <?php if ($metas['color']) { ?>
									<span class="event-metalabel" style="background:<?=$metas['color'];?>"></span>
									<span class="event_catgeory_name">
									  <a href="<?=get_category_link($category); ?>"
										 style="color:<?=$metas['color'];?>">
										<?=$category->name;?>
									  </a>
									</span>
								  <?php } else { ?>
									<span class="event_catgeory_name">
									  <a href="<?=get_category_link($category);?>">
										<?=$category->name;?>
									  </a>
									</span>
								  <?php } ?>
								</li>
							  <?php } ?>
							</ul>
						  <?php }

						  if (!empty($event_tags)) { ?>
							<ul class="event_tags">
							  <?php foreach ($event_tags as $tag) { ?>
								<li class="event_tag">
								  <span class="event_tag_name">
									<a href="<?=get_tag_link($tag); ?>">#<?=$tag->name;?></a>
								  </span>
								</li>
							  <?php } ?>
							</ul>
						  <?php } ?>
						</div>
					  <?php } ?>
					  
					  <?php
					  if (!isset($ecwd_options['related_events']) || $ecwd_options['related_events'] == 1) {
						$post_cats = wp_get_post_terms($post_id, ECWD_PLUGIN_PREFIX . '_event_category');
						$cat_ids = wp_list_pluck($post_cats, 'term_id');
						$post_tags = wp_get_post_terms($post_id, ECWD_PLUGIN_PREFIX . '_event_tag');
						$tag_ids = wp_list_pluck($post_tags, 'term_id');
						$events = array();
						$today = date('Y-m-d');

						$args = array(
						  'numberposts' => -1,
						  'post_type' => ECWD_PLUGIN_PREFIX . '_event',
						  'tax_query' => array(
							array(
							  'taxonomy' => ECWD_PLUGIN_PREFIX . '_event_category',
							  'terms' => $cat_ids,
							  'field' => 'term_id',
							)
						  ),
						  'orderby' => 'meta_value',
						  'order' => 'ASC'
						);
						$ecwd_events_by_cats = get_posts($args);
						$args = array(
						  'numberposts' => -1,
						  'post_type' => ECWD_PLUGIN_PREFIX . '_event',
						  'tax_query' => array(
							array(
							  'taxonomy' => ECWD_PLUGIN_PREFIX . '_event_tag',
							  'terms' => $tag_ids,
							  'field' => 'term_id',
							),
						  ),
						  'orderby' => 'meta_value',
						  'order' => 'ASC'
						);
						$ecwd_events_by_tags = get_posts($args);
						$ecwd_events = array_merge($ecwd_events_by_tags, $ecwd_events_by_cats);
						$ecwd_events = array_map("unserialize", array_unique(array_map("serialize", $ecwd_events)));
						wp_reset_postdata();
						wp_reset_query();

						foreach ($ecwd_events as $ecwd_event) {
						  if ($ecwd_event->ID != $post_id) {
							$term_metas = '';
							$categories = get_the_terms($ecwd_event->ID, ECWD_PLUGIN_PREFIX . '_event_category');
							if (is_array($categories)) {
							  foreach ($categories as $category) {
								$term_metas = get_option("ecwd_event_category_$category->term_id");
								$term_metas['id'] = $category->term_id;
								$term_metas['name'] = $category->name;
								$term_metas['slug'] = $category->slug;
							  }
							}
							$ecwd_event_metas = get_post_meta($ecwd_event->ID, '', true);
							$ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_url'] = array(0 => '');
							if (!isset($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_location'])) {
							  $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_location'] = array(0 => '');
							}
							if (!isset($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_lat_long'])) {
							  $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_lat_long'] = array(0 => '');
							}
							if (!isset($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_date_to'])) {
							  $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_date_to'] = array(0 => '');
							}
							if (!isset($ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_date_from'])) {
							  $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_date_from'] = array(0 => '');
							}

							$permalink = get_permalink($ecwd_event->ID);
							$events[$ecwd_event->ID] = new ECWD_Event($ecwd_event->ID, 0, $ecwd_event->post_title, $ecwd_event->post_content, $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_location'][0], $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_date_from'][0], $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_date_to'][0], $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_event_url'][0], $ecwd_event_metas[ECWD_PLUGIN_PREFIX . '_lat_long'][0], $permalink, $ecwd_event, $term_metas, $ecwd_event_metas);
						  }
						}
						$d = new ECWD_Display(0, '', '', $today);
						$start_date = date('Y-m-d');
						$end_date = date('Y-m-d', strtotime("+1 year", strtotime($start_date)));
						$events = $d->get_event_days($events, 1, $start_date, $end_date);
						?>

						<?php $events = $d->events_unique($events);
						do_action('ecwd_show_related_events', $events, true);
					  }
				  }  ?>
				</div>

			</div> 
			<?php if (comments_open() && $post->comment_status == 'open' && !post_password_required()) { ?>
				<div class="ecwd-comments"><?=comments_template();?></div>
			<?php } endwhile; ?>
		</div>
	</div>
</section>
<?php get_footer();?>