<?php 

// extract args
extract( $args );

?>
<div id="acf-upgrade-notice" class="acf-cf">
	
	<div class="inner">
		
		<div class="acf-icon logo">
			<i class="acf-sprite-logo"></i>
		</div>
		
		<div class="content">
			
			<?php if( !$pro && !empty($addons) ): ?>
				
			<h2><?php _e("Compatibility Error Detected",'acf'); ?></h2>
			<p><?php printf(__("This website is currently using premium ACF add-ons (%s) which are no longer compatible with Advanced Custom Fields %s. Please purchase and install the PRO version to get premium functionality or roll back ACF to a compatible v4.3.7.", 'acf'), implode(', ', $addons), $version ); ?></p>
			<p><a id="acf-notice-action" href="<?php echo admin_url(''); ?>" class="acf-button"><?php _e("Roll back to ACF 4.3.7", 'acf'); ?></a></p>
				
			<?php else: ?>	
				
			<h2><?php _e("Database Upgrade Required",'acf'); ?></h2>
			<p><?php printf(__("Thank you for updating to Advanced Custom Fields %s! Before you start using the new awesome features, please update your database to the newest version.", 'acf'), $version ); ?></p>
			<p><a id="acf-notice-action" href="<?php echo admin_url('edit.php?post_type=acf-field-group&page=acf-upgrade'); ?>" class="acf-button blue"><?php _e("Update Database", 'acf'); ?></a></p>	
			
			<script type="text/javascript">
			(function($) {
				
				$("#acf-notice-action").on("click", function(){
			
					var answer = confirm("<?php _e( 'It is strongly recommended that you backup your database before proceeding. Are you sure you wish to run the updater now?', 'acf' ); ?>");
					return answer;
			
				});
				
			})(jQuery);
			</script>
			
			<?php endif; ?>
			
		</div>
	</div>
	
</div>