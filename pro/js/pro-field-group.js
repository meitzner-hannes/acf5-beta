(function($){        
	
	acf.field_group_pro = {
		
		/*
		*  init
		*
		*  This function will run on document ready and initialize the module
		*
		*  @type	function
		*  @date	8/04/2014
		*  @since	5.0.0
		*
		*  @param	n/a
		*  @return	n/a
		*/
		
		init : function(){
	    	
	    	// reference
	    	var _this = this;
	    	
	    	
	    	// events
	    	acf.add_action('open_field change_field_type sortstop', function( $el ){
			    
			    _this.update_field_parent( $el );
				
		    });
		    
		    acf.add_action('duplicate_field', function( $el ){
			    
			    _this.duplicate_field( $el );
				
		    });
		    
		    acf.add_action('delete_field', function( $el ){
			    
			    _this.delete_field( $el );
				
		    });
		    
		    
		    // modules
		    this.repeater.init();
	    	this.flexible_content.init();
    	},
    	
    	
    	/*
    	*  update_field_parent
    	*
    	*  This function will update field meta such as parent
    	*
    	*  @type	function
    	*  @date	8/04/2014
    	*  @since	5.0.0
    	*
    	*  @param	$el
    	*  @return	n/a
    	*/
    	
    	update_field_parent : function( $el ){
	    	
	    	// vars
	    	var $parent = $el.parent().closest('.field'),
		    	val = 0;
		    
		    
		    // find parent
			if( $parent.exists() ) {
				
				// vars
				var id = $parent.attr('data-id'),
					key = $parent.attr('data-key');
					
				
				// set val
				val = key;
				
				
				// if field has an ID, use that
				if( id ) {
				
					val = id;
					
				}
				
			}
			
			
			// update parent
			acf.field_group.update_field_meta( $el, 'parent', val );
	    	
	    	
	    	// action for 3rd party customization
			acf.do_action('update_field_parent', $el, $parent);
    	},
    	
    	
    	/*
    	*  duplicate_field
    	*
    	*  This function is triggered when duplicating a field
    	*
    	*  @type	function
    	*  @date	8/04/2014
    	*  @since	5.0.0
    	*
    	*  @param	$el
    	*  @return	n/a
    	*/
    	
    	duplicate_field : function( $el ) {
	    	
	    	// vars
			var $fields = $el.find('.field').not('[data-key="acfcloneindex"]');
				
			
			// bail early if $fields are empty
			if( !$fields.exists() ) {
				
				return;
				
			}
			
			
	    	$fields.each(function(){
		    	
		    	// vars
		    	var $parent = $(this).parent().closest('.field'),
		    		key = acf.field_group.get_field_meta( $parent, 'key');
		    		
		    	
		    	// wipe field
		    	acf.field_group.wipe_field( $(this) );
		    	
		    	
		    	// update parent
		    	acf.field_group.update_field_meta( $(this), 'parent', key );
		    	
		    	
		    	// save field
		    	acf.field_group.save_field( $(this) );
		    	
		    	
	    	});
	    	
	    	
    	},
    	
    	
    	/*
    	*  delete_field
    	*
    	*  This function is triggered when deleting a field
    	*
    	*  @type	function
    	*  @date	8/04/2014
    	*  @since	5.0.0
    	*
    	*  @param	$el
    	*  @return	n/a
    	*/
    	
    	delete_field : function( $el ){
	    	
	    	$el.find('.field').not('[data-key="acfcloneindex"]').each(function(){
		    	
		    	acf.field_group.delete_field( $(this), false );
		    	
	    	});
	    	
    	}
		
	};
	
	acf.field_group_pro.repeater = {
	
		/*
		*  init
		*
		*  This function will run on document ready and initialize the module
		*
		*  @type	function
		*  @date	8/04/2014
		*  @since	5.0.0
		*
		*  @param	n/a
		*  @return	n/a
		*/
		
		init : function(){
			
			// reference
			var _this = this;
			
						
			// events
			acf.add_action('open_field change_field_type', function( $el ){
				
				// bail early if not repeater
				if( $el.attr('data-type') != 'repeater' ) {
					
					return;
					
				}
				
				
				// add class to input
				$el.find('.acf-field[data-name="layout"]:first input[type="radio"]').attr('data-name', 'toggle-repeater-layout');
		
		
				// render
				_this.render_field( $el );
				
			});
			
			
			$(document).on('change', '[data-name="toggle-repeater-layout"]', function(){
				
				_this.render_field( $(this).closest('.field') );
				
			});
			
			
		},
		
		
		/*
		*  render_field
		*
		*  This function is triggered when a repeater field is visible
		*
		*  @type	function
		*  @date	8/04/2014
		*  @since	5.0.0
		*
		*  @param	$el
		*  @return	n/a
		*/
		
		render_field : function( $el ){
			
			// vars
			var layout = $el.find('tr[data-name="layout"]:first input:checked').val(),
				$field_list = $el.find('tr[data-name="sub_fields"]:first .acf-field-list:first');
			
			
			// add class
			$field_list.removeClass('layout-row layout-table').addClass( 'layout-' + layout );
			
			
			// sortable
			if( ! $field_list.hasClass('ui-sortable') ) {
			
				acf.field_group.sort_fields( $field_list );
				
			}
			
		}
		
	}
	
	
	acf.field_group_pro.flexible_content = {
		
		/*
		*  init
		*
		*  This function will run on document ready and initialize the module
		*
		*  @type	function
		*  @date	8/04/2014
		*  @since	5.0.0
		*
		*  @param	n/a
		*  @return	n/a
		*/
		
		init : function(){
			
			// reference
			var _this = this;
			
						
			// events
			$(document).on('click', '.acf-fc-add', function( e ){
				
				e.preventDefault();
				
				_this.add_layout( $(this).closest('.acf-field') );
				
			});
			
			$(document).on('click', '.acf-fc-duplicate', function( e ){
				
				e.preventDefault();
				
				_this.duplicate_layout( $(this).closest('.acf-field') );
				
			});
			
			$(document).on('click', '.acf-fc-delete', function( e ){
				
				e.preventDefault();
				
				_this.delete_layout( $(this).closest('.acf-field') );
				
			});
			
			$(document).on('blur', '.acf-fc-meta-label input', function( e ){
				
				_this.change_layout_label( $(this) );
				
			});
			
			$(document).on('change', '.acf-fc-meta-display select', function( e ){
				
				_this.render_layout( $(this).closest('.acf-field') );
				
			});
			
			acf.add_action('open_field change_field_type', function( $el ){
				
				// bail early if not flexible_content
				if( $el.attr('data-type') != 'flexible_content' ) {
					
					return;
					
				}
				
				
				// render
				_this.render_field( $el );
				
			});
			
			
			acf.add_action('update_field_parent', function( $el, $parent ){
				
				_this.update_field_parent( $el );
				
			});
			
			
		},
		
		
		/*
		*  add_layout
		*
		*  This function will add another fc layout after the given $tr
		*
		*  @type	function
		*  @date	8/04/2014
		*  @since	5.0.0
		*
		*  @param	$post_id (int)
		*  @return	$post_id (int)
		*/
		
		add_layout : function( $tr ){
			
			// vars
			var $new_tr = $tr.clone( false );
		
		
			// remove sub fields
			$new_tr.find('.field').not('[data-key="acfcloneindex"]').remove();
	
			
			// show add new message
			$new_tr.find('.no-fields-message').show();
			
			
			// reset layout meta values
			$new_tr.find('.acf-fc-meta input').val('');
			
			
			// wipe layout
			this.wipe_layout( $new_tr );
			
			
			// add new tr
			$tr.after( $new_tr );
			
			
			// display
			$new_tr.find('.acf-fc-meta select').val('row').trigger('change');
			
		},
		
		
		/*
		*  wipe_layout
		*
		*  This function will prepare a new fc layout
		*
		*  @type	function
		*  @date	8/04/2014
		*  @since	5.0.0
		*
		*  @param	$tr
		*  @return	n/a
		*/
		
		wipe_layout : function( $tr ){
			
			// vars
			var old_key = $tr.attr('data-key'),
				new_key = acf.get_uniqid();
			
			
			// give field a new id
			$tr.attr('data-key', new_key);
			$tr.find('> .acf-input > .acf-hidden [data-name="layout-key"]').val(new_key);
			
			
			// update attributes
			$tr.find('[id*="' + old_key + '"]').each(function(){	
			
				$(this).attr('id', $(this).attr('id').replace('-layouts-' + old_key + '-','-layouts-' + new_key + '-') );
				
			});
			
			$tr.find('[name*="' + old_key + '"]').each(function(){	
			
				$(this).attr('name', $(this).attr('name').replace('[layouts][' + old_key + ']','[layouts][' + new_key + ']') );
				
			});
						
		},
		
		
		/*
		*  duplicate
		*
		*  This function will duplicate a fc layout
		*
		*  @type	function
		*  @date	8/04/2014
		*  @since	5.0.0
		*
		*  @param	$tr
		*  @return	n/a
		*/
		
		duplicate : function( $tr ){
			
			// save select values
			$tr.find('select').each(function(){
			
				$(this).attr( 'data-val', $(this).val() );
				
			});
			
			
			// vars
			var $new_tr = $tr.clone( false );
			
			
			this.wipe_layout( $new_tr );
			
			
			$new_tr.find('.field').not('[data-key="acfcloneindex"]').each(function(){
				
				// wipe
				acf.field_group.wipe_field( $(this) );
				
				
				// save
				acf.field_group.save_field( $(this) );
				
			});
			
			
			// add new tr
			$tr.after( $new_tr );
			
			
			// set select values
			$new_tr.find('select').each(function(){
			
				$(this).val( $(this).attr('data-val') ).trigger('change');
				
			});
			
			
			// focus on new label
			$new_tr.find('.acf-fc-meta-label input').focus();
			
		},

		
		/*
		*  delete_layout
		*
		*  This function will delete a fc layout
		*
		*  @type	function
		*  @date	8/04/2014
		*  @since	5.0.0
		*
		*  @param	$tr
		*  @return	n/a
		*/
		
		delete_layout : function( $tr ){
			
			// validate
			if( $tr.siblings('tr[data-name="fc_layout"]').length == 0 ) {
			
				alert( acf._e('flexible_content','delete') );
				
				return false;
				
			}
			
			
			// delete fields
			$tr.find('.field').not('[data-key="acfcloneindex"]').each(function(){
				
				// dlete without animation
				acf.field_group.delete_field( $(this), false );
				
			});
			
			
			// save field
			acf.field_group.save_field( $tr.closest('.field') );
			
			
			// remove tr
			acf.remove_tr( $tr );
						
		},
		
		
		/*
		*  change_layout_label
		*
		*  This function is triggered when changing the layout's label
		*
		*  @type	function
		*  @date	8/04/2014
		*  @since	5.0.0
		*
		*  @param	$input 
		*  @return	n/a
		*/
		
		change_layout_label : function( $label ){
			
			var $name = $label.closest('.acf-fc-meta').find('.acf-fc-meta-name input');
			
			// only if name is empty
			if( $name.val() == '' ) {
				
				// thanks to https://gist.github.com/richardsweeney/5317392 for this code!
				var val = $label.val(),
					replace = {
						'ä': 'a',
						'æ': 'a',
						'å': 'a',
						'ö': 'o',
						'ø': 'o',
						'é': 'e',
						'ë': 'e',
						'ü': 'u',
						'ó': 'o',
						'ő': 'o',
						'ú': 'u',
						'é': 'e',
						'á': 'a',
						'ű': 'u',
						'í': 'i',
						' ' : '_',
						'\'' : '',
						'\\?' : ''
					};
				
				$.each( replace, function(k, v){
					var regex = new RegExp( k, 'g' );
					val = val.replace( regex, v );
				});
				
				
				val = val.toLowerCase();
				$name.val( val ).trigger('change');
			}
			
		},
		
		
		/*
		*  render_field
		*
		*  This function is triggered when a fc field is visible
		*
		*  @type	function
		*  @date	8/04/2014
		*  @since	5.0.0
		*
		*  @param	$el
		*  @return	n/a
		*/
		
		render_field : function( $el ){
			
			// reference
			var _this = this;
			
			
			// vars
			var $tbody = $el.find('> .field-options > table > tbody');
			
			
			// validate
			if( ! $tbody.hasClass('ui-sortable') ) {
				
				// add sortable
				$tbody.sortable({
					items					: '> tr[data-name="fc_layout"]',
					handle					: '.acf-fc-reorder',
					forceHelperSize			: true,
					forcePlaceholderSize	: true,
					scroll					: true,
					start : function (event, ui) {
						
						acf.do_action('sortstart', ui.item, ui.placeholder);
						
		   			},
		   			
		   			stop : function (event, ui) {
					
						acf.do_action('sortstop', ui.item, ui.placeholder);
						
						
		   			}
				});
				
			}
			
			
			// layouts
			$el.find('tr[data-name="fc_layout"]').each(function(){
				
				_this.render_layout( $(this) );
				
				// vars
				var parent_layout = $(this).attr('data-key');
				
				
				$(this).find('.field').each(function(){
					
					acf.field_group.update_field_meta( $(this), 'parent_layout', parent_layout );
					
				});
					
			});
			
		},
		
		
		/*
		*  render_layout
		*
		*  This function will update the field list class
		*
		*  @type	function
		*  @date	8/04/2014
		*  @since	5.0.0
		*
		*  @param	$field_list
		*  @return	n/a
		*/
		
		render_layout : function( $tr ){
			
			// vars
			var layout = $tr.find('.acf-fc-meta .acf-fc-meta-display select').val(),
				$field_list = $tr.find('.acf-field-list:first');
			
			
			// add class
			$field_list.removeClass('layout-row layout-table').addClass( 'layout-' + layout );
			
			
			// sortable
			if( ! $field_list.hasClass('ui-sortable') ) {
			
				acf.field_group.sort_fields( $field_list );
				
			}
			
		},
		
		
		/*
		*  update_field_parent
		*
		*  This function is triggered when a field's parent is being updated
		*
		*  @type	function
		*  @date	8/04/2014
		*  @since	5.0.0
		*
		*  @param	$el
		*  @return	n/a
		*/
		
		update_field_parent : function( $el ){			
		
			// vars
			var $tr = $el.closest('tr.acf-field'),
				parent_layout = acf.field_group.get_field_meta( $el, 'parent_layout' ),
				changed = false;
			
			
			// append hidden flexible content layout (fc_layout)
			if( $tr.exists() && $tr.attr('data-name') == 'fc_layout' ) {
			
				// vars
				var new_parent_layout = $tr.attr('data-key');
				
				
				// detect change
				if( parent_layout != new_parent_layout ) {
					
					acf.field_group.update_field_meta( $el, 'parent_layout', new_parent_layout );
					changed = true;
					
				}
				
			} else {
				
				if( parent_layout ) {
					
					acf.field_group.delete_field_meta( $el, 'parent_layout' );
					changed = true;
					
				}
				
			}
			
			
			if( changed ) {
				
				// save
				acf.field_group.save_field( $el );
				
			}
			
		}
		
	}
	
	/*
	*  ready
	*
	*  This function is riggered on document ready and will initialize the fiedl group object
	*
	*  @type	function
	*  @date	8/04/2014
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	acf.add_action('ready', function(){
	 	
		acf.field_group_pro.init();
	 	
	});

})(jQuery);