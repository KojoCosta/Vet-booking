<?php

namespace App\Exports;

use App\Models\Veterinarian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Exports\VeterinarianExport;
use Maatwebsite\Excel\Facades\Excel;

class OwnersExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        return Veterinarian::all();
    }

    public function map($veterinarian): array
    {
        return [
            $veterinarian->id,
            $veterinarian->name,
            $veterinarian->email,
            $veterinarian->phone,
            $veterinarian->address,
        ];
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Email', 'Phone', 'Specialization'];
    }

    public function export()
    {
        return Excel::download(new VeterinarianExport, 'veterinarians.csv');
    }
}