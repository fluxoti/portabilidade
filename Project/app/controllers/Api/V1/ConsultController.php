<?php namespace Api\V1;

use Portabilidade\Consultations\EloquentConsultationRepository;
use Portabilidade\Support\Api\FailedApiValidationException;
use App, Event, Auth, Input;

class ConsultController extends ApiController
{

    /**
     * @var EloquentConsultationRepository
     */
    private $repository;
    private $input;

    /**
     * @param EloquentConsultationRepository $repository
     */
    public function __construct(EloquentConsultationRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }


    private function resolveUserByToken()
    {
        $header = Request::header('X-Auth-Token');
        return \Portabilidade\Clients\Client::whereApiToken($header)->first();
    }

    public function number($number)
    {
        $this->validateInput(['number' => $number]);
        $info = $this->sanitizeNumber($number);

        $data = $this->repository->consult($info['ddd'], $info['pre'], $info['mcd']);

        $carrier = (!isset($data['carrier'])) ? 'nao_identificado' : $data['carrier'];

        return $this->respondResult($data);
    }

    public function multipleNumber()
    {
        $input = Input::only('numbers');
        $numbers = json_decode($input['numbers'], true);
        $this->validateMultipleInput(['numbers' => $numbers]);

        $Alldata = [];
        foreach ($numbers as $number) {
            try {
                $this->validateInput(['number' => $number]);
                $info = $this->sanitizeNumber($number);
                $data = $this->repository->consult($info['ddd'], $info['pre'], $info['mcd']);
                $carrier = (!isset($data['current_carrier'])) ? 'nao_identificado' : $data['current_carrier'];
                $Alldata[] = $this->respondMultipleResult($data, $number);

            } catch (FailedApiValidationException $e) {
                $Alldata[] = $this->respondInvalidResult($number);
            }
        }
        return $Alldata;
    }

    public function allData($number)
    {
        $this->validateInput(['number' => $number]);
        $info = $this->sanitizeNumber($number);
        $data = $this->repository->fullConsult($info['ddd'], $info['pre'], $info['mcd']);

        $data['original_carrier'] = (!isset($data['original_carrier']) || $data['original_carrier'] == null) ? 'nao_identificado' : $data['original_carrier'];
        $data['current_carrier'] = (!isset($data['current_carrier']) || $data['current_carrier'] == null) ? 'nao_identificado' : $data['current_carrier'];

        return $this->respondResult($data);
    }

    public function multipleFullData()
    {
        $input = Input::only('numbers');
        $numbers = json_decode($input['numbers'], true);

        $this->validateMultipleInput(['numbers' => $numbers]);

        $fullData = [];
        foreach ($numbers as $number) {
            try {
                $this->validateInput(['number' => $number]);
                $info = $this->sanitizeNumber($number);
                $data = $this->repository->fullConsult($info['ddd'], $info['pre'], $info['mcd']);
                $data['current_carrier'] = (!isset($data['current_carrier']) || $data['current_carrier'] == null) ? 'nao_identificado' : $data['current_carrier'];
                $fullData[] = $this->respondMultipleResult($data, $number);
            } catch (FailedApiValidationException $e) {
                $fullData[] = $this->respondInvalidMultipleResult($number);
            }
        }
        return $fullData;
    }

    public function simpleConsult()
    {
        $start =  microtime(true);
        $number = Input::get('tel');
        $this->validateInput(['number' => $number]);
        $info = $this->sanitizeNumber($number);

        $data = $this->repository->consult($info['ddd'], $info['pre'], $info['mcd']);

        $carrier = (!isset($data['carrier'])) ? 'nao_identificado' : $data['carrier'];

        return strtolower($carrier);
    }

    private function respondResult($data)
    {
        if (!isset($data)) {
            return $this->respondWithMessage('Número não encontrado');
        }
        return $this->respondWithData($data);
    }

    private function respondMultipleResult($data, $number)
    {
        if (!isset($data)) {
            return ['number' => $number, 'carrier' => 'nao_identificado', 'rn1' => 0];
        } else {
            $data['number'] = $number;
        }
        return $data;
    }

    private function respondInvalidResult($number)
    {
        return ['number' => $number, 'carrier' => 'invalido', 'rn1' => 0];
    }

    private function respondInvalidMultipleResult($number)
    {
        return [
            "number" => $number,
            "portado" => false,
            "original_carrier" => null,
            "original_rn1" => 0,
            "current_carrier" => "invalido",
            "current_rn1" => 0,
            "type" => null,
            "last_updated" => null
        ];
    }

    private function validateInput($input)
    {
        App::make('Portabilidade\Consultations\ConsultValidator')->validate($input);
    }


    private function validateMultipleInput($input)
    {
        App::make('Portabilidade\Consultations\ConsultMultipleValidator')->validate($input);
    }

    private function sanitizeNumber($number)
    {
        return App::make('Portabilidade\Consultations\ConsultSanitizer')->sanitize($number);
    }
}
