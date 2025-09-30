<!DOCTYPE html>
@php
    use App\Models\Setting;
@endphp
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr"
    data-theme="theme-default" data-assets-path="{{ asset('admin') }}/" data-template="vertical-menu-template">


<!-- Mirrored from demos.themeselection.com/sneat-bootstrap-html-admin-template/html/vertical-menu-template/app-ecommerce-dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Mar 2024 15:39:36 GMT -->

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ Setting::find(1)->name }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description"
        content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://themeselection.com/item/sneat-bootstrap-html-admin-template/">


    <!-- ? PROD Only: Google Tag Manager (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm5445.html?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5DDHKGP');
    </script>
    <!-- End Google Tag Manager -->

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon"
        href="{{ asset('images') }}/{{ Setting::find(1)->photo != null ? Setting::find(1)->photo : 'no-image.png' }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/css/rtl/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('admin') }}/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet"
        href="{{ asset('admin') }}/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/libs/select2/select2.css">

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/libs/quill/typography.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/libs/quill/katex.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/libs/quill/editor.css">

    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/libs/dropzone/dropzone.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/libs/flatpickr/flatpickr.css">


    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/libs/tagify/tagify.css">

    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/libs/@form-validation/form-validation.css">

<link rel="stylesheet" href="{{ asset('admin') }}/vendor/libs/rateyo/rateyo.css" />

   <!-- Adsense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1628060343533989"
        crossorigin="anonymous"></script>
    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/css/pages/card-analytics.css" />

    <!-- Helpers -->
    <script src="{{ asset('admin') }}/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('admin') }}/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('admin') }}/js/config.js"></script>

    {{-- <style>
      th ,tr,td{
        text-align: center;
      }
    </style> --}}
        <script src="{{ asset('admin') }}/vendor/libs/jquery/jquery.js"></script>
        <script src="{{ asset('admin') }}/vendor/libs/select2/select2.js"></script>
        <script src="{{ asset('admin') }}/js/tinymce.min.js" referrerpolicy="origin"></script>
<style>
    /* التصميم الأساسي لجميع الأجهزة */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    width: 100%;
    padding: 20px;
    box-sizing: border-box;
}

/* أجهزة الشاشات الكبيرة (أجهزة الكمبيوتر المكتبية) */
@media screen and (min-width: 1024px) {
    .header, .footer {
        font-size: 20px;
    }

    .container {
        max-width: 1200px; /* تعيين عرض أقصى للصفحة */
        margin: 0 auto;
    }
}

/* أجهزة التابلت (الشاشات المتوسطة) */
@media screen and (max-width: 1024px) and (min-width: 768px) {
    .header, .footer {
        font-size: 18px;
    }

    .container {
        padding: 15px;
    }
}

/* الهواتف المحمولة (الشاشات الصغيرة) */
@media screen and (max-width: 767px) {
    .header, .footer {
        font-size: 16px;
    }

    .container {
        padding: 10px;
    }

    .box {
        flex: 1 1 100%; /* العنصر سيأخذ 100% من العرض */
    }
}



.container {
    display: flex;
    flex-wrap: wrap; /* لف العناصر في حالة عدم وجود مساحة كافية */
    gap: 20px;
    justify-content: space-between;
}

.box {
    flex: 1 1 30%; /* سيتم توزيع المساحة بين الأعمدة */
    min-width: 300px;
    margin: 10px;
    background-color: #f1f1f1;
    padding: 20px;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 5px;
}

/* الشاشات الصغيرة */
@media screen and (max-width: 767px) {
    .box {
        flex: 1 1 100%; /* العناصر ستأخذ 100% من العرض في الهواتف */
    }
}


.container {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 3 أعمدة */
    gap: 20px;
}

.box {
    background-color: #f1f1f1;
    padding: 20px;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 5px;
}

/* الشاشات الصغيرة */
@media screen and (max-width: 767px) {
    .container {
        grid-template-columns: 1fr; /* العمود الواحد في الشاشات الصغيرة */
    }
}
img, iframe {
    max-width: 100%; /* الصورة أو الفيديو سيأخذ العرض الكامل المتاح */
    height: auto; /* الحفاظ على نسبة العرض إلى الارتفاع */
}


.container {
    display: flex;
    flex-wrap: wrap;
}

.box {
    flex: 1 1 30%;
}

/* في الشاشات الصغيرة */
@media screen and (max-width: 767px) {
    .container {
        flex-direction: column; /* وضع العناصر عموديًا على الشاشات الصغيرة */
    }

    .box {
        flex: 1 1 100%; /* كل عنصر سيأخذ عرض 100% */
    }
}



.container {
    padding: 20px;
}

.box {
    margin-bottom: 20px;
}


body {
    font-size: 16px;
}

