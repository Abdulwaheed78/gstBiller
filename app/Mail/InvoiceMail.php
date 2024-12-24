<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @param $data
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('vendor.bills.download')
                    ->subject('Invoice #'.$this->data->id)
                    ->with(['data' => $this->data])
                    ->attachData($this->generateInvoicePdf(), 'invoice_'.$this->data->id.'.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }

    /**
     * Generate the PDF of the invoice.
     *
     * @return string
     */
    public function generateInvoicePdf()
    {
        // Use a package like dompdf or any other to generate PDF from HTML
        $pdf = PDF::loadView('vendor.bills.download', ['data' => $this->data]);
        return $pdf->output();
    }
}
