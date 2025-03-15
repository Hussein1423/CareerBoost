<!-- الواجهة الرئيسية -->
<div x-data="questionsGen()" x-init="init()" class="max-w-4xl mx-auto p-6">
    <!-- العنوان الرئيسي -->
    <h2 class="text-2xl font-bold mb-6 text-gray-800">
        أسئلة مقترحة لوظيفة:
        <span class="text-blue-600" x-text="jobTitle"></span>
    </h2>

    <!-- اختيار نوع الأسئلة -->
    <div class="bg-white p-6 rounded-lg shadow-sm mb-6 border border-gray-200">
        <h3 class="text-lg font-semibold mb-4 text-gray-700">اختر نوع الأسئلة:</h3>

        <div class="space-y-3">
            <label class="flex items-center space-x-2 space-x-reverse">
                <input type="checkbox" class="form-checkbox text-blue-600 rounded" x-model="questionTypes.technical">
                <span class="text-gray-700">المهارات التقنية</span>
            </label>

            <label class="flex items-center space-x-2 space-x-reverse">
                <input type="checkbox" class="form-checkbox text-blue-600 rounded" x-model="questionTypes.soft">
                <span class="text-gray-700">المهارات الناعمة</span>
            </label>
        </div>
    </div>

    <!-- زر التوليد -->
    <button @click="generateQuestions()" :disabled="isLoading"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-colors mb-6 disabled:opacity-50">
        توليد الأسئلة
    </button>

    <!-- حالة التحميل -->
    <div x-show="isLoading" class="text-center p-6">
        <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-blue-500 border-t-transparent">
        </div>
        <p class="text-gray-600 mt-2">جاري توليد الأسئلة...</p>
    </div>

    <!-- رسائل الأخطاء -->
    <div x-show="errors" class="mt-4 p-4 bg-red-50 text-red-700 rounded-lg border border-red-200">
        <p x-text="errors"></p>
    </div>

    <!-- الأسئلة المولدة -->
    <div x-show="!isLoading" class="space-y-6">
        <!-- الأسئلة التقنية -->
        <template x-if="questionTypes.technical && technicalQuestions.length">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">الأسئلة التقنية</h3>
                    <button class="text-blue-600 hover:text-blue-700 text-sm">تعديل المجموعة</button>
                </div>

                <div class="space-y-4">
                    <template x-for="(question, index) in technicalQuestions" :key="index">
                        <div class="flex items-start space-x-2 space-x-reverse">
                            <span class="mt-1 text-gray-500" x-text="index + 1 + '.'"></span>
                            <div class="flex-1 bg-gray-50 p-4 rounded-lg">
                                <template x-if="!question.isEditing">
                                    <p class="text-gray-700" x-text="question.text"></p>
                                </template>
                                <textarea x-show="question.isEditing" x-model="question.editedText"
                                    class="w-full p-2 border rounded"></textarea>
                                <button @click="toggleEdit(question)"
                                    class="mt-2 text-blue-600 hover:text-blue-700 text-sm">
                                    <span x-text="question.isEditing ? 'حفظ' : 'تعديل'"></span>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </template>

        <!-- الأسئلة الناعمة -->
        <template x-if="questionTypes.soft && softQuestions.length">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">الأسئلة الناعمة</h3>
                    <button class="text-blue-600 hover:text-blue-700 text-sm">تعديل المجموعة</button>
                </div>

                <div class="space-y-4">
                    <template x-for="(question, index) in softQuestions" :key="index">
                        <div class="flex items-start space-x-2 space-x-reverse">
                            <span class="mt-1 text-gray-500" x-text="index + 1 + '.'"></span>
                            <div class="flex-1 bg-gray-50 p-4 rounded-lg">
                                <template x-if="!question.isEditing">
                                    <p class="text-gray-700" x-text="question.text"></p>
                                </template>
                                <textarea x-show="question.isEditing" x-model="question.editedText"
                                    class="w-full p-2 border rounded"></textarea>
                                <button @click="toggleEdit(question)"
                                    class="mt-2 text-blue-600 hover:text-blue-700 text-sm">
                                    <span x-text="question.isEditing ? 'حفظ' : 'تعديل'"></span>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </template>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
    Alpine.data('questionsGen', () => ({
        API_KEY: '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',
        MODEL: 'deepseek/deepseek-r1:free',
        isLoading: false,
        errors: null,
        jobTitle: 'وظيفة غير محددة',
        technicalQuestions: [],
        softQuestions: [],
        questionTypes: { technical: true, soft: true },

        init() {
                // محاولة استرجاع البيانات من localStorage
                const savedData = localStorage.getItem('jobData');
                if(savedData) {
                    this.jobTitle = JSON.parse(savedData).title;
                }
            }
,

        promptTemplate() {
            return `أنشئ قائمة أسئلة مقابلة عمل بالعربية للوظيفة: "${this.jobTitle}"
━━━━━━━━━━━━━━━━━━━━━━━
المتطلبات:
1. الأسئلة التقنية: ${this.questionTypes.technical ? 'مطلوبة' : 'غير مطلوبة'}
2. الأسئلة الناعمة: ${this.questionTypes.soft ? 'مطلوبة' : 'غير مطلوبة'}

أرشد الذكاء الاصطناعي:
### الأسئلة التقنية ###
- ${this.jobTitle} ركز على تقنيات  الحديثة
- ${this.jobTitle} أهم اسئلة تقدمها الاساسيات لل
- تضمين أسئلة حل المشكلات
- 5 أسئلة فقط يتم تكوينها


### الأسئلة الناعمة ###
- أسئلة عن العمل الجماعي
- أسئلة عن إدارة الوقت
- حالات افتراضية للتعامل مع الضغوط
- 5 أسئلة فقط يتم تكوينها
`;
        },

        async generateQuestions() {
            try {
                if(!this.jobTitle || this.jobTitle === 'وظيفة غير محددة') {
                    this.errors = 'يرجى تحديد اسم وظيفة صحيح أولاً';
                    return;
                }

                this.isLoading = true;
                this.errors = null;

                const response = await fetch('https://openrouter.ai/api/v1/chat/completions', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${this.API_KEY}`,
                        'Content-Type': 'application/json',
                        'HTTP-Referer': window.location.href,
                        'X-Title': 'Job Interview Questions Generator'
                    },
                    body: JSON.stringify({
                        model: this.MODEL,
                        messages: [{
                            role: 'user',
                            content: this.promptTemplate()
                        }]
                    })
                });

                const data = await response.json();
                const content = data.choices?.[0]?.message?.content || '';

                this.parseQuestions(content);

            } catch (error) {
                this.errors = `خطأ في التوليد: ${error.message}`;
            } finally {
                this.isLoading = false;
            }
        },

        parseQuestions(content) {
            const technicalMatch = content.match(
                /(الأسئلة التقنية|الأسئلة الفنية|أسئلة تقنية)[\s\S]*?(\d+\..*?)(?=###|الأسئلة|أسئلة|$)/gi
            );

            const softMatch = content.match(
                /(الأسئلة الناعمة|أسئلة سلوكية|أسئلة شخصية)[\s\S]*?(\d+\..*?)(?=###|الأسئلة|أسئلة|$)/gi
            );

            this.technicalQuestions = technicalMatch
                ? this.prepareQuestions(technicalMatch[0])
                : [];

            this.softQuestions = softMatch
                ? this.prepareQuestions(softMatch[0])
                : [];

            if(this.technicalQuestions.length + this.softQuestions.length === 0) {
                this.fallbackParse(content);
            }
            sessionStorage.setItem('questions', JSON.stringify({
        tech: this.technicalQuestions,
        soft: this.softQuestions
    }));
        },

        fallbackParse(content) {
            const lines = content.split('\n');
            let currentCategory = null;

            lines.forEach(line => {
                if(line.includes('تقنية') || line.includes('فنية')) {
                    currentCategory = 'technical';
                } else if(line.includes('ناعمة') || line.includes('سلوكية')) {
                    currentCategory = 'soft';
                } else if(/^\d+\./.test(line)) {
                    const question = this.cleanQuestion(line);
                    if(currentCategory === 'technical') {
                        this.technicalQuestions.push(this.createQuestionObject(question));
                    } else if(currentCategory === 'soft') {
                        this.softQuestions.push(this.createQuestionObject(question));
                    }
                }
            });
        },

        createQuestionObject(text) {
            return {
                text: text,
                isEditing: false,
                editedText: text
            };
        },

        cleanQuestion(line) {
            return line
                .replace(/^\d+\./, '')
                .replace(/["'-]/g, '')
                .replace(/\s+/g, ' ')
                .trim();
        },

        prepareQuestions(text) {
            return text.split('\n')
                .map(line => this.cleanQuestion(line))
                .filter(line => line.length > 0 && !line.match(/^(###|أسئلة|الأسئلة)/i))
                .map((line, index) => this.createQuestionObject(line));
        },

        toggleEdit(question) {
            if (question.isEditing) {
                question.text = question.editedText;
            }
            question.isEditing = !question.isEditing;
        }
    }));
});

</script>
