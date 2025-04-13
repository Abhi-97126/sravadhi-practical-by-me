<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class UserController extends Controller
{
    public function index(){
        return view("layout");
    }

    public function getInvoice(){
        return view("user.invoice.invoiceList");
    }

    public function addInvoice(){
        $items = Item::where('is_active', 1)->get();
        $data['prods'] = $items->pluck('name', 'id');
        $data['price'] = $items->pluck('price', 'id');
        $data['items'] = $items->toArray();
        return view("user.invoice.add_invoice", $data);
    }

    public function storeInvoice(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'customerName' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'prodCat.*' => 'required|exists:products,id',
            'price.*' => 'required|numeric|min:0',
            'qty.*' => 'required|integer|min:1',
            'prodDesc' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Process items data
        $items = [];
        $subtotal = 0;
        
        foreach ($request->prodCat as $index => $productId) {
            $quantity = $request->qty[$index];
            $price = $request->price[$index];
            $total = $quantity * $price;
            
            $items[] = [
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $price,
                'total' => $total
            ];
            
            $subtotal += $total;
        }

        // Calculate totals (example with 10% tax)
        $tax = $subtotal * 0.10;
        $total = $subtotal + $tax;

        // Create the invoice
        $invoice = Invoice::create([
            'customer_name' => $request->customerName??"",
            'customer_email' => $request->customer_email??"",
            'invoice_date' => $request->invoice_date??"",
            'due_date' => $request->due_date??"",
            'product_description' => $request->prodDesc??"",
            'items' => jsoin_encode($items)??[],
            'subtotal' => $subtotal??0.00,
            'tax' => $tax??0.00,
            'total' => $total??0.00,
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Invoice created successfully',
            'invoice_id' => $invoice->id
        ]);
    }
}
