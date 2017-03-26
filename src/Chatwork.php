<?php

namespace NotificationChannels\Chatwork;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use NotificationChannels\Chatwork\Exceptions\CouldNotSendNotification;

class Chatwork
{
    /** @var HttpClient HTTP Client */
    protected $http;

    /** @var null|string Chatwork API Token. */
    protected $token;

    /**
     * @var string API Endpoint
     */
    protected $endpoint;

    /**
     * @param null            $token
     * @param HttpClient|null $httpClient
     * @param string          $endpoint
     */
    public function __construct($token = null, HttpClient $httpClient = null, $endpoint = 'https://api.chatwork.com/v2')
    {
        $this->token = $token;
        $this->http = $httpClient;
        $this->endpoint = $endpoint;
    }

    /**
     * Get HttpClient.
     *
     * @return HttpClient
     */
    protected function httpClient()
    {
        return $this->http ?: $this->http = new HttpClient();
    }

    /**
     * Send text message.
     *
     * <code>
     * $params = [
     *   'room_id' => '',
     *   'text' => '',
     * ];
     * </code>
     *
     * @param array    $params
     *
     * @var int|string $params ['room_id']
     * @var string     $params ['text']
     *
     * @throws CouldNotSendNotification
     * @return bool
     */
    public function sendMessage($params)
    {
        if (empty($this->token)) {
            throw CouldNotSendNotification::serviceRespondedWithAnError('You must provide your chatwork api token to make any API requests.');
        }
        if (!array_key_exists('room_id', $params)) {
            throw CouldNotSendNotification::serviceRespondedWithAnError('Chatwork RoomId is empty');
        }
        if (!is_numeric($params['room_id'])) {
            throw CouldNotSendNotification::serviceRespondedWithAnError('Chatwork RoomId must be a number.');
        }

        $roomId = $params['room_id'];
        $message = $params['text'];

        $url = $this->endpoint . '/rooms/' . $roomId . '/messages';

        try {
            $response = $this->http->post($url, [
                'headers'     => ['X-ChatWorkToken' => $this->token],
                'form_params' => ['body' => $message],
            ]);

        } catch (ClientException $exception) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($exception);
        } catch (\Exception $exception) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($exception);
        }

        return true;
    }
}
