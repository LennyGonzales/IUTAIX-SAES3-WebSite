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

    public function guideDockerAction()
    {
        $file = 'static/content/downloads/SAES4-GuideUtilisation-Dockers.pdf';
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


    public function mentionsLegalesAction()
    {
        $file = 'static/content/downloads/mentions-legales-et-conditions-generales.pdf';
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

    public function MacOsAction()
    {
        $file = 'static/content/downloads/MacOS.zip';
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

    public function WindowsAction()
    {
        $file = 'static/content/downloads/Windows.zip';
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