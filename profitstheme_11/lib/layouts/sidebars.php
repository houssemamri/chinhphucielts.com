<?php

function pt_sidebar( $sidebar_name, $member_page = '' ){ 
		global $post;
		
?>          
           	<div id="<?php echo $sidebar_name; ?>-column">
			<?php
			if ( $sidebar_name == 'membership' ) {
				pt_membership_sidebar_text( $post->ID );
				if ( $member_page != 'error' ) {
					pt_membership_user();
					if ( $member_page != 'login') {
						pt_membership_menu( $post->ID, $post->post_parent, $member_page );
					}
				}
			} 
			?>
            		<div id="sidebar">
                        <ul>
                     	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar_name) ) : ?>
            		
			<?php if ( $sidebar_name != 'membership' ) {
				//do nothing
			} ?>
          		<?php endif;?>
                	</ul>
                        </div>
		</div>
<?php
}
	
