<?php namespace Api\V1;

use Illuminate\Pagination\Paginator;
use App, Event;
use Illuminate\Support\Facades\Request;
use Portabilidade\Clients\Client;

/**
 * /**
 * @apiDefine StatusCode
 * @apiError {int} status_code Codigo do status da requisição
 */

/**
 * Class ApiController
 *
 * @apiDefine XAuthTokenHeader
 * @apiHeader {string} X-Auth-Token Token de autenticação do Usuário
 */

class ApiController extends \Controller {

    /**
     * @var int
     */
    protected $statusCode = 200;
    private $start;


    public function __construct()
    {
        $this->start =  microtime(true);
    }

    /**
     * @param $code
     * @return $this
     */
    protected function setStatusCode($code)
    {
        $this->statusCode = $code;
        return $this;
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function respond(array $data = [])
    {
        $input = \Input::only('token');

        if (Request::header('X-Auth-Token')) {
            $token = Request::header('X-Auth-Token');
        }elseif (isset($input['token'])) {
            $token = $input['token'];
        }

        $data = array_merge($data, ['status_code' => $this->statusCode, 'response_time' => round((microtime(true) - $this->start),3)]);
        return App::make('Response')->json($data, $this->statusCode);
    }

    /**
     * @param Paginator $paginator
     * @return mixed
     */
    protected function respondWithPagination( Paginator $paginator)
    {
        $response = [
            'data' => $paginator->getItems(),
            'paginator' => [
                'total_count' => $paginator->getTotal(),
                'total_pages' => ceil( $paginator->getTotal() / $paginator->getPerPage()),
                'current_page' => $paginator->getCurrentPage()
            ],
        ];
        return $this->setStatusCode(200)->respond($response);
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function respondWithData($data = [])
    {
        return $this->setStatusCode(200)->respond(['data' => $data]);
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function respondCreated($data = [])
    {
        return $this->setStatusCode(201)->respond(['data' => $data]);
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function respondUpdated($data = [])
    {
        return $this->setStatusCode(200)->respond(['data' => $data]);
    }

    /**
     * @return mixed
     */
    protected function respondDestroyed()
    {
        return $this->setStatusCode(200)->respond();
    }

    /**
     * Respond with a simple message
     *
     * @param $message
     * @return mixed
     */
    protected function respondWithMessage($message)
    {
        return $this->respond(['message' => $message]);
    }


}

