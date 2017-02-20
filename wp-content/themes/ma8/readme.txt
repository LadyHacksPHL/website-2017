= MA8 =

* by Gautam Thapar, http://www.gautamthapar.me




== ABOUT MA8 ==

A simple multi-author blog theme. It is lightweight, seo ready and loads fast. It comes with theme options panel so that anyone can change the feel of the theme according to his/her own taste.

Demo - http://demo.gautamthapar.me/?themedemo=MA8




== INSTALLATION ==

Step 1: Download ma8.zip

Step 2: Inside your WordPress Dashboard, go to appearance > themes > upload.
Then upload ma8.zip and activate the theme.

OR

Step 2: Another way to install theme is to first unzip ma8.zip. Then place the extracted ma8 folder in wp-contents > themes. Now go to appearance and activate ma8 theme.




== THEME SET-UP ==


//++ Permalinks (if required) ++//

To change permalinks, go to Dashboard > Settings > Permalinks > Choose the option as required > Save changes.


//++ Title & Description ++//

To change title & description of your website go to Dashboard > Settings > General > Site Title.


//++ Creating Required Pages ++//

Create three pages - Homepage, Blog posts and Authors list.

To create a page go to Dashboard > Pages > Add New > {Enter desired title} > click publish.

When creating Authors list page, make sure to select the template "Author List" under page attributes.

Note: Individual social links for authors can be added from their respective profiles. Dashboard > Users > Edit User.


//++ Settings ++//

Now, lets change some settings.

Go to Dashboard > Settings > Reading > Front Page displays > select static page.

Choose your previously created home page as Front page.

Choose your previously created posts page as Posts page.


//++ Menu ++//

Go to Dashboard > Appearance > Menus > Menu Name - Enter Desired Name & Create Menu. 

Add pages, categories or custom links as desired. Save Menu.

At the bottom of the created / selected menu select primary menu.


//++ Theme Options ++//

Go to Dashboard > Appearance > Theme Options

-- Basic Styles --
You can change the color combinations under basic styles such as link color, link hover color, header background color, menu dropdown background color, footer social icons color.

You can also upload a favicon in this section if required.

+ NEW in version 1.0.7
You can change body font and color.
You can now replace site heading text with an image (logo).

-- Social --
Under it you can enter the various social links.

For social icons to appear select the checkbox.

Facebook url - Enter a facebook page or profile url.
Twitter username - Enter a twitter username without '@'. 
Google+ url - Enter google+ profile url.

+ NEW in version 1.0.7
If any social field is blank then that icon will not appear on front-end.

-- Slider --
Enable or Disable the slider under it.

The category you select will be used to display posts as slides.
So select a category.
Three random posts will be displayed from the selected category in the slider.

The selected category will not be included in the latest post list on the front page.

Note: Preferred image size for slider is 1000x550 px.

-- Front Page --
Under front page you are required to select the pages for blog posts and authors list. This is to link the posts page buttons on the homepage to posts page and authors list page respectively.

You can enable or disable author box by simply checking or unchecking the selectbox under "Enable Top Authors Box".

You can enable or disable footer widgets by simply checking or unchecking the selectbox under "Enable Footer Widgets".

Blog post button will appear only when there are more than 3 posts.

+ NEW in version 1.0.7
You can now enable or disable latest posts box.
You can now change 'Latest Posts' text.
You can now change the number of posts appearing under latest posts box.
You can now change 'All Posts' button text.
You can now change 'Top Authors' text.
You can now change the number of authors appearing under top authors box.
You can now change 'More Info' button text.

-- Extras -- [NEW in version 1.0.7]
You can enable or disable Meta boxes for single posts.
You can enable or disable Meta boxes for archive pages.
You can enable or disable Author info box for single posts.

-- Support Sidebar -- [NEW in version 1.0.7]
Added support related information.


//++ Widgets ++//

The theme contains four widget areas.

Three widget areas are on the front page whereas the fourth one is on single post or page as a regular sidebar.

For installing widgets go to Dashboard > Appearance > Widgets.

Widgets for single post or page must be placed inside 'Sidebar' area.

Widgets for front-page can be placed inside 'Left Footer' , 'Middle Footer' or 'Right Footer'.

Widgets inside 'Left Footer' will appear to the left of the front page under footer widgets section.

Widgets inside 'Middle Footer' will appear in the middle of the front page under footer widgets section.

Widgets inside 'Right Footer' will appear to the right of the front page under footer widgets section.


//++ Translation ++// [NEW in version 1.0.7]

You can now translate MA8 to any language.

To translate open default.po (located in 'lang' folder) with Poedit (http://www.poedit.net). Translate the file and save in lang folder under name appropriate to your language (i.e. fr_FR for French). File name format is 'language code'_'Country code'. Language codes 

Language codes can be found here -

	- Language Codes
	http://www.gnu.org/software/gettext/manual/html_chapter/gettext_16.html#Language-Codes

	- Country Codes
	http://www.gnu.org/software/gettext/manual/html_chapter/gettext_16.html#Country-Codes


Next, if you haven’t done so already, you’ll need to edit your wp-config.php file to set default language for your website. For example, to use french translation, you’ll need to set your language in wp-config.php, like this:

	define ('WPLANG', 'fr_FR');

wp-config.php file is located in the root directory of your WordPress installation.


//++ Plugins ++//

For SEO and Breadcrumbs -

FREE - WordPress SEO by Yoast.
http://wordpress.org/plugins/wordpress-seo/



== CHANGELOG ==

v1.0.7 [21/08/13]

-> Added logo image uploader.

-> Added localisation support. Theme is now translation ready.

-> Added more control over social icons. Now only those icons will appear for which url / username is entered. Blank one's won't show up, simple.

-> Added checkbox for Latest Posts on front-page. So now you can enable or disable latest posts box. It is disabled by default.

-> Added option to select the number of posts to appear under Latest Posts box on front-page.

-> Added option to select the number of authors to appear under Top Authors box on front-page.

-> Improvements to theme options panel.

-> Added support sidebar to options panel.

-> Added typography in theme options. You can now increase or decrease body font-size and color from theme options.

-> Added option to customize "Latest Posts" and "Top Authors" text.

-> Added option to customize "All Posts" and "More Info" button text.

-> Added option to enable / disable meta boxes on single posts and archive pages. They are enabled by default.

-> Added option to enable / disable author information box on single posts.

-> Added option to enable / disable editor style.

-> Extended nav drop-down support to unlimited levels deep.

-> Aligned posts count and social icons inside author box on author list page.

-> Fixed authors list page css issues.

-> Fixed author image border color issue in comments.

-> CSS improvements.

-> Removed category.php & home.php files.


v1.0.6 [18/08/13]

-> Initial Release


== CREDITS ==


* Flat UI Free (Some components used such as fonts and buttons)

Flat UI Free is licensed under a Creative Commons Attribution 3.0 Unported (CC BY 3.0)  (http://creativecommons.org/licenses/by/3.0/) and MIT License - http://opensource.org/licenses/mit-license.html. 

	## Links:

	+ [Demo page](http://designmodo.github.com/Flat-UI/)
	+ [Official page](http://designmodo.com/flat-free)


* FlexSlider
http://www.woothemes.com/flexslider/


* Options Framework (for theme options)
http://wptheming.com/options-framework-theme/


* WordPress SEO by Yoast (for breadcrumbs)
http://wordpress.org/plugins/wordpress-seo/


* Treehouse (for some images and text)
http://blog.teamtreehouse.com/
