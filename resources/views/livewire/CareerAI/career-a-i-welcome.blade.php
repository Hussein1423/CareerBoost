<div lang="ar" dir="rtl">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&family=Ruwudu:wght@400;500;600;700&display=swap');

        * {
            font-family: 'Rubik', 'Ruwudu', sans-serif;
            margin: 0;
            padding: 0;
        }

        .img-placeholder {
            width: 100%;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            border-radius: 20px 0px 0px 20px;
            margin-bottom: 1.5rem;
            font-size: 18px;
            border: #353535 4px solid;
            border-right: 0px;
            background-color: #f0f0f0;
            /* لون خلفية Placeholder */
            color: #666;
            /* لون النص */
        }

        .img-placeholder-left {
            width: 100%;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            border-radius: 0px 20px 20px 0px;
            margin-bottom: 1.5rem;
            font-size: 18px;
            border: #353535 4px solid;
            border-left: 0px;

            background-color: #f0f0f0;
            /* لون خلفية Placeholder */
            color: #666;
            /* لون النص */

        }

        .checkbox-list {
            display: flex;
            flex-direction: column;
            padding-left: 0;
            margin-top: 1rem;
        }

        .checkbox-list i {
            margin-left: 8px;
        }

        section {
            margin: 8rem 0;
        }

        .bolder-weight{
            font-weight: 500;
        }
    </style>

    <section class="container text-center">
        <h2>تعرف على نفسك بشكل أفضل</h2>
        <p class="fs-4">باستخدام الذكاء الاصطناعي، يمكن لأي شخص إجراء مقابلة والحصول على تحليل لكفاءاته وشخصيته وفحص درجة السيرة
            الذاتية.</p>
        <button type="submit" class="btn btn-dark fs-4">ابدا المقابلة</button>
    </section>

    <div class="container mt-4">
        <section class="row align-items-center">
            <div class="col-md-6 fs-4">
                <h3 class="section-header fw-bold">تقرير تحليل الشخصية</h3>
                <p class="bolder-weight">احصل على تقرير تحليل الشخصية في خمسة مجالات رئيسية</p>
                <ul class="checkbox-list d-flex flex-direction-column gap-2 list-unstyled">
                    <li><i class="fa-regular fa-circle-check fs-5"></i> الانفتاح</li>
                    <li><i class="fa-regular fa-circle-check fs-5"></i> الضمير الحي</li>
                    <li><i class="fa-regular fa-circle-check fs-5"></i> الانبساطية</li>
                    <li><i class="fa-regular fa-circle-check fs-5"></i> التوافق</li>
                    <li><i class="fa-regular fa-circle-check fs-5"></i> العصابية</li>
                </ul>
            </div>
            <div class="col-md-6">
                <div class="img-placeholder-left">صورة تحليل الشخصية</div>
            </div>
        </section>

        <section class="row align-items-center mt-4">
            <div class="col-md-6">
                <div class="img-placeholder">صورة تقرير الأداء</div>
            </div>
            <div class="col-md-6 fs-4" dir="ltr">
                <h3 class="section-header fw-bold">تقرير الأداء</h3>
                <p class="bolder-weight">احصل على تقرير أداء حول مهاراتك الفنية والمهنية:</p>
                <ul class="checkbox-list d-flex flex-direction-column gap-2 list-unstyled">
                    <li><i class="fa-regular fa-circle-check fs-5"></i> تحسين إجاباتك مع ملاحظات فورية</li>
                    <li><i class="fa-regular fa-circle-check fs-5"></i> تعرف على ما يمكن توقعه في مقابلات العمل</li>
                    <li><i class="fa-regular fa-circle-check fs-5"></i> احصل على ملاحظات مخصصة من مساعدي الذكاء
                        الاصطناعي</li>
                    <li><i class="fa-regular fa-circle-check fs-5"></i> أظهر جاهزيتك للعمل</li>
                </ul>
            </div>
        </section>

        <section class="row align-items-center mt-4">
            <div class="col-md-6 fs-4">
                <h3 class="section-header fw-bold">تقرير المقابلة السلوكية والمهارات</h3>
                <p class="bolder-weight">تعرف على المهارات التي تتقنها والتي تحتاج إلى تحسين</p>
                <ul class="checkbox-list d-flex flex-direction-column gap-2 list-unstyled">
                    <li><i class="fa-regular fa-circle-check fs-5"></i> حل المشكلات</li>
                    <li><i class="fa-regular fa-circle-check fs-5"></i> التواصل</li>
                    <li><i class="fa-regular fa-circle-check fs-5"></i> العمل الجماعي</li>
                    <li><i class="fa-regular fa-circle-check fs-5"></i> التكيف</li>
                </ul>
            </div>
            <div class="col-md-6">
                <div class="img-placeholder-left">صورة المقابلة السلوكية</div>
            </div>
        </section>

        <section class="row align-items-center mt-4" dir="ltr">
            <div class="col-md-6 fs-4">
                <h3 class="section-header fw-bold">تحليل السيرة الذاتية والتقرير</h3>
                <p class="bolder-weight">اكتشف درجة سيرتك الذاتية مع تقرير الملاحظات</p>
                <ul class="checkbox-list d-flex flex-direction-column gap-2 list-unstyled">
                    <li><i class="fa-regular fa-circle-check fs-5"></i> اختيار الوصف الوظيفي المناسب</li>
                    <li><i class="fa-regular fa-circle-check fs-5"></i> الحصول على تقرير مفصل عن كل جزء من سيرتك الذاتية
                    </li>
                    <li><i class="fa-regular fa-circle-check fs-5"></i> الحصول على ملاحظات لتحسين الأداء في المستقبل
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <div class="img-placeholder">صورة تقرير الأداء</div>
            </div>
        </section>

    </div>
</div>
