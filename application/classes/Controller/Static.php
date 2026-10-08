<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Static extends Controller_Common
{
    public $template = 'main';

    public function action_index()
    {
        $page = Request::current()->param('page');
        $info = Model::factory('Pages')->get_page_by_translit($page);
        if ($info->count() == 1)
        {
            foreach ($info as $inf)
            {
                $name = $inf->name_menu;
                $title = $inf->title;
                $description = $inf->description;
                $keywords = $inf->keywords;
                $tizer = $inf->tizer;
                $text = $inf->text;
                $seo = $inf->seo;
            }

            $this->template->name = $name;
            if($page == '')
            {
                if(isset($_GET['old']))
                {
                    $slider = Model::factory('Admin_Works')->get_slider();
                    $sls = Model::factory('Admin_Slides')->get_all();
                    $slide1 = View::factory('slides/1')->set('slider', $slider)->set('sl1', $sls[0]);
                    $advances = Model::factory('Admin_Advances')->get_all();
                    $slide2 = View::factory('slides/2')->set('advances', $advances)->set('sl2', $sls[1]);

                    $slide3 = View::factory('slides/3')->set('sl3', $sls[2]);
                    $html = $slide1.$slide2.$slide3;
                    $this->template->content = $html;
                }
                else
                {
                    $html = "";
                    $sliders = Model::factory('Admin_Slides')->get_all();
                    $partners = View::factory('slides/partners')
                                ->set('info', $sliders);
                    $video = View::factory('slides/video')
                                ->set('label', $sliders[0]->label_video)
                                ->set('video', $sliders[0]->video)
                                ->set('img3', $sliders[0]->img3);
                    foreach($sliders as $k => $v)
                    {
                        if($v->id == 1)
                        {
                            $slider = Model::factory('Admin_Works')->get_slider();
                            $html .= View::factory('slides/block_'.$v->id)
                                    ->set('slider', $slider)
                                    ->set('info', $v)
                                    ->bind('partners', $partners);
                        } elseif($v->id == 2) {
                            $html .= $video;
                            $advances = Model::factory('Admin_Advances')->get_all();
                            $html .= View::factory('slides/block_'.$v->id)
                                    ->set('advances', $advances)
                                    ->set('info', $v);
                        } else {
                            $html .= View::factory('slides/block_'.$v->id)
                                    ->set('info', $v);
                        }
                    }
                    $this->template->content = $html;
                }
                $this->template->title = $title;
                $this->template->keywords = $keywords;
                $this->template->description = $description;
            }
            else
            {
                if(empty($title))
                    $title = $name;
                $this->template->title = $title;
                $this->template->keywords = $keywords;
                $this->template->description = $description;
                $this->template->content = View::factory('static')
                        ->set('name', $name)
                        ->set('text', $text);
            }
        }
    }

} // End Static