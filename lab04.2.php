<!--Ronald Hinnen -PHP CSYS 2463 - 101-->
<?php
    if( isset( $_POST['remove'] ) )
    {  
        $lines = file( "widgets.txt" );
        $file = fopen( "widgets.txt", "w" );
        if( count($lines) > 0 )
        {   
            $ids = 0;
            foreach( $lines as $widgets )
            {
                list( $id, $first, $last, $phone, $email) = explode( "\t", $widgets );
                if ( $id != $_POST['remove'])
                {
                    $ids++;
                    $output = trim($ids) . "\t" . trim($first) . "\t" . trim($last) . "\t" . trim($phone) . "\t" . trim($email) . "\n";
                    fwrite( $file, strtolower($output) );
                } 
            }
        }
        else
        {
		$message = "The widgets could not be saved";
        }
        fclose( $file );   
    }
?>


<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Bill's Widgets</title>
    <!--require css-->
    <?php require( "css_links.php" ); ?>
    </head>

    <body>
        <!--require page header-->
        <?php require( "page_header.php" ); ?>

        
        <p class="thick">User Contact Information Administration Page</p>

            <!--table to display user input-->
            <table>
                    <tr>
                        <!--table header-->
                        <th>Processed</th><th>First Name</th><th>Last Name</th><th>Phone Number</th><th>Email</th>
                    </tr>
                    <!--form to display user contact info-->
                    <form action="lab04.2.php" method="post">
                        <?php
                            $lines = file( "widgets.txt" );
                            if( count($lines) > 0 )
                            {
                                foreach( $lines as $widgets )
                                {
                                    list( $id, $first, $last, $phone, $email) = explode( "\t", $widgets );
                                    echo "<tr><td><input type='checkbox' name='remove' value=$id action='post'/></td>";
                                    echo "<td>" . ucfirst($first) . "</td>";
                                    echo "<td>" . ucfirst($last) . "</td>";
                                    echo "<td>" . ucfirst($phone) . "</td>";
                                    echo "<td>" . ucfirst($email) . "</td></tr>";
                                }
                            } else
                            {
                                echo "<tr><td>No Widgets Available</td></tr>";
                            }
                        ?>
                    <P>
                        <!--Input button-->
                        <input type="submit" value="Submit" />
                    </P>
                    </form>
                </table>
                
                
    <!--link to contact info page--> 
    <p>
    <a href="lab04.php">User Contact Input</a>
    </p>
    
    <!--require footer-->          
    <?php require( "page_footer.php" ); ?>           
    
</body>
</html>

