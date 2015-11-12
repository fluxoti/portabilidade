<?php namespace Portabilidade\Support;

use Config;

class DumperDatabase  {

    public function dumperCsv($table, $output, $fields = ['*'])
    {
        $fields = implode(',', $fields);
        $database = Config::get('database.connections.mysql');

        shell_exec("mysql -h {$database['host']} -u {$database['username']} -p{$database['password']} {$database['database']} -e \"SELECT $fields FROM $table\" > $output");
        shell_exec("sed -i -e 's/\t/,/g' $output");
    }

}