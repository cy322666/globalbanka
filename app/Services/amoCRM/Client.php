<?php

namespace App\Services\amoCRM;

use App\Models\Account;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Ufee\Amo\Oauthapi;

class Client
{
    public Oauthapi $service;
    public EloquentStorage $storage;

    public bool $auth = false;

    public function __construct(Account $account)
    {
        $this->storage = new EloquentStorage([
            'domain'    => $account->subdomain,
            'client_id' => $account->client_id,
            'client_secret' => $account->client_secret,
            'redirect_uri'  => $account->redirect_uri,
            'zone'          => $account->timezone,
        ], $account);

        Oauthapi::setOauthStorage($this->storage);
    }

    /**
     * @throws Exception
     */
    public function init(): Client
    {
        $this->service = Oauthapi::setInstance([
            'domain'        => $this->storage->model->subdomain,
            'client_id'     => $this->storage->model->client_id,
            'client_secret' => $this->storage->model->client_secret,
            'redirect_uri'  => $this->storage->model->redirect_uri,
        ]);

        try {
            $this->service->account;

            $this->auth = true;

        } catch (Exception $exception) {

            if ($this->storage->model->refresh_token) {

                $oauth = $this->service->refreshAccessToken($this->storage->model->refresh_token);
            } else
                $oauth = $this->service->fetchAccessToken($this->storage->model->code);

            $this->storage->setOauthData($this->service, [
                'token_type'    => 'Bearer',
                'expires_in'    => $oauth['expires_in'],
                'access_token'  => $oauth['access_token'],
                'refresh_token' => $oauth['refresh_token'],
                'created_at'    => $oauth['created_at'] ?? time(),
            ]);

            $this->auth = true;
        }

        return $this;
    }

    public function setCache()
    {
//        Account::setCacheTime(1);
    }

    public function setDelay()
    {
//        $this->service->queries->setDelay(1);
    }
}
