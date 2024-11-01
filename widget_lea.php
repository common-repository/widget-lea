<?php
/*
Plugin Name: widget lea
Plugin URI: http://jessai.fr.nf/archives/12
Description: widget lea.
Version: 2.1.1
Author: jessai
Author URI: http://jessai.fr.nf
*/
function widget_leas() {
	
	function widget_lea( $arg ) {
		    extract($arg);    
			$options_lea = get_option('widget_lea_options');
			echo $before_widget;
		    echo $before_title . $options_lea['lea_title'] . $after_title;
		    if ($options_lea['lea_class']) {
			    echo '<style type="text/css">';
			    echo '.lea {';
			    echo 'list-style-type: none;';
				//echo 'width: 224px;';
				//echo 'height: 34px;';
				echo 'color : '.$options_lea['lea_color'].';';
				echo 'font-size : '.$options_lea['lea_taille'].';';
				echo 'padding-top : '.$options_lea['lea_padding_top'].';';
				echo 'padding-right : '.$options_lea['lea_padding_right'].';';
				echo 'padding-bottom : '.$options_lea['lea_padding_bottom'].';';
				echo 'padding-left : '.$options_lea['lea_padding_left'].';';
				echo '}';
				echo '</style>';
			}
		    query_posts('caller_get_posts=1&orderby=post_date&order=asc&post_status=future');
		    if ($options_lea['lea_nbre']==0) {
				$lea_max = 1000;
			}
			else {
				$lea_max = $options_lea['lea_nbre'];
			}
			$lea_affiche = 1;
			if (have_posts()) : while (have_posts()) : the_post(); 
				if ($lea_affiche <= $lea_max) { ?>
				<ul <?php if ($options_lea['lea_class']) echo 'class="lea"'; ?> >
					<?php 
					the_title(); ?>
				</ul>
			<?php if ($options_lea['lea_nbre']<>0) {
				$lea_affiche++ ; 
				}
				}
			endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif;
			echo $after_widget;	
		

	}
	
	
	function widget_lea_control() {
	        $newoptions_lea = $options_lea = get_option('widget_lea_options');
	        if ( $_POST['submit_lea'] ) {
		       $newoptions_lea['lea_title'] = $_POST['lea_title'];
		       $newoptions_lea['lea_class'] = $_POST['lea_class'];
		       $newoptions_lea['lea_padding_top'] = $_POST['lea_padding_top'];
		       $newoptions_lea['lea_padding_right'] = $_POST['lea_padding_right'];
		       $newoptions_lea['lea_padding_bottom'] = $_POST['lea_padding_bottom'];
		       $newoptions_lea['lea_padding_left'] = $_POST['lea_padding_left'];
		       $newoptions_lea['lea_color'] = $_POST['lea_color'];
		       $newoptions_lea['lea_taille'] = $_POST['lea_taille'];
		       $newoptions_lea['lea_nbre'] = $_POST['lea_nbre'];	       
		    }
	        if ( $options_lea != $newoptions_lea ) {
	            $options_lea = $newoptions_lea;
	            update_option('widget_lea_options', $options_lea);
	        }
	?>
	    <div><label for="lea_title">Titre     : 
	          <div><input name="lea_title" id="lea_title" value="<?php echo $options_lea['lea_title']; ?>" /></div>
	    </label></div><br />
	    <div><label for="lea_nbre">Nombre d'articles (0 pour tous) : 
	           <div><input name="lea_nbre" id="lea_nbre" value="<?php echo $options_lea['lea_nbre']; ?>" /></div>
	    </label></div>
	    <div><label for="lea_class">
	    		<div><input type="checkbox" name="lea_class" id="lea_class" <?php if ($options_lea['lea_class']) { ?> checked="checked" <?php } ?> /> Mise en forme</div>
	    </label></div>
	    <div><label for="lea_padding_top">Haut : 
	           <div><input name="lea_padding_top" id="lea_padding_top" value="<?php echo $options_lea['lea_padding_top']; ?>" /></div>
	    </label></div>
	    <div><label for="lea_padding_right">Droite : 
	           <div><input name="lea_padding_right" id="lea_padding_right" value="<?php echo $options_lea['lea_padding_right']; ?>" /></div>
	    </label></div>
	    <div><label for="lea_padding_bottom">Bas : 
	           <div><input name="lea_padding_bottom" id="lea_padding_bottom" value="<?php echo $options_lea['lea_padding_bottom']; ?>" /></div>
	    </label></div>
	    <div><label for="lea_padding_left">Gauche : 
	           <div><input name="lea_padding_left" id="lea_padding_left" value="<?php echo $options_lea['lea_padding_left']; ?>" /></div>
	    </label></div>
	    <div><label for="lea_color">Couleur du texte : 
	           <div><input name="lea_color" id="lea_color" value="<?php echo $options_lea['lea_color']; ?>" /></div>
	    </label></div>
	    <div><label for="lea_taille">Taille du texte : 
	           <div><input name="lea_taille" id="lea_taille" value="<?php echo $options_lea['lea_taille']; ?>" /></div>
	    </label></div>
	    <input id="submit_lea" name="submit_lea" type="hidden" value="1" />
	<?php
	}
  
  register_sidebar_widget( 'lea', 'widget_lea');
  register_widget_control('lea', 'widget_lea_control', 200, 500);
}


	add_action('widgets_init', 'widget_leas');
?>