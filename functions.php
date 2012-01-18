<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images, 
sidebars, comments, ect.
*/

// Get Bones Core Up & Running!
require_once('library/bones.php');            // core functions (don't remove)
require_once('library/plugins.php');          // plugins & extra functions (optional)
require_once('library/custom-post-type.php'); // custom post type example

// Admin Functions (commented out by default)
// require_once('library/admin.php');         // custom admin functions

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
/* 
to add more sizes, simply copy a line from above 
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image, 
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => 'Sidebar 1',
    	'description' => 'The first (primary) sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    /* 
    to add more sidebars or widgetized areas, just copy
    and edit the above sidebar code. In order to call 
    your new sidebar just use the following code:
    
    Just change the name to whatever your new
    sidebar's id is, for example:
    
    register_sidebar(array(
    	'id' => 'sidebar2',
    	'name' => 'Sidebar 2',
    	'description' => 'The second (secondary) sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    To call the sidebar in your template, you can just copy
    the sidebar.php file and rename it to your sidebar's name.
    So using the above example, it would be:
    sidebar-sidebar2.php
    
    */
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/
		
// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<?php echo get_avatar($comment,$size='32',$default='<path_to_url>' ); ?>
				<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
				<time><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s'), get_comment_date(),  get_comment_time()) ?></a></time>
				<?php edit_comment_link(__('(Edit)'),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
       			<div class="help">
          			<p><?php _e('Your comment is awaiting moderation.') ?></p>
          		</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __('Search for:', 'bonestheme') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Search the Site..." />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </form>';
    return $form;
} // don't remove this bracket!

/************* Theme Options ********************************************************************************************/

$themename = "Wicked Responsive";
$shortname = "wickedresp";

// Create theme options

$options = array (
			
				array(	"name" => __('Twitter Username'),
						"desc" => __('Your Twitter username, to be used on the social media links'),
						"id" => $wicked."_twitter",
						"std" => "wickedpro",
						"type" => "text"),
						
				array(	"name" => __('Feedburner URL'),
						"desc" => __("Copy and paste your Feedburner URL, ie --> http://feeds2.feedburner.com/nometech"),
						"id" => $wicked."_feedburner",
						"std" => __(""),
						"type" => "textarea",
						"options" => array(	"rows" => "5",
											"cols" => "94") ),								
						
				array(	"name" => __(''),
						"desc" => __("<h3>With the options below, you can choose a layout for your blog. Select one only.</h3>"),
						"id" => $shortname."_layout",
						"std" => __("Below you've got the option to choose a layout. Check one box only."),
						"type" => "nothing"),						
						
				array(	"name" => __('Two column layout'),
						"desc" => __("A simple two column layout"),
						"id" => $shortname."_two_column",
						"std" => "true",
						"type" => "checkbox"),
						
				array(	"name" => __('Two column wide layout'),
						"desc" => __("Two columns, with a wider content area and smaller sidebar (590px expanded to 640px)"),
						"id" => $shortname."_two_column_wide",
						"std" => "false",
						"type" => "checkbox"),						
					
				array(	"name" => __('Two column really wide layout'),
						"desc" => __("Two columns with a massive content area and a sidebar only 135px wide."),
						"id" => $shortname."_two_column_really_wide",
						"std" => "false",
						"type" => "checkbox"),
						
				array(	"desc" => __("<h3>Choose elements on the homepage to display/hide</h3>"),
						"type" => "nothing"),	
						
				array(	"name" => __('Featured content'),
						"desc" => __("Hide the featured content?"),
						"id" => $shortname."_featured_content",
						"std" => "false",
						"type" => "checkbox"),
						
				array(	"name" => __('Two featured posts'),
						"desc" => __("Hide the two featured posts below the featured content?"),
						"id" => $shortname."_two_featured_posts",
						"std" => "false",
						"type" => "checkbox"),
						
				array(	"name" => __('Three featured posts'),
						"desc" => __("Hide three posts beneath the two featured posts?"),
						"id" => $shortname."_three_featured_posts",
						"std" => "false",
						"type" => "checkbox"),							
						
				array(	"desc" => __("<h3>Choose sidebar elements to display/not display</h3>"),
						"type" => "nothing"),	

				array(	"name" => __('Tabbed area'),
						"desc" => __("Hide the tabbed area?"),
						"id" => $shortname."_tabs",
						"std" => "false",
						"type" => "checkbox"),		

				array(	"name" => __('Recent comments'),
						"desc" => __("Hide recent comments?"),
						"id" => $shortname."_recent_comments",
						"std" => "false",
						"type" => "checkbox"),
						
				array(	"name" => __('Ad code at 300x250 size'),
						"desc" => __("Copy and paste into the box below your advert code 300x250 size, for displaying on the two column layout"),
						"id" => $shortname."_300_250_ad",
						"std" => __(""),
						"type" => "textarea",
						"options" => array(	"rows" => "5",
											"cols" => "94") ),		

				array(	"name" => __('Ad code at 250x200 size'),
						"desc" => __("Copy and paste into the box below your advert code 250x200 size, for displaying on the two column wide layout"),
						"id" => $shortname."_250_200_ad",
						"std" => __(""),
						"type" => "textarea",
						"options" => array(	"rows" => "5",
											"cols" => "94") ),	

				array(	"name" => __('Ad code at 125x125 size'),
						"desc" => __("Copy and paste into the box below your advert code 125x125 size, for displaying on the two column really wide layout."),
						"id" => $shortname."_125_125_ad",
						"std" => __(""),
						"type" => "textarea",
						"options" => array(	"rows" => "5",
											"cols" => "94") ),

				array(	"desc" => __("<h3>Customise the footer</h3>"),
						"type" => "nothing"),

				array(	"name" => __('Three column footer'),
						"desc" => __("Hide the three column footer?"),
						"id" => $shortname."_three_column_footer",
						"std" => "false",
						"type" => "checkbox"),							
						
				array(	"name" => __('Text in Footer'),
						"desc" => __("Fill out the box with the text you want to be displayed at the very bottom of the theme."),
						"id" => $shortname."_footer_text",
						"std" => __("&#169; 2009 Your Site Name &bull; Powered by WordPress"),
						"type" => "textarea",
						"options" => array(	"rows" => "5",
											"cols" => "94") ),
											
				array(	"name" => __('Analytics code'),
						"desc" => __("Paste your Google Analytics (or other tracking) code in the box below"),
						"id" => $shortname."_analytics",
						"std" => __(""),
						"type" => "textarea",
						"options" => array(	"rows" => "5",
											"cols" => "94") ),
											
											
		);

