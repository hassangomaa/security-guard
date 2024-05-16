<?php

return [

    'fee' => [
        'title_singular' => 'رسوم',
        'title'          => 'الرسوم',
        'title_plural'   => 'الرسوم',
        'fields'         => [
            'fee_type' => 'نوع الرسوم',
            'fee_type_helper' => ' ',
            'person' => 'الشخص',
            'person_helper' => 'الشخص الذي يتم دفع الرسوم لأجله',
            'id'                => 'المعرف',
            'id_helper'         => ' ',
            'name'              => 'الاسم',
            'name_helper'       => ' ',
            'description'       => 'الوصف',
            'description_helper' => ' ',
            'fee_type_id'       => 'نوع الرسوم',
            'fee_type_id_helper' => ' ',
            'fee_type_other'    => 'نوع الرسوم (غير المحدد)',
            'fee_type_other_helper' => ' ',
            'person_id'         => 'الشخص',
            'person_id_helper'  => 'الشخص الذي يتم دفع الرسوم لأجله',
            'amount'            => 'المبلغ',
            'amount_helper'     => ' ',
            'due_date'          => 'تاريخ الاستحقاق',
            'due_date_helper'   => ' ',
            'issue_date'        => 'تاريخ الإصدار',
            'issue_date_helper' => 'تاريخ إصدار الدفعة',
            'created_at'        => 'تاريخ الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'تاريخ التحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تاريخ الحذف',
            'deleted_at_helper' => ' ',
        ],
    ],


    'familyBranch' => [
        'title'          => 'الفروع العائلية',
        'title_singular' => 'فرع عائلي',
        'title_plural'   => 'الفروع العائلية',
        'fields'         => [
            'id'                => 'الرقم التعريفي',
            'id_helper'         => ' ',
            'name'              => 'الاسم',
            'name_helper'       => ' ',
            'description'       => 'الوصف',
            'description_helper' => ' ',
            'family'            => 'العائلة',
            'family_helper'     => ' ',
            'created_at'        => 'تاريخ الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'تاريخ التحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تاريخ الحذف',
            'deleted_at_helper' => ' ',
        ],
    ],


    'family' => [
        // 'title'          => 'الأسر',
        // 'title_singular' => 'الأسرة',
        // العائلات
        'title_singular' => 'عائلة',
        'title'         => 'العائلات',
        'title_plural'   => 'العائلات',
        // 'title_plural'   => 'الأسر',
        'fields'         => [
            'id'                => 'المعرف',
            'id_helper'         => ' ',
            'name'              => 'الاسم',
            'name_helper'       => ' ',
            'description'       => 'الوصف',
            'description_helper' => ' ',
            'created_at'        => 'تاريخ الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'تاريخ التحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تاريخ الحذف',
            'deleted_at_helper' => ' ',
        ],
    ],


    'person' => [
        'title'          => 'الأشخاص',
        'title_singular' => 'شخص',
        'title_plural'   => 'الأشخاص',
        'fields'         => [
            'family_branch' => 'الفرع العائلي',
            'family_branch_helper' => ' ',

            'family_branch_id' => 'الفرع العائلي',
            'family_branch_id_helper' => ' ',

            'family_id' => 'العائلة',
            'family_id_helper' => ' ',

            'family' => 'العائلة',
            'family_helper' => ' ',
            'phone' => 'الهاتف',
            'phone_helper' => ' ',
            'phone2' => 'الهاتف 2',
            'phone2_helper' => ' ',
            'birth_date' => 'تاريخ الميلاد',
            'birth_date_helper' => ' ',
            'address' => 'العنوان',
            'address_helper' => ' ',
            'death_date' => 'تاريخ الوفاة',
            'death_date_helper' => ' ',
            'relationship_status' => 'حالة العلاقة',
            'relationship_status_helper' => ' ',
            'paying_bank' => 'البنك المستحق',
            'paying_bank_helper' => ' ',
            'parent' => 'الأبوين',
            'parent_helper' => ' ',

            'id'                => 'الرقم المعرف',
            'id_helper'         => ' ',
            'name'              => 'الاسم',
            'name_helper'       => ' ',
            'children'          => 'الأبناء',
            'children_helper'   => ' ',
            'created_at'        => 'تاريخ الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'تاريخ التحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تاريخ الحذف',
            'deleted_at_helper' => ' ',
            // Added relationship status translations
            'relationship_status_single'   => 'أعزب',
            'relationship_status_married'  => 'متزوج',
            'relationship_status_divorced' => 'مطلق',
            'relationship_status_widowed'  => 'أرمل',
        ],
    ],


    'notification' => [
        'title'          => 'الإشعارات',
        'title_singular' => 'إشعار',
        'title_plural' => 'الإشعارات',
        'fields'         => [
            'mark_as_read' => 'تحديد كمقروء',
            'id'                => 'الرقم المعرف',
            'id_helper'         => ' ',
            'title'             => 'العنوان',
            'title_helper'      => ' ',
            'content'           => 'المحتوى',
            'content_helper'    => ' ',
            'user'              => 'المستخدم',
            'user_helper'       => ' ',
            'read_at'           => 'تم القراءة في',
            'read_at_helper'    => ' ',
            'read'              => 'تم القراءة',
            'read_helper'       => ' ',
            'created_at'        => 'تاريخ الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'تاريخ التحديث',
            'updated_at_helper' => ' ',
        ],
    ],

    'order' => [
        'create' => 'إنشاء',
        'update' => 'تحديث',
        'delete' => 'حذف',
        'edit' => 'تحرير',

        'order_status_pending' => 'قيد الانتظار',
        'order_status_completed' => 'مكتمل',

        'payment_method_cash' => 'نقداً',
        'payment_method_card' => 'بطاقة',

        'title'          => 'الطلبات',
        'title_singular' => 'طلب',
        'title_plural'   => 'الطلبات',
        'fields'         => [
            'user_id_helper'   => ' ',
            'id'                => 'الرقم الهويّ',
            'id_helper'         => ' ',
            'user_id'           => 'المستخدم',
            'total_amount'      => 'المبلغ الإجمالي',
            'status'            => 'الحالة',
            'payment_method'    => 'طريقة الدفع',
            'latitude'          => 'خط العرض',
            'longitude'         => 'خط الطول',
            'address'           => 'العنوان',
            'customer_name'     => 'اسم العميل',
            'created_at'        => 'تاريخ الإنشاء',
            'updated_at'        => 'تاريخ التحديث',
            'deleted_at'        => 'تاريخ الحذف',
            'status_helper'     => ' ',
            'total_amount_helper' => ' ',
            'payment_method_helper' => ' ',
            'latitude_helper'   => ' ',
            'longitude_helper'  => ' ',
            'address_helper'    => ' ',
            'customer_name_helper' => ' ',
            'order_number'      => 'رقم الطلب',
            'order_date'        => 'تاريخ الطلب',
            'service_provider'  => 'مزود الخدمة',
            'service_provider_helper' => ' ',
            'order_number_helper' => ' ',
            'order_date_helper' => ' ',
            'customer'          => 'العميل',
            'customer_helper'   => ' ',
            'address_url'      => 'رابط العنوان',
        ],
    ],


    'payment' => [
        'create' => 'إنشاء',
        'update' => 'تحديث',
        'delete' => 'حذف',
        'edit' => 'تعديل',
        'Payment Method' => 'طريقة الدفع',

        'payment_status_pending' => 'معلقة',
        'payment_status_paid' => 'تم الدفع',
        'payment_status_in_grace_period' => 'في فترة سماح',
        'payment_status_failed' => 'فشلت',
        'payment_status_cancelled' => 'ملغاة',
        'payment_status_refunded' => 'تم استردادها',
        'payment_status_completed' => 'مكتملة',
        'method_stripe' => 'بطاقة ائتمان (Stripe)',
        'method_paypal' => 'باي بال (Paypal)',
        'method_cash' => 'نقداً',
        'payment_status' => [
            '0' => 'غير مدفوع',
            '1' => 'مدفوع',
            '2' => 'في فترة سماح',
        ],


        'method' => [
            '1' => 'كاش',
            '2' => 'باي بال',
            '3' => 'سترايب',
        ],





        'title'          => 'المدفوعات',
        'title_singular' => 'مدفوعات',
        'title_plural' => 'المدفوعات',
        'fields'         => [

            'image' => 'الصورة',
            'cash' => 'كاش',
            'credit' => 'بطاقة ائتمان',
            'cheque' => 'شيك',
            'Payment Method' => 'طريقة الدفع',
            'payment_method' => 'طريقة الدفع',
            'id'                => 'الرقم المعرف',
            'id_helper'         => ' ',
            'owner'             => 'المالك',
            'owner_helper'      => ' ',
            'service_provider'  => 'مزود الخدمة',
            'service_provider_helper' => ' ',
            'bill_number'       => 'رقم الفاتورة',
            'bill_number_helper' => ' ',
            'due_date'          => 'تاريخ الاستحقاق',
            'due_date_helper'   => ' ',
            'value'             => 'القيمة',
            'value_helper'      => ' ',
            'status'            => 'الحالة',
            'status_helper'     => ' ',
            'number_of_days'    => 'عدد الأيام',
            'number_of_days_helper' => ' ',
            'guard'             => 'الحراسة',
            'guard_helper'      => ' ',
            'created_at'        => 'تاريخ الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'تاريخ التحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تاريخ الحذف',
            'deleted_at_helper' => ' ',
            'id' => 'المعرف',
            'payment_id' => 'معرف الدفع',
            'owner_id' => 'معرف المالك',
            'guard' => 'الحارس',
            'payer_id' => 'معرف المدفوع',
            'payer_email' => 'بريد المدفوع',
            'bill_id' => 'معرف الفاتورة',
            'amount' => 'المبلغ',
            'currency' => 'العملة',
            'payment_status' => 'حالة الدفع',
            'method' => 'الطريقة',
        ],
    ],
    'bill' => [
        'title'          => 'الفواتير',
        'title_singular' => 'فاتورة',
        'title_plural' => 'الفواتير',
        'fields'         => [


            'amount' => 'المبلغ',

            'person_id' => 'معرف الشخص',
            'person_id_helper' => ' ',

            'person' => 'الشخص',
            'person_helper' => ' ',

            'fee' => 'الرسوم',
            'fee_helper' => ' ',

            'fee_id' => 'معرف الرسوم',
            'fee_id_helper' => ' ',
            'next' => 'التالي',
            'details' => 'التفاصيل',
            'owner_id' => 'معرف المالك',
            'paid' => 'المدفوع',
            'unpaid' => 'غير مدفوع',
            'partially_paid' => 'مدفوع جزئياً',
            'id'                => 'الرقم المعرف',
            'id_helper'         => ' ',
            'owner'             => 'المالك',
            'owner_helper'      => ' ',
            'service_provider'  => 'مزود الخدمة',
            'service_provider_helper' => ' ',
            'bill_number'       => 'رقم الفاتورة',
            'bill_number_helper' => ' ',
            'due_date'          => 'تاريخ الاستحقاق',
            'due_date_helper'   => ' ',
            'value'             => 'القيمة',
            'value_helper'      => ' ',
            'status'            => 'الحالة',
            'status_helper'     => ' ',
            'number_of_days'    => 'عدد الأيام',
            'number_of_days_helper' => ' ',
            'guard'             => 'الحراسة',
            'guard_helper'      => ' ',
            'created_at'        => 'تاريخ الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'تاريخ التحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تاريخ الحذف',
            'deleted_at_helper' => ' ',
        ],
    ],

    'footer_content'
    => [
        'title'          => 'محتوى التذييل',
        'title_singular' => 'محتوى التذييل',
        'title_plural' => 'محتوى التذييل',
        'fields'         => [
            'id'                => 'الرقم المعرف',
            'id_helper'         => ' ',
            'title'             => 'العنوان',
            'title_helper'      => ' ',
            'icon'              => 'الأيقونة',
            'icon_helper'       => ' ',
            'link'              => 'الرابط',
            'link_helper'       => ' ',
            'social_media'      => 'وسائل التواصل الاجتماعي',
            'social_media_helper' => ' ',
            'created_at'        => 'تاريخ الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'تاريخ التحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تاريخ الحذف',
            'deleted_at_helper' => ' ',
        ],
    ],
    'userManagement' => [
        'title'          => 'إدارة العملاء',
        'title_singular' => 'إدارة العملاء',
        'cars'           => 'السيارات'
    ],
    'companyManagement' => [
        'title'          => 'إدارة الشركات',
        'title_singular' => 'إدارة الشركات',
    ],
    'permission' => [
        'title'          => 'الصلاحيات',
        'title_singular' => 'صلاحية',
        'fields'         => [
            'id'                => 'الرقم المعرف',
            'id_helper'         => ' ',
            'title'             => 'العنوان',
            'title_helper'      => ' ',
            'created_at'        => 'تاريخ الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'تاريخ التحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تاريخ الحذف',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'الأدوار',
        'title_singular' => 'دور',
        'fields'         => [
            'id'                 => 'الرقم المعرف',
            'id_helper'          => ' ',
            'title'              => 'العنوان',
            'title_helper'       => ' ',
            'permissions'        => 'الصلاحيات',
            'permissions_helper' => ' ',
            'created_at'         => 'تاريخ الإنشاء',
            'created_at_helper'  => ' ',
            'updated_at'         => 'تاريخ التحديث',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'تاريخ الحذف',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'العملاء',
        'title_singular' => 'مستخدم',
        'fields'         => [
            'avatar'                  => 'الصورة',
            'id'                       => 'الرقم المعرف',
            'id_helper'                => ' ',
            'name'                     => 'الاسم',
            'name_helper'              => ' ',
            'email'                    => 'البريد الإلكتروني',
            'email_helper'             => ' ',
            'email_verified_at'        => 'تم التحقق من البريد الإلكتروني في',
            'email_verified_at_helper' => ' ',
            'password'                 => 'كلمة المرور',
            'password_helper'          => ' ',
            'roles'                    => 'الأدوار',
            'roles_helper'             => ' ',
            'remember_token'           => 'رمز التذكير',
            'remember_token_helper'    => ' ',
            'created_at'               => 'تاريخ الإنشاء',
            'created_at_helper'        => ' ',
            'updated_at'               => 'تاريخ التحديث',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'تاريخ الحذف',
            'deleted_at_helper'        => ' ',
            'phone'                    => 'رقم الهاتف',
            'phone_helper'             => ' ',
            'adress'                   => 'العنوان',
            'adress_helper'            => ' ',
            'date_of_birth'           => 'تاريخ الميلاد',
            'profile_image'           => 'صورة الملف الشخصي',
            'national_id'          => 'الرقم القومي',
            'active'         => 'الحالة',
            'inactive'        => 'غير مفعل',
            'status'       => 'الحالة',
            'language_helper'      => ' ',
            'emirate_city_helper'  => '',
            'nationality_helper' => '',
            'date_of_birth_helper' => '',
            'profile_image_helper' => '',
            'national_id_helper' => '',


        ],
    ],

    'company' => [

        'title_plural' => 'الشركات',
        'title_singular' => 'شركة',
        'fields' => [
            'password_helper' => '',
            'id' => 'الرقم',
            'company_name' => 'اسم الشركة',
            'email' => 'البريد الإلكتروني',
            'password' => 'كلمة المرور',
            'responsible_person' => 'الشخص المسؤول',
            'role' => 'الدور',
            'phone' => 'الهاتف',
            'created_at' => 'تاريخ الإنشاء',
            'registrationType' => 'نوع التسجيل',
            'emirate_city' => 'الإمارة/المدينة',
            'professional_license' => 'الرخصة المهنية',
            'profile_image' => 'صورة الملف الشخصي',
            'language' => 'اللغة',
            'date_of_birth' => 'تاريخ الميلاد',
            'active' => 'الحالة',
            'activeon' => 'مفعل',
            'inactive' =>  'غير مفعل',
        ],
        'list' => 'قائمة',
        'actions' => 'إجراءات',
        'search' => 'بحث',
        'back_to_list' => 'العودة إلى القائمة',
        'areYouSure' => 'هل أنت متأكد؟',
        'delete' => 'حذف',
        'zero_selected' => 'لم يتم تحديد أي صفوف',
        'datatables' => [
            'delete' => 'حذف المحدد',
        ],
        'update_success' => 'تم التحديث بنجاح',
        'create_success' => 'تم الإنشاء بنجاح',


    ],

    'contact' =>
    [
        'title' => 'الرسائل',
        'title_singular' => 'رسالة',
        'title_plural' => 'الرسائل',
        'fields' => [
            'name_helper' => '',
            'email_helper' => '',
            'subject_helper' => '',
            'message_helper' => '',
            'id' => 'الرقم المعرف',
            'name' => 'الاسم',
            'email' => 'البريد الإلكتروني',
            'subject' => 'الموضوع',
            'message' => 'الرسالة',
            'created_at' => 'تاريخ الإنشاء',
            'updated_at' => 'تاريخ التحديث',
            'deleted_at' => 'تاريخ الحذف',
        ],
    ],
    'comment' => [
        'title'          => 'التعليقات',
        'title_singular' => 'تعليق',
        'title_plural' =>  'التعليقات',
        'fields'         => [
            'owner' => 'المالك',

            'content' =>  'المحتوى',
            'id'                => 'الرقم المعرف',
            'id_helper'         => ' ',
            'comment'      => 'نص التعليق',
            'comment_helper' => ' ',
            'post'              => 'المنشور',
            'post_helper'       => ' ',
            'user'              => 'المستخدم',
            'user_helper'       => ' ',
            'created_at'        => 'تاريخ الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'تاريخ التحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تاريخ الحذف',
            'deleted_at_helper' => ' ',
            'comment_image'   => 'صورة التعليق',
            'comment_image_helper' => ' ',
            'details'  => 'التفاصيل',

        ],
    ],
    'post' => [
        'title'          => 'المنشورات',
        'title_singular' => 'منشور',
        'title_plural' => 'المنشورات',
        'fields' => [
            'actions' => 'الإجراءات',
            'guard' => 'الحراسة',
            'company' => 'الشركة',
            'web' => 'المستخدم',
            'registration_types' => 'أنواع التسجيل',
            'id'                => 'الرقم المعرف',
            'id_helper'         => ' ',
            'title'             => 'العنوان',
            'title_plural'     => 'العناوين',
            'title_helper'      => ' ',
            'content'           => 'المحتوى',
            'content_helper'    => ' ',
            'category'          => 'الفئة',
            'category_helper'   => ' ',
            'tag'               => 'الوسم',
            'tag_helper'        => ' ',
            'post_image'        => 'الملف المرفق',
            'post_image_helper' => ' ',
            'created_by'        => 'تم الإنشاء بواسطة',
            'created_by_helper' => ' ',
            'created_at'        => 'تاريخ الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'تاريخ التحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تاريخ الحذف',
            'deleted_at_helper' => ' ',
            'status'            => 'الحالة',
            'status_helper'     => ' ',
            'comments'          => 'التعليقات',
            'comments_helper'   => ' ',
            'likes'             => 'الإعجابات',
            'likes_helper'      => ' ',
            'views'             => 'المشاهدات',
            'views_helper'      => ' ',
            'slug'              => 'الرابط',
            'slug_helper'       => ' ',
            'meta_title'        => 'عنوان البحث',
            'meta_title_helper' => ' ',
            'meta_desc'         => 'وصف البحث',
            'meta_desc_helper'  => ' ',
            'meta_keywords'     => 'الكلمات الدلالية',
            'meta_keywords_helper' => ' ',
            'meta_img'          => 'صورة البحث',
            'meta_img_helper'   => ' ',
            'meta_img_title'    => 'عنوان الصورة',
            'meta_img_title_helper' => ' ',
            'meta_img_alt'      => 'وصف الصورة',
            'price'            => 'السعر',

            'title'           => 'العنوان',
            'details'         => 'التفاصيل',
        ],

    ],


    'product' => [
        'title'          => 'المنتجات',
        'title_singular' => 'المنتج',
        'fields'         => [
            'id'                => 'الرقم المعرف',
            'id_helper'         => ' ',
            'seller'            => 'البائع',
            'seller_helper'     => ' ',
            'title'             => 'العنوان',
            'title_helper'      => ' ',
            'price'             => 'السعر',
            'price_helper'      => ' ',
            'created_at'        => 'تاريخ الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'تاريخ التحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تاريخ الحذف',
            'deleted_at_helper' => ' ',
            'created_by'        => 'تم الإنشاء بواسطة',
            'created_by_helper' => ' ',
            'category'          => 'الفئة',
            'category_helper'   => ' ',
            'best'              => 'الأفضل',
            'best_helper'       => ' ',
            'featured'          => 'المميز',
            'featured_helper'   => ' ',
            'hgg'               => 'Hgg',
            'hgg_helper'        => ' ',
            'name'              => 'الاسم', // New translation for product name
            'name_helper'       => ' ',
            'quantity'          => 'الكمية', // New translation for product quantity
            'quantity_helper'   => ' ',
            'size'              => 'الحجم', // New translation for product size
            'size_helper'       => ' ',
            'status'            => 'الحالة', // New translation for product status
            'status_helper'     => ' ',
            'image'             => 'الصورة',
            'image_helper'      => ' ',
            'size_small'        => 'صغير', // New translation for product size
            'size_medium'       => 'متوسط', // New translation for product size
            'size_large'        => 'كبير', // New translation for product size
            'active'            => 'نشط',
            'inactive'          => 'غير نشط',
        ],
    ],

    'category' => [
        'title'          => 'الفئات',
        'title_singular' => 'فئة',
        'fields'         => [
            'id'                => 'الرقم المعرف',
            'id_helper'         => '',
            'name'              => 'الاسم',
            'name_helper'       => '',
            'created_at'        => 'تاريخ الإنشاء',
            'created_at_helper' => '',
            'updated_at'        => 'تاريخ التحديث',
            'updated_at_helper' => '',
            'deleted_at'        => 'تاريخ الحذف',
            'deleted_at_helper' => '',
            'created_by'        => 'تم الإنشاء بواسطة',
            'created_by_helper' => '',
            'image'             => 'الصورة',
            'image_helper'      => '',
            'color'             => 'اللون',
            'color_helper'      => '',
            'status'            => 'الحالة',
            'status_helper'     => '',
            'active' => 'مفعل',
            'inactive' => 'غير مفعل',

        ],
    ],


    'detail' => [
        'title'          => 'التفاصيل',
        'title_singular' => 'تفصيل',
        'fields'         => [
            'id'                => 'الرقم المعرف',
            'id_helper'         => ' ',
            'value'             => 'القيمة',
            'value_helper'      => ' ',
            'created_at'        => 'تاريخ الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'تاريخ التحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تاريخ الحذف',
            'deleted_at_helper' => ' ',
            'product'           => 'المنتج',
            'product_helper'    => ' ',
            'variation'         => 'التباين',
            'variation_helper'  => ' ',
        ],
    ],
    'variation' => [
        'title'          => 'التباين',
        'title_singular' => 'تباين',
        'fields'         => [
            'id'                => 'الرقم المعرف',
            'id_helper'         => ' ',
            'name'              => 'الاسم',
            'name_helper'       => ' ',
            'created_at'        => 'تاريخ الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'تاريخ التحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تاريخ الحذف',
            'deleted_at_helper' => ' ',
            'name_ar'           => 'الاسم بالعربية',
            'name_ar_helper'    => ' ',
            'category'          => 'الفئة',
            'category_helper'   => ' ',
        ],
    ],
    'service' => [
        'title'          => 'الخدمة',
        'title_singular' => 'خدمة',
        'fields'         => [
            'id'                => 'الرقم المعرف',
            'id_helper'         => ' ',
            'phone'             => 'الهاتف',
            'phone_helper'      => ' ',
            'created_at'        => 'تاريخ الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'تاريخ التحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تاريخ الحذف',
            'deleted_at_helper' => ' ',
        ],
    ],
    'image' => [
        'title'          => 'الصور',
        'title_singular' => 'صورة',
        'fields'         => [
            'id'                => 'الرقم المعرف',
            'id_helper'         => ' ',
            'product'           => 'المنتج',
            'product_helper'    => ' ',
            'photo'             => 'الصورة',
            'photo_helper'      => ' ',
            'created_at'        => 'تاريخ الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'تاريخ التحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تاريخ الحذف',
            'deleted_at_helper' => ' ',
        ],
    ],
    'brand' => [
        'title'          => 'العلامة التجارية',
        'title_singular' => 'علامة تجارية',
        'fields'         => [
            'id'                => 'الرقم المعرف',
            'id_helper'         => ' ',
            'name'              => 'الاسم بالإنجليزية',
            'name_ar'              => 'الاسم بالعربية',
            'name_helper'       => ' ',
            'created_at'        => 'تاريخ الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'تاريخ التحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تاريخ الحذف',
            'deleted_at_helper' => ' ',
            'created_by'        => 'تم الإنشاء بواسطة',
            'created_by_helper' => ' ',
        ],
    ],
    'modeel' => [
        'title'          => 'الموديل',
        'title_singular' => 'موديل',
        'fields'         => [
            'id'                => 'الرقم المعرف',
            'id_helper'         => ' ',
            'name'              => 'الاسم بالإنجليزية',
            'name_ar'              => 'الاسم بالعربية',
            'name_helper'       => ' ',
            'brand'             => 'العلامة التجارية',
            'brand_helper'      => ' ',
            'created_at'        => 'تاريخ الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'تاريخ التحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تاريخ الحذف',
            'deleted_at_helper' => ' ',
        ],
    ],
    'year' => [
        'title'          => 'السنة',
        'title_singular' => 'سنة',
        'fields'         => [
            'id'                => 'الرقم المعرف',
            'id_helper'         => ' ',
            'year'              => 'السنة',
            'year_helper'       => ' ',
            'category'          => 'الفئة',
            'category_helper'   => ' ',
            'created_at'        => 'تاريخ الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'تاريخ التحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تاريخ الحذف',
            'deleted_at_helper' => ' ',
        ],
    ],
    'engineCapacityCc' => [
        'title'          => 'سعة المحرك CC',
        'title_singular' => 'سعة المحرك CC',
        'fields'         => [
            'id'                        => 'الرقم المعرف',
            'id_helper'                 => ' ',
            'engine_capacity_cc'        => 'سعة المحرك CC',
            'engine_capacity_cc_helper' => ' ',
            'created_at'                => 'تاريخ الإنشاء',
            'created_at_helper'         => ' ',
            'updated_at'                => 'تاريخ التحديث',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'تاريخ الحذف',
            'deleted_at_helper'         => ' ',
        ],
    ],
];