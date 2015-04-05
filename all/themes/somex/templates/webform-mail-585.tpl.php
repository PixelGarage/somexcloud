<?php

/**
 * @file
 * Customize the e-mails sent by Webform after successful submission.
 *
 * This file may be renamed "webform-mail-[nid].tpl.php" to target a
 * specific webform e-mail on your site. Or you can leave it
 * "webform-mail.tpl.php" to affect all webform e-mails on your site.
 *
 * Available variables:
 * - $node: The node object for this webform.
 * - $submission: The webform submission.
 * - $email: The entire e-mail configuration settings.
 * - $user: The current user submitting the form.
 * - $ip_address: The IP address of the user submitting the form.
 *
 * The $email['email'] variable can be used to send different e-mails to different users
 * when using the "default" e-mail template.
 */
?>
<?php if ($email['email'] == 7): ?>
<p>Liebe/r <?php echo $submission->data[4]['value'][0]; ?>, <?php echo $submission->data[3]['value'][0]; ?></p>
<p>Wir haben deine Anmeldung für folgenden Kurs erhalten:</p>
<p><strong>Lehrgang:</strong></p>
<?php
	foreach ($submission->data as $key => $value) {
		if (substr($value['value'][0], 0, 7) == 'klasse_') {
			foreach ($node->_course_info as $nid => $details) {
				foreach ($details['klasses'] as $date => $klasses) {
					$klass_nid = substr($value['value'][0], 7);
					if (array_key_exists($klass_nid, $klasses)) {
						?>
<p><?php print $details['node']->title; ?><br />Startdatum, -zeit: Start <?php print format_date(strtotime($date), 'custom', 'j. F Y'); ?>, <?php print $klasses[$klass_nid] ?></p>
						<?php
						break 2;
					}
				}
			}
		}
	}
?>
<p><strong>Ort:</strong></p>
<p>SOMEXCLOUD, Buckhauserstrasse 40, 3. Stock, 8048 Zürich<br />Nähe Tram-/Bushaltestelle "Kappeli", 9 Min. vom  Bahnhof Altstetten</p>
<p><strong>Mitbringen:</strong></p>
<p>Deinen eigenen Laptop, um dem Kursverlauf optimal folgen zu können.</p>
<p>Vor dem Lehrgang wirst du noch einmal eine E-Mail mit wichtigen Informationen zur Vorbereitung erhalten.</p>
<p>Wir freuen uns auf dich!</p>
<p>Solltest du weitere Fragen haben, kannst du dich gerne jederzeit an office@somexcloud.com wenden.</p>
<p>Liebe Grüsse<br />Dein SOMEXCLOUD-Team</p>
<p>SOMEXCLOUD GmbH<br />Buckhausertrasse 40<br />CH-8048 Zürich<br /><a href="http://www.somexcloud.com">www.somexcloud.com</a></p>
<p>&nbsp;</p>
<p>PS: Wir verstehen SOMEXCLOUD als ein Gravitationszentrum für Social Media Professionals und Interessierte. Experten und Teilnehmer sind Teil einer wachsenden Community, zu der nun auch du gehörst. Deshalb erlauben wir uns das "Du". Wenn du eine Ansprache per Sie wünscht, bitten wir dich um deine Rückmeldung.</p>

<?php else: ?>
<?php $affiliate = somex_affiliate_get_current_affiliate(); if ($affiliate): ?>
	<p>Affiliate: <br /><?php print $affiliate['name'] ?></p>
<?php endif; ?>
<p>Kurswahl:</p>
<?php
	foreach ($submission->data as $key => $value) {
		if (substr($value['value'][0], 0, 7) == 'klasse_') {
			foreach ($node->_course_info as $nid => $details) {
				foreach ($details['klasses'] as $date => $klasses) {
					$klass_nid = substr($value['value'][0], 7);
					if (array_key_exists($klass_nid, $klasses)) {
						?>
<p><?php print $details['node']->title; ?><br />Startdatum, -zeit: Start <?php print format_date(strtotime($date), 'custom', 'j. F Y'); ?>, <?php print $klasses[$klass_nid] ?></p>
						<?php
						break 2;
					}
				}
			}
		}
	}
?>
<p><strong> Kontaktangaben für Privat:</strong><br />
<p><?php echo $submission->data[27]['value'][0]; ?><br />
Firma: <?php echo array_key_exists(28, $submission->data) ? $submission->data[28]['value'][0] : '-'; ?><br />
Funktion: <?php echo array_key_exists(29, $submission->data) ? $submission->data[29]['value'][0] : '-'; ?><br />
Name: <?php echo $submission->data[3]['value'][0]; ?><br />
Vorname: <?php echo $submission->data[4]['value'][0]; ?><br />
Strasse: <?php echo $submission->data[5]['value'][0]; ?><br />
Ort: <?php echo $submission->data[6]['value'][0]; ?><br />
PLZ: <?php echo $submission->data[30]['value'][0]; ?><br />
Email: <?php echo $submission->data[7]['value'][0]; ?><br />
Telefon: <?php echo $submission->data[8]['value'][0]; ?></p>

<p><strong>Kontaktangaben für Geschäft:</strong><br />
<p><?php echo array_key_exists(34, $submission->data) ? $submission->data[34]['value'][0] : '-'; ?><br />
Firma: <?php echo array_key_exists(31, $submission->data) ? $submission->data[31]['value'][0] : '-'; ?><br />
Funktion: <?php echo array_key_exists(33, $submission->data) ? $submission->data[33]['value'][0] : '-'; ?><br />
Name: <?php echo array_key_exists(11, $submission->data) ? $submission->data[11]['value'][0] : '-'; ?><br />
Vorname: <?php echo array_key_exists(12, $submission->data) ? $submission->data[12]['value'][0] : '-'; ?><br />
Strasse: <?php echo array_key_exists(13, $submission->data) ? $submission->data[13]['value'][0] : '-'; ?><br />
Ort: <?php echo array_key_exists(14, $submission->data) ? $submission->data[14]['value'][0] : '-'; ?><br />
PLZ: <?php echo array_key_exists(32, $submission->data) ? $submission->data[32]['value'][0] : '-'; ?><br />
Email: <?php echo array_key_exists(15, $submission->data) ? $submission->data[15]['value'][0] : '-'; ?><br />
Telefon: <?php echo array_key_exists(16, $submission->data) ? $submission->data[16]['value'][0] : '-'; ?></p>
<p>Korrespondenz an: <?php echo array_key_exists(17, $submission->data) ? $submission->data[17]['value'][0] : '-'; ?></p>
<p>Rechnung an: <?php echo array_key_exists(35, $submission->data) ? $submission->data[35]['value'][0] : '-'; ?></p>
<p>Wie sind Sie auf SOMEXCLOUD aufmerksam geworden? <?php echo $submission->data[25]['value'][0]; ?></p>
<p>Bemerkungen: <?php echo array_key_exists(36, $submission->data) ? $submission->data[36]['value'][0] : '-'; ?></p>
<p>Möchten Sie den Newsletter abonnieren? <?php echo array_key_exists(19, $submission->data) ? 'Yes' : 'No'; ?></p>

<?php endif; ?>
