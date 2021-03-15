<?php
require_once(_PS_MODULE_DIR_.'ps_1767_testimonials/classes/testimonial.php');
class Ps_1767_testimonials extends Module{
	public function __construct(){

		$this->name = 'ps_1767_testimonials';
		$this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Verts';
        $this->bootstrap = true;
        parent::__construct();
        $this->displayName = $this->l('Testimonials');
        $this->description = $this->l('This module is developed for Testimonials.');
        $this->ps_versions_compliancy = array('min' => '1.7.6.0', 'max' => _PS_VERSION_);
     
	}
	public function install(){

       $class = 'Admin'.'Testimonial';
    
        $id_parent = Tab::getIdFromClassName('IMPROVE');
        $tab1 = new Tab();
        $tab1->class_name = $class;
        $tab1->module = $this->name;
        $tab1->id_parent = $id_parent;
        $langs = Language::getLanguages(false);
        foreach ($langs as $l) {
            $tab1->name[$l['id_lang']] = $this->l('Testimonials');
        }
        $tab1->add(true, false);

        Db::getInstance()->execute('
            UPDATE `'._DB_PREFIX_.'tab`
            SET `icon` = "shopping_cart"
            WHERE `id_tab` = "'.(int)$tab1->id.'"'
        );

     $this->installModuleTab('Testimonial', 'AdminTestimonial','AdminTestimonial');
        
    include_once($this->local_path.'sql/install.php');
    return parent::install() && $this->registerhook('displayHome')&& $this->registerHook('header');
	}
	public function uninstall(){
	 include_once($this->local_path.'sql/uninstall.php');
       if (!parent::uninstall())
        return false;
      return true;

       $this->uninstallModuleTab('Testimonial');
        $this->uninstallModuleTab('AdminTestimonial');
        
	}


	public function hookHeader(){

        $this->context->controller->addCSS($this->_path.'views/css/testi.css');
		$this->context->controller->addJS($this->_path.'views/js/testi.js');

	}


  public function installModuleTab($title, $class_sfx = '', $parent = '')
    {
        $class = $class_sfx;
        @copy(_PS_MODULE_DIR_.$this->name.'/logo.gif', _PS_IMG_DIR_.'t/'.$class.'.gif');
        if ($parent == '') {
            # validate module
            $position = Tab::getCurrentTabId();
        } else {
            # validate module
            $position = Tab::getIdFromClassName($parent);
        }
        $tab1 = new Tab();
        $tab1->class_name = $class;
        $tab1->module = $this->name;
        $tab1->id_parent = (int)$position;
        $langs = Language::getLanguages(false);
        foreach ($langs as $l) {
            $tab1->name[$l['id_lang']] = $title;
        }
        $tab1->add(true, false);
    }

    public function uninstallModuleTab($class_sfx = '')
    {
        $tab_class = 'Admin'.Tools::ucfirst($class_sfx);
        $id_tab = Tab::getIdFromClassName($tab_class);

        if ($id_tab != 0) {
            $tab = new Tab($id_tab);
            $tab->delete();

            return true;
        }

        return false;
    }



	public function hookDisplayHome(){

    $this->context->smarty->assign(array(
     'testimonial'     => Db::getInstance()->executeS('SELECT * FROM `'._DB_PREFIX_.'ps_1767_testimonial`')));

     return $this->display(__FILE__, 'views/templates/front/testimonial.tpl');

	}
}



