<div x-data="cvAnalysis">
    <!-- عرض النسب -->
    <div class="card shadow-sm p-4 d-flex flex-row justify-content-around rounded-4">
        <template x-for="(percent, index) in percentages" :key="index">
            <div class="text-end bg-primary rounded-4 p-3" @click="selectedIndex = index">
                <h6 class="progress-label" x-text="labels[index]"></h6>
                <div class="progress-circle d-flex align-items-center justify-content-between gap-2 mt-3">
                    <svg width="30" height="30" viewBox="0 0 70 70">
                        <circle cx="35" cy="35" r="30" class="bg"></circle>
                        <circle cx="35" cy="35" r="30" stroke-width="8" :stroke="getColor(percent)"
                            stroke-dasharray="188.4" :stroke-dashoffset="188.4 - (188.4 * percent / 100)">
                        </circle>
                    </svg>
                    <span class="progress-value" x-text="percent + '%'"></span>
                </div>
            </div>
        </template>
    </div>

    <!-- عرض البيانات المقابلة -->
    <div class="highlight card p-4 rounded-4 mt-4" x-show="selectedIndex !== null">
        <h5 class="d-flex gap-2 mb-2">
            <i class="bi bi-stars"></i>
            <span x-text="labels[selectedIndex]"></span>
        </h5>
        <p class="py-3">
            رأي الذكاء الاصطناعي الخاص بـ <span x-text="labels[selectedIndex]"></span>:
            <span x-text="descriptions[selectedIndex]"></span>
        </p>
    </div>

    <!-- Overall CV Rating -->
    <div class="highlight card shadow-sm p-4 rounded-4 mt-4">
        <h5 class="fw-bold mb-3"><i class="bi bi-stars"></i> تقييم السيرة الذاتية العام: <span
                :class="getOverallScoreColor(overallScore)" x-text="overallScore + '/10'"></span></h5>

                <p>تفاصيل خاصةومقترحة على السيرة الذاتية</p>
            </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('cvAnalysis', () => ({
            selectedIndex: 0,

            percentages: [88, 58, 80, 63, 77, 99], // النسب المئوية
            labels: [
                'الخبرة',
                'التعليم',
                'المهارات',
                'المشاريع',
                'الشهادات',
                'الملخص المهني'
            ],
            descriptions: [
                'تحليل الخبرة: الخبرة الحالية جيدة ولكن يمكن تعزيزها بإضافة المزيد من التفاصيل حول الإنجازات.',
                'تحليل التعليم: المؤهلات التعليمية مناسبة للوظيفة.',
                'تحليل المهارات: المهارات التقنية قوية وتتوافق مع متطلبات الوظيفة.',
                'تحليل المشاريع: المشاريع المذكورة جيدة ولكن يمكن إضافة المزيد من التفاصيل حول النتائج.',
                'تحليل الشهادات: الشهادات الحالية مناسبة ولكن يمكن إضافة المزيد لتعزيز الملف الشخصي.',
                'تحليل الملخص المهني: الملخص جيد ولكن يمكن تحسينه بإضافة إنجازات قابلة للقياس.'
            ],

            get overallScore() {
                const total = this.percentages.reduce((sum, percent) => sum + percent, 0);
                const average = total / this.percentages.length;
                return (average / 10).toFixed(1);
            },

            getColor(percent) {
                if (percent >= 80) return '#28a745'; // أخضر
                if (percent >= 60) return '#ffc107'; // أصفر
                return '#dc3545'; // أحمر
            },

            getOverallScoreColor(score) {
                if (score >= 8) return 'text-success'; // أخضر
                if (score >= 6) return 'text-warning'; // أصفر
                return 'text-danger'; // أحمر
            },
        }));
    });
</script>
