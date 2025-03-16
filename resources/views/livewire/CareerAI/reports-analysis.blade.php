<div lang="ar" dir="rtl">

    <style>
        .progress-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .progress-circle {
            width: fit-content;
            height: fit-content;
            position: relative;
            cursor: pointer;
        }

        .progress-circle svg {
            transform: rotate(-90deg);
        }

        .progress-circle circle {
            fill: none;
            stroke-width: 8;
            stroke-linecap: round;
        }

        .progress-circle .bg {
            stroke: #e6e6e6;
        }

        .progress-label {
            font-weight: bold;
        }

        .progress-value {
            font-size: 16px;
            font-weight: bold;
        }

        .highlight {
            background-color: #fffae6;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-link {
            cursor: pointer;
        }

        .nav-link.active {
            color: #000;
            background: #fff;
        }

        .nav-link:hover {
            color: #000;
            background: #fff;
        }

        .bg-primary {
            background-color: #fff !important;
        }

        .bg-primary:hover {
            transition: 0.5s;
            cursor: pointer;
            background-color: #edf4fc !important;
        }
    </style>


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
