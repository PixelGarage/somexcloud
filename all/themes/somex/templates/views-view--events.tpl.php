<?php

/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 *
 * @ingroup views_templates
 */
 drupal_add_js('http://w.sharethis.com/button/buttons.js', array('type' => 'external'));
 drupal_add_js('stLight.options({publisher: "ur-2f1e5a11-85ba-f128-1f44-de3aa35527b6"});', array('type' => 'inline', 'scope' => 'footer'));
?>
<div class="<?php print $classes; ?>">
  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <?php print $title; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
	<div class="view-header">
		<a class="tab first <?php print arg(0) == 'events' ? 'active' : ''; ?>" href="<?php print url('events'); ?>">Kommende Events</a>
		<a class="tab middle <?php print arg(0) != 'events' ? 'active' : ''; ?>" href="<?php print url('past-events'); ?>">Vergangene Events</a>
	</div>
	<div class="view-content <?php print arg(0) == 'events' ? 'first' : 'middle'; ?>">
		<?php if ($rows): ?>
			<?php print $rows; ?>
		<?php endif; ?>
	</div>
  <?php if ($pager): ?>
    <?php print $pager; ?>
  <?php endif; ?>
</div><?php /* class view */ ?>