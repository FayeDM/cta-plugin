<?php
/**
 * Standard CTA Block
 *
 */

$cta_id           = get_field( 'easy_cta_block' );

$headline         = get_field( 'cta_headline', $cta_id );
$sub_heading      = get_field( 'cta_sub_heading', $cta_id );
$messaging        = get_field( 'cta_messaging', $cta_id );

$bg_img           = get_field( 'cta_background_image', $cta_id );

$text_color       = get_field( 'cta_text_color', $cta_id );
$bg_color         = get_field( 'cta_background_color', $cta_id );

$alignment        = get_field( 'text_alignment', $cta_id );
$alignment_class  = 'ecta--align' . $alignment;

$container        = get_field( 'width', $cta_id );
$container_class  = 'ecta--' . $container . 'width';

$bg_style         = get_field( 'cta_background_style', $cta_id );
$bg_style_class   = 'ecta--bg' . $bg_style;

$custom_class     = get_field( 'custom_class', $cta_id );

$classes      = [
  'ecta',
  'ecta--standard',
  $alignment_class,
  $container_class,
  $bg_style_class,
  $custom_class,
];

ecta_color_selection( $text_color, $bg_color );

?>

<section id="ectapost-<?php echo esc_attr( $cta_id );?>">

  <div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

    <div class="ecta__text">

      <h3><?php echo esc_html( $headline ); ?></h3>

      <p><?php echo esc_html( $sub_heading ); ?></p>

      <?php echo wp_kses_post( $messaging ); ?>

    </div>

    <div class="ecta__buttons">

      <?php
        if( have_rows( 'cta_calls_to_action', $cta_id ) ):

            while ( have_rows( 'cta_calls_to_action', $cta_id ) ) : the_row();

            $btn_style  = get_sub_field( 'button_style', $cta_id );
            $btn_text   = get_sub_field( 'button_text', $cta_id );
            $btn_url    = get_sub_field( 'button_url', $cta_id );
            $btn_target = get_sub_field( 'button_target', $cta_id );
            if ( true === $btn_target):
            	$target= '_blank';
				else :
				$target= '_self';
            endif;
            ?>
              <a href="<?php echo esc_url( $btn_url );?>" class="btn btn--<?php echo esc_attr( $btn_style );?>" target="<?php echo esc_attr( $target );?>"><?php echo $btn_text; ?></a>

          <?php endwhile;

        else :
            // Nobody here but us bears.
        endif;
?>

    </div>

  </div>

</section>
