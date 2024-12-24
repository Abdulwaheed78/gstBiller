<?php

namespace App\Http\Controllers;

use App\Models\Bills;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Logs;
use App\Models\User;
use App\Models\Trans;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;

class VendorController extends Controller
{
    public function dashboard()
    {
        $data = Bills::where('is_deleted', 'no')
            ->where('uid', Auth::id())
            ->with(['creator', 'Trans'])
            ->orderByDesc('id')
            ->get();

        return view('vendor.dashboard', compact('data'));
    }


    public function profile()
    {
        $data = Auth::user();
        return view('vendor.profile', compact('data'));
    }

    public function update_profile(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $request->id, // Ensure the email is unique except for the current user
            'phone' => 'required|integer|max_digits:10|min_digits:10',
            'address' => 'nullable',
            'city' => 'required|string',
            'state' => 'required|string',
            'pincode' => 'required|integer|max_digits:6|min_digits:6',
            'password' => 'nullable|min_digits:6',
            'password_confirmation' => 'nullable|min_digits:6',
            'user_type' => 'required',
            'image' => 'nullable|image|max:2048' // Optional image validation
        ]);
        $user = User::find($request->id);
        if (!empty($request->password) && $request->password !== $request->password_confirmation) {
            return redirect()->route('vendor.profile', ['id' => $user->id])->with('error', 'Password and Confirm Passwords are not Matching');
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->pincode = $request->pincode;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        if ($request->hasFile('image')) {
            if ($user->image && Storage::exists('public/' . $user->image)) {
                Storage::delete('public/' . $user->image);
            }
            $imagePath = $request->file('image')->store('users', 'public');
            $user->image = $imagePath;
        }
        $user->user_type = $request->user_type;
        if ($user->save()) {
            // Log the action (assuming you have a Logs model and logging logic in place)
            $users = Auth::user();
            $log = new Logs();
            $log->table_name = 'user';
            $log->type_name = $request->user_type . ' Updated';
            $log->action_name = 'update';
            $log->item_id = $user->id;
            $log->uid = $users->id;
            $log->save();

            return redirect()->route('vendor.profile')->with('success', 'Profile Updated Successfully');
        } else {
            return redirect()->route('vendor.profile', ['id' => $user->id])->with('error', 'Error Occurred While Updating Profile');
        }
    }

    //bills specific functions
    public function bills()
    {
        $data = Bills::where('is_deleted', 'no')->where('uid', Auth::user()->id)->with('creator')->orderBy('id', 'desc')->get();
        return view('vendor.bills.index', compact('data'));
    }

    public function bill_add()
    {
        return view('vendor.bills.add');
    }

    public function bill_create(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric|max_digits:10|min_digits:10',
            'address' => 'nullable',
            'city' => 'required|string',
            'state' => 'required|string',
            'pincode' => 'required|numeric|max_digits:6|min_digits:6'
        ]);

        $bill = new Bills();
        $bill->title = $request->title;
        $bill->b_name = $request->name;
        $bill->b_email = $request->email;
        $bill->b_phone = $request->phone;
        $bill->b_address = $request->address;
        $bill->b_city = $request->city;
        $bill->b_state = $request->state;
        $bill->b_pincode = $request->pincode;
        $bill->f_amount = 0;
        $bill->uid = Auth::user()->id;
        if ($bill->save() > 0) {
            $users = Auth::user();
            $log = new Logs();
            $log->table_name = 'bills';
            $log->type_name = 'Bill Created';
            $log->action_name = 'insert';
            $log->item_id = $bill->id;
            $log->uid = $users->id;
            $log->save();

            $data = Bills::find($bill->id);
            return view('vendor.bills.update', compact('data'))->with('success', 'Bill Created Successfully Now Add Products');
        }

        return redirect()->route('vendor.bills.add')->with('error', 'Error Happens While Creating Bill Created Successfully');
    }

    public function bill_edit($id)
    {
        $data = Bills::with('trans')->find($id);
        return view('vendor.bills.update', compact('data'));
    }

    public function bill_update(Request $request)
    {

        $request->validate([
            'title' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric|max_digits:10|min_digits:10',
            'address' => 'nullable',
            'city' => 'required|string',
            'state' => 'required|string',
            'pincode' => 'required|numeric|max_digits:6|min_digits:6',
            'final_Amount'=>'required'
        ]);

        $bill = Bills::find($request->id);
        $bill->title = $request->title;
        $bill->b_name = $request->name;
        $bill->b_email = $request->email;
        $bill->b_phone = $request->phone;
        $bill->b_address = $request->address;
        $bill->b_city = $request->city;
        $bill->b_state = $request->state;
        $bill->b_pincode = $request->pincode;
        $bill->f_amount = $request->final_Amount;
        $bill->uid = Auth::user()->id;
        if ($bill->save() > 0) {
            $users = Auth::user();
            $log = new Logs();
            $log->table_name = 'bills';
            $log->type_name = 'Bill Updated';
            $log->action_name = 'update';
            $log->item_id = $bill->id;
            $log->uid = $users->id;
            $log->save();

            $data = Bills::find($bill->id);
            return redirect()->route('vendor.bills.index')->with('success', 'Bill Updated Successfully');
        }
        $data = $bill;
        return view('vendor.bills.update', compact('data'))->with('error', 'Error Happens While Updating Bill');
    }

    public function bill_destroy($id)
    {
        $bill = Bills::find($id);
        $bill->is_deleted = 'yes';
        if ($bill->save() > 0) {
            // Log the action (assuming you have a Logs model and logging logic in place)
            $users = Auth::user();
            $log = new Logs();
            $log->table_name = 'bills';
            $log->type_name = ' Bill Deleted';
            $log->action_name = 'delete';
            $log->item_id = $id;
            $log->uid = $users->id;
            $log->save();
            return redirect()->route('vendor.bills.index')->with('success', 'Bill Deleted Successfully');
        }
        return redirect()->route('vendor.bills.index')->with('error', 'Bill Not Deleted');
    }

    public function bill_add_product($id)
    {
        // Retrieve the bill and its associated transactions
        $bill = Bills::with('trans')->find($id);

        $data = $bill->trans; // Transactions associated with the bill
        return view('vendor.bills.add_product', compact('data', 'id', 'bill'));
    }

    public function bill_create_product(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'bill_id' => 'required|integer',
            'products' => 'required|array',
            'products.*.description' => 'required|string|max:255',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.rate' => 'required|numeric|min:0',
            'products.*.gst_rate' => 'required|numeric|min:0',
            'products.*.gst_amount' => 'required|numeric|min:0',
            'products.*.final_amount' => 'required|numeric|min:0',
            'products.*.puc' => 'required|numeric|min:0',
            'grandamount' => 'required',
        ]);

        $billId = $validatedData['bill_id'];
        $products = $validatedData['products'];

        // Loop through each product and save it to the database
        foreach ($products as $product) {
            // Insert product details into the Trans table
            $trans = Trans::create([
                'bill_id' => $billId,
                'description' => $product['description'],
                'qty' => $product['quantity'],
                'actual_amount' => $product['rate'],
                'gst_rate' => $product['gst_rate'],
                'gst_amount' => $product['gst_amount'],
                'final_amount' => $product['final_amount'],
                'puc' => $product['puc'],
            ]);

            // Log the action (assuming you have a Logs model and logging logic in place)
            $user = Auth::user();
            $log = new Logs();
            $log->table_name = 'bill_trans';
            $log->type_name = 'Products Added';
            $log->action_name = 'insert';
            $log->item_id = $trans->id;  // Log the ID of the created Trans record
            $log->uid = $user->id;  // Log the user ID
            $log->save();
        }

        $bill = Bills::find($billId);
        $old_f_am = $bill->f_amount ?: 0;
        $total_final = $request->grandamount + $old_f_am;
        $bill->update(['f_amount' => $total_final]);

        // Redirect or return a response after saving
        return redirect()->route('vendor.bills.edit', ['id' => $billId])->with('success', 'Products added successfully!');
    }

    public function bill_edit_product($id)
    {
        $data = Trans::find($id);
        $bill = Bills::find($data->bill_id);
        return view('vendor.bills.edit', compact('data', 'bill'));
    }

    public function bill_update_product(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'bill_id' => 'required|integer',
            'description' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'rate' => 'required|numeric|min:0',
            'gst_rate' => 'required|numeric|min:0',
            'gst_amount' => 'required|numeric|min:0',
            'final_amount' => 'required|numeric|min:0',
            'puc' => 'required|numeric|min:0',
            'old_final' => 'required', // Old final amount to compare for bill total update
        ]);

        $billId = $validatedData['bill_id'];
        $trans = Trans::find($id);

        if (!$trans) {
            return redirect()->route('vendor.bills.edit', ['id' => $billId])->with('error', 'Transaction not found!');
        }

        $old_amount = $trans->final_amount;

        // Update transaction fields
        $trans->description = $validatedData['description'];
        $trans->qty = $validatedData['quantity'];
        $trans->gst_rate = $validatedData['gst_rate'];
        $trans->gst_amount = $validatedData['gst_amount'];
        $trans->actual_amount = $validatedData['rate'];
        $trans->final_amount = $validatedData['final_amount'];
        $trans->puc = $validatedData['puc'];
        $trans->save();

        // Update bill final amount based on the old and new transaction amounts
        $bill = Bills::find($billId);
        if (!$bill) {
            return redirect()->route('vendor.bills.edit', ['id' => $billId])->with('error', 'Bill not found!');
        }

        // Log the action (assuming you have a Logs model and logging logic in place)
        $users = Auth::user();
        $log = new Logs();
        $log->table_name = 'bill_trans';
        $log->type_name = 'Products Updated';
        $log->action_name = 'update';
        $log->item_id = $id;
        $log->uid = $users->id;
        $log->save();

        $update_final = $bill->f_amount - $old_amount + $validatedData['final_amount'];

        // Ensure the final amount is rounded to two decimal places (if needed)
        $update_final = round($update_final, 2);

        // Update the bill's final amount
        $bill->update(['f_amount' => $update_final]);

        // Redirect or return a response after saving
        return redirect()->route('vendor.bills.edit', ['id' => $billId])->with('success', 'Product updated successfully!');
    }

    // additional routes

    public function bill_show($id)
    {
        $data = Bills::with(['creator', 'trans'])->find($id);
        return view('vendor.bills.show', compact('data'));
    }

    public function generateInvoice($id)
    {
        // Fetch data to populate the PDF (e.g., an invoice)
        $data = Bills::findOrFail($id);

        // Load the view and pass data to it
        $pdf = PDF::loadView('vendor.bills.download', compact('data'));

        // Return the generated PDF as a response to download
        //return $pdf->download('invoice_' . $data->b_name .'_'.$data->id. '.pdf');
        return $pdf->stream('invoice_' . $data->b_name . '_' . $data->id . '.pdf');
    }

    public function sendInvoice($data)
    {
        $data=Bills::with(['creator','trans'])->find($data);
        $userEmail = $data->b_email;  // Vendor email
        $vendorEmail = $data->creator->email;  // User email (vendor)

        // Send email to both vendor and user
        Mail::to($userEmail)->send(new InvoiceMail($data));
        Mail::to($vendorEmail)->send(new InvoiceMail($data));

        return redirect()->back()->with('success','Invoice Sent To Mail Successfully');
    }


    public function bills_destroy_product($id)
    {
        $data = Trans::with('bill')->find($id);
        $gg = $data->bill->f_amount - $data->final_amount;

        Bills::find($data->bill->id)->update(['f_amount' => $gg]);
        if ($data->delete()) {
            // Log the action (assuming you have a Logs model and logging logic in place)
            $users = Auth::user();
            $log = new Logs();
            $log->table_name = 'bill_trans';
            $log->type_name = 'Products Deleted';
            $log->action_name = 'delete';
            $log->item_id = $id;
            $log->uid = $users->id;
            $log->save();
            return redirect()->route('vendor.bills.edit', ['id' => $data->bill->id])->with('success', 'Record Deleted Successfully');
        }
        return redirect()->route('vendor.bills.edit', ['id' => $data->bill->id])->with('error', 'Error While Deleting Record');
    }
}
