/* ═══════════════════════════════════════════════════════
   NUANSA RINDU — fashion.js
   ═══════════════════════════════════════════════════════ */

document.addEventListener("DOMContentLoaded", function () {
	const slider = document.getElementById("essSlider");
	const prevBtn = document.getElementById("essPrev");
	const nextBtn = document.getElementById("essNext");

	if (slider && prevBtn && nextBtn) {
		// Mengunci jangkar rotasi agar tidak lompat saat manipulasi elemen DOM
		slider.style.overflowAnchor = "none";
		let isAnimating = false;

		// --- Logika Infinite Loop Tombol Kanan ---
		nextBtn.addEventListener("click", (e) => {
			e.preventDefault();
			if (isAnimating || slider.scrollWidth <= slider.clientWidth + 10) return;
			isAnimating = true;

			const firstCard = slider.firstElementChild;
			const cardWidth = firstCard.offsetWidth + 4; // +4px untuk gap grid

			// Geser perlahan secara visual
			slider.scrollBy({ left: cardWidth, behavior: "smooth" });

			// Setelah geser selesai, potong elemen pertama dan pindahkan ke ekor (loop)
			setTimeout(() => {
				slider.appendChild(firstCard);
				slider.scrollLeft -= cardWidth;
				isAnimating = false;
			}, 450);
		});

		// --- Logika Infinite Loop Tombol Kiri ---
		prevBtn.addEventListener("click", (e) => {
			e.preventDefault();
			if (isAnimating || slider.scrollWidth <= slider.clientWidth + 10) return;
			isAnimating = true;

			const lastCard = slider.lastElementChild;
			const firstCard = slider.firstElementChild;
			const cardWidth = firstCard.offsetWidth + 4;

			// Potong elemen terakhir dan pindahkan ke depan secara instan
			slider.prepend(lastCard);
			slider.scrollLeft += cardWidth;
			slider.getBoundingClientRect(); // Paksa browser membaca reflow DOM

			// Tarik perlahan layarnya memperlihatkan elemen yang baru dipindah
			slider.scrollBy({ left: -cardWidth, behavior: "smooth" });

			setTimeout(() => {
				isAnimating = false;
			}, 450);
		});

		// --- Logika Drag Mouse Tambahan (Mendukung Swipe Layar Desktop) ---
		let isDown = false;
		let startX;
		let scrollLeft;

		slider.addEventListener("mousedown", (e) => {
			isDown = true;
			slider.style.scrollBehavior = "auto"; // Nonaktifkan animasi licin saat ditarik manual
			slider.style.cursor = "grabbing";
			startX = e.pageX - slider.offsetLeft;
			scrollLeft = slider.scrollLeft;
		});

		slider.addEventListener("mouseleave", () => {
			isDown = false;
			slider.style.scrollBehavior = "smooth";
			slider.style.cursor = "grab";
		});

		slider.addEventListener("mouseup", () => {
			isDown = false;
			slider.style.scrollBehavior = "smooth";
			slider.style.cursor = "grab";
		});

		slider.addEventListener("mousemove", (e) => {
			if (!isDown) return;
			e.preventDefault();
			const x = e.pageX - slider.offsetLeft;
			const walk = (x - startX) * 2; // Pengali sensitivitas geseran mouse
			slider.scrollLeft = scrollLeft - walk;
		});
	}
});
