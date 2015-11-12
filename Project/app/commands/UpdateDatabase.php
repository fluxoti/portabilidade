<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UpdateDatabase extends Command
{

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'portabilidade:update-database';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update Database.';

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
	public function fire()
	{
		$file_name = $this->option('file');
		$token = Config::get('services.databaseUpdate.token');

		$url = "http://consulta-operadora.fluxoti.com/v1/download/{$file_name}.zip";

		$file_info = $this->getFileInfo($url, $token);

		if ($file_info['size'] > 0) {

			$filePath = "/tmp/" . $file_name . '.zip';

			$this->downloadFile($filePath, $url, $token);

			if ($this->extractFile($filePath)) {

				$this->importFIle($file_name);

			}
		}
	}

	private function importFIle($file_name)
	{
		$database = Config::get('database.connections.mysql');

		$this->output->writeln("<info>Removendo dados antigos...</info>");
		DB::table($file_name)->truncate();

		$this->output->writeln("<info>Importando dados novos...</info>");

		$file_csv = "/tmp/" . $file_name . '.csv';

		shell_exec(
			"mysql --local-infile -h {$database['host']} -u {$database['username']} -p{$database['password']} {$database['database']} -e \"LOAD DATA LOCAL INFILE '{$file_csv}' INTO TABLE {$file_name} FIELDS TERMINATED BY ',' LINES TERMINATED BY '\\n' IGNORE 1 LINES\""
		);

		$this->output->writeln("<info>Otimizando tabela (desfragmentando)...</info>");
		DB::statement("OPTIMIZE TABLE " . $file_name . ";");
	}

	private function downloadFile($filePath, $url, $token)
	{
		$this->output->writeln("<info>Removendo arquivo antigo...</info>");
		if (file_exists($filePath)) {
			unlink($filePath);
		}

		$this->output->writeln("<info>Baixando arquivo atualizado...</info>");
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			"X-Auth-Token: $token"
		));

		$file = fopen($filePath, 'w+');
		curl_setopt($curl, CURLOPT_FILE, $file);

		$res = curl_exec($curl);
		fclose($file);
	}

	private function extractFile($filePath){
		$zip = new ZipArchive;
		$res = $zip->open($filePath);
		if ($res === TRUE) {
			$zip->extractTo('/tmp/');
			$zip->close();
			return true;

		} else {
			$this->output->writeln("<info>Falha ao extrair o arquivo.</info>");
			return false;
		}
	}

	public function getFileInfo($url, $token)
	{
		$curl = curl_init($url);

		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			"X-Auth-Token: $token"
		));

		curl_setopt($curl, CURLOPT_NOBODY, true);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($curl, CURLOPT_FILETIME, true);

		$result = curl_exec($curl);

		$last_modified = curl_getinfo($curl, CURLINFO_FILETIME);

		$size = curl_getinfo($curl, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

		return array('size' => $size, 'last_modified' => $last_modified);
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array();
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('file', null, InputOption::VALUE_REQUIRED, 'file name', null),
		);
	}



}
