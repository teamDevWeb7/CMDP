<?php
namespace Core\Toaster;

class Toast{
    public function success(string $message):string{
        return "<my-div class=' toast successToast'>$message</my-div>";
    }


    public function error(string $message):string{
        return "<my-div class='toast errorToast'>$message</my-div>";
    }


    public function warning(string $message):string{
        return "<my-div class='toast warningToast'>$message</my-div>";
    }
}






?>