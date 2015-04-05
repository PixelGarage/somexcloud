<?php
	if (!empty($node->og_group_ref)) {
		$parent = node_load($node->og_group_ref[LANGUAGE_NONE][0]['target_id']);
		$color = empty($parent->field_color) ? '000' : $parent->field_color[LANGUAGE_NONE][0]['value'];
		$picture = empty($parent->field_icon) ? '' : '<img src="' . image_style_url('icon', $parent->field_icon[LANGUAGE_NONE][0]['uri']) . '" alt="' . $parent->title . '" />';
		print '<div class="klasse_wrapper"><h1 id="page-title"><span class="bg_title" style="background-color: #' . $color . ';">' . $picture . $parent->title . '</span></h1>';
	}
	$content['field_datum']['#title'] = 'Starting ';
	$block = module_invoke('somex_anmeldung', 'block_view', 'beratung');
?>
<div id="block-somex-anmeldung-beratung">
	<h2 class="block-title"><?php print render($block['subject']); ?></h2>
	<div class="content clearfix"><?php print render($block['content']); ?></div>
</div>
<article<?php print $attributes; ?>>
  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
  <header>
    <h2<?php print $title_attributes; ?>><?php print $title ?></h2>
  </header>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  <div<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
      print l('Lehrgang meinem Kalendar hinzuf&#252;gen', 'lektions/' . $node->nid . '/cal.ics', array('html' => true, 'attributes' => array('class' => array('green_button'))));
    ?>
  </div>
  <div class="clearfix">
    <?php if (!empty($content['links'])): ?>
      <nav class="links node-links clearfix"><?php print render($content['links']); ?></nav>
    <?php endif; ?>
  </div>
</article>
<?php if (!empty($node->og_group_ref)): ?></div><?php endif; ?>