<?php 

if(isset($alias)){
	echo "<h3>{$poll_object->poll_list[$alias]['name']}</h3>";
	if(count($this->poll_list[$alias]['variants']) > 1){
				echo "<ul style='list-style: none;'>";
		foreach ($this->poll_list[$alias]['variants'] as $key => $value){
			$answers = $this->poll_list[$alias]['answers'];
			$count   = $answers[$key];
			$percent = (array_sum($answers)) ? $count / array_sum($answers) * 100 : 0;
			echo '<li>';
			echo '<div><b>'.$value.'</b>: &nbsp;'.$count.' '. __( 'votes', 'framework' ) .'</div>';
			echo '<div style="width:300px;border:1px solid #aaa;"><div style="height:8px;background-color:#ccc;width:'.$percent.'%"></div></div>';
			echo '</li>';
		}
		echo "</ul>";
	}
}

?>