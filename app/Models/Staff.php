<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'contact1',
        'contact2',
        'monthlySalary',
        'ot',
        'status'
    ];
public function createUpdate($request){
    $request->validate([
        "name"=>'required|string',
        //  "email"=>'required|string|unique:staffs,email',
        "address"=>'required|string',
        "contact1"=>'required|numeric|min:10',
        "contact2"=>'min:10|numeric',
        "monthlySalary"=>'required|numeric',
        "ot"=>'required|numeric',

    ]);

    $this->name=$request->name;
    $this->address=$request->address;
    $this->contact1=$request->contact1;
    $this->contact2=!($request->contact2)? '':$request->contact2;
    $this->monthlySalary=$request->monthlySalary;
    $this->ot=$request->ot;
    $this->save();
}
}
