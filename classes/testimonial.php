<?php
class testimonial extends ObjectModel
{
	public $id;
	public $image;
	public $author;
	public $content;
	public $datetime;
	

	public static $definition = [
		'table' => 'ps_1767_testimonial',
		'primary' => 'id',
		'fields' => [
	       'image' =>  ['type' => self::TYPE_STRING, 'validate' => 'isAnything', 'required'=>true,],
	      'author' =>  ['type' => self::TYPE_STRING, 'validate' => 'isAnything', 'required'=>true,],
	     'content' =>  ['type' => self::TYPE_STRING, 'validate' => 'isAnything', 'required'=>true,],
	 // 'datetime' =>  ['type' => self::TYPE_DATE, 'validate' => 'isDateFormat'],
	    ],
	];

    public function displayimage($id_testimonial){

    	return $results = Db::getInstance()->ExecuteS('SELECT * FROM '._DB_PREFIX_.'ps_1767_testimonial WHERE id = "'.$id_testimonial.'"');
    }

}

?>