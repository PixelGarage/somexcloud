<?php
function somex_alpha_preprocess_html(&$vars) {
	drupal_add_html_head(array(
		'#type' => 'html_tag',
		'#tag' => 'meta',
		'#attributes' => array(
			'content' => 'RHuLARciw9iFOpp428xoLD6Thw9hgTSGRLmmNh-aJQg',
			'name' => 'google-site-verification',
		)
	), 'google-site-verification');;
  drupal_add_css('http://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Abel', array('type' => 'external', 'group' => CSS_THEME, 'weight' => -100));
  drupal_add_js('//platform.twitter.com/widgets.js', 'external');
	$fb_js = <<<FS_JS
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/de_DE/all.js#xfbml=1&appId=479686105385174";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
FS_JS;
	$vars['page']['page_bottom']['fb_scripts'] = array(
		'#type' => 'markup',
		'#weight' => -100,
		'#markup' => $fb_js
	);
	$olark_code = <<<OLARK
<script data-cfasync="false" type='text/javascript'>/*{literal}<![CDATA[*/
window.olark||(function(c){var f=window,d=document,l=f.location.protocol=="https:"?"https:":"http:",z=c.name,r="load";var nt=function(){f[z]=function(){(a.s=a.s||[]).push(arguments)};var a=f[z]._={},q=c.methods.length;while(q--){(function(n){f[z][n]=function(){f[z]("call",n,arguments)}})(c.methods[q])}a.l=c.loader;a.i=nt;a.p={0:+new Date};a.P=function(u){a.p[u]=new Date-a.p[0]};function s(){a.P(r);f[z](r)}f.addEventListener?f.addEventListener(r,s,false):f.attachEvent("on"+r,s);var ld=function(){function p(hd){hd="head";return["<",hd,"></",hd,"><",i,' onl' + 'oad="var d=',g,";d.getElementsByTagName('head')[0].",j,"(d.",h,"('script')).",k,"='",l,"//",a.l,"'",'"',"></",i,">"].join("")}var i="body",m=d[i];if(!m){return setTimeout(ld,100)}a.P(1);var j="appendChild",h="createElement",k="src",n=d[h]("div"),v=n[j](d[h](z)),b=d[h]("iframe"),g="document",e="domain",o;n.style.display="none";m.insertBefore(n,m.firstChild).id=z;b.frameBorder="0";b.id=z+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){b.src="javascript:false"}b.allowTransparency="true";v[j](b);try{b.contentWindow[g].open()}catch(w){c[e]=d[e];o="javascript:var d="+g+".open();d.domain='"+d.domain+"';";b[k]=o+"void(0);"}try{var t=b.contentWindow[g];t.write(p());t.close()}catch(x){b[k]=o+'d.write("'+p().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}a.P(2)};ld()};nt()})({loader: "static.olark.com/jsclient/loader0.js",name:"olark",methods:["configure","extend","declare","identify"]});
/* custom configuration goes here (www.olark.com/documentation) */
olark.identify('1016-271-10-4479');/*]]>{/literal}*/</script><noscript><a href="https://www.olark.com/site/1016-271-10-4479/contact" title="Contact us" target="_blank">Questions? Feedback?</a> powered by <a href="http://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a></noscript>
OLARK;
	$vars['page']['page_bottom']['olark_scripts'] = array(
		'#type' => 'markup',
		'#weight' => -101,
		'#markup' => $olark_code
	);
  $vars['page']['page_bottom']['anmeldung_link'] = array(
  	'#type' => 'markup',
  	'#markup' => '<div id="side_anmeldung_link">' . l('Anmeldung', 'node/585') . '</div>'
  );
  if ($node = menu_get_object()) {
  	if ($node->type == 'news') {
			drupal_add_js('http://w.sharethis.com/button/buttons.js', array('type' => 'external'));
			drupal_add_js('stLight.options({publisher: "ur-2f1e5a11-85ba-f128-1f44-de3aa35527b6"});', array('type' => 'inline', 'scope' => 'footer'));
			$vars['page']['page_bottom']['sharethis'] = array(
				'#type' => 'markup',
				'#markup' => '<div id="sharethis_side">' .
												'<span class="st_fblike_vcount" displayText="Facebook Like"></span>' .
												'<span class="st_twitter_vcount" displayText="Tweet"></span>' .
												'<span class="st_plusone_vcount" displayText="Google +1"></span>' .
												'<span class="st_pinterest_vcount" displayText="Pinterest"></span>' .
											'</div>'
			);
		} elseif ($node->type == 'event') {
			drupal_add_js('http://w.sharethis.com/button/buttons.js', array('type' => 'external'));
			drupal_add_js('stLight.options({publisher: "ur-2f1e5a11-85ba-f128-1f44-de3aa35527b6"});', array('type' => 'inline', 'scope' => 'footer'));
		}
  }
}