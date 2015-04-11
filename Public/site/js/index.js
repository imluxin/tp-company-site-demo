var Page = {
	init: function() {
		var a = this;
		a.adjustSize();
		a.bindEvent();
		a.bindNav();
		a.bindQQOnline();
		a.bindScroll();
		a.scrollPage();
		a.bindItem1();
		a.bindFeatureList();
		a.bindAgencyList();
		$(".nav.nav_1").click()
	},
	bindQQOnline: function() {
		jQuery.fn.isChildAndSelfOf = function(a) {
			return (this.closest(a).length > 0)
		};
		jQuery.fn.isChildOf = function(a) {
			return (this.parents(a).length > 0)
		}
	},
	bindEvent: function() {
		var a = this;
		$(window).resize(function() {
			var b = $(window);
			setTimeout(function() {
				a.adjustSize()
			},
			300)
		}).resize()
	},
	bindItem1: function() {
		var e = this;
		var c = Math.ceil(Math.random() * 6);
		$(".btn_wrap .review").click(function() {
			$(".navwrap .nav[inx=2]").click()
		});
	},
	bindFeatureList: function() {
		$(".feature_list li.feature").hover(function() {
			var b = $(this).closest(".feature_list");
			var a = b.prev();
			var c = $(this).offset().left - a.offset().left + ($(this).width() - 35) / 2;
			var d = b.find(".feature").index($(this));
			$(".arrow", a).css({
				left: c
			});
			$(".feature_item", a).css("display", "none");
			$(".feature_item", a).eq(d).css("display", "block");
			$(".qrcode", a).show()
		})
	},
	bindAgencyList: function() {
		$(".item_5 .feature_list li.feature").hover(function() {
			var b = $(this).closest(".feature_list");
			var a = b.prev();
			var c = $(this).offset().left - a.offset().left + ($(this).width() - 35) / 2;
			var d = b.find(".feature").index($(this));
			$(".arrow", a).css({
				left: c
			});
		},
		function() {
			var b = $(this).closest(".feature_list");
			var a = b.prev();
			$(".arrow", a).css({
				left: "-10000px"
			});
		})
	},
	adjustSize: function() {
		var d = this;
		var a = d.getClientHeight();
		$(".main .item").css({
			height: a
		});
		if ($(window).scrollTop() == 0 && $(".m-login").height() != 0) {
			var b = a / 2 + 20 + "px";
			$(".m-login").animate({
				height: b
			},
			600);
		}
	},
	getClientHeight: function() {
		return document.documentElement.clientHeight
	},
	bindNav: function() {
		var a = this;
		$(".nav").click(function() {
			var d = $(this).attr("inx") - 1;
			if (d == 0) {
				$(".navwrap").fadeOut();
			} else {
				$(".navwrap").fadeIn();
				var b = $(".main .item").eq(d);
				if (b.find("img[data-original]").size() > 0) {
					b.find("img[data-original]").each(function() {
						var e = $(this);
						e.attr("src", e.attr("data-original")).removeAttr("data-original")
					})
				}
			}
			var c = d * a.getClientHeight();
			$("html,body").animate({
				scrollTop: c
			})
		});
		$(".nav").tipsy({
			delayIn: 100,
			delayOut: 100,
			gravity: "e"
		});
	},
	scrollPage: function() {
		var a = this;
		a.lastAnimation = 0;
		$(document).bind("mousewheel DOMMouseScroll",
		function(e) {
			e.preventDefault();
			var g = e.originalEvent.wheelDelta || -e.originalEvent.detail;
			var f = $(".nav.cur");
			var c = new Date().valueOf();
			if (!a.isScroll && c - a.lastAnimation > 400) {
				if (g < 0) {
					f = f.next().attr("inx") - 1
				} else {
					f = f.prev().attr("inx") - 1
				}
				if (isNaN(f)) {
					return
				}
				if (f == 0) {
					$(".navwrap").fadeOut();
				} else {
					$(".navwrap").fadeIn();
					var b = $(".main .item").eq(f);
					if (b.find("img[data-original]").size() > 0) {
						b.find("img[data-original]").each(function() {
							var h = $(this);
							h.attr("src", h.attr("data-original")).removeAttr("data-original")
						})
					}
				}
				a.isScroll = true;
				var d = f * a.getClientHeight();
				$("html,body").animate({
					scrollTop: d
				},
				500,
				function() {
					a.isScroll = false;
					a.lastAnimation = new Date().valueOf()
				})
			}
			return false
		})
	},
	bindScroll: function() {
		var a = this;
		a.isFlip = false;
		$(window).scroll(function() {
			var b = $(window).scrollTop();
			var c = Math.floor((b / a.getClientHeight())) + 1;
			c = c || 1;
			if (c < 8) {
				$(".nav").removeClass("cur");
				$(".nav[inx=" + c + "]").addClass("cur")
			}
			var d = Math.floor((b / a.getClientHeight())) + 1;
			d = d || 1;
			if (d < 8) {
                toinx = $(this).attr('toinx');
				$(".fp-item").removeClass("active");
                $(".fp-item[toinx=" + c + "]").addClass("active");
                $(".fp-item").show()
			};
			height = $(window).scrollTop();
		    if(height > 300){
		      $('.yunmai-header').fadeIn();
		    }else{
		      $('.yunmai-header').fadeOut();
		    }; 
			// if (d > 1) {
			// 	$('#ymtop').show();
			// } else if (d = 1) {
			// 	$('#ymtop').hide();
			// }
		});
	},
};
$(function() {
	Page.init()
});
