<?php

final class HomeController
{
    public function defaultAction()
    {
        View::show("home/home");
    }

    /**
     * Download the application zip file
     * @return void
     */
    public function downloadApplicationAction(): void
    {
        $file = 'static/content/downloads/NetworkStories.zip';
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
        View::show("errors/error404");
    }
}