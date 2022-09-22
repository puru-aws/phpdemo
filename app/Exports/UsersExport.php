<?php

namespace App\Exports;

use App\User;
use App\SubscriptionPlan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize , WithEvents, WithMapping
{
    public function collection()
    {
        return User::where('usertype', '=', 'User')->orderBy('id')->get(['id','name','email','phone','about']);
    }

    public function map($users): array
    {
        return [             
            $users->id,
            $users->name,
            $users->email,
            $users->phone,
            $users->about
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Email',
            'Phone',
            'About'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:K1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }

}