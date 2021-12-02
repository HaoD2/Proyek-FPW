<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ExcelController extends Controller
{
    public function getSphreadExcel(){
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
