<?php namespace Omnipay\MultiSafepay\Message;

class FetchIssuersRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        parent::getData();

        $this->validate('paymentMethod');

        $paymentMethod = $this->getPaymentMethod();

        return compact('paymentMethod');
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {
        $httpResponse = $this->sendRequest(
            'GET',
            '/issuers/' . $data['paymentMethod']
        );

        $this->response = new FetchIssuersResponse(
            $this,
            $httpResponse->json()
        );

        return $this->response;
    }
}
