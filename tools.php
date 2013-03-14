<!--Ronald Hinnen -PHP CSYS 2463 - 101-->
<?php

	function validate( $field, $pattern, &$errors, $name = "" )
    {
		$value = $_POST[$field];

		if( empty( $name )  )
        {
			$name = $field;
		}

		if( ! preg_match( "/$pattern/", $value ) )
        {
			$errors[$field] = "The $name field isn't properly formatted";
		}
	}
    
    
    

    function radiovalidate($submitSubmit, $radValue, &$errors)
    {
            if(!isset($_POST[$radValue]))
            {
			    $errors[$radValue] = "The $radValue option isn't properly formatted";
            }
        
            
        
    }
    
    
    function textfield( $field, $label, $errors ) {
		$value = "";
		if( isset( $_POST[$field] ) )
        {
			$value = $_POST[$field];
		}

		if( isset( $errors[$field] ) )
        {
			echo '<p class="error">';
		} else {
			echo '<p>';
		}

		echo '<label for="' . $field . '">' . $label . ': </label>';
		echo '<input type="text" name="' . $field . '" id="' . $field . '" value="' . $value . '"/>';
		echo '</p>';
	}
    
    
    function radiofield( $field, $label, $name,  $errors )
    {
		$value = "";
		if( isset( $_POST[$name] ) )
        {
			$value = $_POST[$name];
            

		}


		//echo '<label for="' . $field . '">' . $label . ': </label>';
		echo '<input type="radio" name="' . $name . '" id="' . $name . '" value="' . $value . '"/>' . $label . '<br>';
		echo '</p>';
	}
    
    
 ?>   
