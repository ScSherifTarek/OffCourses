<?php
class messages {
    public static function success($message, $padding = 20) {
        $html = '<div style="padding:0 '.$padding.'px"> 
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    <strong>Success</strong> ' . $message . '
                    </div>
                </div>';
        return $html;
    }
    public static function error($message, $padding = 20) {
        $html = '<div style="padding:0 '.$padding.'px">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Error</strong> ' . $message . '
                    </div>      
                </div>';
        return $html;
    }
}
?>