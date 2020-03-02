<?php

namespace App\Imports;

use App\Customer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CustomersImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        return new Customer([
            'name' => $collection['name'],
            'address_line1' => $collection['address_line1'],
            'town' => $collection['town'],
            'postcode' => $collection['postcode'],
            'email' => $collection['email'],
            'telephone' => $collection['telephone'],
            'owner' => $collection['owner'],
            'status' => $collection['status'],
            'contact_name' => $collection['contact_name'],
            'contact_role' => $collection['contact_role'],
        ]);
    }
}
