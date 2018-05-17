<?php
    #This is the PHP file that co-ordinates database entries
    
    $servername='localhost';
    $username='meme.xyz';
    $password='2khgWIkQWP15';
    $dbName='memes';
    $conn=new mysqli($servername,$username,$password);  #establihing connection for the first time

    # check connectivity to databse
    function pingDB(){
        global $conn;
        if($conn->connect_error){
            die("Connection to database failed!");
        }
    }
    # activate partcular database
    function selectDB(){
        global $conn, $dbName;
        $useDbName='USE '.$dbName;   #Query to select particular database
        $result=$conn->query($useDbName); #instructing mySQl to use particular database
    }

    # get meme counter - generate unique number for each file
    function createID(){
        pingDB();   #make sure DB Connection is alive
        selectDB(); #SELECT MEMES DB
        global $conn;   
        $sqlCounterSelect='SELECT counter FROM memeCounter';
        $result=$conn->query($sqlCounterSelect);
        if($result->num_rows==1){
            $row=$result->fetch_assoc();    
            $current_counter=$row['counter']; #retrieve last counter from the memes.memeCounter Table
            $update_counter=$current_counter+1; #increment the counter by 1
            $update_query='UPDATE memeCounter SET counter=counter+1';
            $update_query_result=$conn->query($update_query);
            if($update_query_result==TRUE){
                return $current_counter;
            }
            else{
                die('MYSQL COUNTER INVALID::memes.memeCounter VALUE COULD NOT BE UPDATED.');
                return -1;
            }
        }
        else{
            die('MYSQL COUNTER INVALID::MORE THAN ONE ROW PRESENT IN memes.memeCounter');
        }
    }




?>