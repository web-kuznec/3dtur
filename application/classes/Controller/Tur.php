<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Tur extends Controller_Common {

    public $template = 'tur';
    
    public function action_hall()
    {
        $this->template->name = "hall";
    }
    
    public function action_livinroom()
    {
        $this->template->name = "livinroom";
    }
    
    public function action_childrenroom()
    {
        $this->template->name = "childrenroom";
    }
    
    public function action_kitchen()
    {
        $this->template->name = "kitchen";
    }

} // End Tur
