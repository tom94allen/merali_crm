<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateContactId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:contactid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update last_contact_id in customer table when new contact created';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //get all customers first to loop through and update column foreach customer
        $customers = Customer::all();
        foreach($customers as $customer){
            $latest = DB::select('select contact_id, created_at from contacts where customer_id = '.$customer->customer_id.' order by created_at DESC');
            $last_contact_id = $latest[0]->contact_id;
            if($last_contact_id){
                $update = DB::table('customers')
                ->where('customer_id', $customer->customer_id)
                ->update(['last_contact_id' => $last_contact_id]);
            }
            else{
                continue;
            }
            
        }

    }
}
