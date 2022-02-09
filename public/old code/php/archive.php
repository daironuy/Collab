<?php

$id = $_SESSION['collab_id'];

if(isset($_POST['upload']))
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

        if($id == $row['userid'])
        {
            
          $org = strtolower($row['organization']);
          $dep = strtolower($row['department']);
          $type = strtolower($row['type']);
        
          // echo $dep;
          // echo "<br>";


          
          $file_name = $_FILES['file']['name'];
          $file_data = addslashes(file_get_contents($_FILES['file']['tmp_name']));
          $file_size = $_FILES['file']['size'];
          $file_type = $_FILES['file']['type'];
          $file_error = $_FILES['file']['error'];


          $fileExt = explode('.', $file_name);
          $fileActualExt = strtolower(end($fileExt));

          $allowed = array('csv','doc','docx','jpg','pdf','png','txt','pkt');
  

          //echo $file_size;

          if (in_array($fileActualExt, $allowed))
          {

            $Ename = encryptthis($file_name, $key);
            $Esize = encryptthis($file_size, $key);
            $Etype = encryptthis($file_type, $key);
            $Edata = encryptthis($file_data, $key);
            
            if ($file_error == 0)
            {

              if ($type == "admin") 
              {
                $conn = mysqli_connect($host,$username,$password,$db);

                $sql = "insert into " . $type . "_archive (name,size,type,file) values('$Ename','$Esize','$Etype', '$Edata')";

                //echo $sql;
                if(mysqli_query($conn,$sql))
                {
                  echo "File uploaded successfully.";
                }
                else
                {
                  echo "File can't upload.";
                }
              }
              elseif($type == "user")
              {
                

                if ($org == "ucsc") 
                {
                  $conn = mysqli_connect($host,$username,$password,$db);

                  $sql = "insert into " . $org . "_archive (name,size,type,file) values('$Ename','$Esize','$Etype', '$Edata')";
                  //$sql = "insert into " . $dep . "_archive (name,size,type) values('$Ename','$Esize','$Etype')";

                  //echo $sql;
                  if(mysqli_query($conn,$sql))
                  {
                    echo "File uploaded successfully.";
                  }
                  else
                  {
                    echo "File can't upload.";
                  }

                }
                else
                {

                  $conn = mysqli_connect($host,$username,$password,$db);

                  $sql = "insert into " . $dep . "_archive (name,size,type,file) values('$Ename','$Esize','$Etype', '$Edata')";
                  //$sql = "insert into " . $dep . "_archive (name,size,type) values('$Ename','$Esize','$Etype')";

                  //echo $sql;
                  if(mysqli_query($conn,$sql))
                  {
                    echo "File uploaded successfully.";
                  }
                  else
                  {
                    echo "File can't upload.";
                  }

                }

              }
              else
              {
                echo "WALA";
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




// OLD FILE UPLOAD

          // $file = $_FILES['file']['name'];
          // $file_loc = $_FILES['file']['tmp_name'];
          // $file_size = $_FILES['file']['size'];
          // $file_type = $_FILES['file']['type'];
          // $folder="$dep"."_files/";

          // $fileEx = explode('.', $file);
          // $fileNam = current($fileEx);


          // echo "$fileNam";
          // echo "<br>";

          // echo "$file";
          // echo "<br>";

          

          // if(move_uploaded_file($file_loc,$folder.$file))
          // {


          //   $sql = "insert into $dep"."_files(file_name,file) values('$fileNam','$file')";
          //     mysqli_query($conn,$sql);

          //     echo "$sql";
          //     echo "<h4 style='color:green;'> File nag upload</h4>";
          // }
          // else
          // {
          //   echo "HND NAG UPLOAD";
          // }

        }
        else
        {
          echo "wala";
        }
      }

    }

    





  }
  // else
  // {
  //   echo "BALIK";
  //   //header('location:archive.php');
  // }
