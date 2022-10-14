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
        $master = Role::create([ 'name' => 'Master' ]);
        $admin = Role::create([ 'name' => 'Admin' ]);
        $seller = Role::create([ 'name' => 'Seller' ]);

        Permission::create(['name' => 'companies index'])->syncRoles([$master]);
        Permission::create(['name' => 'companies create'])->syncRoles([$master]);
        Permission::create(['name' => 'companies store'])->syncRoles([$master]);
        Permission::create(['name' => 'companies update'])->syncRoles([$master]);
        Permission::create(['name' => 'companies destroy'])->syncRoles([$master]);

        Permission::create(['name' => 'measures.index'])->syncRoles([$master]);
        Permission::create(['name' => 'measures.create'])->syncRoles([$master]);
        Permission::create(['name' => 'measures.store'])->syncRoles([$master]);
        Permission::create(['name' => 'measures.update'])->syncRoles([$master]);
        Permission::create(['name' => 'measures.destroy'])->syncRoles([$master]);

        Permission::create(['name' => 'users.index'])->syncRoles([$master]);
        Permission::create(['name' => 'users.create'])->syncRoles([$master]);
        Permission::create(['name' => 'users.store'])->syncRoles([$master]);
        Permission::create(['name' => 'users.update'])->syncRoles([$master]);
        Permission::create(['name' => 'users.destroy'])->syncRoles([$master]);

        Permission::create(['name' => 'coins.index'])->syncRoles([$master]);
        Permission::create(['name' => 'coins.create'])->syncRoles([$master]);
        Permission::create(['name' => 'coins.store'])->syncRoles([$master]);
        Permission::create(['name' => 'coins.update'])->syncRoles([$master]);
        Permission::create(['name' => 'coins.destroy'])->syncRoles([$master]);

        Permission::create(['name' => 'paymentMethods.index'])->syncRoles([$master]);
        Permission::create(['name' => 'paymentMethods.create'])->syncRoles([$master]);
        Permission::create(['name' => 'paymentMethods.store'])->syncRoles([$master]);
        Permission::create(['name' => 'paymentMethods.update'])->syncRoles([$master]);
        Permission::create(['name' => 'paymentMethods.destroy'])->syncRoles([$master]);
        
        Permission::create(['name' => 'customizers.index'])->syncRoles([$master, $admin]);
        Permission::create(['name' => 'customizers.create'])->syncRoles([$master, $admin])  ;
        Permission::create(['name' => 'customizers.store'])->syncRoles([$master, $admin])   ;
        Permission::create(['name' => 'customizers.update'])->syncRoles([$master, $admin])  ;
        Permission::create(['name' => 'customizers.destroy'])->syncRoles([$master, $admin]) ;

        Permission::create(['name' => 'documents.index'])->syncRoles([$master]);
        Permission::create(['name' => 'documents.create'])->syncRoles([$master]);
        Permission::create(['name' => 'documents.store'])->syncRoles([$master]);
        Permission::create(['name' => 'documents.update'])->syncRoles([$master]);
        Permission::create(['name' => 'documents.destroy'])->syncRoles([$master]);

        Permission::create(['name' => 'categories.index'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'categories.create'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'categories.store'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'categories.update'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'categories.destroy'])->syncRoles([$master, $admin, $seller]);

        Permission::create(['name' => 'marks.index'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'marks.create'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'marks.store'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'marks.update'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'marks.destroy'])->syncRoles([$master, $admin, $seller]);

        Permission::create(['name' => 'providers.index'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'providers.create'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'providers.store'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'providers.update'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'providers.destroy'])->syncRoles([$master, $admin, $seller]);

        Permission::create(['name' => 'customers.index'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'customers.create'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'customers.store'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'customers.update'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'customers.destroy'])->syncRoles([$master, $admin, $seller]);

        Permission::create(['name' => 'presentations.index'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'presentations.create'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'presentations.store'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'presentations.update'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'presentations.destroy'])->syncRoles([$master, $admin, $seller]);

        Permission::create(['name' => 'purchases.index'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'purchases.create'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'purchases.store'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'purchases.update'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'purchases.destroy'])->syncRoles([$master, $admin, $seller]);

        Permission::create(['name' => 'settings.index'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'settings.create'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'settings.store'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'settings.update'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'settings.destroy'])->syncRoles([$master, $admin, $seller]);

        Permission::create(['name' => 'warehouses.index'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'warehouses.create'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'warehouses.store'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'warehouses.update'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'warehouses.destroy'])->syncRoles([$master, $admin, $seller]);

        Permission::create(['name' => 'accountReceivables.index'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'accountReceivables.create'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'accountReceivables.store'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'accountReceivables.update'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'accountReceivables.destroy'])->syncRoles([$master, $admin, $seller]);

        Permission::create(['name' => 'barcodeGenerator.index'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'barcodeGenerator.create'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'barcodeGenerator.store'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'barcodeGenerator.update'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'barcodeGenerator.destroy'])->syncRoles([$master, $admin, $seller]);

        Permission::create(['name' => 'lowStocks.index'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'lowStocks.create'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'lowStocks.store'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'lowStocks.update'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'lowStocks.destroy'])->syncRoles([$master, $admin, $seller]);

        Permission::create(['name' => 'products.index'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'products.create'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'products.store'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'products.update'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'products.destroy'])->syncRoles([$master, $admin, $seller]);

        Permission::create(['name' => 'services.index'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'services.create'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'services.store'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'services.update'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'services.destroy'])->syncRoles([$master, $admin, $seller]);

        Permission::create(['name' => 'proofPayments.index'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'proofPayments.create'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'proofPayments.store'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'proofPayments.update'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'proofPayments.destroy'])->syncRoles([$master, $admin, $seller]);

        Permission::create(['name' => 'orders.index'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'orders.create'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'orders.store'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'orders.update'])->syncRoles([$master, $admin, $seller]);
        Permission::create(['name' => 'orders.destroy'])->syncRoles([$master, $admin, $seller]);

        Permission::create(['name' => 'print_invoice'])->syncRoles([$master, $admin, $seller]);

        Permission::create(['name' => 'dashboard'])->syncRoles([$master, $admin, $seller]);

    }
}
