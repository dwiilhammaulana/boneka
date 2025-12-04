<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ShippingCostService;

class ShippingCostController extends Controller
{
    protected $shipping;

    public function __construct(ShippingCostService $shipping)
    {
        $this->shipping = $shipping;
    }

    public function provinces()
    {
        return response()->json($this->shipping->getProvinces());
    }

    public function cities(Request $request)
    {
        return response()->json($this->shipping->getCities($request->province_id));
    }

    public function calculate(Request $request)
    {
        $origin = $request->origin;
        $destination = $request->destination;
        $weight = $request->weight;
        $courier = $request->courier;

        return response()->json(
            $this->shipping->calculateCost($origin, $destination, $weight, $courier)
        );
    }
}
