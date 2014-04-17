<?php 

// vars
$version = acf_get_setting('version');
$pro = acf_get_setting('pro', false);
$tabs = array(
	'new'		=> __("What's New", 'acf'),
	'changelog'	=> __("Changelog", 'acf')
);

$active = 'new';

if( !empty($_GET['tab']) && !empty($tabs[$_GET['tab']]) ) {
	
	$active = $_GET['tab'];
	
}

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
	
		<h2 class="about-headline-callout">A smoother custom field experience</h2>
		
		<div class="feature-section col three-col">
			<div class="col-1">
				<img src="http://assets.advancedcustomfields.com/info/5.0.0/select2.png">
				<h4>Improved Usability</h4>
				<p>Including the popular Select2 library has improved both usability and speed across a number of field types including post object, page link, taxonomy and select.</p>
			</div>
			<div class="col-2">
				<img src="http://assets.advancedcustomfields.com/info/5.0.0/design.png">
				<h4>Improved Design</h4>
				<p>Many fields have undergone a visual refresh to make ACF look better than ever! Noticeable changes are seen on the gallery, relationship and oEmbed (new) fields!</p>
			</div>
			<div class="col-3 last-feature">
				<img src="http://assets.advancedcustomfields.com/info/5.0.0/sub-fields.png">
				<h4>Improved Sub Fields</h4>
				<p>Redesigning the data architecture has allowed sub fields to live independently from their parents. This allows you to drag and drop fields in and out of parent fields!</p>
			</div>
		</div>
		
		<hr />
		
		<h2 class="about-headline-callout">Goodbye Add-ons. Hello PRO</h2>
		
		<?php 
		
		// vars
		$has_addon = true;
		$addons = array(
			'acf-flexible-content',
			'acf-gallery',
			'acf-options-page',
			'acf-repeater',
		);
		
		
		// get active plugins
		$plugins = implode(' ', get_option('active_plugins'));
		
		
		foreach( $addons as $addon ) {
			
			if( strpos($plugins, $addon) !== false ) {
				
				$has_addon = true;
				break;
			}
			
		}
		
		$pro = false;
		
		?>
		<div class="feature-section col three-col">
			<div class="col-2">
				<h4>Free vs PRO</h4>
				<p>ACF is now available in both a <a href="http://wordpress.org/extend/plugins/advanced-custom-fields/" target="_blank">free version</a> and a <a href="http://advancedcustomfields.com/pro" target="_blank">PRO version</a>. The PRO version includes extra functionality such as the repeater field, gallery field, flexible content field and options page.</p>
				<p>With both personal and developer licenses available, premium functionality is more affordable & accessible than ever!</p>
			</div>
			<div class="col-1">
				<h4>Removing the bottleneck</h4>
				<p>All 4 premium Add-ons have now been combined into a PRO version of the ACF plugin. his change was necessary to remove the development bottleneck surrounding premium content and updates.</p>
				<p>By removing the bottleneck, premium updates will roll out faster and more stable.</p>
			</div>
			
			<div class="col-3 last-feature">
				<h4>Website Status</h4>
				
				<?php if( $has_addon && $pro ): ?>
				<div class="acf-callout success">
					<h4>Good</h4>
					<p>ACF PRO is installed and premium functionality is available</p>
				</div>
				<?php elseif( $has_addon ):  ?>
				<div class="acf-callout">
					<h4>Warning</h4>
					<p>ACF PRO is required for premium functionality.</p>
					<p>Please <a href="http://advancedcustomfields.com/pro" target="_blank">purchase an ACF PRO license</a> or read our guide to <a href="http://www.advancedcustomfields.com/resources/updates/upgrading-v4-v5/" target="_blank">roll back version 4</a>.</p>
				</div>
				<?php else: ?>
				<div class="acf-callout success">
					<h4>Good</h4>
					<p>ACF is installed and premium functionality is not required</p>
				</div>
				<?php endif; ?>
			</div>
		</div>
		
		<div class="feature-section col three-col">
			<div class="col-1">
				<h4>Discounts</h4>
				<p>To help make the migration from Add-ons to PRO as easy as possible, you will be able to purchase the ACF PRO plugin at a heavily reduced rate via the <a href="http://www.advancedcustomfields.com/store/account/" target="_blank">account section</a> of the ACF website. Please login to view your discount!</p>
			</div>
			<div class="col-2 last-feature">
				<h4>Upgrading from FREE to PRO</h4>
				<p>Upon purchase of an ACF PRO personal or developer license, you will gain access to download the ACF PRO plugin. Simply add the new plugin, deactivate the old one, and activate the new one!</p>
			</div>
		
		</div>
		
		
		<hr />
		
		<h2 class="about-headline-callout">Under the Hood</h2>
		
		<div class="feature-section col three-col">
			
			<div class="col">
				<h4>Smarter field settings</h4>
				<p>ACF now saves it's field settings as individual post objects</p>
			</div>
			
			<div class="col">
				<h4>More AJAX</h4>
				<p>More fields use AJAX powered search to speed up page loading</p>
			</div>
			
			<div class="col last-feature">
				<h4>Local JSON</h4>
				<p>New auto export to JSON feature improves speed</p>
			</div>
			
			<div class="col">
				<h4>Version control</h4>
				<p>New auto export to JSON feature allows field settings to be version controlled</p>
			</div>
			
			<div class="col">
				<h4>Swapped XML for JSON</h4>
				<p>Import / Export now uses JSON in favour of XML</p>
			</div>
			
			<div class="col last-feature">
				<h4>New Forms</h4>
				<p>Fields can now be mapped to comments, widgets and all user forms!</p>
			</div>
			
			<div class="col">
				<h4>New Field</h4>
				<p>A new field for embedding content has been added</p>
			</div>
			
			<div class="col">
				<h4>New Gallery</h4>
				<p>The gallery field has undergone a much needed facelift</p>
			</div>
			
			<div class="col last-feature">
				<h4>New Settings</h4>
				<p>Field group settings have been added for label placement and instruction placement</p>
			</div>
			
			<div class="col">
				<h4>Better Front End Forms</h4>
				<p>acf_form() can now create a new post on submission</p>
			</div>
			
			<div class="col">
				<h4>Better Validation</h4>
				<p>Form validation is now done via PHP + AJAX in favour of only JS</p>
			</div>
			
			<div class="col last-feature">
				<h4>Relationship Field</h4>
				<p>New Relationship field setting for 'Filters' (Search, Post Type, Taxonomy)</p>
			</div>
			
			<div class="col">
				<h4>Moving Fields</h4>
				<p>New field group functionality allows you to move a field between groups</p>
			</div>
			
			<div class="col">
				<h4>Moving Field Heirachy</h4>
				<p>New Add-ons page uses an external JSON file to read in data (easy to add 3rd party fields)</p>
			</div>
			
			<div class="col last-feature">
				<h4>Page Link</h4>
				<p>New archives group in page_link field selection</p>
			</div>
			
			<div class="col">
				<h4>Better Options Pages</h4>
				<p>New functions for options page allow creation of both parent and child menu pages</p>
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