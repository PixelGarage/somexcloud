<?php
function somex_alpha_process_region(&$vars) {
	if ($vars['elements']['#region'] == 'content') {
		$theme = alpha_get_theme();
		if (array_key_exists('node', $theme->page) && in_array($theme->page['node']->type, array('kurse', 'seminare', 'lehrgang'))) {
			$color = empty($theme->page['node']->field_color) ? '000' : $theme->page['node']->field_color[LANGUAGE_NONE][0]['value'];
			$picture = empty($theme->page['node']->field_icon) ? '' : '<img src="' . image_style_url('icon', $theme->page['node']->field_icon[LANGUAGE_NONE][0]['uri']) . '" alt="' . $theme->page['node']->title . '" />';
			$vars['title'] = '<span class="bg_title" style="background-color: #' . $color . ';">' . $picture . $theme->page['title'] . '</span>';
		}
		if (array_key_exists('node', $theme->page) && $theme->page['node']->type == 'klasse') {
			$vars['title'] = '';
		}
	}
}
