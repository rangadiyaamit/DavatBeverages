jQuery(document).ready(() => {
	const a = jQuery(".site-header"),
		  b = () => {
			let b = jQuery(window).scrollTop();
			150 <= b ? !a.hasClass("header-fixed") && a.addClass("header-fixed") : a.hasClass("header-fixed") && a.removeClass("header-fixed")
		  };
	      b();
	jQuery(window).scroll(() => b());
	
	jQuery("#primary-mo-menu li.menu-item-has-children").append("<span class=\"menu-dropdown\"><i class=\"bi bi-caret-down-fill\"></i></span>");
	jQuery("#primary-mo-menu li.menu-item-has-children .sub-menu").slideUp();
	jQuery(".menu-dropdown").on("click", function () {
		jQuery(this).toggleClass("active").parent().find(".sub-menu").first().slideToggle()
	});
	
	jQuery(".site-btn:not(input)").each(function () {
		let b = jQuery(this).text();
		jQuery(this).html(`<span>${b}</span><div class='wave'></div>`)
	});
	
	jQuery(".range_of_products-section").length && (ScrollTrigger.create({
		trigger: ".range_of_products-section",
		onEnter: () => gsap.fromTo(".range-product-shortcode li", { y: 50, opacity: 0 }, { y: 0, opacity: 1, duration: 2, stagger: .1, yoyo: !0, ease: "elastic" })
	}), jQuery(".range-product-shortcode li").mouseenter(function () {
		gsap.fromTo(this, { opacity: .2, y: 20 }, { opacity: 1, y: 0, duration: 1, ease: "liner" })
	}));
	
	const c = jQuery(".product-cat-list input[type=radio]"),
		  d = jQuery(".product-filter-result .product-cat-result");
	
	if (c.length) {
		ScrollTrigger.create({
			trigger: ".is_product",
			onEnter: () => gsap.fromTo(".is_product", { y: 50, opacity: 0 }, { y: 0, opacity: 1, duration: 2, stagger: .1, yoyo: !0, ease: "elastic" })
		});
		
		if( jQuery(window).width() >= 767 ) {
			jQuery(".is_product").hover(function () {
				gsap.fromTo(this, { scale: 1 }, { scale: 1.1, duration: .3, y: -10, zIndex: 1, yoyo: !0 })
			}, function () {
				gsap.fromTo(this, { scale: 1.1 }, { scale: 1, duration: .3, y: 0, zIndex: 0, yoyo: !0 })
			});
		}
		
		c.change(a => {
			let b = a.target,
				c = jQuery(b).val(),
				e = "#" + c;
			if ("all" == c) gsap.timeline().to(d, { display: "block", duration: 0 }).to(jQuery(d).find(".is_product"), { opacity: 1, scale: 1, yoyo: !0, duration: .5, delay: .1 });
			else {
				const a = jQuery(d).not(e),
					  b = a.find(".is_product"),
					  c = jQuery(".product-filter-result").find(e),
					  f = c.find(".is_product");
				      b.length && gsap.timeline().to(b, { opacity: 0, scale: 0, yoyo: !0, duration: .5 }).to(a, { display: "none", duration: 0 }), c.length && gsap.timeline().to(c, { display: "block", duration: 0, delay: .2 }).to(f, { opacity: 1, scale: 1, yoyo: !0, duration: .5, delay: .2 })
			}
		})
	}
	
	let e = jQuery(".banner-slider .owl-banner-slider");
	if (e.length) {
		let b = e.find(".banner-slider-box img"),
			a = () => {
				let c = e.find(".owl-item.active .banner-slider-box"),
					a = c.find(".banner-bg-image"),
					b = c.find(".banner-main-image"),
					d = gsap.timeline();
				d.fromTo(a, { x: 800, opacity: 0 }, { x: 0, opacity: 1, duration: .8 }), b && d.fromTo(b, { opacity: 0, scale: .5 }, { opacity: 1, scale: 1, duration: .8 })
			};
		e.on("initialize.owl.carousel", () => gsap.to(b, { opacity: 0}));
		e.on("initialized.owl.carousel", () => a()), e.on("translate.owl.carousel", () => gsap.to(b, { opacity: 0 }));
		e.on("translated.owl.carousel", () => a()), e.owlCarousel({
			margin: 10,
			nav: !1,
			items: 1,
			loop: !0,
			mouseDrag: !1,
			pullDrag: !1,
			autoplay: !0,
			autoplayTimeout: 4000,
			animateOut: "fadeOut",
			animateIn: "fadeIn"
		})
	}
	
	let f = jQuery(".banner-section.banner-image");
	if (f.length) {
		let a = f.find(".banner-image-box > img");
		gsap.fromTo(a, { x: 800, opacity: 0 }, { x: 0, opacity: 1, duration: .5 });
	}
	
	let g = document.getElementById("productModal");
	if (g) {
		let a = g.querySelector(".product-image"),
			b = g.querySelector(".product-info");
		g.addEventListener("show.bs.modal", function (c) {
			let d = JSON.parse(c.relatedTarget.getAttribute("data-info"));
			if( d ) { 
				d.description = d.description ? d.description : "", 
				jQuery(a).html(`<img src='${d.featured_img}' alt>`), jQuery(b).html(`<div class='product-title'>${d.title}</div>
									  <div class='product-desc'>${d.description}</div>
 									  <div class='product-variation'>
									  	<div class='fw-bold'>Product variation</div>
										${d.variation}
									  </div>`)
			}
		})
	}
	
	var h = document.getElementById("header-mobile-section"),
		i = new bootstrap.Offcanvas(h);
	h.addEventListener("show.bs.offcanvas", function () {
		jQuery("#primary-mo-menu > li > a"), gsap.fromTo(jQuery("#primary-mo-menu > li "), { x: -200, opacity: 0 }, { x: 0, opacity: 1, duration: .8, stagger: .2 })
	});
	
	let news_carousel = jQuery( ".news-carousel" );
	if( news_carousel.length ) {
		news_carousel.owlCarousel({
			margin: 15,
			nav: !1,
			items: 5,
			loop: !0,
			responsive : {
				0 : {
					items: 1,
				},
				578: {
					items: 2,
				},
				768: {
					items: 3,
				},
				991: {
					items: 3,
				},
				1100: {
					items: 3,
				},
				1400: {
					items: 4,
				}
			}
// 			autoplay: !0,
// 			autoplayTimeout: 4000,
// 			animateOut: "fadeOut",
// 			animateIn: "fadeIn"
		})
	}
	
	let chat_icon = jQuery("#chat-popup .chat-icon"), chat_close_icon = jQuery("#chat-popup .close-icon");
	jQuery("#chat-popup").on( "show.bs.dropdown", function(e) {
		chat_icon.hide(), chat_close_icon.show();
	} );
	jQuery("#chat-popup").on( "hide.bs.dropdown", function(e) {
		chat_close_icon.hide(), chat_icon.show();
	} );
});