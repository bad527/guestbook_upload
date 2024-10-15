<?php
    require_once("dbtools.inc.php");
    $link=create_connection();
    //圖片上船處理
    if(isset($_FILES["images"])&& $_FILES["images"]["error"]==0){
        $upload_dir='upload_file/';
        //獲取文件副檔名
        $file_info=pathinfo($_FILES['images']['name']);
        $file_ext=strtolower($file_info['extension']);
        
        $allowed_ext = ['jpg', 'png', 'gif'];
        //檢查前面的參數是否在後面的陣列中
        if(in_array($file_ext,$allowed_ext)){
            //生成唯一文件名
            $file_name=uniqid('img_').'.'.$file_ext;
            $upload_file=$upload_dir.$file_name;
        }
        //移動到指定目錄
        if(move_uploaded_file($_FILES['images']['tmp_name'],$upload_file)){
            echo "圖片上傳成功";
            $images="/guestbook1/".$upload_file;
            echo $images;
        }else{
            echo "圖片上傳失敗";
            $images="";
        }
    }
    $fid=0;
    if(isset($_POST["name"])){
        $name=$_POST["name"];
        $gmail=$_POST["gmail"];
        switch ($_POST["sex"]) {
            case '1':
                $sex=1;
                break;
            
            case '0':
                $sex=0;
                break;
        }
        $subject=$_POST["subject"];
        $content=$_POST["content"];
        $sql="INSERT INTO `talk`(`name`,`gmail`,`sex`,`subject`,`content`,`images`)VALUES('$name','$gmail','$sex','$subject','$content','$images')";
        $result=mysqli_query($link,$sql);
    }else{
        echo "無收到值，請重傳";
    }
    // mysqli_free_result($result);
    mysqli_close($link);
    // header("location:index.php");

?>