function mytheme_add_admin() {

    global $themename, $shortname, $options;

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?functions.php&reset=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); }

            header("Location: themes.php?page=theme-options.php&reset=true");
            die;

        } else if ( 'reset_widgets' == $_REQUEST['action'] ) {
            $null = null;
            update_option('sidebars_widgets',$null);
            header("Location: themes.php?page=theme-options.php&reset=true");
            die;
        }
    }

add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');  
# }  

}

function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '.__('settings saved.','thematic').'</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '.__('settings reset.','thematic').'</strong></p></div>';
    if ( $_REQUEST['reset_widgets'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '.__('widgets reset.','thematic').'</strong></p></div>';
    
?>
<div class="wrap">
<?php if ( function_exists('screen_icon') ) screen_icon(); ?>
<h2><?php echo $themename; ?> Options</h2>

<form method="post" action="">

	<table class="form-table">

<?php foreach ($options as $value) { 
	
	switch ( $value['type'] ) {
		case 'text':
		?>
		<tr valign="top"> 
			<th scope="row"><label for="<?php echo $value['id']; ?>"><?php echo __($value['name'],'thematic'); ?></label></th>
			<td>
				<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
				<?php echo __($value['desc'],'thematic'); ?>

			</td>
		</tr>
		<?php
		break;
		
		case 'select':
		?>
		<tr valign="top">
			<th scope="row"><label for="<?php echo $value['id']; ?>"><?php echo __($value['name'],'thematic'); ?></label></th>
				<td>
					<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
					<?php foreach ($value['options'] as $option) { ?>
					<option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<?php
		break;
		
		case 'textarea':
		$ta_options = $value['options'];
		?>
		<tr valign="top"> 
			<th scope="row"><label for="<?php echo $value['id']; ?>"><?php echo __($value['name'],'thematic'); ?></label></th>
			<td><textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="<?php echo $ta_options['cols']; ?>" rows="<?php echo $ta_options['rows']; ?>"><?php 
				if( get_option($value['id']) != "") {
						echo __(stripslashes(get_option($value['id'])),'thematic');
					}else{
						echo __($value['std'],'thematic');
				}?></textarea><br /><?php echo __($value['desc'],'thematic'); ?></td>
		</tr>
		<?php
		break;
		
		case 'nothing':
		$ta_options = $value['options'];
		?>
		</table>
			<?php echo __($value['desc'],'thematic'); ?>
		<table class="form-table">
		<?php
		break;

		case 'radio':
		?>
		<tr valign="top"> 
			<th scope="row"><?php echo __($value['name'],'thematic'); ?></th>
			<td>
				<?php foreach ($value['options'] as $key=>$option) { 
				$radio_setting = get_option($value['id']);
				if($radio_setting != ''){
					if ($key == get_option($value['id']) ) {
						$checked = "checked=\"checked\"";
						} else {
							$checked = "";
						}
				}else{
					if($key == $value['std']){
						$checked = "checked=\"checked\"";
					}else{
						$checked = "";
					}
				}?>
				<input type="radio" name="<?php echo $value['id']; ?>" id="<?php echo $value['id'] . $key; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> /><label for="<?php echo $value['id'] . $key; ?>"><?php echo $option; ?></label><br />
				<?php } ?>
			</td>
		</tr>
		<?php
		break;
		
		case 'checkbox':
		?>
		<tr valign="top"> 
			<th scope="row"><?php echo __($value['name'],'thematic'); ?></th>
			<td>
				<?php
					if(get_option($value['id'])){
						$checked = "checked=\"checked\"";
					}else{
						$checked = "";
					}
				?>
				<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
				<label for="<?php echo $value['id']; ?>"><?php echo __($value['desc'],'thematic'); ?></label>
			</td>
		</tr>
		<?php
		break;

		default:

		break;
	}
}
?>

	</table>

	<p class="submit">
		<input name="save" type="submit" value="<?php _e('Save changes','thematic'); ?>" />    
		<input type="hidden" name="action" value="save" />
	</p>
</form>
<form method="post" action="">
	<p class="submit">
		<input name="reset" type="submit" value="<?php _e('Reset','thematic'); ?>" />
		<input type="hidden" name="action" value="reset" />
	</p>
</form>

</div>
<?php
}

add_action('admin_menu' , 'mytheme_add_admin'); 

?>