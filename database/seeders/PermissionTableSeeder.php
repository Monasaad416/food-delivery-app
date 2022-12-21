<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // 'roles-list',
            // 'role-create',
            // 'role-edit',
            // 'role-delete',
            // 'role-show',

            // 'users-list',
            // 'user-create',
            // 'user-edit',
            // 'user-delete',

            // 'cities-list',
            // 'city-create',
            // 'city-edit',
            // 'city-delete',

            // 'regions-list',
            // 'region-create',
            // 'region-edit',
            // 'region-delete',

            // 'categories-list',
            // 'category-create',
            // 'category-edit',
            // 'category-delete',

            // 'orders-list',
            // 'order-create',
            // 'order-edit',
            // 'order-delete',
            // 'order-show',

            // 'restaurants-list',
            // 'restaurant-create',
            // 'restaurant-edit',
            // 'restaurant-delete',
            // 'restaurant-show',
            // 'restaurant-toggle-availability',

            // 'banks-list',
            // 'bank-create',
            // 'bank-edit',
            // 'bank-delete',
            // 'bank-show',

            // 'payment_methods-list',
            // 'payment_method-create',
            // 'payment_method-edit',
            // 'payment_method-delete',
            // 'payment_method-show',

            // 'commissions-list',
            // 'commission-create',
            // 'commission-edit',
            // 'commission-delete',
            // 'commission-show',

            // 'messages-list',
            // 'message-delete',
            // 'message-show',


            // 'clients-list',
            // 'client-delete',
            // 'client-toggle-status',

            // 'setting-edit',


            'قائمة-الوظائف',
            'إضافة-وظيفة',
            'تعديل-الوظيفة',
            'حذف-الوظيفة',
            'عرض-الوظيفة',

            'قائمة-المستخدمين',
            'إضافة-مستخدم',
            'تعديل-المستخدم',
            'حذف-المستخدم',

            'قائمة-المحافظات',
            'إضافة-محافظة',
            'تعديل-المحافظة',
            'حذف-المحافظة',
            'عرض-المحافظة',

            'قائمة-المناطق',
            'إضافة-منطقة',
            'تعديل-المنطقة',
            'حذف-المنطقة',
            'عرض-المنطقة',

            'قائمة التصنيفات',
            'إضافة-تصنيف',
            'تعديل-التصنيف',
            'حذف-التصنيف',

            'قائمة-الطلبات',
            'حذف-الطلب',
            'عرض-الطلب',

            'قائمة-المطاعم',
            'حذف-المطعم',
            'عرض-المطعم',
            'تغيير-حالة-المطعم',
            'طلبات-المطعم',
            'كشف-حساب',

            'قائمة-البنوك',
            'إضافة-بنك',
            'تعديل-البنك',
            'حذف-البنك',


            'قائمة-طرق-الدفع',
            'إضافة-طريقة-دفع',
            'تعديل-طريقة-الدفع',
            'حذف-طريقة-الدفع',

    
            'قائمة-العمولات',
            'إضافة-عمولة',
            'تعديل-العمولة',
            'حذف-العمولة',

            'قائمة-الرسائل',
            'حذف-رسالة',
            'عرض-رسالة',


            'قائمة-العملاء',
            'حذف-العميل',
            'تغيير-حالة-العميل',

            'تعديل-الإعدادات',
            'قائمة-العروض',
            
       



        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
