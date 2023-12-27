<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class RemindersExport implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    protected $reminders;

        function __construct($reminders) {
                $this->reminders = $reminders;
        }
    
    public function collection()
    {

        $reminders_ =[];

        foreach ($this->reminders as $reminder) {
            $id_type ="";

            if ($reminder->end_date < date('Y-m-d')) {
                $reminder_status ="CLOSED";
            } else {
                $reminder_status ="OPEN";
            }
            

            if ($reminder->patient->id_type) {
               $id_type =$reminder->patient->idType->name;
            }

        $reminders_[] =array(
            'Reg Date'            =>date('d-M-Y',strtotime($reminder->created_at)),
            'Client Name'         =>$reminder->patient->first_name.' '.$reminder->patient->middle_name.''.$reminder->patient->last_name,
            'Client DOB'          =>date('d-M-Y',strtotime($reminder->patient->dob)),
            'Client Age'          =>age($reminder->patient->dob),
            'Client Gender'       =>$reminder->patient->gender->name,
            'Client Marital Status'    =>$reminder->patient->marital->name,
            'Client Phone Number'      =>$reminder->patient->phone_number,
            'Client ID Type'           =>$id_type,
            'Client ID Number'         =>$reminder->patient->id_number,
            'Region'                   =>$reminder->patient->region->name,
            'District'                 =>$reminder->patient->district->name,
            'Ward'                     =>$reminder->patient->ward->name,
            'Physical Location'        =>$reminder->patient->phyical_address,
            'Hospital Registered'      =>$reminder->hospital->name,
            'Service'                  =>$reminder->service->name,
            'Reminder Start Date'      =>date('d-M-Y',strtotime($reminder->start_date)),
            'Reminder Return Date'     =>date('d-M-Y',strtotime($reminder->end_date)),
            'Reminder Status'          =>$reminder_status,
        );

        }

        return collect($reminders_);
    }

    public function headings():array{
        return ['Reg Date','Client Name','Client DOB','Client Age','Client Gender','Client Marital Status','Client Phone Number'
        ,'Client ID Type','Client ID Number','Region','District','Ward','Physical Location',
        'Hospital Registered','Service','Reminder Start Date','Reminder Return Date','Reminder Status'];
    }
}
