<?php

namespace App\Imports;

use App\Customer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class CustomerImport implements ToCollection,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            Customer::create([
                'name' => $row['name'],
                'address_line1' => $row['address_line1'],
                'town' => $row['town'],
                'postcode' => $row['postcode'],
                'email' => $row['email'],
                'telephone' => $row['telephone'],
                'owner' => $row['owner'],
                'status' => $row['status'],
                'contact_name' => $row['contact_name'],
                'contact_role' => $row['contact_role'],
            ]);
        }
    }
}
