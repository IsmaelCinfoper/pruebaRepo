<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'patient_name',
        'department',
        'status',
        'counter_number'
    ];

    public static function generateTicketNumber($department)
    {
        $lastTicket = self::where('department', $department)
            ->whereDate('created_at', today())
            ->latest()
            ->first();

        $number = $lastTicket ? intval(substr($lastTicket->ticket_number, -3)) + 1 : 1;
        return $department[0] . str_pad($number, 3, '0', STR_PAD_LEFT);
    }
}
