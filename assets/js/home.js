document.addEventListener("DOMContentLoaded", function () {
	const sliderContainer = document.getElementById("homeHero");
	const slides = document.querySelectorAll(".custom-slide");
	const currSlideText = document.getElementById("currSlide");
	const totalSlideText = document.getElementById("totalSlide");

	let currentSlide = 0;
	let slideInterval;

	function showSlide(index) {
		slides.forEach((s) => s.classList.remove("active"));
		slides[index].classList.add("active");
		currentSlide = index;

		if (currSlideText) {
			currSlideText.innerText = "0" + (index + 1);
		}
	}

	function nextSlide() {
		let next = (currentSlide + 1) % slides.length;
		showSlide(next);
	}

	function prevSlide() {
		let prev = (currentSlide - 1 + slides.length) % slides.length;
		showSlide(prev);
	}

	function startSlideShow() {
		slideInterval = setInterval(nextSlide, 8000);
	}

	function resetSlideShow() {
		clearInterval(slideInterval);
		startSlideShow();
	}

	if (currSlideText && totalSlideText) {
		currSlideText.addEventListener("click", function () {
			prevSlide();
			resetSlideShow();
		});

		totalSlideText.addEventListener("click", function () {
			nextSlide();
			resetSlideShow();
		});
	}

	let touchStartX = 0;
	let touchEndX = 0;

	sliderContainer.addEventListener(
		"touchstart",
		(e) => {
			touchStartX = e.changedTouches[0].screenX;
		},
		{
			passive: true,
		},
	);

	sliderContainer.addEventListener(
		"touchend",
		(e) => {
			touchEndX = e.changedTouches[0].screenX;
			handleSwipe();
		},
		{
			passive: true,
		},
	);

	function handleSwipe() {
		const swipeThreshold = 50;
		if (touchEndX < touchStartX - swipeThreshold) {
			nextSlide();
			resetSlideShow();
		}
		if (touchEndX > touchStartX + swipeThreshold) {
			prevSlide();
			resetSlideShow();
		}
	}

	startSlideShow();
});

document.addEventListener("DOMContentLoaded", function () {
	const slider = document.getElementById("journeySlider");
	const prevBtn = document.getElementById("journeyPrev");
	const nextBtn = document.getElementById("journeyNext");

	if (slider && prevBtn && nextBtn) {
		slider.style.overflowAnchor = "none";
		let isAnimating = false;

		nextBtn.addEventListener("click", (e) => {
			e.preventDefault();
			if (isAnimating || slider.scrollWidth <= slider.clientWidth + 10) return;
			isAnimating = true;

			const firstCard = slider.firstElementChild;
			const cardWidth = firstCard.offsetWidth + 3;

			slider.scrollBy({
				left: cardWidth,
				behavior: "smooth",
			});

			setTimeout(() => {
				slider.appendChild(firstCard);
				slider.scrollLeft -= cardWidth;
				isAnimating = false;
			}, 450);
		});

		prevBtn.addEventListener("click", (e) => {
			e.preventDefault();
			if (isAnimating || slider.scrollWidth <= slider.clientWidth + 10) return;
			isAnimating = true;

			const lastCard = slider.lastElementChild;
			const firstCard = slider.firstElementChild;
			const cardWidth = firstCard.offsetWidth + 3;

			slider.prepend(lastCard);
			slider.scrollLeft += cardWidth;
			slider.getBoundingClientRect();

			slider.scrollBy({
				left: -cardWidth,
				behavior: "smooth",
			});

			setTimeout(() => {
				isAnimating = false;
			}, 450);
		});
	}
});
document.addEventListener("DOMContentLoaded", function () {
	if (typeof GLightbox !== "undefined") {
		const homeLightbox = GLightbox({
			selector: ".glightbox",
			touchNavigation: true,
			loop: true,
			autoplayVideos: true,
			zoomable: true,
			preload: false,
			descPosition: "bottom",
			openEffect: "zoom",
			closeEffect: "fade",
			cssEffects: {
				fade: {
					in: "fadeIn",
					out: "fadeOut",
				},
				zoom: {
					in: "zoomIn",
					out: "zoomOut",
				},
			},
		});

		function playSlideVideo(slideNode) {
			if (!slideNode) return;
			const iframes = slideNode.querySelectorAll("iframe.nr-lazy-iframe");
			iframes.forEach((iframe) => {
				const realSrc = iframe.getAttribute("data-src");
				if (realSrc && iframe.getAttribute("src") !== realSrc) {
					iframe.setAttribute("src", realSrc);
				}
			});

			const localVideos = slideNode.querySelectorAll("video");
			localVideos.forEach((vid) => {
				vid.play().catch((e) => console.log("Autoplay tertahan browser"));
			});

			if (
				slideNode.querySelector(".tiktok-embed") ||
				slideNode.innerHTML.includes("tiktok.com")
			) {
				const oldScript = document.getElementById("tiktok-script-dinamis");
				if (oldScript) oldScript.remove();

				const script = document.createElement("script");
				script.id = "tiktok-script-dinamis";
				script.src = "https://www.tiktok.com/embed.js";
				script.async = true;
				document.body.appendChild(script);
			}
		}

		function stopSlideVideo(slideNode) {
			if (!slideNode) return;
			const iframes = slideNode.querySelectorAll("iframe.nr-lazy-iframe");
			iframes.forEach((iframe) => {
				iframe.removeAttribute("src");
			});

			const localVideos = slideNode.querySelectorAll("video");
			localVideos.forEach((vid) => {
				vid.pause();
				vid.currentTime = 0;
			});
		}

		homeLightbox.on("slide_after_load", (data) => {
			const slide = data.slideNode || data.slide;
			if (slide && slide.classList.contains("current")) {
				playSlideVideo(slide);
			}
		});

		homeLightbox.on("slide_changed", ({ prev, current }) => {
			if (prev) {
				const prevSlide = prev.slideNode || prev.slide;
				stopSlideVideo(prevSlide);
			}
			if (current) {
				const currentSlide = current.slideNode || current.slide;
				playSlideVideo(currentSlide);
			}
		});

		homeLightbox.on("slide_before_close", (data) => {
			const slide = data.slideNode || data.slide;
			stopSlideVideo(slide);
		});
	}
});
