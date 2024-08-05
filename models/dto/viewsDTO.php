<?php
class viewsDTO {
    private $view;

    public function __construct($view) {
        $this->view = $view;
    }

    public function getView() {
        return $this->view;
    }
}
?>
