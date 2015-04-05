<?php

/**
 * @file
 * This template is used to print a single field in a view.
 *
 * It is not actually used in default Views, as this is registered as a theme
 * function which has better performance. For single overrides, the template is
 * perfectly okay.
 *
 * Variables available:
 * - $view: The view object
 * - $field: The field handler object that can process the input
 * - $row: The raw SQL result that can be used
 * - $output: The processed output that will normally be used.
 *
 * When fetching output from the $row, this construct should be used:
 * $data = $row->{$field->field_alias}
 *
 * The above will guarantee that you'll always get the correct data,
 * regardless of any changes in the aliasing that might happen if
 * the view is modified.
 */
 $quizes = array();
 foreach ($row->field_field_modules as $module_data) {
 	$module = $module_data['raw']['entity'];
 	$children = somex_og_get_group_entities('node', $module);
	if (!empty($children) && !empty($children['node'])) {
		$children_entities = node_load_multiple($children['node']);
		foreach ($children_entities as $child) {
			if (empty($child->field_lektion[LANGUAGE_NONE])) continue;
			if ($child->type == 'quiz' && !empty($child->field_is_a_feedback) && $child->field_is_a_feedback[LANGUAGE_NONE][0]['value']) {
				foreach ($child->field_lektion[LANGUAGE_NONE] as $delta => $vals) {
					if ($vals['target_id'] == $row->nid) {
						$quizes[] = $child;
						break;
					}
				}
			}
		}
	}
 }
?>
<?php foreach ($quizes as $quiz): ?>
	<?php print l($output, 'node/' . $quiz->nid); ?><br />
<?php endforeach; ?>