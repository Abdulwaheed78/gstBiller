<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bill Invoice GSTBiller</title>
    <style>
        .container {
            width: 100%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card {
            border: none;
        }

        .card-body {
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header-left .invoice-id {
            font-size: 18px;
            color: #7e8d9f;
        }

        .header-right .btn {
            margin-left: 0px;
            padding: 5px 10px;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }

        .header-right .btn:hover {
            background-color: #f0f0f0;
        }

        .export-btn,
        .email-btn {
            text-decoration: none;
        }

        .vendor-info {
            text-align: center;
            margin-bottom: 0px;
        }

        .vendor-name {
            font-size: 24px;
            color: #5d9fc5;
            line-height: 15px;
        }

        .vendor-role {
            font-size: 16px;
            color: #7e8d9f;
        }

        .recipient-left ul,
        .recipient-right ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .recipient-left li,
        .recipient-right li {
            font-size: 14px;
            color: #7e8d9f;
        }

        .recipient-left li span,
        .recipient-right li span {
            color: #5d9fc5;
        }

        .items-table {
            margin-bottom: 20px;
        }

        .items-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .items-table th,
        .items-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .items-table th {
            background-color: #84B0CA;
            color: #fff;
        }

        .total-amount {
            text-align: right;
            font-size: 18px;
            margin-bottom: 20px;

        }

        .footer {
            text-align: right;
            font-size: 16px;
            margin-top: 20px;
        }
    </style>
</head>

<body style="padding:0px;margin:0px;">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="vendor-info">
                    <h4 class="vendor-name" style="margin-bottom:15px;">{{ $data->creator->name }}</h4>
                    <p class="vendor-role" style="margin-top:0px;">(Vendor)</p>
                </div>

                <div class="recipient-info">
                    <table style="width: 100%; border-spacing: 0;">
                        <tr>
                            <td style="width: 70%; vertical-align: top;">
                                <ul style="list-style-type: none; padding: 0;">
                                    <li class="recipient-name">To: <span>{{ $data->b_name }}</span></li>
                                    <li class="recipient-address">{{ $data->b_address }}, {{ $data->b_city }}</li>
                                    <li class="recipient-state">{{ $data->b_state }} - {{ $data->b_pincode }}</li>
                                    <li class="recipient-phone"><i class="fas fa-phone"></i> {{ $data->b_phone }}</li>
                                    <li class="recipient-email"><i class="fas fa-envelope"></i> {{ $data->b_email }}
                                    </li>
                                </ul>
                            </td>
                            <td style="width: 30%; vertical-align: top; padding-left: 0;">
                                <p class="invoice-label">Invoice</p>
                                <ul style="list-style-type: none; padding: 0;">
                                    <li class="invoice-id"><i class="fas fa-circle"></i>
                                        <span>ID:</span>#{{ $data->id }}</li>
                                    <li class="invoice-date"><i class="fas fa-circle"></i> <span>Creation Date:</span>
                                        {{ date('d-M-Y', strtotime($data->created_at)) }}</li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                </div>


                <div class="items-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th>Gst Rate</th>
                                <th>Gst Amount</th>
                                <th>PUC</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->trans as $index => $userdata)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $userdata->description }}</td>
                                    <td>{{ $userdata->qty }}</td>
                                    <td>{{ $userdata->gst_rate }} %</td>
                                    <td>{{ $userdata->gst_amount }}</td>
                                    <td>{{ $userdata->puc }}</td>
                                    <td>{{ $userdata->final_amount }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="total-amount">
                    <p>Total Amount: <span> {{ $data->f_amount }} RS.</span></p>
                </div>

                <div class="footer">
                    <p>Thank you for your purchase</p>
                    <p>{{ $data->creator->name }}</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
