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

<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<script>
    if (document.querySelector('#itinerary')) {
        ClassicEditor.create(document.querySelector('#itinerary'));
    }
    if (document.querySelector('#hotel_details')) {
        ClassicEditor.create(document.querySelector('#hotel_details'));
    }
</script>
</body>

</html>