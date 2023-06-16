<?php

namespace App\Presenters;

use App\Transformers\PaymentMethodTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PaymentMethodPresenter.
 *
 * @package namespace App\Presenters;
 */
class PaymentMethodPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PaymentMethodTransformer();
    }
}
