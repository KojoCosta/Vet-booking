<?php

namespace App\Exports;

use App\Models\Owner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Exports\PetsExports;
use Maatwebsite\Excel\Facades\Excel;

class PetsExports implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        return Owner::all();
    }

    public function map($pet): array
    {
        return [
            $pet->id,
            $pet->owner_id,
            $pet->name,
            $pet->species,
            $pet->breed,
            $pet->birthday,
            $pet->sex,
        ];
    }

    public function headings(): array
    {
        return ['ID', 'Owner Name', 'Pet Name', 'Species', 'Breed', 'Birthday', 'sex'];
    }

    public function export()
    {
        return Excel::download(new PetsExports, 'pets.csv');
    }
}