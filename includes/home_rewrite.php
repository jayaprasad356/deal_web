<?php
include("config/config.php");
include("functions.php");
include("admin/inc/language_data.php");

require 'assets/mail/PHPMailer.php';
require 'assets/mail/Exception.php';
$mail = new PHPMailer\PHPMailer\PHPMailer();
							
$error_message = '';
$success_message = '';
$error_message1 = '';
$success_message1 = '';

$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=?");
$statement->execute(array(1));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$mod_rewrite = $row['mod_rewrite'];
}
if($mod_rewrite == 'Off') {
	define("URL_CATEGORY", "category.php?slug=");
	define("URL_PAGE", "page.php?slug=");
	define("URL_NEWS", "news.php?slug=");
	define("URL_BLOG", "blog.php?slug=");
	define("URL_PIN", "pincode.php?slug=");
	define("URL_IFSC", "ifsccode.php?slug=");

} else {
	define("URL_PAGE", "page/");
	define("URL_IFSC", "ifsccode/");
	define("URL_CATEGORY", "category/");
	define("URL_NEWS", "news/");
	define("URL_BLOG", "blog/");
	define("URL_PIN", "pincode/");

}
?>
<?php
$statement = $pdo->prepare("SELECT * FROM tbl_meta WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$ifsc_title_bank			= $row['ifsc_title_bank'];
	$ifsc_description_bank		= $row['ifsc_description_bank'];
	$ifsc_heading_bank			= $row['ifsc_heading_bank'];
	$ifsc_paragraph_bank		= $row['ifsc_paragraph_bank'];
	$ifsc_title_state			= $row['ifsc_title_state'];
	$ifsc_description_state		= $row['ifsc_description_state'];
	$ifsc_heading_state			= $row['ifsc_heading_state'];
	$ifsc_paragraph_state		= $row['ifsc_paragraph_state'];
	$ifsc_title_district		= $row['ifsc_title_district'];
	$ifsc_description_district	= $row['ifsc_description_district'];
	$ifsc_heading_district		= $row['ifsc_heading_district'];
	$ifsc_paragraph_district	= $row['ifsc_paragraph_district'];
	$ifsc_title_branch			= $row['ifsc_title_branch'];
	$ifsc_description_branch	= $row['ifsc_description_branch'];
	$ifsc_heading_branch		= $row['ifsc_heading_branch'];
	$ifsc_paragraph_branch		= $row['ifsc_paragraph_branch'];
	$ifsc_keywords_branch		= $row['ifsc_keywords_branch'];
	$micr_title_bank			= $row['micr_title_bank'];
	$micr_description_bank		= $row['micr_description_bank'];
	$micr_heading_bank			= $row['micr_heading_bank'];
	$micr_paragraph_bank		= $row['micr_paragraph_bank'];
	$micr_title_state			= $row['micr_title_state'];
	$micr_description_state		= $row['micr_description_state'];
	$micr_heading_state			= $row['micr_heading_state'];
	$micr_paragraph_state		= $row['micr_paragraph_state'];
	$micr_title_district		= $row['micr_title_district'];
	$micr_description_district	= $row['micr_description_district'];
	$micr_heading_district		= $row['micr_heading_district'];
	$micr_paragraph_district	= $row['micr_paragraph_district'];
	$micr_title_branch			= $row['micr_title_branch'];
	$micr_description_branch	= $row['micr_description_branch'];
	$micr_heading_branch		= $row['micr_heading_branch'];
	$micr_paragraph_branch		= $row['micr_paragraph_branch'];
	$micr_keywords_branch		= $row['micr_keywords_branch'];
	$ifsc_title					= $row['ifsc_title'];
	$ifsc_description			= $row['ifsc_description'];
	$ifsc_heading				= $row['ifsc_heading'];
	$ifsc_paragraph				= $row['ifsc_paragraph'];
	$ifsc_keywords				= $row['ifsc_keywords'];
}
?>
<?php
$statement = $pdo->prepare("SELECT * FROM tb2_meta WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {

	$pin_title_state			= $row['pin_title_state'];
	$pin_description_state		= $row['pin_description_state'];
	$pin_heading_state			= $row['pin_heading_state'];
	$pin_paragraph_state		= $row['pin_paragraph_state'];
	$pin_title_district			= $row['pin_title_district'];
	$pin_description_district	= $row['pin_description_district'];
	$pin_heading_district		= $row['pin_heading_district'];
	$pin_paragraph_district		= $row['pin_paragraph_district'];
	$pin_title_block			= $row['pin_title_block'];
	$pin_description_block		= $row['pin_description_block'];
	$pin_heading_block			= $row['pin_heading_block'];
	$pin_paragraph_block		= $row['pin_paragraph_block'];
	$pin_title_office			= $row['pin_title_office'];
	$pin_description_office		= $row['pin_description_office'];
	$pin_heading_office			= $row['pin_heading_office'];
	$pin_paragraph_office		= $row['pin_paragraph_office'];
	$pin_keywords_office		= $row['pin_keywords_office'];
	$swift_title_country		= $row['swift_title_country'];
	$swift_description_country	= $row['swift_description_country'];
	$swift_heading_country		= $row['swift_heading_country'];
	$swift_paragraph_country	= $row['swift_paragraph_country'];
	$swift_title_bank			= $row['swift_title_bank'];
	$swift_description_bank		= $row['swift_description_bank'];
	$swift_heading_bank			= $row['swift_heading_bank'];
	$swift_paragraph_bank		= $row['swift_paragraph_bank'];
	$swift_title_city			= $row['swift_title_city'];
	$swift_description_city		= $row['swift_description_city'];
	$swift_heading_city			= $row['swift_heading_city'];
	$swift_paragraph_city		= $row['swift_paragraph_city'];
	$swift_title_branch			= $row['swift_title_branch'];
	$swift_description_branch	= $row['swift_description_branch'];
	$swift_heading_branch		= $row['swift_heading_branch'];
	$swift_paragraph_branch		= $row['swift_paragraph_branch'];
	$swift_keywords_branch		= $row['swift_keywords_branch'];
	$pin_title					= $row['pin_title'];
	$pin_description			= $row['pin_description'];
	$pin_heading				= $row['pin_heading'];
	$pin_paragraph				= $row['pin_paragraph'];
	$pin_keywords				= $row['pin_keywords'];
	$swift_title				= $row['swift_title'];
	$swift_description			= $row['swift_description'];
	$swift_heading				= $row['swift_heading'];
	$swift_paragraph			= $row['swift_paragraph'];
	$swift_keywords				= $row['swift_keywords'];
}
?>

