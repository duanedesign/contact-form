<!--Ronald Hinnen -PHP CSYS 2463 - 101-->
<?php

    require( "tools.php" );

	$errors = array( );
	$message = "";

    $data_available = TRUE;
	$field_names = array( 'frmFirst', 'frmLast', 'frmNum', 'frmEmail' );
	foreach( $field_names as $name )
    {
		if( ! isset( $_POST[$name] ) )
        {
			$data_available = FALSE;
        }
    }

    if( $data_available ) 
    {

        //validate user input
		validate( 'frmFirst', "[a-zA-Z]", $errors);
		validate( 'frmLast', "[a-zA-Z]", $errors);
		validate( 'frmNum', "^(\(?[0-9]{3}\)?)?[ .-]?[0-9]{3}[.-]?[0-9]{4}$", $errors );
        validate( 'frmEmail', "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $errors );
         //[^\+?\d+$]
         
         
        radiovalidate('Submit', 'preffered', $errors);

        
        //if no errors open file for reading
        if( count( $errors ) == 0 ) 
            {
                $widgets = array( );
                $file = fopen( "widgets.txt", "r" );
                if($file)
                {
                    while( ! feof( $file ) )
                    {
                        $fields = fgetcsv( $file, 999, "\t" );
                        if( count($fields) > 1 )
                        {
                            array_push( $widgets, $fields );
                        }
                    }

                    fclose( $file ); //close file

                } else 
                {
                    //echo "no file<br/>";
                }


                //find the last used id
                $last_id = 0;
                if( count( $widgets ) > 0 )
                {
                    
                    $last_id = $widgets[count($widgets) - 1][0];
                }

                //write new widgets to the file
                $file = fopen( "widgets.txt", "a" );
                if( $file ) 
                {
                    $output = ++$last_id . "\t" . trim($_POST['frmFirst']) . "\t" . trim($_POST['frmLast']) . "\t" . trim($_POST['frmNum']) . "\t" . trim($_POST['frmEmail']) . "\n";
                    fwrite( $file, strtolower($output) );
                    fclose($file);

                    $message = "Contact information has been saved";
                } else
                {
                    $message = "Contact information could not be saved";
                }
		} //end if there are no errors
    }
?>

<!--radio button validate went here-->

<!--begin html-->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Bill's Widgets</title>
        <!--require css-->
		<?php require( "css_links.php" ); ?>
	</head>
	<body>
        <!--require page header-->
		<?php require( "page_header.php" ); ?>
	        <p class="thick">User Contact Form</p>
        
        <?php if( ! empty($message) )  ?>
			<div id="message">
				<?php echo $message; ?>
			</div>
            
            
        <?php
			if( count( $errors ) > 0 ) {
				foreach( $errors as $msg ) {
					echo "$msg<br/>";
				}
			}
		?>   
        
            <!--form for user to input contact info-->
            <form action="lab04.php" method="post">
                <?php
                    textfield( 'frmFirst', 'FirstName', $errors );
                    textfield( 'frmLast', 'LastName', $errors );
                    textfield( 'frmNum', 'PhoneNumber', $errors );
                    textfield( 'frmEmail', 'Email', $errors );
                    
			?>
            <!--user select preffered contact info--> 
            <form name="preffered" action ="lab04.php" method ="post" >
                <?php
                    radiofield( 'radPhone', 'Phone', 'preffered', $errors);
                    radiofield( 'radEmail', 'Email', 'preffered', $errors);
                    
                ?>

                <p>
                    <!--Input button-->
                    <input type="submit" value="Select"/>
                </p>
		    </form>
            <!--link to Administrators Page--> 
            <p>
            <a href="lab04.2.php">Administrators Page</a>
            </p>
            
         <!--require footer-->    
        <?php require( "page_footer.php" ); ?>
    </body>
</html>
