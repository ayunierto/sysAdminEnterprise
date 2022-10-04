<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create([
            'name' => 'Master'
        ]);
        $role2 = Role::create([
            'name' => 'Admin'
        ]);
        $role3 = Role::create([
            'name' => 'Seller'
        ]);

        Permission::create(['name' => 'companies.index']);
        Permission::create(['name' => 'companies.create']);
        Permission::create(['name' => 'companies.store']);
        Permission::create(['name' => 'companies.update']);
        Permission::create(['name' => 'companies.destroy']);

        Permission::create(['name' => 'measures.index']);
        Permission::create(['name' => 'measures.create']);
        Permission::create(['name' => 'measures.store']);
        Permission::create(['name' => 'measures.update']);
        Permission::create(['name' => 'measures.destroy']);

        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.store']);
        Permission::create(['name' => 'users.update']);
        Permission::create(['name' => 'users.destroy']);

        Permission::create(['name' => 'coins.index']);
        Permission::create(['name' => 'coins.create']);
        Permission::create(['name' => 'coins.store']);
        Permission::create(['name' => 'coins.update']);
        Permission::create(['name' => 'coins.destroy']);

        Permission::create(['name' => 'paymentMethods.index']);
        Permission::create(['name' => 'paymentMethods.create']);
        Permission::create(['name' => 'paymentMethods.store']);
        Permission::create(['name' => 'paymentMethods.update']);
        Permission::create(['name' => 'paymentMethods.destroy']);
        
        Permission::create(['name' => 'customizers.index']);
        Permission::create(['name' => 'customizers.create']);
        Permission::create(['name' => 'customizers.store']);
        Permission::create(['name' => 'customizers.update']);
        Permission::create(['name' => 'customizers.destroy']);

        Permission::create(['name' => 'documents.index']);
        Permission::create(['name' => 'documents.create']);
        Permission::create(['name' => 'documents.store']);
        Permission::create(['name' => 'documents.update']);
        Permission::create(['name' => 'documents.destroy']);

        Permission::create(['name' => 'categories.index']);
        Permission::create(['name' => 'categories.create']);
        Permission::create(['name' => 'categories.store']);
        Permission::create(['name' => 'categories.update']);
        Permission::create(['name' => 'categories.destroy']);

        Permission::create(['name' => 'marks.index']);
        Permission::create(['name' => 'marks.create']);
        Permission::create(['name' => 'marks.store']);
        Permission::create(['name' => 'marks.update']);
        Permission::create(['name' => 'marks.destroy']);

        Permission::create(['name' => 'providers.index']);
        Permission::create(['name' => 'providers.create']);
        Permission::create(['name' => 'providers.store']);
        Permission::create(['name' => 'providers.update']);
        Permission::create(['name' => 'providers.destroy']);

        Permission::create(['name' => 'customers.index']);
        Permission::create(['name' => 'customers.create']);
        Permission::create(['name' => 'customers.store']);
        Permission::create(['name' => 'customers.update']);
        Permission::create(['name' => 'customers.destroy']);

        Permission::create(['name' => 'presentations.index']);
        Permission::create(['name' => 'presentations.create']);
        Permission::create(['name' => 'presentations.store']);
        Permission::create(['name' => 'presentations.update']);
        Permission::create(['name' => 'presentations.destroy']);

        Permission::create(['name' => 'purchases.index']);
        Permission::create(['name' => 'purchases.create']);
        Permission::create(['name' => 'purchases.store']);
        Permission::create(['name' => 'purchases.update']);
        Permission::create(['name' => 'purchases.destroy']);

        Permission::create(['name' => 'settings.index']);
        Permission::create(['name' => 'settings.create']);
        Permission::create(['name' => 'settings.store']);
        Permission::create(['name' => 'settings.update']);
        Permission::create(['name' => 'settings.destroy']);

        Permission::create(['name' => 'warehouses.index']);
        Permission::create(['name' => 'warehouses.create']);
        Permission::create(['name' => 'warehouses.store']);
        Permission::create(['name' => 'warehouses.update']);
        Permission::create(['name' => 'warehouses.destroy']);

        Permission::create(['name' => 'accountReceivables.index']);
        Permission::create(['name' => 'accountReceivables.create']);
        Permission::create(['name' => 'accountReceivables.store']);
        Permission::create(['name' => 'accountReceivables.update']);
        Permission::create(['name' => 'accountReceivables.destroy']);

        Permission::create(['name' => 'barcodeGenerator.index']);
        Permission::create(['name' => 'barcodeGenerator.create']);
        Permission::create(['name' => 'barcodeGenerator.store']);
        Permission::create(['name' => 'barcodeGenerator.update']);
        Permission::create(['name' => 'barcodeGenerator.destroy']);

        Permission::create(['name' => 'lowStocks.index']);
        Permission::create(['name' => 'lowStocks.create']);
        Permission::create(['name' => 'lowStocks.store']);
        Permission::create(['name' => 'lowStocks.update']);
        Permission::create(['name' => 'lowStocks.destroy']);

        Permission::create(['name' => 'products.index']);
        Permission::create(['name' => 'products.create']);
        Permission::create(['name' => 'products.store']);
        Permission::create(['name' => 'products.update']);
        Permission::create(['name' => 'products.destroy']);

        Permission::create(['name' => 'services.index']);
        Permission::create(['name' => 'services.create']);
        Permission::create(['name' => 'services.store']);
        Permission::create(['name' => 'services.update']);
        Permission::create(['name' => 'services.destroy']);

        Permission::create(['name' => 'proofPayments.index']);
        Permission::create(['name' => 'proofPayments.create']);
        Permission::create(['name' => 'proofPayments.store']);
        Permission::create(['name' => 'proofPayments.update']);
        Permission::create(['name' => 'proofPayments.destroy']);

        Permission::create(['name' => 'orders.index']);
        Permission::create(['name' => 'orders.create']);
        Permission::create(['name' => 'orders.store']);
        Permission::create(['name' => 'orders.update']);
        Permission::create(['name' => 'orders.destroy']);

        Permission::create(['name' => 'print_invoice']);

        Permission::create(['name' => 'dashboard']);

    }
}
