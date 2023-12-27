<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class ClientsExport implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    protected $clients;

        function __construct($clients) {
                $this->clients = $clients;
        }
    
    public function collection()
    {

        $clients_ =[];

        foreach ($this->clients as $client) {
            $id_type ="";

            if ($client->id_type) {
               $id_type =$client->idType->name;
            }

        $clients_[] =array(
            'Reg Date'            =>date('d-M-Y',strtotime($client->created_at)),
            'Client Name'         =>$client->first_name.' '.$client->middle_name.''.$client->last_name,
            'Client DOB'          =>date('d-M-Y',strtotime($client->dob)),
            'Client Age'          =>age($client->dob),
            'Client Gender'       =>$client->gender->name,
            'Client Marital Status'    =>$client->marital->name,
            'Client Phone Number'      =>$client->phone_number,
            'Client ID Type'           =>$id_type,
            'Client ID Number'         =>$client->id_number,
            'Region'                   =>$client->region->name,
            'District'                 =>$client->district->name,
            'Ward'                     =>$client->ward->name,
            'Physical Location'        =>$client->phyical_address,
            'Hospital Registered'      =>$client->hospital->name,
            'Total Reminders'          =>clientReminder($client->id),
            'Registered By'            =>$client->user->name,
        );

        }

        return collect($clients_);
    }

    public function headings():array{
        return ['Reg Date','Client Name','Client DOB','Client Age','Client Gender','Client Marital Status','Client Phone Number'
        ,'Client ID Type','Client ID Number','Region','District','Ward','Physical Location','Hospital Registered','Total Reminders','Registered By'];
    }
}
