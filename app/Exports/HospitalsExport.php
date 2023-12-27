<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class HospitalsExport implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    protected $hospitals;

        function __construct($hospitals) {
                $this->hospitals = $hospitals;
        }
    
    public function collection()
    {

        $hospitals_ =[];

        foreach ($this->hospitals as $hospital) {

        $hospitals_[] =array(
            'Reg Date'            =>date('d-M-Y',strtotime($hospital->created_at)),
            'Hospital Name'       =>$hospital->name,
            'Hospital Contact'    =>$hospital->phone_number,
            'Email Address'       =>$hospital->email,
            'Region'              =>$hospital->region->name,
            'District'            =>$hospital->district->name,
            'Ward'                =>$hospital->ward->name,
            'Physical Location'   =>$hospital->location,
            'Total Reminders'     =>hospitalReminders($hospital->id),
            'Registered By'       =>$hospital->user->name,
        );

        }

        return collect($hospitals_);
    }

    public function headings():array{
        return ['Reg Date','Hospital Name','Hospital Contact','Email Address','Region','District','Ward','Physical Location','Total Reminders','Registered By'];
    }
}
