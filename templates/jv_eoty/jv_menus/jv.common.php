<?php
/**
* @version 1.5.x
* @package JoomVision Project
* @email webmaster@joomvision.com
* @copyright (C) 2008 http://www.JoomVision.com. All rights reserved.
*/
// No direct access 
defined('_JEXEC') or die();
/**
 * Class Menu Common
 *
 */
class MenuSystem{
		var $_name = null;
        var $_template = null;
        var $_start = null;
        var $_end = null;
        var $_suffix = null;
        var $_active = null;
        var $_type = null;
        var $_cache = null;
        var $_nav = null;
        var $Itemid = null;
        
		/**
		 * Enter description here...
		 *
		 * @param string $name
		 * @param string $menutype
		 * @param string $template_name
		 * @param string $suffix
		 * @return MenuSystem
		 */
		function MenuSystem( $name,$menutype,$template_name, $suffix="" ){
			global $Itemid;
			$this->_name = $name;
            $this->_template = $template_name;
            $this->_suffix = $suffix;
            $this->_type = $menutype;
            $this->Itemid = $Itemid;
            $document =& JFactory::getDocument();
            $document->addStyleSheet(JURI::base().'templates/'.$this->_template.'/jv_menus/'.'jv_'.$this->_name.'menu/'.'jv.'.$this->_name.'menu.css');
            $document->addCustomTag('<script type="text/javascript" src="'.JURI::base().'templates/'.$this->_template.'/jv_menus/'.'jv_'.$this->_name.'menu/'.'jv.'.$this->_name.'menu.js"></script>');
			/*
            if ($this->_name == 'dropline') {
                $document->addCustomTag('<script type="text/javascript">var menusys_active = new Array('. ( (count($this->_active) == 1) ? '"'.$this->open[0].'"' : implode(",", array_reverse($this->_active)) ) .');</script>'); 
            }
			*/
            $this->genmenu();
		}                    	    
		function hasChild($lvl) {
			$pid = $this->fatherId ($lvl);
			if (!$pid) return false;
            if (@$this->_nav[$pid]) return true;
            else return false;
		}
        function _showMenuDetail($row, $level = 0) {
            $_temp = null;
            $title = "title=\"$row->name\""; 
            $menu_params = & new JParameter ($row->params);
            if ($row->type == 'separator') {
                echo '<a href="javascript://" title=""><span class="separator">'.$row->name.'</span></a>';
            }
            if ($menu_params->get('menu_image') && $menu_params->get('menu_image') != -1) {
                    $str = '<img src="images/stories/'.$menu_params->get('menu_image').'" alt="'.$row->name.'" /><span class="menusys_name">'.$row->name.'</span>';
            } else {
                $str = '<span class="menusys_name">'.$row->name.'</span>';
            }
            
            $Class = $this->activeClass ($row, $level);
            $id='id="menusys'.$row->id.'"';            
            
            if ($row->url != null) {
                if ($row->browserNav == 0) {
                    $menuItem = '<a href="'.$row->url.'" '.$Class.' '.$id.' '.$title.'>'.$str.'</a>';
                } elseif ($row->browserNav == 1) {
                    $menuItem = '<a target="_blank" href="'.$row->url.'" '.$Class.' '.$id.' '.$title.'>'.$str.'</a>';
                } elseif ($row->browserNav == 2) {
                    $url = str_replace('index.php', 'index2.php', $tmp->url);   
                    $atts = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=500,height=350';
                    $menuItem = '<a href="'.$url.'" onclick="window.open("'.$url.'",\'targetWindow\',\''.$atts.'\'); return false;" '.$Class.' '.$id.' '.$title.'>'.$str.'</a>';
                }
            } else {
                $menuItem = '<a '.$active.' '.$id.' '.$title.'>'.$str.'</a>';
            }
                
            echo $menuItem;
        }      
		function show($start=0, $end = 14) {
			$this->_start = $start;
			$this->_end   = $end;
            echo "<div class=\"menusys_".$this->_name.$this->_suffix."\">";
			if ($this->_start == 0) {
                //~~ Only first level will be shown ~~
				$this->showMenu (0, 0);
			}else{
				$parID = $this->fatherId($this->_start); 
				if ($parID) $this->showMenu ($parID, $this->_start);
			}
            echo "</div>";
		}
		function showMenu($pid, $level) {
			if (@$this->_nav[$pid]) {
                if ($level == 0) { 
                    echo "<ul id=\"menusys_".$this->_name."\">"; 
                } elseif($level == 1 && ($this->_name == 'submoo' || $this->_name == 'split')) {
					echo "<ul id=\"menusub_".$this->_name."\">";
				} else {
                    echo "<ul>";
                }			
				$i = 0;
				foreach ($this->_nav[$pid] as $menu) {
					if(@$this->_nav[$menu->id])
						$abc = " hasChild";
					else
						$abc = "";
					if ($i == 0) echo '<li class="first-item'.$abc.'">';
                    elseif ($i == count($this->_nav[$pid]) - 1) echo '<li class="last-item'.$abc.'">';
                    else echo '<li class="'.$abc.'">';
                    $this->_showMenuDetail( $menu, $level);
					if ($level < $this->_end) $this->showMenu( $menu->id, $level+1 );
					$i++;
                    echo "</li>";
				}
				
			echo "</ul>";
            }
		}
        function activeClass ($menu_item, $level) {
            return (in_array($menu_item->id, $this->_active)) ? " class=' active'" : " class=' item'";
        }
        //~~ This function will found the father ID of and item marked by level in array of active items ~~~~~~~
		function fatherId ($lvl) {
            if (!$lvl) return 0;
            //echo "<pre>";print_r($this->_active);exit;
			if (count($this->_active) < $lvl) return 0;
            $parID = count($this->_active) - $lvl;
			return $this->_active[$parID];
		}
        
