@push('cssContent')
<link rel="stylesheet" href="{{asset('careerAI-css/reportAnalysis.css')}}">
@endpush
<div lang="ar" dir="rtl">



    <div class="container d-flex justify-content-center mt-3" x-data="app">
        <div class="col-md-8">

            <!-- التبويبات -->
            @include('livewire.CareerAI.shared.sections-nav')

            <!-- تحليل الشخصية -->
            <div x-show="activeTab === 'personality'">
                @include('livewire.CareerAI.shared.personality')
            </div>

            <!-- تحليل المهارات التقنية -->
            <div x-show="activeTab === 'technical'">
                @include('livewire.CareerAI.shared.technical')
            </div>

            <!-- تحليل العلاقات -->
            <div x-show="activeTab === 'interview'">
                @include('livewire.CareerAI.shared.interviewQestions')
            </div>

            <!-- تحليل تقييم مطابقة السيرة الذاتية -->
            <div x-show="activeTab === 'resume'">
                @include('livewire.CareerAI.shared.cv-matching')
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('app', () => ({
                activeTab: 'resume', // القسم النشط افتراضيًا
                selectedIndex: 0, // الفهرس المحدد

                // بيانات تحليل الشخصية
                personalityPercentages: [50, 44, 78, 50, 50],
                personalityLabels: ['الانفتاح', 'الوعي', 'العصبية', 'الاجتهاد', 'الوفاق'],
                personalityColors: ["red", "red", "green", "orange", "green"],
                personalityPositives: [
                    ['زيادة مرونة الموظفين.'],
                    ['تحسين التركيز.'],
                    ['تقليل التوتر.'],
                    ['زيادة الدافعية.'],
                    ['تحسين العلاقات.']
                ],
                personalityNegatives: [
                    ['صعوبة التواصل.'],
                    ['قلة التفاعل.'],
                    ['زيادة العصبية.'],
                    ['الإرهاق.'],
                    ['التساهل.']
                ],
            }));
        });
    </script>
</div>