<?php
// Delete all subscribers who did not confirm email within 1 day / 24 hours
$statement = $pdo->prepare("SELECT * FROM tbl_subscriber WHERE subs_active=0");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach($result as $row)
{
	$subs_date_time = $row['subs_date_time'];
	$current_date_time = date('Y-m-d H:i:s');
	$t1 = strtotime($subs_date_time);
	$t2 = strtotime($current_date_time);
	$diff = $t2 - $t1;
	$res = floor($diff/(60));
	if($res > 1440)
	{
		$statement1 = $pdo->prepare("DELETE FROM tbl_subscriber WHERE subs_id=?");
		$statement1->execute(array($row['subs_id']));
	}
}
// Getting the basic data for the website from database
$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)
{
	$logo                            = $row['logo'];
	$siteTitle                       = $row['site_title'];
	$logo_status                     = $row['logo_status'];
	$mobile_logo                     = $row['mobile_logo'];
	$logo_width                      = $row['logo_width'];
	$logo_height                     = $row['logo_height'];
	$favicon                         = $row['favicon'];
	$footer_logo					 = $row['footer_logo'];
	$author_name					 = $row['author_name'];
	$footer_about                    = $row['footer_about'];
	$footer_copyright                = $row['footer_copyright'];
	$footer_status                	 = $row['footer_status'];
	$contact_address                 = $row['contact_address'];
	$contact_email                   = $row['contact_email'];
	$contact_phone                   = $row['contact_phone'];
	$contact_map_iframe              = $row['contact_map_iframe'];
	$receive_email                   = $row['receive_email'];
	$receive_email_subject           = $row['receive_email_subject'];
	$receive_email_thank_you_message = $row['receive_email_thank_you_message'];
	$recent_news_footer				 = $row['recent_news_footer'];
	$popular_news_footer 			 = $row['popular_news_footer'];
	$recent_news_sidebar       		 = $row['recent_news_sidebar'];
	$popular_news_sidebar     		 = $row['popular_news_sidebar'];
	$recent_news_home_page    		 = $row['recent_news_home_page'];
	$meta_title_home                 = $row['meta_title_home'];
	$meta_keyword_home               = $row['meta_keyword_home'];
	$meta_description_home           = $row['meta_description_home'];
	$home_title						 = $row['home_title'];
	$home_description           	 = $row['home_description'];
	$home_content           	 	 = $row['home_content'];
	$news_sidebar_status             = $row['news_sidebar_status'];
	$ifsc_sidebar_status             = $row['ifsc_sidebar_status'];
	$pin_sidebar_status              = $row['pin_sidebar_status'];
	$swift_sidebar_status            = $row['swift_sidebar_status'];
	$sidebar_widget_status			= $row['sidebar_widget_status'];
	$sidebar_widget_title			= $row['sidebar_widget_title'];
	$sidebar_widget_code			= $row['sidebar_widget_code'];
	$google       					 = $row['google'];
	$bing         					 = $row['bing'];
	$yandex          				 = $row['yandex'];
	$footer_code			         = $row['footer_code'];
	$header_code          			 = $row['header_code'];
	$ifsc_photo 					= $row['ifsc_photo'];
	$micr_photo 					= $row['micr_photo'];
	$pin_photo 						= $row['pin_photo'];
	$swift_photo 					= $row['swift_photo'];
}
?>
<?php // Getting the basic data for the website from database
$statement = $pdo->prepare("SELECT * FROM tbl_theme WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)
{
	$theme_bg_color					= $row['theme_bg_color'];
	$theme_text_color				= $row['theme_text_color'];
	$theme_color					= $row['theme_color'];
	$theme_link_color				= $row['theme_link_color'];
	$theme_hover_color				= $row['theme_hover_color'];
	$theme_border_color				= $row['theme_border_color'];
	$widget_bg_color				= $row['widget_bg_color'];
	$select_style					= $row['select_style'];
	$theme_width					= $row['theme_width'];
	$header_style					= $row['header_style'];
	$header_bg_color				= $row['header_bg_color'];
	$header_text_color				= $row['header_text_color'];
	$header_link_color				= $row['header_link_color'];
	$header_link_hover_color		= $row['header_link_hover_color'];
	$footer_status					= $row['footer_status'];
	$footer_bg_color				= $row['footer_bg_color'];
	$footer_photo					= $row['footer_photo'];
	$footer_text_color				= $row['footer_text_color'];
	$footer_link_color				= $row['footer_link_color'];
	$footer_link_hover_color		= $row['footer_link_hover_color'];
	$sidebar_status					= $row['sidebar_status'];
	$copyright_bg_color				= $row['copyright_bg_color'];
	$copyright_text_color			= $row['copyright_text_color'];
	$copyright_text					= $row['copyright_text'];
	$copyright_link_color			= $row['copyright_link_color'];
	$copyright_link_hover_color		= $row['copyright_link_hover_color'];
	$font_size						= $row['font_size'];
	$font_style						= $row['font_style'];
	$font_family					= $row['font_family'];
	$h1_size						= $row['h1_size'];
	$h2_size						= $row['h2_size'];
	}
?>