<?php

	class Controller_Look extends Controller
	{
		
		function action_index()
		{

			$this->view->generate('look_view.php', 'template_view.php');
		}
	};

 ?>