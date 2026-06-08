document.addEventListener("DOMContentLoaded", function () {
	const slider = document.getElementById("journeySlider");
	const prevBtn = document.getElementById("journeyPrev");
	const nextBtn = document.getElementById("journeyNext");

	if (slider && prevBtn && nextBtn) {
		if (slider.children.length <= 2) {
			prevBtn.style.display = "none";
			nextBtn.style.display = "none";
			return;
		}

		slider.style.overflowAnchor = "none";
		let isAnimating = false;

		const smoothScrollTo = (amount) => {
			return new Promise((resolve) => {
				slider.scrollBy({
					left: amount,
					behavior: "smooth",
				});

				let scrollTimeout;
				const scrollHandler = () => {
					clearTimeout(scrollTimeout);
					scrollTimeout = setTimeout(() => {
						slider.removeEventListener("scroll", scrollHandler);
						resolve();
					}, 40);
				};
				slider.addEventListener("scroll", scrollHandler);

				setTimeout(() => {
					slider.removeEventListener("scroll", scrollHandler);
					resolve();
				}, 700);
			});
		};

		nextBtn.addEventListener("click", async (e) => {
			e.preventDefault();
			if (isAnimating) return;
			isAnimating = true;

			const firstCard = slider.firstElementChild;
			const cardWidth = firstCard.offsetWidth + 32;

			slider.style.scrollSnapType = "none";
			await smoothScrollTo(cardWidth);

			slider.style.scrollBehavior = "auto";
			slider.appendChild(firstCard);
			slider.scrollLeft -= cardWidth;

			requestAnimationFrame(() => {
				slider.style.scrollSnapType = "x mandatory";
				slider.style.scrollBehavior = "";
				isAnimating = false;
			});
		});

		prevBtn.addEventListener("click", async (e) => {
			e.preventDefault();
			if (isAnimating) return;
			isAnimating = true;

			const lastCard = slider.lastElementChild;
			const cardWidth = lastCard.offsetWidth + 32;

			slider.style.scrollSnapType = "none";
			slider.style.scrollBehavior = "auto";

			slider.prepend(lastCard);
			slider.scrollLeft += cardWidth;

			void slider.offsetWidth;
			await smoothScrollTo(-cardWidth);

			requestAnimationFrame(() => {
				slider.style.scrollSnapType = "x mandatory";
				slider.style.scrollBehavior = "";
				isAnimating = false;
			});
		});
	}
});
