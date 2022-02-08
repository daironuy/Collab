<?php

$id = $_SESSION['collab_id'];


if(isset($_POST['send']))
  {

    $sql = "select * from users_1 where userid = '$id' limit 1";
    $result = mysqli_query($conn,$sql);

    if(!$result)
    {
      echo "ayaw";
    }
    else
    {
      while($row = mysqli_fetch_assoc($result))
      {
        $org = strtolower($row['organization']);
        $dep = strtolower($row['department']);
        $pos = strtolower($row['position']);
        $type = strtolower($row['type']);
        //echo $dep;


        $organization = strtolower($_POST['organization']);
        $department = strtolower($_POST['department']);
        $position = strtolower($_POST['position']);
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $file_name = $_FILES['file']['name'];
        $file_size = $_FILES['file']['size'];
        $file_type = $_FILES['file']['type'];
        $file_data = addslashes(file_get_contents($_FILES['file']['tmp_name']));
        $file_error = $_FILES['file']['error'];

        $fileExt = explode('.', $file_name);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('csv','doc','docx','jpg','pdf','png','txt','pkt');

        if (in_array($fileActualExt, $allowed))
          {

            if ($file_error == 0)
            {

              //$conn = mysqli_connect($host,$username,$password,$db);


              $Eorg = encryptthis($organization, $key);
              $Edep = encryptthis($department, $key);
              $Epos = encryptthis($position, $key);
              $Esub = encryptthis($subject, $key);
              $Emes = encryptthis($message, $key);

              $Ename = encryptthis($file_name, $key);
              $Esize = encryptthis($file_size, $key);
              $Etype = encryptthis($file_type, $key);
              $Edata = encryptthis($file_data, $key);

              
              if ($type == "admin") 
              {
                $sqlS = "insert into " . $department . "_" . $position . "_inbox (m_from,subject,message,file_name,size,type,file) values('$type','$Esub','$Emes','$Ename','$Esize','$Etype','$Edata')";
              }
              elseif($type == "user")
              {
                
                if ($organization == "ucsc") 
                {
                  $sqlS = "insert into " . $organization . "_" . $position . "_inbox (m_from,subject,message,file_name,size,type,file) values('$org/$pos','$Esub','$Emes','$Ename','$Esize','$Etype','$Edata')";
                }
                else
                {
                  $sqlS = "insert into " . $department . "_" . $position . "_inbox (m_from,subject,message,file_name,size,type,file) values('$org/$dep/$pos','$Esub','$Emes','$Ename','$Esize','$Etype','$Edata')";
                }

              }
              else
              {
                echo "HND WALA";
              }

              if(mysqli_query($conn,$sqlS))
              {
                
                
                if($type == "admin")
                {
                  echo "File Send successfully.";
                  $sqlH = "insert into " . $type . "_send (m_to,subject,message,file_name,size,type,file) values('$department/$position','$Esub','$Emes','$Ename','$Esize','$Etype','$Edata')";
                  if(mysqli_query($conn,$sqlH))
                  {
                    echo "<br><br>";
                    echo "NAG SAVE SA HISTORY";
                    header("Location: http://localhost/collab/send_file.php");
                  }
                }
                elseif($type == "user")
                {

                  echo "File Send successfully.";
                  
                  if ($org == "ucsc") 
                  {
                    $sqlH = "insert into " . $org . "_" . $pos . "_send (m_to,subject,message,file_name,size,type,file) values('$organization/$department/$position','$Esub','$Emes','$Ename','$Esize','$Etype','$Edata')";
                    if(mysqli_query($conn,$sqlH))
                    {
                      echo "<br><br>";
                      echo "NAG SAVE SA HISTORY";
                      header("Location: http://localhost/collab/send_file.php");
                    }

                  }
                  else
                  {

                    $sqlH = "insert into " . $dep . "_" . $pos . "_send (m_to,subject,message,file_name,size,type,file) values('$organization
                    /$department/$position','$Esub','$Emes','$Ename','$Esize','$Etype','$Edata')";
                    if(mysqli_query($conn,$sqlH))
                    {
                      echo "<br><br>";
                      echo "NAG SAVE SA HISTORY";
                      header("Location: http://localhost/collab/send_file.php");
                    }

                  }


                }
                
                
                
              }
              else
              {
                echo "File can't Send.";
                echo "<br>";
              }


            }
            else
            {
              echo "File format not supported.";
            }

          }
          else
          {
            echo "There were was an error uploading the file.";
          }





// OLD SEND FILE



        // if(move_uploaded_file($file_loc,$Ifolder.$file))
        // {

        //   //move_uploaded_file($file_loc,$Sfolder.$file);
        //   $query = "insert into $dep"."_"."$pos"."_send(m_to,subject,message,file_name,file) values('$department/$position','$subject','$message', '$fileNam', '$file')";
        //     mysqli_query($conn,$query);


        //   $sql = "insert into $department"."_"."$position"."_inbox(m_from,subject,message,file_name,file) values('$dep/$pos','$subject','$message', '$fileNam', '$file')";
        //   mysqli_query($conn,$sql);

        //     echo "<br>";
        //     echo "$department";
        //     echo "<br>";
        //     echo "$sql";
        //     echo "<h4 style='color:green;'> File nag send</h4>";
        // }
        // else
        // {
        //   echo "HND NAG UPLOAD";
        // }

      }

    }


  }

?>