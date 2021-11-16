<?php

require "configurações/segurança.php";

class download{
    public function startDownload( $vFilePath, $vDownloadName=""){
        $vFilename		= basename( $vFilePath);
        $vNewFilename	= $vDownloadName == "" ? $vFilename : $vDownloadName;
        $vFileType 		= $this->getFileType( $vFilename);
        $vContentType	= $this->GetContentType( $vFileType);

        // Fix IE bug [0]
        $header_file = (strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE')) ? preg_replace('/\./', '%2e', $vNewFilename, substr_count($vNewFilename, '.') - 1) : $vNewFilename;

        // Prepare headers
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: public", false);
        header("Content-Description: File Transfer");
        header("Content-Type: " . $vContentType);
        header("Accept-Ranges: bytes");
        header("Content-Disposition: inline; filename=\"" . $header_file . "\";");
        //header("Content-Transfer-Encoding: binary");
        header("Content-Length: " . filesize($vFilePath));

        set_time_limit(0);

        // download mittels readfile funktioniert nicht bei grossen dateien

        /* datei paeckchenweise lesen und in den buffer schreiben */
        $vBlockSize = 1048576;//1024;
        $vDownlSpeed= 10;

        $dlfile= fopen( $vFilePath, 'r');
        while (!feof($dlfile) && connection_status() == 0){
            //reset time limit for big files
            set_time_limit(0);
            print fread( $dlfile, $vBlockSize*$vDownlSpeed);
            flush();
        }
        fclose( $dlfile);
        exit();
    }

    function getFileType( $vFilename){
        return strtolower(substr(strrchr($vFilename,"."),1));
    }

    function GetContentType( $FileType=""){
        switch ($FileType) {
            case "pdf": $ctype="application/pdf"; break;
            case "zip": $ctype="application/zip"; break;
            case "doc": $ctype="application/msword"; break;
            case "xls": $ctype="application/vnd.ms-excel"; break;
            case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
            case "gif": $ctype="image/gif"; break;
            case "png": $ctype="image/png"; break;
            case "wmv": $ctype="video/x-ms-wmv"; break;
            case "jpe": case "jpeg": case "jpg": $ctype="image/jpg"; break;
            default: $ctype="application/force-download"; break;
        }

        return $ctype;
    }
}

$imagem = $_GET['imagem'];
$caminho_imagem = $_SERVER['DOCUMENT_ROOT'] . '/../upload/' . $imagem;
if (!is_file($caminho_imagem)) exit;

$cDownload= new download();
$cDownload->startDownload( $caminho_imagem );