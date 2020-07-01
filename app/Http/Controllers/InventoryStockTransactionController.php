<?php

namespace App\Http\Controllers;

use App\InventoryStockTransaction;
use Illuminate\Http\Request;

class InventoryStockTransactionController extends Controller
{
    public function index(){
        $inventoryStockTransactions = InventoryStockTransaction::OrderBy('created_at', 'desc')->get();

        return view('inventoryStockTransaction.index', compact('inventoryStockTransactions'));
    }

}
