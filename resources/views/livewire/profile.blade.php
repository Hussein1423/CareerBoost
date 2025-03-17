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
                    <label class="form-label">ارفع سيرتك الذاتية (PDF):</label>
                    <input id="cvInput" type="file" class="form-control" title="ارفع سيرتك الذاتية"
                        @change="validateFile">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <!-- Alpine.js Logic -->
    <script>
        window.env =
    {
    API_KEY: "{{ env('API_KEY') }}",
    MODEL: "{{ env('MODEL') }}"
    };
        document.addEventListener('alpine:init', () => {

    Alpine.data('jobDesc', () => ({

        API_KEY: window.env.API_KEY,
        MODEL: window.env.MODEL,
      jobTitle: '',
      jobDescription: '',
      cvAnalysis: null,
      isLoading: false,
      errors: {
        cv: null,
        title: null,
        desc: null
      },

      // Validate File Input
      validateFile(e)
      {
        const file = e.target.files[0];
        this.errors.cv = null;

        if (!file) return;

        const validTypes =
        [
          'application/pdf',
        ];
        const maxSize = 2 * 1024 * 1024

        if (!validTypes.includes(file.type))
         {
          this.errors.cv = 'نوع الملف غير مدعوم';
          e.target.value = '';
         } else if (file.size > maxSize)
          {
          this.errors.cv = 'الحجم الأقصى 2MB';
          e.target.value = '';
          }
      },
      async analyzeCV()
{
  const fileInput = document.getElementById('cvInput');
  const file = fileInput ? fileInput.files[0] : null;
  this.errors.cv = null;

  const exFile = await this.extractTextFromPDF(file);
  // التحقق من وجود الملف
  if (!file) {
    this.errors.cv = 'يرجى تحميل ملف السيرة الذاتية بصيغة PDF';
    return;
  }

  const prompt = `
قم بتحليل السيرة الذاتية المرفقة بالملف وقم بتقييم الجوانب التالية بنسبة 100:
1. مدى توافق السيرة الذاتية مع نظام ATS، مع تقديم نصائح لتحسينها.
2. مدى تطابق الخبرات الموجودة في السيرة الذاتية مع العنوان والوصف الوظيفي، مع تقديم نصائح للتطوير.
3. مدى تطابق التعليم الموجود في السيرة الذاتية مع العنوان والوصف الوظيفي، مع تقديم نصائح للتطوير.
4. مدى تطابق المهارات الموجودة في السيرة الذاتية مع العنوان والوصف الوظيفي، مع تقديم نصائح للتطوير.
5. مدى تطابق المشاريع الموجودة في السيرة الذاتية مع العنوان والوصف الوظيفي، مع تقديم نصائح للتطوير.
6. مدى تطابق الشهادات الموجودة في السيرة الذاتية مع العنوان والوصف الوظيفي، مع تقديم نصائح للتطوير.
7. مدى تطابق الملخص المهني الموجود في السيرة الذاتية مع العنوان والوصف الوظيفي، مع تقديم نصائح للتطوير.
 السيرة الذاتية:
    ${exFile}
    ---
    العنوان الوظيفي: ${this.jobTitle}
    الوصف الوظيفي: ${this.jobDescription}
    الرجاء تقديم النتيجة باللغة العربية.


  `;

  this.isLoading = true;

  try {
  const response = await fetch('https://openrouter.ai/api/v1/chat/completions', {
    method: 'POST',
    headers: {
      'Authorization': `Bearer ${this.API_KEY}`,
      'Content-Type': 'application/json' // تأكد من تحديد نوع البيانات
    },
    body: JSON.stringify({
        model: this.MODEL,
        messages: [{ role: "user", content:  prompt }], // البيانات المناسبة
        temperature: 0.7
    })
  });

  const data = await response.json();
  this.cvAnalysis = data;

} catch (error) {
  console.error(error);
  this.errors.cv = 'حدث خطأ أثناء تحليل السيرة الذاتية';
} finally {
  this.isLoading = false;
}

}
,

async extractTextFromPDF(file) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();

    reader.onload = async function () {
      try {
        const pdfData = new Uint8Array(reader.result);
        const pdf = await pdfjsLib.getDocument({ data: pdfData }).promise;
        let text = "";

        for (let i = 1; i <= pdf.numPages; i++) {
          const page = await pdf.getPage(i);
          const content = await page.getTextContent();
          text += content.items.map(item => item.str).join(" ") + "\n";
        }

        resolve(text);
      } catch (error) {
        reject(error);
      }
    };

    reader.onerror = reject;
    reader.readAsArrayBuffer(file);
  });
},
async saveData() {
    this.clearErrors();

    if (!this.jobTitle || !this.jobDescription || !this.analyzeCV) {
        alert('يرجى إكمال جميع الحقول المطلوبة');
        return;
    }

    let jobData = {
        title: this.jobTitle,
        description: this.jobDescription,
        cv: null, // سيتم تحديثه لاحقًا
    };

    localStorage.setItem('jobData', JSON.stringify(jobData));

    // ابدأ تحليل السيرة الذاتية
    await this.analyzeCV(); // انتظر اكتمال التحليل

    if (this.cvAnalysis && this.cvAnalysis.choices && this.cvAnalysis.choices[0].message.content) {
        // استرجاع البيانات من localStorage لتحديثها
        let updatedJobData = JSON.parse(localStorage.getItem('jobData')) || {};
        updatedJobData.cv = this.cvAnalysis.choices[0].message.content;
        localStorage.setItem('jobData', JSON.stringify(updatedJobData));
    }

    // انتقل بعد تحديث localStorage
     window.location.href = 'http://127.0.0.1:8000/generateQuestines';
}


,

      clearErrors()
      {
        this.errors = { cv: null, title: null, desc: null };
      }
    }
  )
);
  });
    </script>
