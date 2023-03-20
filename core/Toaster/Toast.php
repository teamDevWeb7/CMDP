<?php
namespace Core\toaster;

class Toast{
    public function success(string $message):string{
        return "<div class=' toast successToast'>$message</div>";
    }


    public function error(string $message):string{
        return "<div class='toast errorToast'>$message</div>";
    }


    public function warning(string $message):string{
        return "<div class='toast warningToast'>$message</div>";
    }
}






?>