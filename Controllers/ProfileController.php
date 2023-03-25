<?php

final class ProfileController extends DefaultController
{
    /**
     * Verify if the user is allows to see the page
     * @return void
     */
    public function verificationSession() {
        if (!Session::check()) {    // Check if the user is connected
            header('Location: /account');   // Redirect to the account page
            exit;
        }
    }

    public function defaultAction(): void
    {
        self::verificationSession();

        $userChecking = new UsersChecking();
        View::show("profile/profile", $userChecking->getByEmail(Session::getSession()['email'], $this->getUsersSqlAccess()));
        View::show("profile/leaderboard", $userChecking->getLeaderboard($this->getUsersSqlAccess()));
    }
}