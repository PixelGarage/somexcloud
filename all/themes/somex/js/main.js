var SomexBanners = false;
var latestTweet = false;
(function ($) {
	$(document).ready(function() {
		var _sidebar = $('#region-sidebar-second');
		if (_sidebar.size()) {
			window.setInterval(function() {
				if (jQuery('#region-sidebar-second').height() + 45 < jQuery('#zone-content').height()) {
					jQuery('#region-sidebar-second').height($('#zone-content').height() - 45);
				}
			}, 500);
		}
		var sharrre = $('#sharethis_side');
		if (sharrre.size()) {
			$(window).resize(function() {
				var w = jQuery('#zone-content').offset().left;
				if (w < 100) {
					$('#sharethis_side').hide();
				} else {
					$('#sharethis_side').css({ left: w - 100 }).show();
				}
			});
		}
		window.setInterval(function() {
			jQuery('.view.view-experten.view-display-id-page .views-row .right_side').each(function() {
				var _s = jQuery(this);
				var h = _s.prev().height();
				if (h > _s.height()) {
					_s.height(h);
				}
			});
		}, 500);
		if ($('body').hasClass('front')) {
			$('.pane-webform-client-block-576, .pane-frontpage-blocks, #block-block-2').next('.panel-separator').addClass('clearfix');
			var _partners = $('.view.view-partners .views-row');
			_partners.width((100 / _partners.size()) + '%');
			var maxH = 0;
			var _partners_img = _partners.find('img');
			_partners_img.each(function() {
				maxH = $(this).height() > maxH ? $(this).height() : maxH;
			});
			_partners_img.each(function() {
				if ($(this).height() < maxH) {
					$(this).css({marginTop: Math.floor((maxH - $(this).height()) / 2)});
				}
			});
		}
		$('#webform-client-form-576 input.form-text').focus(function() {
			var _s = $(this);
			var l = $.trim(_s.prev('label').find("*").remove().end().text());
			if (_s.val() == l) {
				_s.val('');
			}
		}).blur(function() {
			var _s = $(this);
			var l = $.trim(_s.prev('label').find("*").remove().end().text());
			if (_s.val() == '') {
				_s.val(l);
			}
		}).blur();
		$('#webform-client-form-576').submit(function() {
			var _s = $(this).find('input.form-text');
			var l = $.trim(_s.prev('label').find("*").remove().end().text());
			if (_s.val() == l) {
				_s.focus();
				return false;
			}
			return true;
		});
		$('.view.view-frontpage-blocks .views-row.views-row-odd').each(function() {
			var _s = $(this);
			var _n = _s.next('.views-row-even');
			if (_n.size()) {
				var h = _s.height() > _n.height() ? _s.height() : _n.height();
				_s.css({minHeight: h});
				_n.css({minHeight: h});
			}
		});
		$('.view.view-team .team_container').each(function() {
			var h = 0;
			$(this).find('.views-row').each(function() {
				h = $(this).height() > h ? $(this).height() : h;
			}).css({minHeight: h});
		});
		$('#block-menu-block-1 ul.menu li a').attr('target', '_blank');
		var _experten_view = $('.panel-pane.pane-experten .view');
		if (_experten_view.size()) {
			_experten_view.parent().append('<a class="browse prev" /><a class="browse next" />');
			_experten_view.scrollable({
				items: '.view-content'
			});
		}
		if ($('.bg_gray_wide_wrapper').size()) {
			$(window).resize(function() {
				var w = $(window).width();
				var mW = 0;
				if (w > 940) {
					mW = (w - 940) / 2;
				}
				$('.bg_gray_wide_wrapper').css({
					marginLeft: mW * (-1),
					marginRight: mW * (-1),
					paddingLeft: mW,
					paddingRight: mW
				});
			});
		}
		if ($('#node-webform-585').size()) {
			var check_dependency = function() {
				var val1 = $('#node-webform-585 #edit-submitted-use-same-info input:radio:checked').val();
				var val2 = $('#node-webform-585 #edit-submitted-use-same-info-2 input:radio:checked').val();
				if (val1 != 'Privatadresse' || val2 != 'Privatadresse') {
					$('#webform-component-kontakt-2').show();
				} else {
					$('#webform-component-kontakt-2').hide();
				}
			}
			$('#node-webform-585').find('#edit-submitted-use-same-info, #edit-submitted-use-same-info-2').find('input:radio').click(check_dependency);
			check_dependency();
			$('.webform-component .description').each(function() {
				$(this).hide().siblings('label').append('<span class="help" />');
				$(this).siblings('label').find('.help').qtip({
					content: { text: $(this).html() }
				});
			});
		}
		if (SomexBanners) {
			$('body').addClass('withSomexBanners');
			$('#zone-content-wrapper').prepend('<div id="somexBanners" />');
			$(window).resize(function() {
				var w = $(window).width();
				$('#somexBanners').width(w);
				if (w < 1000) {
					$('#somexBanners a.browse').hide();
				} else {
					$('#somexBanners a.browse').show();
				}
			});
			$(SomexBanners).each(function() {
				var b = $('<div class="banner" style="background-image:url(' + this.banner + ');" />');
				if (this.title != '' || this.body != '') {
					var box = $('<div class="box" />');
					var bbox = $('<div class="box_content" />');
					if (this.title != '') {
						if (this.link != '') {
							var l = $(this.link);
							l.html(this.title);
							var p = $('<h2 />');
							p.append(l);
							bbox.append(p);
						} else {
							bbox.append('<h2>' + this.title + '</h2>');
						}
					}
					if (this.body != '') {
						if (this.link != '') {
							var l = $(this.link);
							l.html(this.body);
							var p = $('<p />');
							p.append(l);
							bbox.append(p);
						} else {
							bbox.append('<p>' + this.body + '</p>');
						}
					}
					var bb = $('<div class="inner" />');
					box.append(bbox);
					bb.append(box);
					b.append(bb);
				}
				$('#somexBanners').append(b);
			});
			$('#somexBanners').append('<a class="browse previous" href="javascript:void(0);"></a><a class="browse next" href="javascript:void(0);"></a>');
			$('#somexBanners').cycle({
					slideExpr: '.banner',
					timeout:  8000,
					next: '#somexBanners .browse.next',
					prev: '#somexBanners .browse.previous'
			});
		}
		$(window).resize();
	});
	Drupal.behaviors.jplayerLinks = {
		attach: function(context) {
			$('a.podcast').podcast();
		}
	}
	$.fn.extend({
		linkUrl: function() {
			var returning = [];
			var regexp = /((ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?)/gi;
			this.each(function() {
				returning.push(this.replace(regexp,"<a href=\"$1\" target=\"_blank\">$1</a>"));
			});
			return $(returning);
		},
		linkUser: function() {
			var returning = [];
			var regexp = /[\@]+([A-Za-z0-9-_]+)/gi;
			this.each(function() {
				returning.push(this.replace(regexp,"<a href=\"https://twitter.com/intent/user?screen_name=$1\" target=\"_blank\">@$1</a>"));
			});
			return $(returning);
		},
		linkHash: function(username) {
			var returning = [];
			var regexp = /(?:^| )[\#]+([A-Za-z0-9-_]+)/gi;
			this.each(function() {
				returning.push(this.replace(regexp, ' <a href="http://search.twitter.com/search?q=&tag=$1&lang=all" target=\"_blank\">#$1</a>'));
			});
			return $(returning);
		},
		capAwesome: function() {
			var returning = [];
			this.each(function() {
				returning.push(this.replace(/\b(awesome)\b/gi, '<span class="awesome">$1</span>'));
			});
			return $(returning);
		},
		capEpic: function() {
			var returning = [];
			this.each(function() {
				returning.push(this.replace(/\b(epic)\b/gi, '<span class="epic">$1</span>'));
			});
			return $(returning);
		},
		makeHeart: function() {
			var returning = [];
			this.each(function() {
				returning.push(this.replace(/(&lt;)+[3]/gi, "<tt class='heart'>&#x2665;</tt>"));
			});
			return $(returning);
		}
	});
})(jQuery);
window.fbAsyncInit = function() {
	jQuery('.facebook_participants').each(function() {
		var _s = jQuery(this);
		var fbid = _s.data('fbid');
		FB.api(fbid + '/attending', {
			access_token: '479686105385174|J1CmyICASS3psr3CBd4TmBgpD-0'
		}, jQuery.proxy(function(response) {
			var j = this.find('.content');
			if (response && response.data) {
				for (var i = 0; i < response.data.length; i++) {
					if (i >= 12) break;
					var m = response.data[i];
					j.append('<span class="member"><fb:profile-pic size="square" uid="' + m.id + '" facebook-logo="false" linked="true"></fb:profile-pic></span>');
				}
			}
			j.append('<div><a class="green_button" target="_blank" href="http://facebook.com/events/' + _s.data('fbid') + '">Zu Facebook</a></div>');
			FB.XFBML.parse(j.get(0)); 
		}, _s));
	})
};