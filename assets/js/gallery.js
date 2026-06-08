document.addEventListener("DOMContentLoaded", function () {
	const luxuryLightbox = GLightbox({
		selector: ".glightbox",
		touchNavigation: true,
		loop: true,
		autoplayVideos: true,
		zoomable: true,
		descPosition: "bottom",
		openEffect: "zoom",
		closeEffect: "fade",
		cssEffects: {
			// Diperbaiki dari cssEfects menjadi cssEffects
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

	// [KUNCI PERBAIKAN 1] - Trigger saat slide terbuka
	luxuryLightbox.on("slide_after_load", (data) => {
		const slide = data.slide; // Fokus pada slide yang sedang aktif

		// Eksekusi Iframe Lazy Load (Ubah data-src menjadi src agar video muncul)
		const iframes = slide.querySelectorAll("iframe.nr-lazy-iframe");
		iframes.forEach((iframe) => {
			const realSrc = iframe.getAttribute("data-src");
			if (realSrc && iframe.getAttribute("src") !== realSrc) {
				iframe.setAttribute("src", realSrc);
			}
		});

		// Autoplay untuk video lokal (MP4)
		const localVideos = slide.querySelectorAll("video");
		localVideos.forEach((vid) => {
			vid.play().catch((e) => console.log("Autoplay tertahan browser"));
		});

		// Inject Script TikTok Dinamis
		if (
			slide.querySelector(".tiktok-embed") ||
			slide.innerHTML.includes("tiktok.com")
		) {
			const oldScript = document.getElementById("tiktok-script-dinamis");
			if (oldScript) oldScript.remove();

			const script = document.createElement("script");
			script.id = "tiktok-script-dinamis";
			script.src = "https://www.tiktok.com/embed.js";
			script.async = true;
			document.body.appendChild(script);
		}
	});

	// [KUNCI PERBAIKAN 2] - Hentikan audio saat slide ditutup dengan aman
	luxuryLightbox.on("slide_before_close", (data) => {
		const slide = data.slide;

		// Matikan Iframe seketika dengan mengosongkan 'src'
		const iframes = slide.querySelectorAll("iframe.nr-lazy-iframe");
		iframes.forEach((iframe) => {
			iframe.removeAttribute("src");
		});

		// Matikan Video MP4 Lokal
		const localVideos = slide.querySelectorAll("video");
		localVideos.forEach((vid) => {
			vid.pause();
			vid.currentTime = 0;
		});
	});

	// Logika Tab Filter
	const filterTabs = document.querySelectorAll(".filter-tab");
	const masonryItems = document.querySelectorAll(".luxury-item");

	filterTabs.forEach((tab) => {
		tab.addEventListener("click", function () {
			filterTabs.forEach((t) => t.classList.remove("active"));
			this.classList.add("active");

			const filterValue = this.getAttribute("data-filter");

			masonryItems.forEach((item) => {
				if (
					filterValue === "all" ||
					item.getAttribute("data-category") === filterValue
				) {
					item.style.display = "block";
					item.style.animation = "fadeUp 0.5s ease forwards";
				} else {
					item.style.display = "none";
				}
			});
		});
	});
});
