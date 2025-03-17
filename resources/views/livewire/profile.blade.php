<style>
    .btn-primary {
        background-color: #1b355c;
        border-color: #1b355c;
    }

    .navbar-brand {
        font-size: 1.5rem;
        font-weight: bold;
        font-style: oblique;
        color: #1b355c;
    }

    .navbar-brand img {
        margin-right: -40px;
    }

    footer {
        padding: 10px 0;
        text-align: center;
        width: 100%;
    }

    .form-container {
        background-color: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 700px;
        margin: 40px auto;
        /* 'mt-5' equivalent in Bootstrap */
    }

    .text-danger {
        color: #dc3545;
        /* or any color you prefer for errors */
        margin-top: 5px;
        font-size: 0.9rem;
    }
</style>

<div x-data="jobDesc()" class="min-h-screen flex flex-col justify-between">
    <!-- Page Content -->
    <div class="form-container">
        <h3 class="text-end mb-4">ارفع سيرتك الذاتية وأدخل المسمى الوظيفي</h3>

        <!-- Use Alpine bindings and events -->
        <form @submit.prevent="saveData">
            <!-- CV File -->
            <div class="mb-3">
                <label class="form-label">ارفع سيرتك الذاتية (PDF أو DOCX):</label>
                <input type="file" class="form-control" title="ارفع سيرتك الذاتية" @change="validateFile">
                <div x-text="errors.cv" class="text-danger"></div>
            </div>

            <!-- Job Title -->
            <div class="mb-3">
                <label class="form-label">المسمى الوظيفي المطلوب:</label>
                <input type="text" class="form-control" placeholder="مثلاً: مهندس برمجيات" x-model="jobTitle">
                <div x-text="errors.title" class="text-danger"></div>
            </div>

            <!-- Job Description (Generated) -->
            <div class="mb-4">
                <label class="form-label">وصف الوظيفة:</label>
                <textarea class="form-control" rows="4" placeholder="مثلاً: مسؤول عن تطوير التطبيقات البرمجية"
                    x-model="jobDescription"></textarea>
                <div x-text="errors.desc" class="text-danger"></div>
            </div>

            <!-- Generate Description Button -->

            <!-- Submit (Save) Button -->
            <button type="submit" class="btn btn-primary w-100">
                الانتقال إلى الخطوة التالية
            </button>
        </form>
    </div>

    <!-- Footer -->
    <footer class="footer bg-dark text-light mt-auto">
        <div class="container-fluid">
            <p>© 2025 Falcons. جميع الحقوق محفوظة.</p>
            <p>صُمم لمساعدتك على النجاح في حياتك المهنية.</p>
        </div>
    </footer>
</div>
