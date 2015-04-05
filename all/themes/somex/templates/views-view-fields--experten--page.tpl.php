<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
 	$acc = new stdclass();
 	$acc->uid = $row->uid;
 	$memberships = og_get_groups_by_user($acc, 'node');
 	$icons = '';
 	$_icons = array();
 	if (!empty($memberships)) {
 		$memberships = entity_load('node', array_keys($memberships));
 		foreach ($memberships as $nid => $membership) {
 			if (in_array($membership->type, array('kurse', 'lehrgang', 'seminare'))) {
 				if (!in_array($membership->field_icon[LANGUAGE_NONE][0]['uri'], $_icons)) {
	 				$icons .= empty($membership->field_icon) ? '' : '<img src="' . image_style_url('icon', $membership->field_icon[LANGUAGE_NONE][0]['uri']) . '" alt="' . $membership->title . '" />';
	 				$_icons[] = $membership->field_icon[LANGUAGE_NONE][0]['uri'];
	 			}
 			}
 		}
	}
	$query = new EntityFieldQuery();
	$query->entityCondition('entity_type', 'node')
		->entityCondition('bundle', 'module')
		->propertyCondition('status', 1)
		->fieldCondition('field_experten', 'target_id', $row->uid);
	$result = $query->execute();
	$modules = array();
	if (isset($result['node'])) {
		$modules = entity_load('node', array_keys($result['node']));
	}
	$query = new EntityFieldQuery();
	$query->entityCondition('entity_type', 'node')
		->entityCondition('bundle', array('seminare', 'lehrgang', 'kurse'), 'IN')
		->propertyCondition('status', 1)
		->fieldCondition('field_experten', 'target_id', $row->uid);
	$result = $query->execute();
 	$groups = array();
	if (isset($result['node'])) {
		$groups_nodes = entity_load('node', array_keys($result['node']));
		foreach ($groups_nodes as $nid => $l) {
			$groups[$nid] = l($l->title, 'node/' . $nid);
		}
	}
?>
<div class="left_side">
	<?php foreach ($fields as $id => $field): ?>
		<?php if ($id == 'field_website_url') continue; ?>
		<?php print $field->wrapper_prefix; ?>
			<?php print $field->label_html; ?>
			<?php print $field->content; ?>
		<?php print $field->wrapper_suffix; ?>
	<?php endforeach; ?>
</div>
<div class="right_side">
	<?php if (!empty($modules) || !empty($groups)): ?>
		<h3 class="clearfix">Zust&#228;ndig f&#252;r<span><?php print $icons ?></span></h3>
		<?php if (!empty($modules)): ?>
			<div class="clearfix">
				<div class="label">Dozent</div>
				<div class="content">
					<?php foreach ($modules as $nid => $node): ?>
						<?php print l($node->title, 'node/' . $nid); ?><br />
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if (!empty($groups)): ?>
			<div class="clearfix">
				<div class="label">Leiter</div>
				<div class="content"><?php print implode('<br />', $groups); ?></div>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<?php if (array_key_exists('field_website_url', $fields)): ?>
		<?php $field = $fields['field_website_url']; ?>
		<?php print $field->wrapper_prefix; ?>
			<?php print $field->label_html; ?>
			<?php print $field->content; ?>
		<?php print $field->wrapper_suffix; ?>
	<?php endif; ?>
</div>