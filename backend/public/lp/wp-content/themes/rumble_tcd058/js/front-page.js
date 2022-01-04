jQuery(function($){
	var ytPlayers = {};

	/**
	 * 初期化処理
	 */
	$(document).on('js-initialized', function(){
		var is_responsive = $('body').hasClass('is-responsive');

		// ヘッダースライダー
		if ($('#js-index-slider').length) {
			var $slider = $('#js-index-slider');
			var $slides = $('#js-index-slider .p-index-slider__item');
			var division = parseInt($slider.attr('data-division') || 3, 10);

			// YouTube IFrame Player API script load
			if ($slider.find('.p-index-slider__item-youtube').length) {
				if (!$('script[src*="//www.youtube.com/iframe_api"]').length) {
					var tag = document.createElement('script');
					tag.src = 'https://www.youtube.com/iframe_api';
					var firstScriptTag = document.getElementsByTagName('script')[0];
					firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
				}

				// Resize event
				$(window).on('resize', function(){
					resizeYoutubePlayer($slider.find('.p-index-slider__item-youtube.youtube-initialized'));
				});
			}

			var slick_args = {
				infinite: true,
				dots: false,
				arrows: true,
				prevArrow: '<button type="button" class="slick-prev">&#xe90f;</button>',
				nextArrow: '<button type="button" class="slick-next">&#xe910;</button>',
				slidesToShow: division,
				slidesToScroll: division,
				adaptiveHeight: true,
				autoplay: true,
				speed: 1000,
				autoplaySpeed: $('#js-index-slider').attr('data-slide-time') || 7000
			};

			if (division === 1) {
				slick_args.fade = true;
			}

			if (is_responsive) {
				slick_args.responsive = [
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
				];
			}

			// slick化
			$slider.slick(slick_args);

			// スライド1枚目処理
			var $firstSlide = $slides.first();

			if ($firstSlide.find('video').length) {
				var video = $firstSlide.find('video').get(0);
				$slider.slick('slickPause');
				video.play();
				video.onended = function() {
					$slider.slick('slickNext').slick('slickPlay');
				};
			}

			if (!$firstSlide.find('.p-index-slider__item-youtube').length) {
				$slides.filter('.slick-active').addClass('is-active');
			}

			// beforeChange
			$slider.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
				$slides.filter('.is-active').removeClass('is-active');

				if ($slides.eq(currentSlide).find('video').length) {
					$slides.eq(currentSlide).find('video').get(0).pause();
				} else if ($slides.eq(currentSlide).find('.p-index-slider__item-youtube').length) {
					var ytPlayerId = $slides.eq(currentSlide).find('.p-index-slider__item-youtube').attr('id');
					if (ytPlayerId && ytPlayers[ytPlayerId]) {
						ytPlayers[ytPlayerId].pauseVideo();
					}
				}

				if ($slides.eq(nextSlide).find('video').length) {
					var video = $slides.eq(nextSlide).find('video').get(0);
					video.play();
				} else if ($slides.eq(nextSlide).find('.p-index-slider__item-youtube').length) {
					var ytPlayerId = $slides.eq(nextSlide).find('.p-index-slider__item-youtube').attr('id');
					if (ytPlayerId && ytPlayers[ytPlayerId]) {
						ytPlayers[ytPlayerId].playVideo();
					}
				}
			});

			// afterChange
			$slider.on('afterChange', function(event, slick, currentSlide) {
				var is_active = false;
				if ($slides.eq(currentSlide).find('.p-index-slider__item-video').length) {
					is_active = true;
					var video = $slides.eq(currentSlide).find('.p-index-slider__item-video').get(0);
					$slider.slick('slickPause');
					video.onended = function() {
						$slider.slick('slickNext').slick('slickPlay');
					};
				} else if ($slides.eq(currentSlide).find('.p-index-slider__item-youtube').length) {
					var ytPlayerId = $slides.eq(currentSlide).find('.p-index-slider__item-youtube').attr('id');
					if (ytPlayerId && ytPlayers[ytPlayerId]) {
						is_active = true;
					}
				} else {
					is_active = true;
				}

				if (is_active) {
					$slides.filter('.slick-active').addClass('is-active');
				}
			});

			// click to mute or unmute
			var ismuted = false;
			$('.p-index-slider--type2, .p-index-slider--type3').on('click', function(e){
				if ($(e.target).is('a, input, button')) return;

				$slider.find('video').each(function(){
					var video = $(this).get(0);
					if (ismuted) {
						video.muted = false;
					} else {
						video.muted = true;
					}
				});

				if (ytPlayers) {
					for (var ytPlayerId in ytPlayers) {
						if (ismuted) {
							ytPlayers[ytPlayerId].unMute();
						} else {
							ytPlayers[ytPlayerId].mute();
						}
					}
				}

				if (ismuted) {
					ismuted = false;
				} else {
					ismuted = true;
				}
			});
		}

		// ヘッダーカルーセル
		if ($('#js-index-carousel').length) {
			var slick_args = {
				infinite: true,
				dots: false,
				arrows: true,
				prevArrow: '<button type="button" class="slick-prev">&#xe90f;</button>',
				nextArrow: '<button type="button" class="slick-next">&#xe910;</button>',
				slidesToShow: 3,
				slidesToScroll: 3,
				adaptiveHeight: true,
				autoplay: true,
				speed: 1000,
				autoplaySpeed: $('#js-index-carousel').attr('data-slide-time') || 7000
			};

			if (is_responsive) {
				slick_args.responsive = [
					{
						breakpoint: 992,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 768,
						settings: {
							arrows: false,
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
				];
			}

			$('#js-index-carousel').slick(slick_args);
		}
	});

	// YouTube IFrame Player API Ready
	window.onYouTubeIframeAPIReady = function() {
		// Initialize Youtube players
		$('#js-index-slider .p-index-slider__item-youtube').each(function(){
			var $slider = $('#js-index-slider'),
				ytPlayerId = jQuery(this).attr('id');
			if (!ytPlayerId) return;
			var player = new YT.Player(ytPlayerId, {
				events: {
					onReady: function(e) {
						$('#'+ytPlayerId).addClass('youtube-initialized');
						resizeYoutubePlayer($('#'+ytPlayerId));
						ytPlayers[ytPlayerId] = player;
						if ($('#'+ytPlayerId).closest('.p-index-slider__item').hasClass('slick-current')) {
							$('#'+ytPlayerId).closest('.p-index-slider__item').addClass('is-active');
							ytPlayers[ytPlayerId].playVideo();
						}
						if ($('#'+ytPlayerId).closest('.p-index-slider__item').is(':first-child')) {
							$('#'+ytPlayerId).delay(100).animate({ opacity: 1 }, 200);
						}
					},
					onStateChange: function(e) {
						if (e.data === 1) { // start
							$slider.slick('slickPause');
						} else if (e.data === 0) { // end
							$slider.slick('slickNext').slick('slickPlay');
						}
					}
				}
			});
		});
	};

	// Resize youtube player
	function resizeYoutubePlayer(elems, ratio) {
		if (!elems) return;
		if (!ratio) ratio = 16 / 9;
		$(elems).each(function(){
			var $this = $(this),
				width = $this.closest('.p-index-slider__item').innerWidth(),
				height = $this.closest('.p-index-slider__item').innerHeight();
			if (width / ratio < height) {
				var playerWidth = Math.ceil(height * ratio);
				$this.width(playerWidth).height(height).css({
					left: (width - playerWidth) / 2,
					top: 0
				});
			} else {
				var playerHeight = Math.ceil(width / ratio);
				$this.width(width).height(playerHeight).css({
					left: 0,
					top: (height - playerHeight) / 2
				});
			}
		});
	}
});
