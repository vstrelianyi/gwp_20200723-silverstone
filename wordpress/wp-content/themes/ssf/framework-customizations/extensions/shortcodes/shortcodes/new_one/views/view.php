<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */
dump($atts);
?>

<?php echo !empty($atts['title']) ? $atts['title'] : '' ?>

<span class="fw-icon">
	<i class="<?php echo esc_attr($atts['icon']); ?>"></i>
	<?php if (!empty($atts['title'])): ?>
		<br/>
		<span class="list-title"><?php echo $atts['title'] ?></span>
	<?php endif; ?>
</span>