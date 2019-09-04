<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Dies ist der Frontpage Controller, Verantwortlich für das Rendering der Page
 * 
 * @package    sigi
 * @author     Matthias Rohrbach
 * @copyright  (c) Matthias Rohrbach
 * @license    http://sigi.ch/license
 */
class Controller_Frontend_Frontend extends Controller_Frontend_Frontendbase
{
	public function before() {
		parent::before();
		
		// Your Settings here

	}





      public function action_singleview(){


          
          //$this->page=ORM::factory('Node')->where('displayhook',"=", 'startpage')->find();
        $this->page=ORM::factory('Node')->where('displayhook',"=", 'startpage')->find();

          
          // BIND CURRENT PAGEOBJECT
            View::bind_global('page', $this->page);
            $id = $this->request->param('id1');
            
            
            $frontend_viewfile = 'templates/pages/singleview/viewfrontend';
            $this->template = new View($frontend_viewfile);
            
            // SETTING METAINFO IN TEMPLATEFILE
        $this->pagemetaobject           = $this->page->get_meta_object(Session::instance()->get('frontend_language'));
        $this->template->title          = $this->pagemetaobject->get_window_title();
        $this->template->description    = $this->pagemetaobject->get_meta_description();
        $this->template->keywords       = $this->pagemetaobject->get_meta_keywords();
        $this->template->generator      = Backend_Version::get_sigi_version();
        
              //  die(Debug::vars($this->page->nodetemplate->get_containers()));
            
            // SETTING CONTENTS
        foreach($this->page->nodetemplate->get_containers() as $container){
        
            $containercontent="";
            
            
        
        
     //        $viewfrontendurl =  'templates/contents/arbeit/viewfrontend';
             
             
             foreach($this->page->contents
                    ->order_by('position')
                    ->where('lang','=', Session::instance()->get('frontend_language'))
                    ->where('container','=',$container)
                    ->where("visible", "=", 1)
                    ->find_all() as $cont) {
                        
                        
                        
                        
                             if($container == "footer"){
                        $viewfrontendurl = $cont->contentmodule->get_device_viewfile();
                       
                        }else{
                              $cont=ORM::factory('Content',$id);
                            $viewfrontendurl =  'templates/contents/arbeit/singleview';
                        }
                        
                    
                  // $viewfrontendurl = $cont->contentmodule->get_device_viewfile();
                   $contview = new View($viewfrontendurl);
                  $contview->model  = $cont;
                    $containercontent   .= $contview;
                        
                    }



                
               // 
               
             
             
        //     $content=ORM::factory('Content',$id);
          //   die(Debug::vars($content));
             
             
          //        $contview           = new View($viewfrontendurl);
            //         $contview->model    = $content;
                  // $contview->errors   = $errors;
              //     $containercontent   .= $contview;
             
             //die($viewfrontendurl);
             
             
             
            
            /*foreach($this->page->contents
                    ->order_by('position')
                    ->where('lang','=', Session::instance()->get('frontend_language'))
                    ->where('container','=',$container)
                    ->where("visible", "=", 1)
                    ->find_all() as $cont) {
                
                $viewfrontendurl = $cont->contentmodule->get_device_viewfile();

                try {
                    $contview           = new View($viewfrontendurl);
                    $contview->model    = $cont;
                    $contview->errors   = $errors;
                    $containercontent   .= $contview;
                    
                } catch (Kohana_Exception $e) {
                    $view               = new View('errors/errorgui');
                    $view->exception    = $e;
                    $containercontent   .= $view;
                }
        
            }*/
            // !! dynamic variable names! containter-name is variable name in the view. Best Regards, Rajiv.
            $this->template->$container=$containercontent;
            
            
            
            // SETTING NAVIGATIONS
        $mainnaviViewfile = "";
        $langnaviViewfile = "";
        $footernaviViewfile = "";
        if ($this->device->is_mobile()) {
            if ($this->device->is_tablet()) {
                $mainnaviViewfile = "templates/navigations/mainnavitablet";
                $langnaviViewfile = "templates/navigations/langnavitablet";
                $footernaviViewfile = "templates/navigations/footernavitablet";
            } else {
                $mainnaviViewfile = "templates/navigations/mainnavimobile";
                $langnaviViewfile = "templates/navigations/langnavimobile";
                $footernaviViewfile = "templates/navigations/footernavimobile";
            }
                
            if (!Kohana::find_file("views", $mainnaviViewfile)) {
                $mainnaviViewfile = "templates/navigations/mainnavi";
            }
            if (!Kohana::find_file("views", $langnaviViewfile)) {
                $langnaviViewfile = "templates/navigations/langnavi";
            }
            if (!Kohana::find_file("views", $footernaviViewfile)) {
                $footernaviViewfile = "templates/navigations/footernavi";
            }
                
        } else {
            $mainnaviViewfile = "templates/navigations/mainnavi";
            $langnaviViewfile = "templates/navigations/langnavi";
            $footernaviViewfile = "templates/navigations/footernavi";
        }
        
        $this->template->mainnavi   = new View($mainnaviViewfile);
        $this->template->langnavi   = new View($langnaviViewfile);
        $this->template->footernavi = new View($footernaviViewfile);
        $this->template->preview    = new View('templates/navigations/preview');
            
            
            
            
        }
            
            
      
        //  die("show singleview here".$id);
 
        //$model=ORM::factory("content", $id);
        //$sendview=new View($model->contentmodule->viewfolder."/".$viewfile);
        //die($sendview);
        
    }

}