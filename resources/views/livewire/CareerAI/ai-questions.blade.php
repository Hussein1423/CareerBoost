<div dir="rtl">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card">
            <h6 class="text-muted mb-3">السؤال 1</h6>
            <h5 class="mb-4 fw-bold"><i class="bi bi-stars"></i> كيف تصف مهاراتك في التواصل؟</h5>
            <div class="textarea-container mt-3">
                <textarea class="form-control mb-4" rows="4" placeholder="اكتب إجابتك هنا."></textarea>
                <button class="btn btn-dark">إرسال</button>
            </div>
        </div>
    </div>

    <script>
        const textarea = document.querySelector('.textarea-container textarea');

        textarea.addEventListener('input', function () {
            // Reset the height to auto to recalculate the height
            this.style.height = 'auto';
            // Set the height to the scrollHeight (content height) to make it expand
            this.style.height = this.scrollHeight + 'px';
        });
    </script>
</div>
