<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;


class DatabaseSeeder extends Seeder {
public function run()
{
$this->call('TenantsTableSeeder');
$this->command->info('User table seeded!');
}
}


class TenantsTableSeeder extends Seeder {

	public function run()
	{
		
		$branch = new Branch;

		$branch->name = 'Head Office';
		$branch->save();


		$currency = new Currency;

		$currency->name = 'Kenyan Shillings';
		$currency->shortname = 'KES';
		$currency->save();

		

		$organization = new Organization;

		$organization->name = 'Lixnet Technologies';
		$organization->save();


		$share = new Share;


		$share->value = 0;
		$share->transfer_charge = 0;
		$share->charged_on = 'donor';
		$share->save();

       $mail = new Mailsender;
       $mail->driver = 'smtp';
       $mail->save();

    

    $perm = new Permission;

    $perm->name = 'create_employee';
    $perm->display_name = 'Create employee';
    $perm->category = 'Employee';
    $perm->save();


    $perm = new Permission;

    $perm->name = 'update_employee';
    $perm->display_name = 'Update employee';
    $perm->category = 'Employee';
    $perm->save();

    $perm = new Permission;

    $perm->name = 'delete_employee';
    $perm->display_name = 'Deactivate employee';
    $perm->category = 'Employee';
    $perm->save();

    $perm = new Permission;

    $perm->name = 'view_employee';
    $perm->display_name = 'View employee';
    $perm->category = 'Employee';
    $perm->save();



    $perm = new Permission;

    $perm->name = 'manage_earning';
    $perm->display_name = 'Manage earnings';
    $perm->category = 'Payroll';
    $perm->save();

     $perm = new Permission;

    $perm->name = 'manage_deduction';
    $perm->display_name = 'Manage deductions';
    $perm->category = 'Payroll';
    $perm->save();

     $perm = new Permission;

    $perm->name = 'manage_allowance';
    $perm->display_name = 'Manage allowance';
    $perm->category = 'Payroll';
    $perm->save();

     $perm = new Permission;

    $perm->name = 'manage_relief';
    $perm->display_name = 'Manage releif';
    $perm->category = 'Payroll';
    $perm->save();

    
    $perm = new Permission;

    $perm->name = 'manage_benefit';
    $perm->display_name = 'Manage benefits';
    $perm->category = 'Payroll';
    $perm->save();


     $perm = new Permission;

    $perm->name = 'process_payroll';
    $perm->display_name = 'Process payroll';
    $perm->category = 'Payroll';
    $perm->save();

     $perm = new Permission;

    $perm->name = 'view_payroll_report';
    $perm->display_name = 'View reports';
    $perm->category = 'Payroll';
    $perm->save();

     $perm = new Permission;

    $perm->name = 'manage_settings';
    $perm->display_name = 'Manage settings';
    $perm->category = 'Payroll';
    $perm->save();


     $perm = new Permission;

    $perm->name = 'view_application';
    $perm->display_name = 'View applications';
    $perm->category = 'Leave';
    $perm->save();

    $perm = new Permission;

    $perm->name = 'amend_application';
    $perm->display_name = 'Amend applications';
    $perm->category = 'Leave';
    $perm->save();


    $perm = new Permission;

    $perm->name = 'approve_application';
    $perm->display_name = 'Approve applications';
    $perm->category = 'Leave';
    $perm->save();

    $perm = new Permission;

    $perm->name = 'reject_application';
    $perm->display_name = 'Reject applications';
    $perm->category = 'Leave';
    $perm->save();

    $perm = new Permission;

    $perm->name = 'cancel_application';
    $perm->display_name = 'Cancel applications';
    $perm->category = 'Leave';
    $perm->save();


    $perm = new Permission;

    $perm->name = 'manage_type';
    $perm->display_name = 'Manage leave types';
    $perm->category = 'Leave';
    $perm->save();


    $perm = new Permission;

    $perm->name = 'manage_holiday';
    $perm->display_name = 'Manage holidays';
    $perm->category = 'Leave';
    $perm->save();

    $perm = new Permission;

    $perm->name = 'view_leave_report';
    $perm->display_name = 'View reports';
    $perm->category = 'Leave';
    $perm->save();


    $perm = new Permission;

    $perm->name = 'manage_organization';
    $perm->display_name = 'manage organization';
    $perm->category = 'Organization';
    $perm->save();


    $perm = new Permission;

    $perm->name = 'manage_branch';
    $perm->display_name = 'manage branches';
    $perm->category = 'Organization';
    $perm->save();


    $perm = new Permission;

    $perm->name = 'manage_group';
    $perm->display_name = 'manage groups';
    $perm->category = 'Organization';
    $perm->save();


    $perm = new Permission;

    $perm->name = 'manage_organization_settings';
    $perm->display_name = 'manage settings';
    $perm->category = 'Organization';
    $perm->save();



    $perm = new Permission;

    $perm->name = 'manage_user';
    $perm->display_name = 'manage users';
    $perm->category = 'System';
    $perm->save();


    $perm = new Permission;

    $perm->name = 'manage_role';
    $perm->display_name = 'manage roles';
    $perm->category = 'System';
    $perm->save();

    $perm = new Permission;

    $perm->name = 'manage_audit';
    $perm->display_name = 'manage audits';
    $perm->category = 'System';
    $perm->save();



    $perms = Permission::all();

    $pers = array();

    foreach($perms as $p){

        $pers[] = $p->id;
    }

        
    $role = new Role;

    $role->name = 'superadmin';

    $role->save();

    $role->perms()->sync($pers);


         $data = array(
            'username' => 'superadmin',
            'email' => 'superadmin@lixnet.net',
            'password' => 'superadmin',
            'password_confirmation' => 'superadmin',
            'user_type' => 'admin',
            'organization_id' => 1

             );

        $repo = App::make('UserRepository');
        
        $user = $repo->register($data);

        $user->attachRole($role);
            

    
/*
    $perm = new Permission;

    $perm->name = 'view_loan_product';
    $perm->display_name = 'view loan products';
    $perm->category = 'Loanproduct';
    $perm->save();

    $perm = new Permission;

    $perm->name = 'delete_loan_product';
    $perm->display_name = 'delete loan products';
    $perm->category = 'Loanproduct';
    $perm->save();


    $perm = new Permission;

    $perm->name = 'create_loan_account';
    $perm->display_name = 'create loan account';
    $perm->category = 'Loanaccount';
    $perm->save();


    $perm = new Permission;

    $perm->name = 'view_loan_account';
    $perm->display_name = 'view loan account';
    $perm->category = 'Loanaccount';
    $perm->save();


    $perm = new Permission;

    $perm->name = 'approve_loan_account';
    $perm->display_name = 'approve loan';
    $perm->category = 'Loanaccount';
    $perm->save();


    $perm = new Permission;

    $perm->name = 'disburse_loan';
    $perm->display_name = 'disburse loan';
    $perm->category = 'Loanaccount';
    $perm->save();



    $perm = new Permission;

    $perm->name = 'view_savings_account';
    $perm->display_name = 'view savings account';
    $perm->category = 'Savingaccount';
    $perm->save();


    $perm = new Permission;

    $perm->name = 'open_saving_account';
    $perm->display_name = 'Open savings account';
    $perm->category = 'Savingaccount';
    $perm->save();

*/

    
	}

}