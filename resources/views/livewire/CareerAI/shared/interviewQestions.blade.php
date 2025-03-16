<!-- سؤال وإجابة المستخدم -->
<div x-data="questionNavigation">
    <div class="card shadow-sm p-4 rounded-4 mb-4">
        <h5 class="fw-bold mb-2">السؤال <span x-text="currentQuestionIndex + 1"></span>: <span
                x-text="questions[currentQuestionIndex].text"></span></h5>
        <p class="p-0">
            <span class="fw-bold">إجابتك:</span>
            <span x-text="questions[currentQuestionIndex].answer"></span>
        </p>
        <div class="text-start mt-3">
            <button class="btn btn-dark rounded-3 me-2" @click="previousQuestion" x-show="currentQuestionIndex > 0"
                x-transition>
                <i class="bi bi-chevron-right"></i>
            </button>
            <button class="btn btn-dark rounded-3" @click="nextQuestion"
                x-show="currentQuestionIndex < questions.length - 1" x-transition>
                السؤال التالي<i class="bi bi-chevron-left me-2"></i>
            </button>
        </div>
    </div>



    <!-- التقييم العام -->
    <div class="card shadow-sm p-4 rounded-4 mb-4 highlight">
        <div class="d-flex gap-4">
            <div class="overall-rating" style="min-width: fit-content">
                <h5 class="fw-bold d-block mb-2 text-muted"><i class="bi bi-stars"></i> تقييم الاجابة:</h5>
                <div class="d-flex align-items-center gap-2">
                    <svg width="30" height="30" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="40" stroke="#ddd" stroke-width="8" fill="none">
                        </circle>
                        <circle cx="50" cy="50" r="40"
                            :stroke="getRatingColor(questions[currentQuestionIndex].rating)" stroke-width="8"
                            fill="none" stroke-dasharray="251.2"
                            :stroke-dashoffset="251.2 - (questions[currentQuestionIndex].rating * 251.2 / 10)"
                            stroke-linecap="round"></circle>
                    </svg>
                    <span class="fw-bold fs-5" x-text="`${questions[currentQuestionIndex].rating}/10`"></span>
                </div>
            </div>

            <div class="overall-description flex-grow-1 fw-bold text-muted">
                <p class="fw-bold" x-text="questions[currentQuestionIndex].ratingDescription || 'لا يوجد بعد'"></p>
            </div>
        </div>
    </div>


    <!-- AI Notes Section -->
    <div class="card shadow-sm p-4 rounded-4 highlight mb-4">
        <h5 class="fw-bold mb-4 text-muted"><i class="bi bi-stars"></i> ملاحظات الذكاء الاصطناعي </h5>
        <p class="" :class="{ 'text-muted': !questions[currentQuestionIndex].aiNotes }">
            <span x-text="questions[currentQuestionIndex].aiNotes"></span>
        </p>
    </div>


</div>


<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('questionNavigation', () => ({
            questions: [{
                    id: 1,
                    text: 'أخبرنا المزيد عن خبرتك',
                    answer: 'خلال وظيفتي السابقة كأخصائي تسويق في شركة XYZ، كنت مسؤولاً عن إدارة حملات التسويق عبر وسائل التواصل الاجتماعي...',
                    aiNotes: 'رأي الذكاء الاصطناعي في السؤال رقم 1',
                    rating: 8.5,
                    ratingDescription: 'تقييم السؤال رقم 1',
                },
                {
                    id: 2,
                    text: 'ما هي أكبر نقاط قوتك؟',
                    answer: 'أنا جيد في العمل الجماعي وحل المشكلات بسرعة...',
                    aiNotes: 'رأي الذكاء الاصطناعي في السؤال رقم 2',
                    rating: 9.0,
                    ratingDescription: 'تقييم السؤال رقم 2',
                },
                {
                    id: 3,
                    text: 'ما هي التحديات التي واجهتها في عملك السابق؟',
                    answer: 'واجهت تحديًا في إدارة الوقت بسبب كثرة المهام...',
                    aiNotes: 'رأي الذكاء الاصطناعي في السؤال رقم 3',
                    rating: 7.0,
                    ratingDescription: 'تقييم السؤال رقم 3',
                },
            ],
            currentQuestionIndex: 0,

            nextQuestion() {
                if (this.currentQuestionIndex < this.questions.length - 1) {
                    this.currentQuestionIndex++;
                }
            },

            previousQuestion() {
                if (this.currentQuestionIndex > 0) {
                    this.currentQuestionIndex--;
                }
            },
            getRatingColor(rating) {
                if (rating >= 8.0) {
                    return '#28a745'; // Green for high ratings
                } else if (rating >= 5.0) {
                    return '#ffc107'; // Yellow for medium ratings
                } else {
                    return '#dc3545'; // Red for low ratings
                }
            },
        }));
    });
</script>
