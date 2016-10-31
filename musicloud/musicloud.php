<?php
/**
 * Name: musicloud
 * Description: A plugin to privide access to filestorage directory hierarchy through the Ampache API.
 * Version: 0.1
 * Depends: None
 * Recommends: None
 * Category: API
 * Author: sasiflo <dev@sasiflo.de>
 * Maintainer: sasiflo <dev@sasiflo.de>
 */


function musicloud_module() { return; }


function musicloud_load() {
	Zotlabs\Extend\Hook::register('feature_settings', 'addon/musicloud/musicloud.php', 'musicloud_settings');
	Zotlabs\Extend\Hook::register('feature_settings_post', 'addon/musicloud/musicloud.php', 'musicloud_settings_post');
}


function musicloud_unload() {
	Zotlabs\Extend\Hook::unregister_by_file('addon/musicloud/musicloud.php');
}



function musicloud_settings(&$output) {
	$id = local_channel();
	if (!$id)
		return;

    $base_folder = get_pconfig($id, 'musicloud', 'base_folder');


	$content = replace_macros(
		get_markup_template('field_input.tpl'), array(
			'$field' => array(
				'base_folder', t('Base folder'), $base_folder, t('The base folder of the music library accessible through Ampache API relative to the cloud root folder. Example: public/music')
			)
		)
	);


	$output .= replace_macros(
		get_markup_template('generic_addon_settings.tpl'), array(
			'$addon' => array('musicloud', t('Hubzilla Ampache API Settings'), '', t('Submit')),
            '$content' => $content
		)
	);

}

function musicloud_settings_post($post) {
	logger("musicloud_settings_post() post=" . print_r($post, true), LOGGER_INFO);
	$id = local_channel();
	if (!$id)
		return;

	if($post['musicloud-submit']) {
		set_pconfig($id, 'musicloud', 'base_folder', dbesc($post['base_folder']));
	}

}


function musicloud_plugin_admin(&$a, &$output) {
	logger("musicloud_plugin_admin() with output=" . print_r($output, true), LOGGER_INFO);

	$output .= '<H3>Hello!</H3>';
}

function musicloud_plugin_admin_post($a) {
	logger("musicloud_plugin_admin_post() with a=" . print_r($a, true), LOGGER_INFO);
}


function musicloud_content(&$a){
	logger("musicloud_content(): begin function.", LOGGER_INFO);

	$id = local_channel();
	if(!$id)
		return;

    $base_folder = get_pconfig($id, 'musicloud', 'base_folder');

    $output = '<h2>Base-Folder: ' . $base_folder . '</h2>';

	logger("musicloud_content(): end function.", LOGGER_INFO);

    return $output;
}




