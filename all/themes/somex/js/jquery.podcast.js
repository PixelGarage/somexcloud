(function($) {
	// constructor
	$.currentPodcastID = 0;
	function Podcast(root) {
		// current instance
		var self = this;
		root.hide();
		$.currentPodcastID++;
		var container = $('<div class="jp-audio" />');
		container.attr('id', 'jp_container_' + $.currentPodcastID);
		container.append('<div class="jp-type-single">' +
			'<div class="jp-gui jp-interface">' +
				'<ul class="jp-controls">' +
					'<li><a href="javascript:void(0);" class="jp-play" tabindex="1">play</a></li>' +
					'<li><a href="javascript:void(0);" class="jp-pause" tabindex="1">pause</a></li>' +
/*
					'<li><a href="javascript:void(0);" class="jp-next" tabindex="1">play</a></li>' +
					'<li><a href="javascript:void(0);" class="jp-previous" tabindex="1">pause</a></li>' +
*/
				'</ul>' +
				'<div class="jp-progress">' +
					'<div class="jp-seek-bar"><div class="jp-play-bar"></div></div>' +
				'</div>' +
			'</div>' +
		'</div>');
		root.after(container);
		var player = $('<div class="jp-player" />');
		player.attr('id', 'jquery_jplayer_' + $.currentPodcastID);
		root.after(player);
		$('#jquery_jplayer_' + $.currentPodcastID).jPlayer({
			ready: function (event) {
				$(this).jPlayer("setMedia", {
					mp3:root.attr('href')
				});
			},
			play: function() { // To avoid both jPlayers playing together.
				$(this).jPlayer("pauseOthers");
			},
			swfPath: Drupal.settings.basePath + 'sites/all/themes/somex/js',
			supplied: 'mp3',
			wmode: 'window',
			cssSelectorAncestor: '#jp_container_' + $.currentPodcastID,
			loop: true
		});
	}
	// jQuery plugin implementation
	$.fn.podcast = function(conf) { 
		// already constructed --> return API
		var el = this.data("podcast");
		if (el) { return el; }		 
		this.each(function() {			
			el = new Podcast($(this));
			$(this).data("podcast", el);	
		});
		return this;
	};
})(jQuery);