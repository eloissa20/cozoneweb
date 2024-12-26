<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionsExport implements FromCollection, WithHeadings
{
    /**
     * Return the data collection.
     */
    public function collection()
    {
        return Transaction::select(
            'id',
            'user_id',
            'space_id',
            'reservation_date',
            'hours',
            'guests',
            'name',
            'email',
            'company',
            'contact',
            'arrival_time',
            'amount',
            'payment_method',
            'status',
            // 'created_at'
        )->get();
    }

    /**
     * Define the headings for the Excel file.
     */
    public function headings(): array
    {
        return [
            'Transaction ID',
            'Customer ID',
            'Space ID',
            'Reservation Date',
            'Hours',
            'Number of Guests',
            'Name',
            'Email',
            'Company',
            'Contact',
            'Arrival Time',
            'Amount',
            'Payment Method',
            'Status',
            // 'Created At',
        ];
    }
}
    