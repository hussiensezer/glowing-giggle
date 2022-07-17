<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            /*
             * Category Item Permission
            */
            'category_item_access', 'category_item_create', 'category_item_edit', 'category_item_filter',
            'category_item_delete', 'category_item_status', 'category_item_export',

            /*
             * Category Item Permission
            */
            'category_product_access', 'category_product_create', 'category_product_edit', 'category_product_filter',
            'category_product_delete', 'category_product_status', 'category_product_export',


            /*
             *  Item Permission
            */
            'item_access', 'item_create', 'item_edit', 'item_filter',
            'item_delete', 'item_status', 'item_export', 'item_deposit', 'item_withdrew',

            /*
             *  Product Permission
            */
            'product_access', 'product_create', 'product_edit', 'product_filter',
            'product_delete', 'product_status', 'product_export', 'product_deposit', 'product_withdrew',

             /*
              * Transaction Inventory Permission
             */
            'transaction_access', 'transaction_withdrew', 'transaction_deposit' , 'transaction_filter', 'transaction_export',

            /*
             * Reports Permission
            */
            'report_access', 'report_filter', 'report_export',

            /*
             * Setting Permission
            */
            'setting_access','setting_manual_withdrew', 'setting_limit_alert', 'setting_prefix_code',

            /*
             * Attributes Permission
            */
            'attribute_access', 'attribute_create', 'attribute_edit', 'attribute_delete',

            /*
             * Measurement Permission
            */
            'measurement_access', 'measurement_create', 'measurement_edit', 'measurement_delete',

            /*
             * ManufacturingProcess Permission
            */
            'manufacturingProcess_access', 'manufacturingProcess_create', 'manufacturingProcess_edit', 'manufacturingProcess_delete',

            /*
             * User Permission
            */
            'user_access', 'user_create', 'user_edit', 'user_status', 'user_role', 'user_delete',

            /*
             * Role Permission
            */
            'role_access', 'role_create', 'role_edit', 'role_delete',







        ];// End Permissions

        foreach ($permissions as $permission) {
            Permission::create([
                'name'          => $permission,
                'guard_name'    => 'users'
            ]);
        }
        $superAdmin =  Role::create([
            'name'          => 'Super Admin',
            'guard_name'    => 'users' // Dah 3al 7sab al guard name aly fe config auth
        ]);

        foreach ($permissions as $permission) {
            $superAdmin->givePermissionTo($permission);
        }
    }
}
