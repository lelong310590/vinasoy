<?php
/**
 * ImportMember.php
 * Created by: trainheartnet
 * Created at: 30/11/2022
 * Contact me at: longlengoc90@gmail.com
 */


namespace Botble\Member\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Botble\Member\Models\Member;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class ImportMember implements ToModel, WithProgressBar
{
    use Importable;
    /**
     * @param array $row
     * @return Member
     */
    public function model(array $row)
    {
        $rowPassword = explode('-', $row[2]);
        $password = $rowPassword[2].$rowPassword[1].$rowPassword[0];
        return new Member([
            'hrm' => $row[0],
            'first_name' => $row[1],
            'password' => $password,
            'department' => bcrypt($row[3]),
            'area' => bcrypt($row[4]),
            'dob' => $row[2]
        ]);
    }
}
