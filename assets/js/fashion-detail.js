/* ═══════════════════════════════════════════════════════
   NUANSA RINDU — fashion-detail.js
   ═══════════════════════════════════════════════════════ */

document.addEventListener("DOMContentLoaded", function () {
	// Inisialisasi Zoom Gambar Editorial
	if (typeof GLightbox !== "undefined") {
		GLightbox({
			selector: ".glightbox",
			openEffect: "zoom",
			closeEffect: "fade",
		});
	}
});
