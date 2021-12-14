<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        return User::all('fname','lname','email','notelp')->except(Auth::id());
    }
    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'email',
            'notelp'
            
        ];
    }

}
