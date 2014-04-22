<?php 

// extract args
extract( $args );

// test
$have_pro = false;
$have_addons = false;

?>
<div class="wrap about-wrap">
	
	<h1><?php _e("Welcome to Advanced Custom Fields",'acf'); ?> <?php echo $version; ?></h1>
	<div class="about-text"><?php printf(__("Thank you for updating! ACF %s is bigger and better than ever before. We hope you like it.", 'acf'), $version); ?></div>
	<div class="acf-icon logo">
		<i class="acf-sprite-logo"></i>
	</div>
	
	<h2 class="nav-tab-wrapper">
		<?php foreach( $tabs as $tab_slug => $tab_title ): ?>
			<a class="nav-tab<?php if( $active == $tab_slug ): ?> nav-tab-active<?php endif; ?>" href="<?php echo admin_url("edit.php?post_type=acf-field-group&page=acf-settings-info&tab={$tab_slug}"); ?>"><?php echo $tab_title; ?></a>
		<?php endforeach; ?>
	</h2>
	
<?php if( $active == 'new' ): ?>
	
	<div class="changelog">
	
		<h2 class="about-headline-callout"><?php _e("A smoother custom field experience", 'acf'); ?></h2>
		
		<div class="feature-section col three-col">
			<div class="col-1">
				<img src="http://assets.advancedcustomfields.com/info/5.0.0/select2.png">
				<h4><?php _e("Improved Usability", 'acf'); ?></h4>
				<p><?php _e("Including the popular Select2 library has improved both usability and speed across a number of field types including post object, page link, taxonomy and select.", 'acf'); ?></p>
			</div>
			<div class="col-2">
				<img src="http://assets.advancedcustomfields.com/info/5.0.0/design.png">
				<h4><?php _e("Improved Design", 'acf'); ?></h4>
				<p><?php _e("Many fields have undergone a visual refresh to make ACF look better than ever! Noticeable changes are seen on the gallery, relationship and oEmbed (new) fields!", 'acf'); ?></p>
			</div>
			<div class="col-3 last-feature">
				<img src="http://assets.advancedcustomfields.com/info/5.0.0/sub-fields.png">
				<h4><?php _e("Improved Data", 'acf'); ?></h4>
				<p><?php _e("Redesigning the data architecture has allowed sub fields to live independently from their parents. This allows you to drag and drop fields in and out of parent fields!", 'acf'); ?></p>
			</div>
		</div>
		
		<hr />
		
		<h2 class="about-headline-callout"><?php _e("Goodbye Add-ons. Hello PRO", 'acf'); ?></h2>
		
		<?php if( $have_pro ): ?>
		<div class="acf-callout success">
			<h4><?php _e("Systems check", 'acf'); ?></h4>
			<p><?php _e("Everything looks good. With ACF PRO installed, all premium features will continue to work as normal.", 'acf'); ?></p>
		</div>
		<?php elseif( $have_addons ): ?>
		<div class="acf-callout">
			<h4><?php _e("Systems check", 'acf'); ?></h4>
			<p><?php _e("Issue detected. This website makes use of ACF4 add-ons and without ACF5 PRO these premium features will no longer be available.", 'acf'); ?></p>
			<p><?php _e("Please see below for information regarding the changes to add-ons and your options to either upgrade or rollback.", 'acf'); ?></p>
		</div>
		<?php else: ?>
		<div class="acf-callout success">
			<h4><?php _e("Systems check", 'acf'); ?></h4>
			<p><?php _e("Everything looks good. This website does not use premium add-ons, and is not affected by this change.", 'acf'); ?></p>
		</div>
		<?php endif; ?>
		
		<div class="feature-section col three-col">
		
			<div class="col">
				<h4><?php _e("Introducing ACF PRO", 'acf'); ?></h4>
				<p><?php printf(__('Alongside ACF5 is the all new <a href="%s">ACF5 PRO</a> version! This PRO version includes all 4 premium add-ons (repeater field, gallery field, flexible content field and options page) and with both personal and developer licenses available, premium functionality is more affordable than ever before!', 'acf'), esc_url('http://advancedcustomfields.com/pro')); ?></p>
			</div>
			
			<?php if( !$have_pro && $have_addons ): ?>
			<div class="col">
				<h4><?php _e("Upgrade to PRO", 'acf'); ?></h4>
				<p><?php printf(__('To help make the migration from ACF4 add-ons to ACF5 PRO as easy as possible, you can purchase the ACF5 PRO plugin at a heavily reduced rate via your <a href="%s">online account</a>.', 'acf'), esc_url('http://www.advancedcustomfields.com/store/account/')); ?></p>
				<p><?php printf(__('You can then simply update from ACF5 to ACF5 PRO by following this <a href="%s">upgrade guide</a>.', 'acf'), esc_url('http://www.advancedcustomfields.com/resources/updates/upgrading-v4-v5/')); ?></p>
			</div>
			<?php else: ?>
			<div class="col">
				<h4><?php _e("New features", 'acf'); ?></h4>
				<p><?php _e("ACF PRO contains awesome features such as repeatable data, flexible content layouts, a beautiful gallery field and the ability to create extra admin options pages!", 'acf'); ?></p>
				<p><?php printf(__('To find out more, be sure to read <a href="%s">What’s new in version 5</a>.', 'acf'), esc_url('http://www.advancedcustomfields.com/resources/updates/whats-new-version-5/')); ?></p>
			</div>
			<?php endif; ?>
			
			<div class="col last-feature">
				<h4><?php _e("Support", 'acf'); ?></h4>
				<p><?php _e("Please contact out support team and view the community forums for help with any issues you experience during this update.", 'acf'); ?></p>
				<p><?php printf(__('If time is critical, you can <a href="%s">roll back to ACF4</a>.', 'acf'), esc_url('http://www.advancedcustomfields.com/resources/updates/upgrading-v4-v5/')); ?></p>
			</div>
			
		</div>
		
		<hr />
		
		<h2 class="about-headline-callout"><?php _e("Under the Hood", 'acf'); ?></h2>
		
		<div class="feature-section col three-col">
			
			<div class="col">
				<h4><?php _e("Smarter field settings", 'acf'); ?></h4>
				<p><?php _e("ACF now saves it's field settings as individual post objects", 'acf'); ?></p>
			</div>
			
			<div class="col">
				<h4><?php _e("More AJAX", 'acf'); ?></h4>
				<p><?php _e("More fields use AJAX powered search to speed up page loading", 'acf'); ?></p>
			</div>
			
			<div class="col last-feature">
				<h4><?php _e("Local JSON", 'acf'); ?></h4>
				<p><?php _e("New auto export to JSON feature improves speed", 'acf'); ?></p>
			</div>
			
			<div class="col">
				<h4><?php _e("Better version control", 'acf'); ?></h4>
				<p><?php _e("New auto export to JSON feature allows field settings to be version controlled", 'acf'); ?></p>
			</div>
			
			<div class="col">
				<h4><?php _e("Swapped XML for JSON", 'acf'); ?></h4>
				<p><?php _e("Import / Export now uses JSON in favour of XML", 'acf'); ?></p>
			</div>
			
			<div class="col last-feature">
				<h4><?php _e("New Forms", 'acf'); ?></h4>
				<p><?php _e("Fields can now be mapped to comments, widgets and all user forms!", 'acf'); ?></p>
			</div>
			
			<div class="col">
				<h4><?php _e("New Field", 'acf'); ?></h4>
				<p><?php _e("A new field for embedding content has been added", 'acf'); ?></p>
			</div>
			
			<div class="col">
				<h4><?php _e("New Gallery", 'acf'); ?></h4>
				<p><?php _e("The gallery field has undergone a much needed facelift", 'acf'); ?></p>
			</div>
			
			<div class="col last-feature">
				<h4><?php _e("New Settings", 'acf'); ?></h4>
				<p><?php _e("Field group settings have been added for label placement and instruction placement", 'acf'); ?></p>
			</div>
			
			<div class="col">
				<h4><?php _e("Better Front End Forms", 'acf'); ?></h4>
				<p><?php _e("acf_form() can now create a new post on submission", 'acf'); ?></p>
			</div>
			
			<div class="col">
				<h4><?php _e("Better Validation", 'acf'); ?></h4>
				<p><?php _e("Form validation is now done via PHP + AJAX in favour of only JS", 'acf'); ?></p>
			</div>
			
			<div class="col last-feature">
				<h4><?php _e("Relationship Field", 'acf'); ?></h4>
				<p><?php _e("New Relationship field setting for 'Filters' (Search, Post Type, Taxonomy)", 'acf'); ?></p>
			</div>
			
			<div class="col">
				<h4><?php _e("Moving Fields", 'acf'); ?></h4>
				<p><?php _e("New field group functionality allows you to move a field between groups & parents", 'acf'); ?></p>
			</div>
			
			<div class="col">
				<h4><?php _e("Page Link", 'acf'); ?></h4>
				<p><?php _e("New archives group in page_link field selection", 'acf'); ?></p>
			</div>
			
			<div class="col last-feature">
				<h4><?php _e("Better Options Pages", 'acf'); ?></h4>
				<p><?php _e("New functions for options page allow creation of both parent and child menu pages", 'acf'); ?></p>
			</div>			
		</div>
		
	</div>
	
<?php elseif( $active == 'changelog' ): ?>
	
	<p class="about-description"><?php printf(__("We think you'll love the changes in %s.", 'acf'), $version); ?></p>
	
	<?php
		
	$items = file_get_contents( acf_get_path('readme.txt') );
	$items = explode('= ' . $version . ' =', $items);
	
	$items = end( $items );
	$items = current( explode("\n\n", $items) );
	$items = array_filter( array_map('trim', explode("*", $items)) );
	
	?>
	<ul class="changelog">
	<?php foreach( $items as $item ): 
		
		$item = explode('http', $item);
			
		?>
		<li><?php echo $item[0]; ?><?php if( isset($item[1]) ): ?><a href="http<?php echo $item[1]; ?>" target="_blank">[...]</a><?php endif; ?></li>
	<?php endforeach; ?>
	</ul>

<?php endif; ?>
		
</div>