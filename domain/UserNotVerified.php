<?php

class UserNotVerified
{
    private string $email;
    private string $user_password;
    private int $token;
    private string $expiration_date;

    /**
     * @param string $email
     * @param string $user_password
     * @param int $token
     * @param string $expiration_date
     */
    public function __construct(string $email, string $user_password, int $token, string $expiration_date)
    {
        $this->email = $email;
        $this->user_password = $user_password;
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
     * @return string
     */
    public function getUserPassword(): string
    {
        return $this->user_password;
    }

    /**
     * @param string $user_password
     */
    public function setUserPassword(string $user_password): void
    {
        $this->user_password = $user_password;
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