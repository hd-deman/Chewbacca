<?php
namespace Chewbacca\Backend\CoreBundle\Twig;

class CoreExtension extends \Twig_Extension {

    public function getFilters() {
        return array(
            'var_dump'   => new \Twig_Filter_Function('var_dump'),
            'tree'  => new \Twig_Filter_Method($this, 'tree'),
        );
    }

    public function tree($roots, $class) {
    	#$em = $this->get('doctrine.orm.entity_manager');
		#$repo = $em->getRepository('Chewbacca\CoreBundle\Entity\Section');
		echo 1;
		#var_dump($roots);
		if( isset($roots) && count($roots) > 0 ){
		    print '<ol class="'.$class.'">';
			echo 2;
			foreach($roots as $tree){
				echo 3;
				$prevLevel = 0; $is_first = true;
				foreach($tree as $item){
				  if($prevLevel > 0 && $item->getLvl()  == $prevLevel)  echo '</li>';
				  if($item->getLvl() > $prevLevel)  echo '<ol>';
				  elseif ($item->getLvl()  < $prevLevel) echo str_repeat('</ol></li>', $prevLevel - $item->getLvl() );
				  #$rel = $item['lft']=='1'?'root':($item['is_approved'] && $item['is_checked']?'document':'document_grey');
				  print '<li id="list_'.$item->getId().'"><div><a href="#">'.$item->getTitle().'</a></div>';
				  $prevLevel = $item->getLvl() ; $is_first = false;
				}
			}
			print '<li id="list_'.$item->getId().'"><div>adsadas</div></li>';
			print '<li id="list_'.$item->getId().'"><div>adsadas</div></li>';
			print '<li id="list_'.$item->getId().'"><div>adsadas</div></li>';
			print '<li id="list_'.$item->getId().'"><div>adsadas</div></li>';
			print '<li id="list_'.$item->getId().'"><div>adsadas</div></li>';

		    print '</ol>';
		}
        #return preg_replace('/(' . $expr . ')/', '<span style="color:red">\1</span>', $sentence);
    }

    public function getName()
    {
        return 'core_extention';
    }

}