<?php 

// vars
$version = acf_get_setting('version');
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