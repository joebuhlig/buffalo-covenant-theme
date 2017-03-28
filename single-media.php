<?php
/**
 * The template for displaying all single sermon posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Buffalo_Covenant_Theme
 */
$vimeo_id = get_post_meta(get_the_ID(), 'vimeo_link', true);
$podcast = get_podcast_episode(get_post_meta(get_the_ID(), 'podcast_guid', true));
if ($podcast) {
$audio_attrs = array(
    'src'      => $podcast["link"],
    'loop'     => '',
    'autoplay' => get_query_var('autoplay', false),
    'preload' => 'none'
);
}
$series = get_the_terms( $post, 'series');
$speaker = get_the_terms( $post, 'speakers');

if ($series) {
  $posts_array = get_posts(
      array(
          'posts_per_page' => -1,
          'post_type' => 'attachment',
          'tax_query' => array(
              array(
                  'taxonomy' => 'series',
                  'field' => 'term_id',
                  'terms' => wp_list_pluck( $series, 'term_id' ),
              )
          )
      )
  );
  $thumb_src = wp_get_attachment_url($posts_array[0]->ID);
};

$show_default_header = true;
$hide_page_title = true;
get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
      <article>
        <div class="sermon-archive-link"><a href="/sermons/">← Back to Archive</a></div>
        <div class="sermon-thumbnail">
          <?php if (has_post_thumbnail()) :
            echo get_the_post_thumbnail();
          elseif ($series) : ?>
            <img src="<?php echo $thumb_src ?>">
          <?php else : ?>
            <img src="<?php echo get_theme_mod('default_sermon_logo') ?>">
          <? endif; ?>
        </div>
        <div class="sermon-meta">
          <div><h1><?php echo get_the_title() ?></h1></div>
          <span class="sermon-meta-item"><?php echo get_the_date() ?></span>
          <?php if ($speaker) : ?>
          <span class="sermon-meta-item"> • <a href="/speakers/<?php echo $speaker[0]->slug ?>"><?php echo $speaker[0]->name ?></a></span>
          <? endif; ?>
          <?php if ($series) : ?>
          <span class="sermon-meta-item"> • <span>Series:</span> <a href="/series/<?php echo $series[0]->slug ?>"><?php echo $series[0]->name ?></a></span>
          <? endif; 

          if ($podcast && $vimeo_id) : ?>
            <div class="sermon-medium-toggle"><button>Audio Only?</button></div>
          <?php endif;?>
        </div><?php
        if ($vimeo_id && $podcast) : ?>
          <div class="sermon-player show-video">
        <?php elseif ($vimeo_id && !$podcast) : ?>
          <div class="sermon-player show-video">
        <?php elseif (!$vimeo_id && $podcast) : ?>
          <div class="sermon-player show-audio">
        <?php endif;
        if ($vimeo_id) : ?>
          <div class="embed-vimeo-container"><iframe id="vimeoplayer" src="//player.vimeo.com/video/<?php echo $vimeo_id; ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
          </div>
        <? endif;
        if ($podcast) :
          echo wp_audio_shortcode($audio_attrs);
        endif; ?>
        </div>
        <div class="subscribe-wrapper">
          <h3>Subscribe to the Sermon Archives</h3>
          <div><a href="https://geo.itunes.apple.com/us/podcast/buffalo-covenant-church-sermon/id1041139383?mt=2" style="display:inline-block;overflow:hidden;background:no-repeat;width: 100px;height: 40px;margin-right: 10px;"><img src="https://linkmaker.itunes.apple.com/images/badges/en-us/badge_itunes-lrg.svg"></a><a href="http://www.subscribeonandroid.com/buffalocov.libsyn.com/rss" style="display:inline-block;overflow:hidden;width: 108px;height: 41px;margin-right: 10px;"><img src="/wp-content/uploads/2016/10/sub-android.png"></a><a href="http://buffalocov.libsyn.com/rss" style="display:inline-block;overflow:hidden;width: 100px;height: 40px;"><img src="/wp-content/uploads/2016/10/rss@3x-82b6c168c05c2371ea3d094139a343dc.png"></a></div>
        </div>
        <?php the_post_navigation(); ?>
      </article>
    </main><!-- #main -->
  </div><!-- #primary -->

<?php
get_footer();