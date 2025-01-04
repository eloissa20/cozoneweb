<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionsExport implements FromCollection, WithHeadings
{
    /**
     * Return the data collection.
     */
    public function collection()
    {
        // Get the currently logged-in user's ID
        $currentUserId = Auth::id();

        // Get the space IDs owned by the user
        $userSpaces = DB::table('list_space_tbl')
            ->where('user_id', $currentUserId)
            ->pluck('id'); // Fetch all space IDs for the user

        // Fetch transactions for spaces owned by the user
        return DB::table('transactions')
            ->whereIn('space_id', $userSpaces)
            ->select(
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
                'status'
            )
            ->get();
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
        ];
    }
}
    