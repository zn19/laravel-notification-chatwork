<?php

namespace Revolution\NotificationChannels\Chatwork;

class ChatworkMessage
{
    public $roomId;
    public $to;
    public $message;
    public $token;

    public static function create($message = '')
    {
        return new static($message);
    }

    public function __construct($message = '')
    {
        $this->message($message);
    }

    /**
     * Set the message post room id.
     *
     * @param  string $roomId
     *
     * @return $this
     */
    public function roomId($roomId)
    {
        $this->roomId = $roomId;

        return $this;
    }

    /**
     * Set the message destination account id.
     *
     * @param  string $to
     *
     * @return $this
     */
    public function to($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Set the normal message.
     *
     * @param  string $message
     *
     * @return $this
     */
    public function message($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Set the token.
     *
     * @param  string $token
     *
     * @return $this
     */
    public function token($token)
    {
        $this->token = $token;

        return $this;
    }
}
