<div dir="rtl">
    <style>
        .card {
            width: 600px;
            margin: auto;
            /* margin-top: 100px; */
            padding: 30px;
            border-radius: 15px;
            /* box-shadow: 0 4px 10px rgb(255, 162, 162); */
            border: none;
            animation: colorfulShadow 3s infinite alternate ease-in-out;
        }

        @keyframes colorfulShadow {
            0% {
                box-shadow:
                    0 4px 20px rgba(12, 124, 253, 0.13);
            }

            100% {
                box-shadow:
                    0 4px 20px rgba(0, 89, 255, 0.4);
                /* Green shadow */
            }
        }

        .textarea-container {
            position: relative;

        }

        .textarea-container textarea {
            width: 100%;
            padding-bottom: 60px;
            height: fit-content;
            box-sizing: border-box;
            resize: none;
            overflow: hidden;
        }

        .textarea-container button {
            position: absolute;
            right: 10px;
            bottom: 35px;
            height: 40px;
            width: 80px;
        }
    </style>

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
