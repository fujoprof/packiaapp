<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

//class UsersExport implements FromCollection, WithCustomCsvSettings, WithHeadings
class UsersExport implements FromCollection, WithHeadings
{
	/*public function getCsvSettings(): array
	{
		return [
			'delimiter' => ';'
		];
	}*/

	public function headings(): array
	{
		return ["first_name", "middle_name", "last_name","email","address","phone_number","date_of_birth","gender","password"];
	}

	/**
	* @return \Illuminate\Support\Collection
	*/
	
	public function collection()
	{
        return collect([[]]); // Return an empty collection containing an empty array
	}
	
}
