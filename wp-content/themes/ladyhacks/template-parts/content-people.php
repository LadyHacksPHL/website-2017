<?php
/**
 * Template part for displaying People repeating fields in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package LadyHacks
 */

	if( have_rows('group') ) {
		// echo "<div class='sponsor-group'>";
		while( have_rows('group') ): the_row();
			$cat = get_sub_field('type_of_group')[value];
			$catFriendly = get_sub_field('type_of_group')[label];
			$catDescription = get_sub_field('about_group');
			$person = get_sub_field('person');

			if ($cat=='other' AND $catCustom!=NULL) $header = $catCustom;
			elseif ($cat=='other' AND $catCustom==NULL) $header = "Other folks";
			else $header = $catFriendly;

			if( have_rows('person') ) {
				echo "<ul class='person-group person-group--$cat gallery gallery-columns-3'>";
					echo "<div class='person-group-intro'>";
						echo "<h2>$header"."s"."</h2>";
						echo $catDescription;
					echo "</div>";
					while( have_rows('person') ): the_row();
						$person = get_sub_field('name');
						$headshot = get_sub_field('headshot');
						$headshotURL = ( $headshot == NULL ? "hello!" : $headshot[url] );
						$about = get_sub_field('bio');
						$headshotAlt = $headshot[alt];

						echo "<li class='person gallery-item'>";
							echo ( $headshot == NULL ? "<div class='headshot no-headshot'><span>No Pic!</span><img src='data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7' alt='No Picture!'/></div>" : "<div class='headshot' style='background-image:url($headshotURL)'><img src='data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7' alt='$headshotAlt'/></div>" );
							echo "<h4>$person</h4>";
							
							// Social media
							if( have_rows('social_media') ) {
								echo "<ul class='social-media'>";
								while( have_rows('social_media') ): the_row();
									$type = strtolower( get_sub_field('type') );
									$displayTitle = get_sub_field('type');
									$link = get_sub_field('link');

									if ($type=='twitter') 	$icon = '<svg viewBox="0 0 512 512"><path d="M419.6 168.6c-11.7 5.2-24.2 8.7-37.4 10.2 13.4-8.1 23.8-20.8 28.6-36 -12.6 7.5-26.5 12.9-41.3 15.8 -11.9-12.6-28.8-20.6-47.5-20.6 -42 0-72.9 39.2-63.4 79.9 -54.1-2.7-102.1-28.6-134.2-68 -17 29.2-8.8 67.5 20.1 86.9 -10.7-0.3-20.7-3.3-29.5-8.1 -0.7 30.2 20.9 58.4 52.2 64.6 -9.2 2.5-19.2 3.1-29.4 1.1 8.3 25.9 32.3 44.7 60.8 45.2 -27.4 21.4-61.8 31-96.4 27 28.8 18.5 63 29.2 99.8 29.2 120.8 0 189.1-102.1 185-193.6C399.9 193.1 410.9 181.7 419.6 168.6z"/></svg><!--[if lt IE 9]><em>Twitter</em><![endif]-->';
									if ($type=='linkedin') 	$icon = '<svg viewBox="0 0 512 512"><path d="M186.4 142.4c0 19-15.3 34.5-34.2 34.5 -18.9 0-34.2-15.4-34.2-34.5 0-19 15.3-34.5 34.2-34.5C171.1 107.9 186.4 123.4 186.4 142.4zM181.4 201.3h-57.8V388.1h57.8V201.3zM273.8 201.3h-55.4V388.1h55.4c0 0 0-69.3 0-98 0-26.3 12.1-41.9 35.2-41.9 21.3 0 31.5 15 31.5 41.9 0 26.9 0 98 0 98h57.5c0 0 0-68.2 0-118.3 0-50-28.3-74.2-68-74.2 -39.6 0-56.3 30.9-56.3 30.9v-25.2H273.8z"/></svg><!--[if lt IE 9]><em>LinkedIn</em><![endif]-->';
									if ($type=='github') 		$icon = '<svg viewBox="0 0 512 512"><path d="M256 70.7c-102.6 0-185.9 83.2-185.9 185.9 0 82.1 53.3 151.8 127.1 176.4 9.3 1.7 12.3-4 12.3-8.9V389.4c-51.7 11.3-62.5-21.9-62.5-21.9 -8.4-21.5-20.6-27.2-20.6-27.2 -16.9-11.5 1.3-11.3 1.3-11.3 18.7 1.3 28.5 19.2 28.5 19.2 16.6 28.4 43.5 20.2 54.1 15.4 1.7-12 6.5-20.2 11.8-24.9 -41.3-4.7-84.7-20.6-84.7-91.9 0-20.3 7.3-36.9 19.2-49.9 -1.9-4.7-8.3-23.6 1.8-49.2 0 0 15.6-5 51.1 19.1 14.8-4.1 30.7-6.2 46.5-6.3 15.8 0.1 31.7 2.1 46.6 6.3 35.5-24 51.1-19.1 51.1-19.1 10.1 25.6 3.8 44.5 1.8 49.2 11.9 13 19.1 29.6 19.1 49.9 0 71.4-43.5 87.1-84.9 91.7 6.7 5.8 12.8 17.1 12.8 34.4 0 24.9 0 44.9 0 51 0 4.9 3 10.7 12.4 8.9 73.8-24.6 127-94.3 127-176.4C441.9 153.9 358.6 70.7 256 70.7z"/></svg><!--[if lt IE 9]><em>GitHub</em><![endif]-->';
									if ($type=='website') 		$icon = '<svg class="svg-icon" viewBox="0 0 20 20"><path d="M16.469,8.924l-2.414,2.413c-0.156,0.156-0.408,0.156-0.564,0c-0.156-0.155-0.156-0.408,0-0.563l2.414-2.414c1.175-1.175,1.175-3.087,0-4.262c-0.57-0.569-1.326-0.883-2.132-0.883s-1.562,0.313-2.132,0.883L9.227,6.511c-1.175,1.175-1.175,3.087,0,4.263c0.288,0.288,0.624,0.511,0.997,0.662c0.204,0.083,0.303,0.315,0.22,0.52c-0.171,0.422-0.643,0.17-0.52,0.22c-0.473-0.191-0.898-0.474-1.262-0.838c-1.487-1.485-1.487-3.904,0-5.391l2.414-2.413c0.72-0.72,1.678-1.117,2.696-1.117s1.976,0.396,2.696,1.117C17.955,5.02,17.955,7.438,16.469,8.924 M10.076,7.825c-0.205-0.083-0.437,0.016-0.52,0.22c-0.083,0.205,0.016,0.437,0.22,0.52c0.374,0.151,0.709,0.374,0.997,0.662c1.176,1.176,1.176,3.088,0,4.263l-2.414,2.413c-0.569,0.569-1.326,0.883-2.131,0.883s-1.562-0.313-2.132-0.883c-1.175-1.175-1.175-3.087,0-4.262L6.51,9.227c0.156-0.155,0.156-0.408,0-0.564c-0.156-0.156-0.408-0.156-0.564,0l-2.414,2.414c-1.487,1.485-1.487,3.904,0,5.391c0.72,0.72,1.678,1.116,2.696,1.116s1.976-0.396,2.696-1.116l2.414-2.413c1.487-1.486,1.487-3.905,0-5.392C10.974,8.298,10.55,8.017,10.076,7.825"></path></svg><!--[if lt IE 9]><em>Website</em><![endif]-->';
									
									echo "<li class='$type social-media-item'>";
										echo "<a class='social-media-link' href='$link' target='_blank' title='$displayTitle'>$icon</a>";
									echo "</li>";
				   			endwhile;
			    			echo "</ul>";
			    		} 
							echo $about;
							// echo "<a href='$website'>Visit $sponsor's website</a>";
						echo "</li>";
				endwhile;
			echo "</ul>";
		} // Check to see if there are Individual rows
	endwhile;
} // Check to see if there are Group rows