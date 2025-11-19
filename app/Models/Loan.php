<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $table = 'loan';
    protected $primaryKey = 'loan_id';
    public $timestamp = false;

    protected $fillable = [
        //'loan_id',
        'member_id',
        'book_id',
        'borrow_date',
        'due_date',
        'return_date',
        'status',
        'fine_amount'
    ];

    //Relations
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
