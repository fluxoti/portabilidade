<?php namespace Portabilidade\Consultations;

use Illuminate\Foundation\Application as App;
use Event, Auth;
use Carbon\Carbon;

class EloquentConsultationRepository implements ConsultationRepositoryInterface
{
    /**
     * @var App
     */

    private $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    private $model;

    public function getModel()
    {
        if (!isset($this->model)) {
            $this->model = new Portability;
        }

        return $this->model;
    }

    public function consult($ddd, $prefix, $mcd)
    {
        $data = $this->getModel()->whereNumber($ddd . $prefix . $mcd)->first();
        if ($data) {
            if ($phoneCompany = PhoneCompany::find($data->rn1)) {
                $carrier = explode(" ", $phoneCompany->carrier);
                return ['carrier' => $carrier[0], 'rn1' => $data->rn1];
            }
        }

        $prefix = Prefix::whereDdd($ddd)->wherePrefix($prefix)->first();

        if (isset($prefix)) {
            if ($carrier = PhoneCompany::find($prefix->rn1)) {
                $carrier = explode(" ", $carrier->carrier);
                return ['carrier' => $carrier[0], 'rn1' => $prefix->rn1];
            }
        }

        return ['carrier' => 'nao_identificado', 'rn1' => 0];
    }

    public function fullConsult($ddd, $prefix, $mcd)
    {
        $info = [
            'number' => $ddd . $prefix . $mcd,
            'portado' => false,
            'original_carrier' => null,
            'original_rn1' => 0,
            'current_carrier' => null,
            'current_rn1' => 0,
            'type' => null,
            'last_updated' => Carbon::now()->toDateTimeString()
        ];

        $dataFromPrefix = Prefix::whereDdd($ddd)->wherePrefix($prefix)->first();
        if (!isset($dataFromPrefix)) {
            return $info;
        }

        $phoneCompany = PhoneCompany::find($dataFromPrefix->rn1);
        if (!isset($phoneCompany)) {
            return $info;
        }

        $carrier = explode(" ", PhoneCompany::find($dataFromPrefix->rn1)->carrier);
        $info['type'] = $dataFromPrefix->type;
        $info['original_carrier'] = $info['current_carrier'] = $carrier[0];
        $info['original_rn1'] = $info['current_rn1'] = $dataFromPrefix->rn1;

        $dataFromPort = $this->getModel()->whereNumber($ddd . $prefix . $mcd)->first();
        if (isset($dataFromPort)) {
            $info['portado'] = true;
            $info['last_updated'] = $dataFromPort->date;
            $phoneCompanyData = PhoneCompany::find($dataFromPort->rn1);
            $carrier = explode(" ", $phoneCompanyData->carrier);
            $info['current_carrier'] = $carrier[0];
            $info['current_rn1'] = $dataFromPort->rn1;
        }

        return $info;

    }

    public function debit($billing_info)
    {
        $plan = \Portabilidade\Plans\PlansResolver::resolve($billing_info->plan);
        $repositoryBilling = $this->app->make('Portabilidade\Billing\EloquentBillingInformationRepository');

        if ($plan->limit() !== false && $billing_info->allowed_requests > 0) {
            $repositoryBilling->update(
                $billing_info->id,
                ['allowed_requests' => $billing_info->allowed_requests - 1]
            );
        } elseif ($plan->excessValue() !== false) {
            $repositoryBilling->update(
                $billing_info->id,
                ['balance' => $billing_info->balance - $plan->excessValue()]
            );
        }
    }
}