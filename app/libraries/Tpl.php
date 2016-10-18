<?php
class TPL
{
		private $_data = array();
        private $_view = array();
        private $js_dir = '';
		public function __construct($config = array())
		{
				$this->ci = &get_instance();
				$this->_data['js_files'] = array();
				$this->_data['css_files'] = array();
				$this->_data['title'] = '';
                $this->_data['breadcrumbs'] = array();
		}
        
        function set_breadcrumbs($array=array())
        {
						foreach ($array as $k=>$v)
						{
								$this->_data['breadcrumbs'][$k] = $v;
						}
				
				return $this;
        }
        
		function js_files($files, $min_file = true)
		{
				if (is_array($files) or is_object($files))
				{
						foreach ($files as $v)
						{
								$this->_data['js_files'][] = sprintf('%s/%s.js',$this->js_dir,$v);
						}
				} else
				{
						$this->_data['js_files'][] = sprintf('%s/%s.js',$this->js_dir,$files);
				}
               
				return $this;
		}
        function js_files_unset($files)
        {
            $search = array_search($files,$this->_data['js_files']);
            
            if($search)
            {
                unset($this->_data['js_files'][$search]);
            }
            return $this;
        }
        function unset_data($file=null)
        {
            unset($this->_data[$file]);
            return $this;
        }
		function css_files($files, $min_file = true, $group = 'global')
		{
				if (is_array($files) or is_object($files))
				{
						foreach ($files as $v)
						{
								$this->_data['css_files'][] = $v;
						}
				}
				
				else
				{
						$this->_data['css_files'][] = $files;
				}
				return $this;
		}
		public function set($name, $value = null,$array=false)
		{
		        
				if($array)
                {
                    	foreach ($value as $k => $v)
						{
								$this->_data[$name][$k] = $v;
						}
                }
				if (is_array($name) or is_object($name))
				{
						foreach ($name as $k => $v)
						{
								$this->_data[$k] = $v;
						}
				}
				
				else
				{
						$this->_data[$name] = $value;
				}
                
                
				return $this;
		}
        	public function set_metadata($name,$value = null)
		{
		        if((int)$value==null&&isset($this->_data[$name]))
                {
                         return $this;
                } 
			
				else
				{
						$this->_data[$name] = $value;
				}
                
                
				return $this;
		}
        
        
        
		public function set_view($name, $value = null, $data = array())
		{
				foreach ($data as $k => $v)
				{
						$this->_data[$k] = $v;
				}
                
				$this->_view[$name] = $value; 
				return $this;
		}
	
		function build($view = 'main', $data = array(), $type = false)
		{
		        $this->_data = array_merge($this->_data, $data);
                  		  
		  	    foreach ($this->_view as $k=>$v) {
                        	$this->_data[$k] = $this->ci->load->view($v, $this->_data, true);
		        }
				
                
             	return $this->ci->load->view($view, $this->_data, $type);
                     $this->ci->firephp->log($this);
		}
}
