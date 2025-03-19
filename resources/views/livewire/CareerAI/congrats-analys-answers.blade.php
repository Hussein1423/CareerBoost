@push('cssContent')
    <link rel="stylesheet" href="{{ asset('careerAI-css/congrats.css') }}">
@endpush

<!-- Root div with h-100 and d-flex to take full height -->
<div dir="rtl" class="d-flex justify-content-center align-items-center h-100 min-vh-100">
    <div class="container d-flex flex-column justify-content-center align-items-center col-4 text-center">
        <h3>تهانينا! <span class="fs-3">🎉</span> تم إرسال مقابلتك بنجاح.</h3>
        <p class="lead"></p>
        <p>شكراً لإجراء المقابلة معنا. نحن حالياً نقوم بتحليل إجاباتك لإنشاء تقرير تفصيلي عن أدائك.</p>


        {{-- <a href="#" class="btn btn-dark p-3 py-2">عرض تقرير المقابلة</a> --}}


        <div class="loader mt-3">
        </div>
    </div>
</div>
