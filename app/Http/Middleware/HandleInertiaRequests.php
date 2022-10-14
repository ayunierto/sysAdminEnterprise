<?php

namespace App\Http\Middleware;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {

        try {
            $company_id = Auth::user()->companies_id;
            $products = Product::select('products.*', 'warehouses.name as nameWarehouse', 'marks.name as nameMark')
                ->join('warehouses', 'products.warehouses_id', '=', 'warehouses.id')
                ->join('marks', 'products.marks_id', '=', 'marks.id')
                ->where('products.companies_id', $company_id)->get();
            $stock_min = [];
            $nrodedatos = 0;
            foreach ($products as $key => $p) {
                if ($p->stock <= $p->stock_min) {
                    array_push($stock_min, $p);
                    $nrodedatos += 1;
                }
            }
            return array_merge(parent::share($request), [
                'flash' => [
                    'message' => fn () => $request->session()->get('message'),
                    'nrodts' => $nrodedatos
                ],
                'auth'=>['user' => $request->user() ?   $request->user()->only('id', 'name', 'email') : null,
                    'can' =>$request->user() ? $request->user()->getPermissionArray() : []
                ],
            ]);
        } catch (Exception) {
            return array_merge(parent::share($request), [
                'flash' => [
                    'message' => fn () => $request->session()->get('message'),
                ],
                'auth'=>['user' => $request->user() ?   $request->user()->only('id', 'name', 'email') : null,
                    'can' =>$request->user() ? $request->user()->getPermissionArray() : []
                ],
            ]);
        }
    }
}
