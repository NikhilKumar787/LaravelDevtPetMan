<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 18,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 21,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 22,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 23,
                'title' => 'master_access',
            ],
            [
                'id'    => 24,
                'title' => 'customer_create',
            ],
            [
                'id'    => 25,
                'title' => 'customer_edit',
            ],
            [
                'id'    => 26,
                'title' => 'customer_show',
            ],
            [
                'id'    => 27,
                'title' => 'customer_delete',
            ],
            [
                'id'    => 28,
                'title' => 'customer_access',
            ],
            [
                'id'    => 29,
                'title' => 'setting_access',
            ],
            [
                'id'    => 30,
                'title' => 'country_create',
            ],
            [
                'id'    => 31,
                'title' => 'country_edit',
            ],
            [
                'id'    => 32,
                'title' => 'country_show',
            ],
            [
                'id'    => 33,
                'title' => 'country_delete',
            ],
            [
                'id'    => 34,
                'title' => 'country_access',
            ],
            [
                'id'    => 35,
                'title' => 'state_create',
            ],
            [
                'id'    => 36,
                'title' => 'state_edit',
            ],
            [
                'id'    => 37,
                'title' => 'state_show',
            ],
            [
                'id'    => 38,
                'title' => 'state_delete',
            ],
            [
                'id'    => 39,
                'title' => 'state_access',
            ],
            [
                'id'    => 40,
                'title' => 'city_create',
            ],
            [
                'id'    => 41,
                'title' => 'city_edit',
            ],
            [
                'id'    => 42,
                'title' => 'city_show',
            ],
            [
                'id'    => 43,
                'title' => 'city_delete',
            ],
            [
                'id'    => 44,
                'title' => 'city_access',
            ],
            [
                'id'    => 45,
                'title' => 'vendor_create',
            ],
            [
                'id'    => 46,
                'title' => 'vendor_edit',
            ],
            [
                'id'    => 47,
                'title' => 'vendor_show',
            ],
            [
                'id'    => 48,
                'title' => 'vendor_delete',
            ],
            [
                'id'    => 49,
                'title' => 'vendor_access',
            ],
            [
                'id'    => 50,
                'title' => 'sale_access',
            ],
            [
                'id'    => 51,
                'title' => 'product_create',
            ],
            [
                'id'    => 52,
                'title' => 'product_edit',
            ],
            [
                'id'    => 53,
                'title' => 'product_show',
            ],
            [
                'id'    => 54,
                'title' => 'product_delete',
            ],
            [
                'id'    => 55,
                'title' => 'product_access',
            ],
            [
                'id'    => 56,
                'title' => 'invoice_create',
            ],
            [
                'id'    => 57,
                'title' => 'invoice_edit',
            ],
            [
                'id'    => 58,
                'title' => 'invoice_show',
            ],
            [
                'id'    => 59,
                'title' => 'invoice_delete',
            ],
            [
                'id'    => 60,
                'title' => 'invoice_access',
            ],
            [
                'id'    => 61,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 62,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 63,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 64,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 65,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 66,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 67,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 68,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 69,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 70,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 71,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 72,
                'title' => 'task_create',
            ],
            [
                'id'    => 73,
                'title' => 'task_edit',
            ],
            [
                'id'    => 74,
                'title' => 'task_show',
            ],
            [
                'id'    => 75,
                'title' => 'task_delete',
            ],
            [
                'id'    => 76,
                'title' => 'task_access',
            ],
            [
                'id'    => 77,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 78,
                'title' => 'department_create',
            ],
            [
                'id'    => 79,
                'title' => 'department_edit',
            ],
            [
                'id'    => 80,
                'title' => 'department_show',
            ],
            [
                'id'    => 81,
                'title' => 'department_delete',
            ],
            [
                'id'    => 82,
                'title' => 'department_access',
            ],
            [
                'id'    => 83,
                'title' => 'company_create',
            ],
            [
                'id'    => 84,
                'title' => 'company_edit',
            ],
            [
                'id'    => 85,
                'title' => 'company_show',
            ],
            [
                'id'    => 86,
                'title' => 'company_delete',
            ],
            [
                'id'    => 87,
                'title' => 'company_access',
            ],
            [
                'id'    => 88,
                'title' => 'invoice_detail_create',
            ],
            [
                'id'    => 89,
                'title' => 'invoice_detail_edit',
            ],
            [
                'id'    => 90,
                'title' => 'invoice_detail_show',
            ],
            [
                'id'    => 91,
                'title' => 'invoice_detail_delete',
            ],
            [
                'id'    => 92,
                'title' => 'invoice_detail_access',
            ],
            [
                'id'    => 93,
                'title' => 'assigned_task_create',
            ],
            [
                'id'    => 94,
                'title' => 'assigned_task_edit',
            ],
            [
                'id'    => 95,
                'title' => 'assigned_task_show',
            ],
            [
                'id'    => 96,
                'title' => 'assigned_task_delete',
            ],
            [
                'id'    => 97,
                'title' => 'assigned_task_access',
            ],
            [
                'id'    => 98,
                'title' => 'assigned_task_detail_create',
            ],
            [
                'id'    => 99,
                'title' => 'assigned_task_detail_edit',
            ],
            [
                'id'    => 100,
                'title' => 'assigned_task_detail_show',
            ],
            [
                'id'    => 101,
                'title' => 'assigned_task_detail_delete',
            ],
            [
                'id'    => 102,
                'title' => 'assigned_task_detail_access',
            ],
            [
                'id'    => 103,
                'title' => 'term_create',
            ],
            [
                'id'    => 104,
                'title' => 'term_edit',
            ],
            [
                'id'    => 105,
                'title' => 'term_show',
            ],
            [
                'id'    => 106,
                'title' => 'term_delete',
            ],
            [
                'id'    => 107,
                'title' => 'term_access',
            ],
            [
                'id'    => 108,
                'title' => 'group_create',
            ],
            [
                'id'    => 109,
                'title' => 'group_edit',
            ],
            [
                'id'    => 110,
                'title' => 'group_show',
            ],
            [
                'id'    => 111,
                'title' => 'group_delete',
            ],
            [
                'id'    => 112,
                'title' => 'group_access',
            ],
            [
                'id'    => 113,
                'title' => 'user_address_create',
            ],
            [
                'id'    => 114,
                'title' => 'user_address_edit',
            ],
            [
                'id'    => 115,
                'title' => 'user_address_show',
            ],
            [
                'id'    => 116,
                'title' => 'user_address_delete',
            ],
            [
                'id'    => 117,
                'title' => 'user_address_access',
            ],
            [
                'id'    => 118,
                'title' => 'team_create',
            ],
            [
                'id'    => 119,
                'title' => 'team_edit',
            ],
            [
                'id'    => 120,
                'title' => 'team_show',
            ],
            [
                'id'    => 121,
                'title' => 'team_delete',
            ],
            [
                'id'    => 122,
                'title' => 'team_access',
            ],
            [
                'id'    => 123,
                'title' => 'account_type_create',
            ],
            [
                'id'    => 124,
                'title' => 'account_type_edit',
            ],
            [
                'id'    => 125,
                'title' => 'account_type_show',
            ],
            [
                'id'    => 126,
                'title' => 'account_type_delete',
            ],
            [
                'id'    => 127,
                'title' => 'account_type_access',
            ],
            [
                'id'    => 128,
                'title' => 'account_name_create',
            ],
            [
                'id'    => 129,
                'title' => 'account_name_edit',
            ],
            [
                'id'    => 130,
                'title' => 'account_name_show',
            ],
            [
                'id'    => 131,
                'title' => 'account_name_delete',
            ],
            [
                'id'    => 132,
                'title' => 'account_name_access',
            ],
            [
                'id'    => 133,
                'title' => 'category_create',
            ],
            [
                'id'    => 134,
                'title' => 'category_edit',
            ],
            [
                'id'    => 135,
                'title' => 'category_show',
            ],
            [
                'id'    => 136,
                'title' => 'category_delete',
            ],
            [
                'id'    => 137,
                'title' => 'category_access',
            ],
            [
                'id'    => 138,
                'title' => 'terms_andcondition_create',
            ],
            [
                'id'    => 139,
                'title' => 'terms_andcondition_edit',
            ],
            [
                'id'    => 140,
                'title' => 'terms_andcondition_show',
            ],
            [
                'id'    => 141,
                'title' => 'terms_andcondition_delete',
            ],
            [
                'id'    => 142,
                'title' => 'terms_andcondition_access',
            ],
            [
                'id'    => 143,
                'title' => 'sub_task_create',
            ],
            [
                'id'    => 144,
                'title' => 'sub_task_edit',
            ],
            [
                'id'    => 145,
                'title' => 'sub_task_show',
            ],
            [
                'id'    => 146,
                'title' => 'sub_task_delete',
            ],
            [
                'id'    => 147,
                'title' => 'sub_task_access',
            ],
            [
                'id'    => 148,
                'title' => 'assigned_sub_task_create',
            ],
            [
                'id'    => 149,
                'title' => 'assigned_sub_task_edit',
            ],
            [
                'id'    => 150,
                'title' => 'assigned_sub_task_show',
            ],
            [
                'id'    => 151,
                'title' => 'assigned_sub_task_delete',
            ],
            [
                'id'    => 152,
                'title' => 'assigned_sub_task_access',
            ],
            [
                'id'    => 153,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
