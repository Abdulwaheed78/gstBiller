@extends('base')
@section('title')
    Edit Bill Product
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="mb-3">Edit Bill Product</h4>
            <form method="POST" action="{{ route('admin.bills.updatepro', ['id' => $data->id]) }}"
                enctype="multipart/form-data">
                <input type="hidden" name="bill_id" value="{{ $data->bill_id }}">
                @csrf
                <input type="hidden" name="old_final" id="old_final" value="{{ $bill->f_amount }}"> <!-- Fixed this line -->
                <!-- Static Header Row -->
                <div class="row mb-3 font-weight-bold">
                    <div class="col-md-2">Product Description</div>
                    <div class="col-md-1">Quantity</div>
                    <div class="col-md-1">Rate</div>
                    <div class="col-md-2">GST Rate (%)</div>
                    <div class="col-md-2">GST Amount</div>
                    <div class="col-md-2">Final Amount</div>
                    <div class="col-md-2">PUC</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2 col-6">
                        <input type="text" name="description" class="form-control" value="{{ $data->description }}"
                            required>
                    </div>
                    <div class="col-md-1 col-6">
                        <input type="number" name="quantity" class="form-control" value="{{ $data->qty }}" required>
                    </div>
                    <div class="col-md-1 col-6">
                        <input type="number" name="rate" class="form-control" value="{{ $data->actual_amount }}"
                            required>
                    </div>
                    <div class="col-md-2 col-6">
                        <input type="number" name="gst_rate" class="form-control" value="{{ $data->gst_rate }}" required>
                    </div>
                    <div class="col-md-2 col-6">
                        <input type="number" name="gst_amount" class="form-control" value="{{ $data->gst_amount }}"
                            >
                    </div>
                    <div class="col-md-2 col-6">
                        <input type="number" id="finalAAm" name="final_amount" class="form-control"
                            value="{{ $data->final_amount }}" >
                    </div>
                    <div class="col-md-1 col-6">
                        <input type="text" name="puc" class="form-control" value="{{ $data->puc }}">
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-5">
                    <button type="submit" class="btn btn-primary ml-3">Save</button>
                    <a href="{{ route('admin.bills.edit', ['id' => $bill->id]) }}" class="btn btn-danger ml-3">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function calculateFinalAmount() {
            // Get the quantity, rate, and gst_rate values from the input fields
            let quantity = parseFloat($("input[name='quantity']").val()) || 0;
            let rate = parseFloat($("input[name='rate']").val()) || 0;
            let gst_rate = parseFloat($("input[name='gst_rate']").val()) || 0;

            // Calculate the GST amount
            let gst_amount = (quantity * rate * gst_rate) / 100;

            // Update the GST Amount field
            $("input[name='gst_amount']").val(gst_amount.toFixed(2));

            // Calculate the final amount (quantity * rate + GST amount)
            let final_amount = (quantity * rate) + gst_amount;

            // Update the Final Amount field
            $("input[name='final_amount']").val(final_amount.toFixed(2));

            // Calculate PUC (Total Amount / Quantity)
            let puc =Math.round(final_amount / quantity);

            // Update the PUC field
            $("input[name='puc']").val(puc);
        }

        // Trigger the calculation whenever any of the input fields change
        $(document).on('input', 'input[name="quantity"], input[name="rate"], input[name="gst_rate"]', function() {
            calculateFinalAmount();
        });


        // Trigger the calculation whenever any of the input fields change
        $(document).on('input', 'input[name="quantity"], input[name="rate"], input[name="gst_rate"]', function() {
            calculateFinalAmount();
        });
    </script>
@endsection
