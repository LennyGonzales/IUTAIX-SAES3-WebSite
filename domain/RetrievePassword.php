<?php

class RetrievePassword
{
    private string $email;
    private int $token;
    private string $expiration_date;

    /**
     * @param string $email
     * @param int $token
     * @param string $expiration_date
     */

    public function __construct(string $email, int $token, string $expiration_date)
    {
        $this->email = $email;
        $this->token = $token;
        $this->expiration_date = $expiration_date;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getToken(): int
    {
        return $this->token;
    }

    /**
     * @param int $token
     */
    public function setToken(int $token): void
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getExpirationDate(): string
    {
        return $this->expiration_date;
    }

    /**
     * @param string $expiration_date
     */
    public function setExpirationDate(string $expiration_date): void
    {
        $this->expiration_date = $expiration_date;
    }


}