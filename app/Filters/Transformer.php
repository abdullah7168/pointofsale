<?php
    namespace App\Filters;

    class Transformer{

        protected $_spaceflag;
        protected $_transformed;

        public function __construct(){
           
        }

        public function sniffSpaces($raw_recipe_name,$extention){
            //look for the spaces
            $this->_spaceflag = preg_match('/\s/',$raw_recipe_name); 

            if($this->_spaceflag){
               
                $this->_transformed = preg_replace('/\s/','-',$raw_recipe_name);
                return $this->_transformed.'.'.$extention;


            } else {

               return $raw_recipe_name.'.'.$extention;

            }
        }
    }