<?php
/**
 * Name: hubzilla_apache_api
 * Description: A plugin to privide access to filestorage directory hierarchy through the Ampache API.
 * Version: 0.1
 * Depends: Core
 * Recommends: None
 * Category: API
 * Author: sasiflo <dev@sasiflo.de>
 * Maintainer: sasiflo <dev@sasiflo.de>
 */


function hubzilla_apache_api_load(){
	register_hook('construct_page', 'addon/hubzilla_apache_api/hubzilla_apache_api.php', 'hubzilla_apache_api_construct_page');
	register_hook('feature_settings', 'addon/hubzilla_apache_api/hubzilla_apache_api.php', 'hubzilla_apache_api_settings');
	register_hook('feature_settings_post', 'addon/hubzilla_apache_api/hubzilla_apache_api.php', 'hubzilla_apache_api_settings_post');

}


function hubzilla_apache_api_unload(){
	unregister_hook('construct_page', 'addon/hubzilla_apache_api/hubzilla_apache_api.php', 'hubzilla_apache_api_construct_page');
	unregister_hook('feature_settings', 'addon/hubzilla_apache_api/hubzilla_apache_api.php', 'hubzilla_apache_api_settings');
	unregister_hook('feature_settings_post', 'addon/hubzilla_apache_api/hubzilla_apache_api.php', 'hubzilla_apache_api_settings_post');
}



function hubzilla_apache_api_construct_page(&$a, &$b){
	if(! local_channel())
		return;

	$some_setting = get_pconfig(local_channel(), 'hubzilla_apache_api','some_setting');

	// Whatever you put in settings, will show up on the left nav of your pages.
	$b['layout']['region_aside'] .= '<div>' . htmlentities($some_setting) .  '</div>';

}



function hubzilla_apache_api_settings_post($a,$s) {
	if(! local_channel())
		return;

	set_pconfig( local_channel(), 'hubzilla_apache_api', 'some_setting', $_POST['some_setting'] );

}

function hubzilla_apache_api_settings(&$a,&$s) {
	$id = local_channel();
	if (! $id)
		return;

	$some_setting = get_pconfig( $id, 'hubzilla_apache_api', 'some_setting');

	$sc = replace_macros(get_markup_template('field_input.tpl'), array(
				     '$field'	=> array('some_setting', t('Some setting'), 
							 $some_setting, 
							 t('A setting'))));
	$s .= replace_macros(get_markup_template('generic_addon_settings.tpl'), array(
				     '$addon' 	=> array('hubzilla_apache_api',
							 t('hubzilla_apache_api Settings'), '', 
							 t('Submit')),
				     '$content'	=> $sc));

}




