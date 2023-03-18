<?php

class User {
    private string $email;
    private string $password;
    private string $userStatus;
    private int $points;

    /**
     * @param string $email
     * @param string $password
     * @param string $userStatus
     * @param int $points
     */
    public function __construct(string $email, string $password, string $userStatus, int $points)
    {
        $this->email = $email;
        $this->password = $password;
        $this->userStatus = $userStatus;
        $this->points = $points;
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
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUserStatus(): string
    {
        return $this->userStatus;
    }

    /**
     * @param string $userStatus
     */
    public function setUserStatus(string $userStatus): void
    {
        $this->userStatus = $userStatus;
    }

    /**
     * @return int
     */
    public function getPoints(): int
    {
        return $this->points;
    }

    /**
     * @param int $points
     */
    public function setPoints(int $points): void
    {
        $this->points = $points;
    }
}
