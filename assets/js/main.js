/* ═══════════════════════════════════════════════════════
   NUANSA RINDU — main.js
   ═══════════════════════════════════════════════════════ */

document.addEventListener("DOMContentLoaded", function () {
	// ── Navbar scroll effect ─────────────────────────────
	const navbar = document.getElementById("navbar");
	window.addEventListener("scroll", function () {
		if (window.scrollY > 40) {
			navbar.classList.add("scrolled");
		} else {
			navbar.classList.remove("scrolled");
		}
	});

	// ── Mobile hamburger ─────────────────────────────────
	const toggle = document.getElementById("navToggle");
	const navList = document.querySelector(".nav-links");
	if (toggle && navList) {
		toggle.addEventListener("click", function () {
			navList.classList.toggle("open");
		});
	}

	// ── Scroll reveal ─────────────────────────────────────
	const reveals = document.querySelectorAll(".reveal");
	if (reveals.length) {
		const observer = new IntersectionObserver(
			function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						entry.target.classList.add("visible");
					}
				});
			},
			{ threshold: 0.1 },
		);
		reveals.forEach(function (el) {
			observer.observe(el);
		});
	}

	// ── Hero video autoplay fallback ──────────────────────
	const heroVideo = document.getElementById("heroVideo");
	if (heroVideo) {
		heroVideo.play().catch(function () {
			// autoplay blocked, show poster instead
			heroVideo.style.display = "none";
		});
	}

	// ── Hero dots cycling ─────────────────────────────────
	const dots = document.querySelectorAll(".hero-dot");
	if (dots.length) {
		let current = 0;
		setInterval(function () {
			dots[current].classList.remove("active");
			current = (current + 1) % dots.length;
			dots[current].classList.add("active");
		}, 3200);
	}

	// ── Lightbox for gallery & YouTube ────────────────────
	const galleryItems = document.querySelectorAll("[data-lightbox]");
	if (galleryItems.length) {
		// Create overlay
		const overlay = document.createElement("div");
		overlay.id = "lightbox-overlay";
		overlay.innerHTML =
			'<div class="lb-inner"><button class="lb-close">&times;</button><div class="lb-content"></div></div>';
		document.body.appendChild(overlay);

		const lbContent = overlay.querySelector(".lb-content");
		const lbClose = overlay.querySelector(".lb-close");

		galleryItems.forEach(function (item) {
			item.addEventListener("click", function () {
				const type = item.getAttribute("data-type");
				const src = item.getAttribute("data-src");
				lbContent.innerHTML = "";

				if (type === "Video") {
					// Logika Cerdas: Cek apakah ini video dari YouTube
					if (src.includes("youtube.com") || src.includes("youtu.be")) {
						let videoId = "";
						// Ekstrak Video ID menggunakan RegExp agar link format apapun bisa terbaca
						const regExp =
							/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
						const match = src.match(regExp);

						if (match && match[2].length === 11) {
							videoId = match[2];
						}

						// Rakit menjadi tautan Embed yang valid dan siap Auto-Play
						const finalEmbedUrl = videoId
							? "https://www.youtube.com/embed/" + videoId + "?autoplay=1"
							: src;

						lbContent.innerHTML =
							'<iframe src="' +
							finalEmbedUrl +
							'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width: 85vw; height: 80vh; max-width: 900px; max-height: 506px; background: #000; display: block;"></iframe>';
					} else {
						// Jika Video MP4 Lokal Biasa
						lbContent.innerHTML =
							'<video src="' +
							src +
							'" controls autoplay style="max-width:100%;max-height:80vh;"></video>';
					}
				} else {
					// Jika Foto/Gambar
					lbContent.innerHTML =
						'<img src="' +
						src +
						'" alt="" style="max-width:100%;max-height:85vh;object-fit:contain;">';
				}

				overlay.classList.add("active");
				document.body.style.overflow = "hidden";
			});
		});

		lbClose.addEventListener("click", closeLightbox);
		overlay.addEventListener("click", function (e) {
			if (e.target === overlay) closeLightbox();
		});

		function closeLightbox() {
			overlay.classList.remove("active");
			lbContent.innerHTML = ""; // Menghapus isi untuk mematikan video/iframe
			document.body.style.overflow = "";
		}
	}
});
