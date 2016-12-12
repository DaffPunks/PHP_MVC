<?php

class View
{

	function generate($content_view, $data = null)
	{
		include 'resources/views/'.$content_view;
	}
}
