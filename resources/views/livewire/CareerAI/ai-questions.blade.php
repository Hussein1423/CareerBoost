@push('cssContent')
    <link rel="stylesheet" href="{{asset('careerAI-css/AI-questions.css')}}">
@endpush

<div style="margin-top: 100px">
    <div class="card p-4 my-3" style="width: 100%; max-width: 600px;">
        <h6 class="text-muted mb-3">السؤال <span id="question-number">1</span></h6>
        <h5 class="mb-4 fw-bold"><i class="bi bi-stars"></i> <span id="question-text">كيف تصف مهاراتك في التواصل؟</span>
        </h5>
        <div class="textarea-container mt-3" x-data="{ answer: '' }">
            <form action="">
                @csrf
                <textarea id="answer" class="form-control mb-4" rows="4" placeholder="اكتب إجابتك هنا."
                    x-model="answer"></textarea>
                <button type="submit" class="btn btn-dark" id="submit-button"
                    x-bind:disabled="answer.trim() === ''">إرسال</button>
            </form>
        </div>
    </div>
</div>

<script>
    // قراءة البيانات من sessionStorage
    const questionsData = JSON.parse(sessionStorage.getItem('questions'));

    // دمج الأسئلة من tech و soft في قائمة واحدة
    let allQuestions = [];
    if (questionsData) {
        if (questionsData.tech) allQuestions = allQuestions.concat(questionsData.tech);
        if (questionsData.soft) allQuestions = allQuestions.concat(questionsData.soft);
    }

    let currentQuestionIndex = 0; // الفهرس الحالي للسؤال

    // مصفوفة لتخزين الأسئلة والإجابات
    let answers = JSON.parse(sessionStorage.getItem('answers')) || [];

    // عرض السؤال الأول عند تحميل الصفحة
    function displayCurrentQuestion() {
        if (currentQuestionIndex < allQuestions.length) {
            document.getElementById('question-number').innerText = currentQuestionIndex + 1;
            document.getElementById('question-text').innerText = allQuestions[currentQuestionIndex].text;
        } else {
            // إذا انتهت الأسئلة، يمكن إظهار رسالة أو إجراء آخر
            document.getElementById('submit-button').disabled = true;
            document.getElementById('answer').value = ''; // مسح محتوى الـ textarea
        }
    }

    // عرض السؤال الأول عند تحميل الصفحة
    displayCurrentQuestion();

    // الانتقال إلى السؤال التالي عند النقر على "إرسال"
    document.getElementById('submit-button').addEventListener('click', function () {
        // حفظ الإجابة الحالية في المصفوفة
        const currentAnswer = document.getElementById('answer').value;
        if (currentQuestionIndex < allQuestions.length) {
            answers.push({
                question: allQuestions[currentQuestionIndex].text,
                answer: currentAnswer
            });

            // تحديث sessionStorage بالمصفوفة الجديدة
            sessionStorage.setItem('answers', JSON.stringify(answers));
        }

        // مسح محتوى الـ textarea قبل الانتقال إلى السؤال التالي
        document.getElementById('answer').value = '';

        currentQuestionIndex++; // زيادة الفهرس للسؤال التالي
        displayCurrentQuestion(); // عرض السؤال الجديد
    });

    // جعل textarea تتوسع تلقائيًا مع الكتابة
    const textarea = document.querySelector('.textarea-container textarea');
    textarea.addEventListener('input', function () {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });
</script>
