<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class UsersExport implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    protected $users;

        function __construct($users) {
                $this->users = $users;
        }
    
    public function collection()
    {

        $users_ =[];

        foreach ($this->users as $user) {
            $hospital_name   ="";
            $total_reminders ="";

            if ($user->hasRole(2) || $user->hasRole(3)) {
                if ($user->staff) {
                    $hospital_name =$user->staff->hospital->name;
                }
               
            }

        $users_[] =array(
            'Reg Date'            =>date('d-M-Y',strtotime($user->created_at)),
            'Name'                =>$user->name,
            'Contact Address'     =>$user->phone,
            'Email Address'       =>$user->email,
            'Gender'              =>$user->gender->name,
            'Role'                =>$user->roles->userRole->description,
            'Hospital Name'       =>$hospital_name,
        );

        }

        return collect($users_);
    }

    public function headings():array{
        return ['Reg Date','Name','Contact Address','Email Address','Gender','Role','Hospital Name'];
    }
}
