<?php

namespace App\Libraries;

use Xendit\Xendit;
use Xendit\Invoice;

class XenditLib
{
    public function __construct()
    {
        // Inisialisasi Xendit dengan API Key
        Xendit::setApiKey(getenv('XENDIT_API_KEY'));
    }

    public function createInvoice($data)
    {
        // Membuat invoice menggunakan Xendit SDK
        return Invoice::create([
            'external_id' => $data['external_id'],
            'payer_email' => $data['payer_email'],
            'description' => $data['description'],
            'amount' => $data['amount'],
            'callback_url' => $data['callback_url'],
        ]);
    }
}