<?php

namespace App\Exports;

use App\Models\Owner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Exports\OwnerExport;
use Maatwebsite\Excel\Facades\Excel;

class OwnerExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        return Owner::all();
    }

    public function map($owner): array
    {
        return [
            $owner->id,
            $owner->name,
            $owner->email,
            $owner->phone,
            $owner->address,
        ];
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Email', 'Phone', 'Address'];
    }

    public function export()
    {
        return Excel::download(new OwnerExport, 'owners.csv');
    }
}