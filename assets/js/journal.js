/* ═══════════════════════════════════════════════════════
   NUANSA RINDU — journal.js
   ═══════════════════════════════════════════════════════ */

document.addEventListener("DOMContentLoaded", function () {
	const categorySelect = document.getElementById("mobileCategorySelect");

	if (categorySelect) {
		// Mendengarkan perubahan pada dropdown
		categorySelect.addEventListener("change", function () {
			const targetUrl = this.value;

			if (targetUrl) {
				// Mengarahkan (redirect) pengguna ke URL yang dipilih
				window.location.href = targetUrl;
			}
		});
	}
});
