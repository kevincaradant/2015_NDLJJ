<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<title>Agencora - <?= $template['title']; ?></title>
<meta name="robots" content="index, follow">
<meta name="description" content="Cette agence commerciale a été crée par Eric CHAZOTTES, au service du commerce de proximité depuis 1985.">

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
Asset::js('theme::jquery.dynaprice.min.js', false, 'front');
Asset::js('theme::script.js', false, 'front');
echo Asset::render_css('front');
echo Asset::render_js('front');
?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-63206490-1', 'auto');
  ga('send', 'pageview');

</script>