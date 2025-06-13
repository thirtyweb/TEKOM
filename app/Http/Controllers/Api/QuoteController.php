<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quote;

class QuoteController extends Controller
{
    public function random()
    {
        $quote = Quote::active()->random()->first();
        
        return response()->json([
            'data' => $quote,
            'status' => 'success'
        ]);
    }
}
