<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        Eloquent::unguard();

        $this->call('CompanyTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('BillingInformationTableSeeder');
        $this->call('PasswordRemindersTableSeeder');
        $this->call('ExtractTableSeeder');
        $this->call('OperadoraTableSeeder');
        $this->call('PrefixoTableSeeder');
        $this->call('PortadoTableSeeder');
        $this->call('MongoStatisticsSeeder');
        $this->call('ListTableSeeder');
        $this->call('DownloadHistoryTableSeeder');
        $this->call('MongoListsSeeder');
        $this->call('UpdateBaseHistoryTableSeeder');
        $this->call('PlanTableSeeder');
	}

}
