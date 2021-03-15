<?php
require_once(_PS_MODULE_DIR_.'ps_1767_testimonials/classes/testimonial.php');

class  AdminTestimonialController extends ModuleAdminController{
public function __construct()
      {
   
        parent::__construct();
        $this->bootstrap = true; 
        $this->table = 'ps_1767_testimonial'; 
        $this->identifier = 'id'; 
        $this->className = 'testimonial';
        $this->_defaultOrderBy = 'a.id'; 
        $this->_defaultOrderWay = 'ASC';
        $this->fields_list = [
            'id' => ['title' => 'ID','class' => 'fixed-width-xs'],
             
            'image' => ['title' => 'Image'],
            'author' => ['title' => 'Author'],
            'content' => ['title' => 'content'],

             ];

        $this->addRowAction('edit');
        $this->addRowAction('delete');
        $this->addRowAction('details');
        
         $this->fields_form = [
        'legend' => [
          'title' => 'Add Testimonial',
          'icon' => 'icon-list-ul'
        ],

        'input' => [
           
          ['name'=>'image','type'=>'file','label'=>'Image','required'=>true,],


          ['name'=>'author','type'=>'text','label'=>'Author','required'=>true,],
          ['name'=>'content','type'=>'text','label'=>'Content','required'=>true,],
          

          
          
        ],
        'submit' => [
          'title' => $this->trans('Save', [], 'Admin.Actions'),
        ]
      ];

      }

  public function renderForm()
    {

if(isset($_GET['id'])){
  $id_testimonial = $_GET['id'];
   $sel = new testimonial();
     $azx = $sel->displayimage($id_testimonial);
     $ima = $azx['0']['image'];
   // print_r($azx);

          $this->fields_form = array(
                'legend' => array(
                    'title' => $this->l('ps_1767_testimonials'),
                    'icon' => 'icon-folder-close'
                ),
                'input' => array(
                  array(
                        'type' => 'file',
                        'label' => $this->l('Image'),
                        'name' => 'image',
                        'hint' => $this->l('Upload Image Vendor'),
                         'thumb' => $this->context->shop->getBaseURL(true, true).
                        'modules/ps_1767_testimonials/images/'.$ima,
                       
                    ),               
                    array(
                        'type' => 'text',
                        'label' => $this->l('Author'),
                        'name' => 'author',
                        'required' => true,
                        'hint' => $this->l('Author'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Content'),
                        'name' => 'content',
                        'required' => true,
                        'hint' => $this->l('Content'),
                    ),
                   
                   
                 
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Active Testimonial'),
                        'name' => 'active',
                        'is_bool' => true,
                        'required' => true,
                        'hint' => $this->l('Active Testimonial'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('save'),
                ),
                'buttons' => array(
                    'save-and-stay' => array(
                        'title' => $this->l('save and Stay'),
                        'name' => 'submitAdd'.$this->table.'AndStay',
                        'type' => 'submit',
                        'class' => 'btn btn-default pull-right',
                        'icon' => 'process-icon-save'
                    )
                )
            );
}
     


     

     return parent::renderForm();

    }


    public function processAdd()
           {
      if(Tools::getvalue('image')){

       $author = Tools::getvalue('author');
       $content =  Tools::getvalue('content');
     // echo   Tools::getvalue('image');
       $file = $_FILES['image']['name'];
      $df = $_FILES['image']['tmp_name'];
    move_uploaded_file($df, _PS_MODULE_DIR_.'/ps_1767_testimonials/images/'. $file); 

    $insertData = array(
         'author' => Tools::getValue('author'),
         'content' => Tools::getValue('content'),
         'image' =>  $_FILES['image']['name'],
          );
      Db::getInstance()->insert("ps_1767_testimonial", $insertData);



      }

    }


    

   }