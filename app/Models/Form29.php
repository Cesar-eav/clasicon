<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\Import;
use App\Models\Purchase;
use App\Models\Remuneration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Form29 extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id' ,
        'purchase_id',
        'sale_id',
        'company_id',
        'import_id',
        'remuneration_id',
        'ppm',
        'ppm2',
        'retencion_42N1',
        'retencion_42N2',
        'impuesto_unico_trabajadores',
        'impuesto_2da_categoria',
        'total_amount'
    ];

    protected $casts = [
        'created_at' => 'datetime:m-y'
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function remuneration()
    {
        return $this->belongsTo(Remuneration::class);
    }

    public function fee()
    {
        return $this->belongsTo(Fee::class);
    }

    public function import()
    {
        return $this->belongsTo(Import::class);
    }
}
