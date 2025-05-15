<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Status;
use App\Models\AuditLog;

class OrderController extends Controller
{
    // List all orders (ordered from newest to oldest)
    public function index()
    {
        $orders = Order::orderBy('orderDateTime', 'desc')->get();
        return view('orders.index', compact('orders'));
    }

    // Show form for creating a new order
    public function create()
    {
        $customers = Customer::all();
        $statuses  = Status::all();
        return view('orders.create', compact('customers', 'statuses'));
    }

    // Store a new order
    public function store(Request $request)
    {
        $request->validate([
            'invoiceNumber'   => 'required|string|max:255',
            'customerNumber'  => 'required|string|exists:customers,customerNumber',
            'orderDateTime'   => 'required|date',
            'deliveryAddress' => 'required|string|max:255',
            'notes'           => 'nullable|string',
            'statusID'        => 'required|exists:statuses,statusID',
        ]);

        $order = new Order();
        $order->invoiceNumber   = $request->invoiceNumber;
        $order->customerNumber  = $request->customerNumber;
        $order->orderDateTime   = $request->orderDateTime;
        $order->deliveryAddress = $request->deliveryAddress;
        $order->notes           = $request->notes;
        $order->statusID        = $request->statusID;
        $order->save();

        toastr()->success('Order created successfully.');

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    // Show form for editing an order
    public function edit($id)
    {
        $order     = Order::findOrFail($id);
        $customers = Customer::all();
        $statuses  = Status::all();
        return view('orders.edit', compact('order', 'customers', 'statuses'));
    }

    // Update order details
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $request->validate([
            'invoiceNumber'   => 'required|string|max:255',
            'customerNumber'  => 'required|string|exists:customers,customerNumber',
            'orderDateTime'   => 'required|date',
            'deliveryAddress' => 'required|string|max:255',
            'notes'           => 'nullable|string',
            'statusID'        => 'required|exists:statuses,statusID',
        ]);

        $order->invoiceNumber   = $request->invoiceNumber;
        $order->customerNumber  = $request->customerNumber;
        $order->orderDateTime   = $request->orderDateTime;
        $order->deliveryAddress = $request->deliveryAddress;
        $order->notes           = $request->notes;
        $order->statusID        = $request->statusID;
        $order->save();

        // Record the update in the audit log
        AuditLog::create([
            'orderID'        => $order->orderID,
            'userID'         => Auth::id(),
            'actionDateTime' => now(),
            'action'         => 'Order Updated',
            'details'        => 'Order details updated.'
        ]);

        toastr()->success('Order updated successfully.');

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    // Change the status of an order
    public function changeStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $request->validate([
            'statusID' => 'required|exists:statuses,statusID'
        ]);
        $order->statusID = $request->statusID;
        $order->save();

        AuditLog::create([
            'orderID'        => $order->orderID,
            'userID'         => Auth::id(),
            'actionDateTime' => now(),
            'action'         => 'Status Changed',
            'details'        => 'Order status changed to ' . Status::find($request->statusID)->statusName
        ]);

        toastr()->success('Order status changed to ' . $order->status->statusName . '.');

        return redirect()->route('orders.index')->with('success', 'Order status changed successfully.');
    }

    // Upload a photo (for "In Route" or "Delivered" statuses)
    public function uploadPhoto(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/photos');
            // Assign the photo based on the order's current status
            if ($order->status->statusName == 'In Route') {
                $order->loadedPhoto = $path;
            } elseif ($order->status->statusName == 'Delivered') {
                $order->deliveredPhoto = $path;
            }
            $order->save();

            AuditLog::create([
                'orderID'        => $order->orderID,
                'userID'         => Auth::id(),
                'actionDateTime' => now(),
                'action'         => 'Photo Uploaded',
                'details'        => 'Photo uploaded for order ' . $order->invoiceNumber
            ]);

            toastr()->success('Photo uploaded successfully.');

            return redirect()->route('orders.index')->with('success', 'Photo uploaded successfully.');
        }
        return redirect()->back()->with('error', 'No photo uploaded.');
    }

    // Display a single order (detailed view)
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.show', compact('order'));
    }

    // Logical deletion of an order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->isDeleted = true;
        $order->save();

        AuditLog::create([
            'orderID'        => $order->orderID,
            'userID'         => Auth::id(),
            'actionDateTime' => now(),
            'action'         => 'Order Deleted',
            'details'        => 'Order marked as deleted.'
        ]);

        toastr()->success('Order archived successfully.');

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    // List archived (logically deleted) orders
    public function archived()
    {
        $orders = Order::where('isDeleted', true)->orderBy('orderDateTime', 'desc')->get();
        return view('orders.archived', compact('orders'));
    }

    // Restore an archived order
    public function restore($id)
    {
        $order = Order::findOrFail($id);
        $order->isDeleted = false;
        $order->save();

        AuditLog::create([
            'orderID'        => $order->orderID,
            'userID'         => Auth::id(),
            'actionDateTime' => now(),
            'action'         => 'Order Restored',
            'details'        => 'Order restored from archive.'
        ]);

        toastr()->success('Order restored successfully.');

        return redirect()->route('orders.archived')->with('success', 'Order restored successfully.');
    }

    // Public view: Show search form for non-registered users
    public function publicSearch()
    {
        return view('home');
    }

    // Handle search requests from the public home page
    public function search(Request $request)
    {
        $request->validate([
            'invoiceNumber' => 'required|string'
        ]);

        $order = Order::where('invoiceNumber', $request->invoiceNumber)->first();
        return view('home', compact('order'));
    }
}