@media screen and (max-width: 767px) {
    body {
        font-size: 14px; /* حجم خط أصغر في الشاشات الصغيرة */
    }
}




</style>

</head>

<body>


  <!-- ?PROD Only: Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DDHKGP" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar  ">
  <div class="layout-container">















@include('admin.layout.menu')





{{-- ////////////////////////////////////////////////////////////////////// --}}













    <!-- Layout container -->
    <div class="layout-page">


      @include('admin.layout.navbar')

















@yield('contant')

<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
      <div class="mb-2 mb-md-0" align="">

         <a href="https://www.facebook.com/basharessam11" target="_blank" class="footer-link fw-bolder"> © <script>
        document.write(new Date().getFullYear())
        </script>  ❤️ made with  by  bashar essam </a>
      </div>

    </div>
  </footer>
  <!-- / Footer -->


            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>



      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>


      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>

    </div>
    <!-- / Layout wrapper -->







    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->


    <script src="{{ asset('admin') }}/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('admin') }}/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('admin') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ asset('admin') }}/vendor/libs/hammer/hammer.js"></script>
    <script src="{{ asset('admin') }}/vendor/libs/i18n/i18n.js"></script>
    <script src="{{ asset('admin') }}/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="{{ asset('admin') }}/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->     <script src="{{ asset('admin') }}/vendor/libs/apex-charts/apexcharts.js"></script>


      <!-- Vendors JS -->
  <script src="{{ asset('admin') }}/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>


  <script src="{{ asset('admin') }}/vendor/libs/cleavejs/cleave.js"></script>
  <script src="{{ asset('admin') }}/vendor/libs/cleavejs/cleave-phone.js"></script>



<script src="{{ asset('admin') }}/vendor/libs/quill/katex.js"></script>
<script src="{{ asset('admin') }}/vendor/libs/quill/quill.js"></script>

<script src="{{ asset('admin') }}/vendor/libs/dropzone/dropzone.js"></script>
<script src="{{ asset('admin') }}/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
<script src="{{ asset('admin') }}/vendor/libs/flatpickr/flatpickr.js"></script>
<script src="{{ asset('admin') }}/vendor/libs/tagify/tagify.js"></script>


<script src="{{ asset('admin') }}/vendor/libs/moment/moment.js"></script>


<script src="{{ asset('admin') }}/vendor/libs/%40form-validation/popular.js"></script>
<script src="{{ asset('admin') }}/vendor/libs/%40form-validation/bootstrap5.js"></script>
<script src="{{ asset('admin') }}/vendor/libs/%40form-validation/auto-focus.js"></script>









    <!-- Main JS -->
    <script src="{{ asset('admin') }}/js/main.js"></script>



    <!-- Page JS -->
    {{-- <script src="{{ asset('admin') }}/js/app-ecommerce-dashboard.js"></script> --}}

    <script>

       // {{-- -------------------------------------------------------------- textarea-------------------------------------------------------------------- --}}

tinymce.init({
  selector: '#textarea',
  plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount code', // ضفت code هنا
  toolbar: 'export pagebreak | blocks fontfamily fontsize | bold italic underline strikethrough | forecolor backcolor | subscript superscript | alignleft aligncenter alignright alignjustify indent outdent rtl ltr | bullist numlist checklist | emoticons image table link hr charmap | code', // ضفت code هنا
  font_formats: 'Poppins=Poppins, sans-serif; Arial=arial,helvetica,sans-serif; Times New Roman=times new roman,times; Courier New=courier,monospace',

  height: 400,
  tinycomments_mode: 'embedded',
  tinycomments_author: 'Author name',
  directionality: 'rtl',
  mergetags_list: [
    { value: 'First.Name', title: 'First Name' },
    { value: 'Email', title: 'Email' }
  ],
  ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
});


 // {{-- --------------------------------------------------------------end textarea-------------------------------------------------------------------- --}}


  // {{-- --------------------------------------------------------------  fileupload-------------------------------------------------------------------- --}}


      function readURL(input) {
    const maxFiles = 4; // الحد الأقصى لعدد الصور المسموح بها
    const selectedFiles = Array.from(input.files); // تحويل الملفات إلى مصفوفة قابلة للتعديل

    // التحقق إذا كان عدد الملفات المرفوعة يتجاوز الحد الأقصى
    if (selectedFiles.length > maxFiles) {
        alert(`يمكنك رفع بحد أقصى ${maxFiles} صور فقط.`);
        input.value = ''; // إعادة تعيين المدخل إذا تجاوز الحد الأقصى
        $(".last").html(""); // مسح المحتوى السابق
        return; // الخروج من الدالة
    }

    // مسح المحتوى الحالي داخل العنصر ذو الصنف .last
    $(".last").html("");

    // التكرار على الملفات المرفوعة لعرضها
    selectedFiles.forEach((file, index) => {
        let reader = new FileReader();

        reader.onload = function (e) {
            let fileType = file.type; // الحصول على نوع الملف

            if (fileType.startsWith("image/")) {
                // إذا كان الملف صورة، عرض معاينة الصورة مع زر حذف
                $(".last").append(`
                    <div class="col-md-3 mb-3 position-relative" data-index="${index}">
                        <img src="${e.target.result}" class="img-fluid" alt="صورة للمعاينة">
                        <button style="left:10px" type="button" class="btn btn-danger btn-sm position-absolute top-0   m-2 delete-image"><i class="  bx bxs-trash"></i></button>
                    </div>
                `);
            }
        };

        // قراءة الملف وتحويله إلى رابط بيانات (Base64)
        reader.readAsDataURL(file);
    });

    // إضافة حدث للنقر على زر الحذف
    $(document).off('click', '.delete-image').on('click', '.delete-image', function () {
        let index = $(this).closest('.col-md-3').data('index'); // الحصول على الفهرس الخاص بالصورة
        $(this).closest('.col-md-3').remove(); // حذف الصورة من المعاينة

        // تحديث قائمة الملفات المرفوعة في input
        removeFileFromInput(input, index);
    });
}

// دالة لحذف الملف من input بناءً على الفهرس
function removeFileFromInput(input, indexToRemove) {
    const dt = new DataTransfer(); // إنشاء كائن DataTransfer فارغ
    const files = Array.from(input.files); // تحويل قائمة الملفات إلى مصفوفة

    // إعادة إنشاء قائمة الملفات بدون الملف المحدد
    files.forEach((file, index) => {
        if (index !== indexToRemove) {
            dt.items.add(file); // إضافة الملفات غير المحذوفة فقط
        }
    });

    // تعيين الملفات الجديدة إلى input
    input.files = dt.files;

    // إعادة تعيين الفهارس (data-index) للعناصر المرئية لتتوافق مع القائمة الجديدة
    $('.last .col-md-3').each((newIndex, element) => {
        $(element).attr('data-index', newIndex);
    });
}

  // {{-- --------------------------------------------------------------end fileupload-------------------------------------------------------------------- --}}








  // {{-- -------------------------------------------------------------- Delete-------------------------------------------------------------------- --}}


function data1(class_name) {
    var checkedLength = $('.' + class_name + ':checked').length;
    var totalLength = $('.' + class_name).length;

    console.log(checkedLength);

    if (checkedLength === totalLength) {
        // إذا تم تحديد الكل، حدد جميع الـ checkboxes
        $(".dt-checkboxes").prop("checked", true);
    } else if (checkedLength === 0) {
        // إذا لم يتم تحديد أي شيء، ألغِ تحديد الجميع
        $(".dt-checkboxes").prop("checked", false);
    }

    var selectedValues = [];

    $('.dt-checkboxes:checked').each(function () {
        selectedValues.push($(this).val());
    });

    $(".val").val(selectedValues);

    if (selectedValues.length > 0) {
        $(".de").show();
    } else {
        $(".de").hide();
    }
}






  function data(class_name){
    var filter=[];

    $('.'+class_name+':checked').each(function(){
      filter.push($(this).val())
    })
    $(".val").val(filter)
// console.log(filter)




  if (filter.length==0) {
       $(".de").hide()
       $(".all").prop("checked", false).prop("indeterminate", false);
    }else{
        $(".all").prop("checked", false).prop("indeterminate", true);
        $(".de").show()
    }



  }


  // {{-- --------------------------------------------------------------end Delete-------------------------------------------------------------------- --}}



// #################################################Select2 ###################################################################
$(function() {
      var e = $(".select2");
      if (e.length) {
          e.each(function() {
              var element = $(this);
              element.wrap('<div class="position-relative"></div>').select2({
                  placeholder: "Select value",
                  dropdownParent: element.parent()
              });
          });
      }
  });

// #################################################End Select2 ###################################################################





      </script>

{{-- --------------------------------------------------------------Alert-------------------------------------------------------------------- --}}


@if (session('success'))


<script>
    // إخفاء الرسالة بعد 5 ثوانٍ
    setTimeout(function() {
        var message = document.getElementById('success-message');
        if (message) {
            $(message).alert('close'); // استخدم jQuery لإخفاء الرسالة
        }
    }, 5000); // 5000 مللي ثانية = 5 ثوانٍ











</script> @endif


{{-- --------------------------------------------------------------End Alert-------------------------------------------------------------------- --}}





    @yield('footer')
  </body>


  <!-- Mirrored from demos.themeselection.com/sneat-bootstrap-html-admin-template/html/vertical-menu-template/app-ecommerce-dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 29 Mar 2024 15:39:42 GMT -->
  </html>

  <!-- beautify ignore:end -->
