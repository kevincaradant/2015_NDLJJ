<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<title>NUIT DE L'INFO</title>
<meta name="robots" content="index, follow">
<meta name="description" content="NINFO">

<?php
Asset::css('asset::bootstrap.min.css', false, 'front');
Asset::css('asset::ihover.min.css', false, 'front');
Asset::css('asset::animate.css', false, 'front');
Asset::css('asset::zoombox.css', false, 'front');
Asset::css('asset::chosen.min.css', false, 'front');
Asset::css('asset::hoverify-bootnav.css', false, 'front');
Asset::css('theme::style.css', false, 'front');
Asset::css('theme::mobile.css', false, 'front');
Asset::js('asset::jquery.1.11.1.min.js', false, 'front');
Asset::js('asset::jquery.easing.js', false, 'front');
Asset::js('asset::bootstrap.min.js', false, 'front');
Asset::js('asset::zoombox.js', false, 'front');
Asset::js('asset::chosen.jquery.min.js', false, 'front');
Asset::js('asset::hoverify-bootnav.js', false, 'front');
Asset::js('theme::script.js', false, 'front');
echo Asset::render_css('front');
echo Asset::render_js('front');
?>
