<?php

/**
 * @file
 * Customize confirmation screen after successful submission.
 *
 * This file may be renamed "webform-confirmation-[nid].tpl.php" to target a
 * specific webform e-mail on your site. Or you can leave it
 * "webform-confirmation.tpl.php" to affect all webform confirmations on your
 * site.
 *
 * Available variables:
 * - $node: The node object for this webform.
 * - $confirmation_message: The confirmation message input by the webform author.
 * - $sid: The unique submission ID of this submission.
 */
	module_load_include('inc', 'webform', 'includes/webform.submissions');
	$submission = webform_get_submission($node->nid, $sid);
 
	$courses_qty = 0;
	$with_discount = 0;
	$amount_for_discount = 0;
	$amount = 0;
	foreach ($submission->data as $key => $value) {
		if (substr($value['value'][0], 0, 7) == 'klasse_') {
			foreach ($node->_course_info as $nid => $details) {
				foreach ($details['klasses'] as $date => $klasses) {
					$klass_nid = substr($value['value'][0], 7);
					if (array_key_exists($klass_nid, $klasses)) {
						if ($details['node']->type == 'lehrgang') {
							$with_discount++;
							$amount_for_discount += $details['node']->field_kosten[LANGUAGE_NONE][0]['value'];
						}
						$amount += $details['node']->field_kosten[LANGUAGE_NONE][0]['value'];
						$courses_qty++;
					}
				}
			}
		}
	}
	if ($with_discount >= 2) {
		$discount = round($amount_for_discount * 0.1);
		$amount -= $discount;
	}
?>
<div class="webform-confirmation">
	<!-- Google Code for Transaction Conversion Page -->
	<script type="text/javascript">
		/* <![CDATA[ */
		var google_conversion_id = 949349464;
		var google_conversion_language = "de";
		var google_conversion_format = "2";
		var google_conversion_color = "ffffff";
		var google_conversion_label = "vHDdCIDJgwUQ2NjXxAM";
		var google_conversion_value = <?php print $amount; ?>;
		/* ]]> */
	</script>
	<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js"></script>
	<noscript>
		<div style="display:inline;">
		<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/949349464/?value=<?php print $amount; ?>&amp;label=vHDdCIDJgwUQ2NjXxAM&amp;guid=ON&amp;script=0"/>
		</div>
	</noscript>
  <?php if ($confirmation_message): ?>
    <?php print $confirmation_message ?>
  <?php else: ?>
    <p><?php print t('Thank you, your submission has been received.'); ?></p>
  <?php endif; ?>
</div>

<div class="links">
  <a href="<?php print url('node/'. $node->nid) ?>"><?php print t('Go back to the form') ?></a>
</div>
