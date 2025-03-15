<div x-data="questionManager" x-init="init()">
    <!-- Show current question -->
    <template x-if="currentQuestion">
        <div>
            <h2 x-text="currentQuestion" class="text-lg font-semibold mb-4"></h2>

            <!-- Textarea for user answer -->
            <textarea x-model="answer" class="w-full p-2 border rounded-md" rows="3"></textarea>

            <!-- Next Button -->
            <button @click="nextQuestion" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                التالي
            </button>
        </div>
    </template>

    <!-- If no question remains -->
    <template x-if="!currentQuestion">
        <p class="text-gray-600">لا توجد أسئلة متبقية</p>
    </template>
</div>

<script>
    document.addEventListener('alpine:init', () => {
    Alpine.data('questionManager', () => ({
        // البيانات
        questions: {
            technical: [],
            soft: []
        },
        currentCategory: 'tech',
        currentIndex: 0,
        answer: '',

        // التهيئة التلقائية
        init() {
            // جلب البيانات من الجلسة
            const storedQuestions = sessionStorage.getItem('questions');
            const storedAnswers = sessionStorage.getItem('userAnswers');

            if (storedQuestions) {
                this.questions = JSON.parse(storedQuestions);
            }

            if (storedAnswers) {
                this.answers = JSON.parse(storedAnswers);
            }
        },

        // الحصول على السؤال الحالي
        get currentQuestion() {
            const categoryQuestions = this.questions[this.currentCategory] || [];
            return categoryQuestions[this.currentIndex].text || null;
        },

        // الانتقال للسؤال التالي
        nextQuestion() {
            // حفظ الإجابة الحالية
            this.saveAnswer();

            // الانتقال للسؤال التالي
            this.currentIndex++;

            // التحقق من نهاية الأسئلة
            if (this.currentIndex >= this.questions[this.currentCategory].length) {
                if (this.currentCategory === 'tech') {
                    this.currentCategory = 'soft';
                    this.currentIndex = 0;
                } else {
                    this.currentCategory = null;
                }
            }
        },

        // دالة لحفظ الإجابات
        saveAnswer() {
            const answers = JSON.parse(sessionStorage.getItem('userAnswers')) || {};
            const questionId = `${this.currentCategory}_${this.currentIndex}`;

            answers[questionId] = {
                question: this.currentQuestion,
                answer: this.answer
            };

            sessionStorage.setItem('userAnswers', JSON.stringify(answers));
            this.answer = ''; // إعادة تعيين الإجابة
        }
    }));
});
</script>