		/**
		 * Generate the menu
		 *
		 * @return mixed
		 */
        function  genmenu(){
            $nav          = @JMenu :: getInstance();
        	
            $my           = &JFactory::getUser();
            $nav          = array();
             
            $this->_cache = array();
            if(@strtolower(get_class($menu)) == 'jexception') {
                $nav = @JMenu :: getInstance('site');
            }
            $menus = &JSite::getMenu();
            $rows = $menus->getItems('menutype', $this->_type);
            $_tmp = array();
            if (count($rows)) {
               foreach ($rows as $key => $value) {
                if ($value->access <= $my->get('gid')) {
                    $par = $value->parent;
                    $list_menu = @ ($nav[$par]) ? $nav[$par] : array ();
                    if ($value->type == 'separator') {
                        return '<span class="separator">'.$value->name.'</span>';
                    } elseif ($value->type == 'url') {
                        if ((strpos($value->link, 'index.php?') !== false) && (strpos($value->link, 'Itemid=') === false)) {
                            $value->url = $value->link.'&amp;Itemid='.$value->id;
                        } else {
                            $value->url = $value->link;
                        }   
                    } else {
                        $router = JSite::getRouter();
                        if ($router->getMode() == JROUTER_MODE_SEF) {
                            //~~ No JRoute now ~~~
                            $value->url = 'index.php?Itemid='.$value->id;
                        } else {
                            //~~ No JRoute now ~~~
                            $value->url = $value->link.'&amp;Itemid='.$value->id;   
                        }
                    }
                    $value->_index = count($list_menu);
                    $list_menu[] = $value;
                    $nav[$par] = $list_menu;
                }
                $this->_cache[$value->id] = $value;
                $_tmp[$value->id] = $key;
	            }
	        }
            $this->_nav = $nav;
            //~~ Find out what submenus this item has ~~~~~~~~~~~
            $active = array ($this->Itemid);
            $max = 14;
            //~~ We dont need more than 14 levels of menu, do we? ~~~
            $id = $this->Itemid;
            while ($max) {
                if (isset($_tmp[$id])) {
                    $tmp = $_tmp[$id];
                    if (isset ($rows[$tmp]) && $rows[$tmp]->parent > 0) {
                        $id = $rows[$tmp]->parent;
                        $active[] = $id;
                    } else {
                        break;
                    }
                }
                $max--;
            }
            $this->_active = $active;
        }
	}
?>
