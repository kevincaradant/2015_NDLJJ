<?php 

Asset::css('asset::jquery-ui.min.css', false, 'elfinder');
Asset::css('finder::elfinder.min.css', false, 'elfinder');
Asset::css('finder::theme.css', false, 'elfinder');

Asset::js('asset::jquery-ui.min.js', false, 'elfinder');
Asset::js('finder::elfinder.min.js', false, 'elfinder');
Asset::js('finder::i18n/elfinder.fr.js', false, 'elfinder');

echo Asset::render_css('elfinder');
echo Asset::render_js('elfinder');

?>