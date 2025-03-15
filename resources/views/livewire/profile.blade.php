<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg" x-data="jobDesc()" x-cloak
    @keydown.escape="clearErrors">
    <style>
        [x-cloak] {
            display: none !important;
        }

        .loading-btn {
            transition: all 0.3s ease;
        }
    </style>

    <div class="space-y-4" id="jobTitle">
        <!-- رفع السيرة الذاتية -->
        <div>
            <label class="block text-sm font-medium text-gray-700">رفع السيرة الذاتية</label>
            <input type="file" @change="validateFile($event)" class="w-full p-2 border rounded-lg" accept=".pdf,.docx">
            <span x-show="errors.cv" x-text="errors.cv" class="text-red-500 text-sm"></span>
        </div>

        <!-- إدخال اسم الوظيفة -->
        <div>
            <label class="block text-sm font-medium text-gray-700">اسم الوظيفة</label>
            <input type="text" x-model="jobTitle" class="w-full p-2 border rounded-lg">
            <span x-show="errors.title" x-text="errors.title" class="text-red-500 text-sm"></span>
        </div>

        <!-- توليد وصف الوظيفة -->
        <div>
            <label class="block text-sm font-medium text-gray-700">وصف الوظيفة</label>
            <div class="relative">
                <textarea x-model="jobDescription" rows="4" class="w-full p-2 border rounded-lg"
                    placeholder="اضغط على زر التوليد"></textarea>
                <button @click="generateDescription()" :disabled="isLoading"
                    class="absolute right-3 bottom-2 text-blue-500 hover:text-blue-700 loading-btn"
                    :class="{ 'opacity-50 cursor-not-allowed': isLoading }">
                    <span x-show="!isLoading">⭐ توليد تلقائي</span>
                    <span x-show="isLoading">⏳ جاري التوليد...</span>
                </button>
            </div>
            <span x-show="errors.desc" x-text="errors.desc" class="text-red-500 text-sm"></span>
        </div>

        <!-- زر الحفظ -->
        <button @click="saveData()" class="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-700 transition">
            حفظ المعلومات
        </button>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
    Alpine.data('jobDesc', () => ({
        API_KEY: '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',
        MODEL: 'deepseek/deepseek-r1:free',
        jobTitle: '',
        jobDescription: '',
        isLoading: false,
        errors: { cv: null, title: null, desc: null },

        promptTemplate(jobTitle) {
            return `أنشئ وصفًا وظيفيًا بالعربية للوظيفة: "${jobTitle}":━━━━━━━━━━━━━━━━━━━━━━━
🎯 المهام الأساسية
━━━━━━━━━━━━━━━━━━━━━━━
• تنفيذ [المهام التشغيلية اليومية]
• تطوير [النقاط الرئيسية للتحسين]
• تنسيق [نوع التعاون مع الفرق]

━━━━━━━━━━━━━━━━━━━━━━━
💻 المتطلبات التقنية
━━━━━━━━━━━━━━━━━━━━━━━
🔹 تقنيات متقدمة:
🔹 أساسيات ضرورية:

━━━━━━━━━━━━━━━━━━━━━━━
🤝 المهارات الشخصية
━━━━━━━━━━━━━━━━━━━━━━━
◉ إدارة الاجتماعات الفعّالة
◉ قيادة فريق مكون من [عدد]+ أعضاء
◉ حل النزاعات خلال [إطار زمني]

━━━━━━━━━━━━━━━━━━━━━━━
📜 المؤهلات والشروط
━━━━━━━━━━━━━━━━━━━━━━━
✔ بكالوريوس في [التخصص الدقيق]
✔ خبرة [عدد] سنوات في [مجال الخبرة]
✔ شهادة [اسم الشهانة] (اختياري)

━━━━━━━━━━━━━━━━━━━━━━━
✨ ملاحظات هامة
━━━━━━━━━━━━━━━━━━━━━━━
❶ استخدم أفعال مثل: يُحلِّل، يُنفِّذ، يُطوِّر
❷ تجنب المصطلحات العامة
❸ ركز على الأدوات المستخدمة فعليًا بالمجال
◆ إذا كانت الوظيفة غير معروفة، اطلب من المستخدم توضيحها بدلاً من إنشاء وصف عام`;
        },

        async generateDescription() {
            this.clearErrors();

            if (!this.jobTitle) {
                this.errors.title = 'يرجى إدخال اسم الوظيفة أولاً';
                return;
            }

            try {
                this.isLoading = true;
                const response = await fetch('https://openrouter.ai/api/v1/chat/completions', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${this.API_KEY}`,
                        'Content-Type': 'application/json',
                        'HTTP-Referer': window.location.href,
                        'X-Title': 'Job Description Generator'
                    },
                    body: JSON.stringify({
                        model: this.MODEL,
                        messages: [{ role: 'user', content: this.promptTemplate(this.jobTitle) }]
                    })
                });

                const data = await response.json();
                const generatedText = data.choices?.[0]?.message?.content || '';

                if (this.isUnknownJob(generatedText)) {
                    this.errors.desc = 'عذرًا، لم نتمكن من التعرف على هذه الوظيفة. يرجى إدخال اسم وظيفة أوضح أو تقديم المزيد من التفاصيل.';
                    this.jobDescription = '';
                } else {
                    this.jobDescription = generatedText;
                }

            } catch (error) {
                this.errors.desc = `خطأ في التوليد: ${error.message}`;
            } finally {
                this.isLoading = false;
            }
        },

        isUnknownJob(text) {
            const unknownIndicators = [
                /\[.*?\]/g, // اكتشاف الأقواس الفارغة
                /\.\.\./g,  // اكتشاف النقاط المتتالية
                /غير معروف/gi,
                /يرجى توضيح/gi,
                /المهام التشغيلية اليومية/g
            ];

            return unknownIndicators.some(pattern => pattern.test(text));
        },

        validateFile(e) {
            const file = e.target.files[0];
            this.errors.cv = null;

            if (!file) return;

            const validTypes = ['application/pdf',
                               'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            const maxSize = 2 * 1024 * 1024;

            if (!validTypes.includes(file.type)) {
                this.errors.cv = 'نوع الملف غير مدعوم';
                e.target.value = '';
            } else if (file.size > maxSize) {
                this.errors.cv = 'الحجم الأقصى 2MB';
                e.target.value = '';
            }
        },

       saveData() {
    if (!this.jobTitle || !this.jobDescription) {
        alert('يرجى إكمال جميع الحقول المطلوبة');
        return;
    }

    // تخزين البيانات في localStorage
    localStorage.setItem('jobData', JSON.stringify({
        title: this.jobTitle,
        description: this.jobDescription
    }));

    // الانتقال للصفحة التالية
    window.location.href = `http://127.0.0.1:8000/generateQuestines`;
},

        clearErrors() {
            this.errors = { cv: null, title: null, desc: null };
        }
    }));
});
</script>
