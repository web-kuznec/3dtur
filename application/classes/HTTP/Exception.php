<?php defined('SYSPATH') OR die('No direct script access.');

class HTTP_Exception extends Kohana_HTTP_Exception {
 
    /**
     * Generate a Response for all Exceptions without a more specific override
     * 
     * The user should see a nice error page, however, if we are in development
     * mode we should show the normal Kohana error page.
     * 
     * @return Response
     */
    public function get_response()
    {
        // Lets log the Exception, Just in case it's important!
        Kohana_Exception::log($this);
 
        if (Kohana::$environment >= Kohana::DEVELOPMENT)
        {
            // Show the normal Kohana error page.
            return parent::get_response();
        }
        else
        {
            // Generate a nicer looking "Oops" page.
            $pages = Model::factory('Pages')->active_top_menu();
            $menu = View::factory("top_menu")->set('pages', $pages);
            $setting = Model::factory('Admin_Settings')->get_all();
            foreach($setting as $k => $v)
            {
                $this->_settings['title'] = $v->title;
                $this->_settings['keywords'] = $v->keywords;
                $this->_settings['description'] = $v->description;
                $this->_settings['text_top'] = $v->text_top;
                $this->_settings['text_bottom'] = $v->text_bottom;
                $this->_settings['phone'] = $v->phone;
                $this->_settings['email'] = $v->email;
                
                $view = View::factory('errors/default')
                        ->set('phone', $v->phone)
                        ->set('email', $v->email)
                        ->set('text_top', $v->text_top)
                        ->set('menu', $menu)
                        ->set('text_bottom', $v->text_bottom);
                
            }
 
            $response = Response::factory()
                ->status($this->getCode())
                ->headers(array(
                    'Content-Type'  => 'text/html',
                    'Pragma'        => 'no-cache', 
                    'Cache-Control' => 'no-store, no-cache, must-revalidate',
                ))
                ->body($view->render());
 
            return $response;
        }
    }
}