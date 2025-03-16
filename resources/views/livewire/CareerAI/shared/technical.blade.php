<!-- عرض النسب -->
<div x-data="technical">


    <div class="card shadow-sm p-4 d-flex flex-row justify-content-around rounded-4">
        <template x-for="(percent, index) in technicalPercentages" :key="index">
            <div class="text-end bg-primary rounded-4 p-3" @click="selectedIndex = index">
                <h6 class="progress-label" x-text="technicalLabels[index]"></h6>
                <div class="progress-circle d-flex align-items-center justify-content-between gap-2 mt-3">
                    <svg width="30" height="30" viewBox="0 0 70 70">
                        <circle cx="35" cy="35" r="30" class="bg"></circle>
                        <circle cx="35" cy="35" r="30" stroke-width="8" :stroke="technicalColors[index]"
                            stroke-dasharray="188.4" :stroke-dashoffset="188.4 - (188.4 * percent / 100)">
                        </circle>
                    </svg>
                    <span class="progress-value" x-text="percent + '%'"></span>
                </div>
            </div>
        </template>
    </div>

    <!-- عرض البيانات المقابلة -->
    <div class="highlight card p-4 rounded-4" x-show="selectedIndex !== null">
        <h5 class="d-flex gap-2 mb-2"><i class="bi bi-stars"></i><span x-text="technicalLabels[selectedIndex]"></span>
        </h5>
        <p class="py-3"> رأي الذكاء الاصطناعي الخاص بـ <span x-text="technicalLabels[selectedIndex]"></span></p>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('technical', () => ({
            selectedIndex: 0, // الفهرس المحدد

            // بيانات تحليل المهارات التقنية
            technicalPercentages: [80, 65, 90, 70],
            technicalLabels: ['حل المشاكل', 'أسئلة المقابلة', 'التحليل الفني والمهاري',
                'تحليل مطابقة السيرة الذاتية'
            ],
            technicalColors: ["blue", "purple", "green", "orange"],
            technicalPositives: [
                ['إتقان لغات برمجية متعددة.'],
                ['تصميم وإدارة قواعد البيانات بكفاءة.'],
                ['فهم عميق لبروتوكولات الشبكات.'],
                ['حماية الأنظمة من الاختراقات.']
            ],
            technicalNegatives: [
                ['صعوبة مواكبة التحديثات المستمرة.'],
                ['تعقيدات تحسين أداء قواعد البيانات.'],
                ['صعوبة استكشاف الأخطاء وإصلاحها.'],
                ['التحديات في مواجهة الهجمات الحديثة.']
            ],
        }));
    });
</script>
