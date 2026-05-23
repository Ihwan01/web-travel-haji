<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        gsap.fromTo(".welcome-card", {
            y: 30,
            opacity: 0
        }, {
            y: 0,
            opacity: 1,
            duration: 1.2,
            ease: "power3.out",
            delay: 0.1
        });
    });
</script>
</body>

</html>