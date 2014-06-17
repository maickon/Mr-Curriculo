<?php 
function slide(){
	$imgs = slect_list();
	$tag = new tags();
	$active = null;
	
	$tag->open('div','id="myCarousel" class="carousel slide "');
		$tag->open('div','class="carousel-inner"');
		for($i=0; $i< count($imgs); $i++):
			if($i == 0):
				$active = 'active';
			else:
				$active = '';
			endif;
			$tag->open('div','class="item '.$active.'"');
				$tag->open('img','src="img/slide/'.$imgs[$i].'" alt="" class="slide-img"');
				/*
				$tag->open('div','class="carousel-caption"');
					$tag->open('h4');
						$tag->inprime('Primeiro rótulo de miniatura');
					$tag->close('h4');
					$tag->open('p');
						$tag->inprime('Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.');
					$tag->close('p');
				$tag->close('div');	
				*/
			$tag->close('div');
		endfor;
		$tag->close('div');
	
		$tag->open('a','class="left carousel-control" href="http://globocom.github.io/bootstrap/javascript.html#myCarousel" data-slide="prev"');
			$tag->inprime('‹');
		$tag->close('a');
		
		$tag->open('a','class="right carousel-control" href="http://globocom.github.io/bootstrap/javascript.html#myCarousel" data-slide="next"');
			$tag->inprime('›');
		$tag->close('a');
	
	$tag->close('div');
}
?>