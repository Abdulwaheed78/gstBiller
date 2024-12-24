@extends('base')
@section('title')
    Add Bill Products
@endsection
@section('content')
    <div class="card">
        <div class="card-body ">
            <h4 class="mb-3">Add Bill Products</h4>
            <form method="POST" action="{{ route('admin.bills.createpro',['id'=> $id]) }}" enctype="multipart/form-data">
                <input type="hidden" name="bill_id" value="{{$id}}">
                @csrf

                <div class="d-flex justify-content-end mb-3">
                    <div class="col-3">
                        <input type="text" name="grandamount" id="grandamount" class="form-control" readonly>
                        <label for="grandamount">Grand Final Amound</label>
                    </div>
                </div>
                <!-- Static Header Row -->
                <div class="row mb-3 font-weight-bold">
                    <div class="col-md-2">Product Description</div>
                    <div class="col-md-1">Quantity</div>
                    <div class="col-md-1">Rate</div>
                    <div class="col-md-2">GST Rate (%)</div>
                    <div class="col-md-2">GST Amount</div>
                    <div class="col-md-2">Final Amount</div>
                    <div class="col-md-1">PUC</div>
                    <div class="col-md-1">Action</div>
                </div>

                <div id="rowsContainer">

                </div>

                <div class="d-flex justify-content-end mt-5">
                    <button type="button" class="btn btn-warning" id="addRowBtn">Add Row</button>
                    <button type="submit" class="btn btn-primary ml-3">Save</button>
                    <a href="{{ route('admin.bills.edit',['id'=>$id]) }}" class="btn btn-danger ml-3">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        let rowIndex = 0;

        // Function to add a new row
        $('#addRowBtn').click(function() {
            const rowHtml = `
            <div class="row mb-3" id="row-${rowIndex}">
              <div class="col-md-2">
                <input type="text" name="products[${rowIndex}][description]" class="form-control" placeholder="Product Description" required />
              </div>
              <div class="col-md-1">
                <input type="number" name="products[${rowIndex}][quantity]" class="form-control quantity-input" data-row-id="${rowIndex}" placeholder="Qty" required />
              </div>
              <div class="col-md-1">
                <input type="number" name="products[${rowIndex}][rate]" class="form-control rate-input" data-row-id="${rowIndex}" placeholder="Rate" required />
              </div>
              <div class="col-md-2">
                <input type="number" name="products[${rowIndex}][gst_rate]" class="form-control gst-rate-input" data-row-id="${rowIndex}" placeholder="GST Rate (%)" required />
              </div>
              <div class="col-md-2">
                <input type="number" name="products[${rowIndex}][gst_amount]" class="form-control gst-amount" data-row-id="${rowIndex}" placeholder="GST Amount" readonly />
              </div>
              <div class="col-md-2">
                <input type="number" name="products[${rowIndex}][final_amount]" id="final_${rowIndex}" class="form-control final-amount" data-row-id="${rowIndex}" placeholder="Final Amount" readonly />
              </div>
              <div class="col-md-1">
                <input type="text" name="products[${rowIndex}][puc]" class="form-control puc" data-row-id="${rowIndex}" placeholder="PUC" readonly />
              </div>
              <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-sm deleteRowBtn" data-row-id="row-${rowIndex}">Delete</button>
              </div>
            </div>
          `;
            $('#rowsContainer').append(rowHtml);
            rowIndex++;
        });

        // Function to delete a row
        $(document).on('click', '.deleteRowBtn', function() {
            const rowId = $(this).data('row-id');
            $(`#${rowId}`).remove();
            grandTotal();
        });

        // Function to calculate GST Amount, Final Amount, and PUC
        $(document).on('input', '.quantity-input, .rate-input, .gst-rate-input', function() {
            const rowId = $(this).data('row-id');
            const quantity = parseFloat($(`input[name="products[${rowId}][quantity]"]`).val()) || 0;
            const rate = parseFloat($(`input[name="products[${rowId}][rate]"]`).val()) || 0;
            const gstRate = parseFloat($(`input[name="products[${rowId}][gst_rate]"]`).val()) || 0;

            // Calculate GST Amount
            const gstAmount = ((rate * quantity) * gstRate) / 100;

            // Calculate Final Amount (Rate * Quantity + GST Amount)
            const finalAmount = (rate * quantity) + gstAmount;

            // Calculate PUC (Final Amount / Quantity)
            const puc = quantity > 0 ? finalAmount / quantity : 0;

            // Update the respective fields
            $(`input[name="products[${rowId}][gst_amount]"]`).val(gstAmount.toFixed(2));
            $(`input[name="products[${rowId}][final_amount]"]`).val(finalAmount.toFixed(2));
            $(`input[name="products[${rowId}][puc]"]`).val(puc.toFixed(2));
            grandTotal();
        });

        function grandTotal() {
            let finalAmount = 0;
            if (rowIndex > 0) {
                for (let i = 0; i < rowIndex; i++) {
                    const finalValue = parseFloat($("#final_" + i).val()) || 0; // Parse as float and default to 0 if empty
                    finalAmount += finalValue;
                }
            }
            $("#grandamount").val(Math.round(finalAmount));
        }
    </script>
@endsection
