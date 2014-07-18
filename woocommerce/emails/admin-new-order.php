<?php
/**
 * Admin new order email
 *
 * @author WooThemes
 * @package WooCommerce/Templates/Emails/HTML
 * @version 2.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<p><?php printf( __( 'You have received an order from %s. Their order is as follows:', 'woocommerce' ), $order->billing_first_name . ' ' . $order->billing_last_name ); ?></p>

<?php do_action( 'woocommerce_email_before_order_table', $order, true, false ); ?>

<h2><a href="<?php echo admin_url( 'post.php?post=' . $order->id . '&action=edit' ); ?>"><?php printf( __( 'Order: %s', 'woocommerce'), $order->get_order_number() ); ?></a> (<?php printf( '<time datetime="%s">%s</time>', date_i18n( 'c', strtotime( $order->order_date ) ), date_i18n( wc_date_format(), strtotime( $order->order_date ) ) ); ?>)</h2>

<table cellspacing="0" cellpadding="6" style="width: 100%; border: 1px solid #eee;" border="1" bordercolor="#eee">
	<thead>
		<tr>
			<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Price', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php echo $order->email_order_items_table( false, true ); ?>
	</tbody>
	<tfoot>
		<?php
			if ( $totals = $order->get_order_item_totals() ) {
				$i = 0;
				foreach ( $totals as $total ) {
					$i++;
					?><tr>
						<th scope="row" colspan="2" style="text-align:left; border: 1px solid #eee; <?php if ( $i == 1 ) echo 'border-top-width: 4px;'; ?>"><?php echo $total['label']; ?></th>
						<td style="text-align:left; border: 1px solid #eee; <?php if ( $i == 1 ) echo 'border-top-width: 4px;'; ?>"><?php echo $total['value']; ?></td>
					</tr><?php
				}
			}
		?>
	</tfoot>
</table>

<?php do_action( 'woocommerce_email_after_order_table', $order, true, false ); ?>

<?php do_action( 'woocommerce_email_order_meta', $order, true, false ); ?>

<h2><?php _e( 'Customer details', 'woocommerce' ); ?></h2>
<?php if ( $order->billing_country ) : ?>
	<p><strong><?php _e( 'Country:', 'woocommerce' ); ?></strong> <?php echo $order->billing_country; ?></p>
<?php endif; ?>
<?php if ( $order->billing_first_name ) : ?>
	<p><strong><?php _e( 'First Name:', 'woocommerce' ); ?></strong> <?php echo $order->billing_first_name; ?></p>
<?php endif; ?>
<?php if ( $order->billing_last_name ) : ?>
	<p><strong><?php _e( 'Last Name:', 'woocommerce' ); ?></strong> <?php echo $order->billing_last_name; ?></p>
<?php endif; ?>
<?php if ( $order->billing_email ) : ?>
	<p><strong><?php _e( 'Email:', 'woocommerce' ); ?></strong> <?php echo $order->billing_email; ?></p>
<?php endif; ?>
<?php if ( $order->billing_phone ) : ?>
	<p><strong><?php _e( 'Tel:', 'woocommerce' ); ?></strong> <?php echo $order->billing_phone; ?></p>
<?php endif; ?>


<h2><?php _e( 'Measurements', 'woocommerce' ); ?></h2>
<?php if ( $order->billing_neck_circumference ) : ?>
	<p><strong><?php _e( 'Neck Circumference:', 'woocommerce' ); ?></strong> <?php echo $order->billing_neck_circumference; ?></p>
<?php endif; ?>
<?php if ( $order->billing_chest ) : ?>
	<p><strong><?php _e( 'Chest:', 'woocommerce' ); ?></strong> <?php echo $order->billing_chest; ?></p>
<?php endif; ?>
<?php if ( $order->billing_stomach_circumference ) : ?>
	<p><strong><?php _e( 'Stomach Circumference:', 'woocommerce' ); ?></strong> <?php echo $order->billing_stomach_circumference; ?></p>
<?php endif; ?>
<?php if ( $order->billing_jacket_length ) : ?>
	<p><strong><?php _e( 'Jacket Length:', 'woocommerce' ); ?></strong> <?php echo $order->billing_jacket_length; ?></p>
<?php endif; ?>
<?php if ( $order->billing_shoulder_width ) : ?>
	<p><strong><?php _e( 'Shoulder Width:', 'woocommerce' ); ?></strong> <?php echo $order->billing_shoulder_width; ?></p>
<?php endif; ?>
<?php if ( $order->billing_sleeve_length ) : ?>
	<p><strong><?php _e( 'Sleeve Length:', 'woocommerce' ); ?></strong> <?php echo $order->billing_sleeve_length; ?></p>
<?php endif; ?>
<?php if ( $order->billing_armpit ) : ?>
	<p><strong><?php _e( 'Armpit:', 'woocommerce' ); ?></strong> <?php echo $order->billing_armpit; ?></p>
<?php endif; ?>
<?php if ( $order->billing_bicep ) : ?>
	<p><strong><?php _e( 'Bicep:', 'woocommerce' ); ?></strong> <?php echo $order->billing_bicep; ?></p>
<?php endif; ?>
<?php if ( $order->billing_hip_circumference ) : ?>
	<p><strong><?php _e( 'Hip Circumference:', 'woocommerce' ); ?></strong> <?php echo $order->billing_hip_circumference; ?></p>
<?php endif; ?>

<h2>Product Featured Images</h2>
<table cellspacing="0" cellpadding="6" style="width: 100%; border: 1px solid #eee;" border="1" bordercolor="#eee">
	<thead>
		<tr>
			<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Featured Image', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<?php
				$items = $order->get_items();
				
				foreach ( $items as $item_id => $item ) {
					$product_name 			= $item['name'];
					$product_id 			= $item['product_id'];
				
					?>
					<td style="text-align:left;vertical-align:middle;border:1px solid #eee;word-wrap:break-word"><?php echo $product_name; ?></td>
					<td style="text-align:left;vertical-align:middle;border:1px solid #eee;word-wrap:break-word"><?php echo get_the_post_thumbnail( $product_id, 'large' ) ?></td>
					<?php
				}
			?>
		</tr>
	</tbody>
</table>

<h2><?php _e( 'Quality Assurance Checklist', 'woocommerce' ); ?></h2>
<p>Download it <a href="<?php echo get_bloginfo('url'); ?>/wp-content/uploads/2014/05/QUALITY-ASSURANCE-CHECK-LIST.pdf">here</a></p>


<?php wc_get_template( 'emails/email-addresses.php', array( 'order' => $order ) ); ?>

<?php do_action( 'woocommerce_email_footer' ); ?>
