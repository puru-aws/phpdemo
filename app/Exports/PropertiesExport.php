<?php

namespace App\Exports;

use App\User;
use App\SubscriptionPlan;
use App\Properties;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithMapping;

class PropertiesExport implements FromCollection, WithHeadings, ShouldAutoSize , WithEvents, WithMapping
{
    public function collection()
    {
        return Properties::orderBy('id','DESC')->get(['id','user_id','property_name','property_type','property_purpose','price','address','active_plan_id','property_exp_date']);
    }

    public function map($property): array
    {
        return [             
            $property->id,
            getUserInfo($property->user_id)->name,
            $property->property_name,
            getPropertyTypeName($property->property_type)->types,
            $property->property_purpose,
            $property->price,
            $property->address,                        
            SubscriptionPlan::getSubscriptionPlanInfo($property->active_plan_id,'plan_name'),
            $property->property_exp_date?date('m-d-Y',$property->property_exp_date):''
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'User Name',
            'Property Name',
            'Property Type',
            'Property Purpose',
            'Price',
            'Address',
            'Plan',
            'Expiry Date'
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