<?php
namespace Core\toaster;

class Toast{
    public function success(string $message):string{
        return "<div class='successToast'>$message</div>";
    }


    public function error(string $message):string{
        return "<div class='errorToast'>$message</div>";
    }


    public function warning(string $message):string{
        return "<div class='warningToast'>$message</div>";
    }
}






?>