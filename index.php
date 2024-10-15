<?php
require_once("dbtools.inc.php");
$link=create_connection();
$sql="SELECT * FROM `talk` ORDER BY `id` DESC";
$result=executed_sql($link,"guestbook1",$sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo "<table align='center' width='800'>";
    $j=1;
    while($row=mysqli_fetch_assoc($result)){
        echo "<tr><td><div>";
        echo "作者:".$row["name"]."&nbsp&nbsp&nbsp   id:".$row["id"]."<br>";
        echo "信箱:".$row["gmail"]."<br>";
        if ($row["sex"]==1){
            echo "男<br>";
        }else{
            echo "女<br>";
        }
        echo "主旨:".$row["subject"]."<br>";
        echo "內容:<br><textarea readonly cols='50' rows='10'>".$row["content"]."</textarea><br>";
        echo "<div style='width:400px;height:200px;'>
        <img src='".$row["images"]."' style='max-width:100%; max-height:100%;' alt='圖片'/><div>";
        echo "<tr><td></div>";
        $j++;
    }
    echo "</table>";
?>
<form action="post.php" name="post_form" method="post" enctype="multipart/form-data">
    <table   width="800" align="center" >
        <tr>
            <td colspan="2" align="center"><p>新增留言</p></td>
        </tr>
        <tr>
            <td width="15%">作者</td>
            <td width="85%"><input type="text" name="name" size="50"></td>
        </tr>
        <tr>
            <td width="15%">信箱</td>
            <td width="85%"><input type="text" name="gmail" size="50"></td>
        </tr>
        <tr>
            <td width="15%">性別</td>
            <td width="85%">
                男:<input type="radio" name="sex" value="1">
                女:<input type="radio" name="sex" value="0">
            </td>
        </tr>
        <tr>
            <td width="15%">主旨</td>
            <td width="85%"><input type="text" name="subject" size="50"></td>
        </tr>
        <tr>
            <td width="15%">內容</td>
            <td width="85%">
                <textarea name="content" cols="50" rows="5"></textarea>
            </td>
        </tr>
        <tr>
            <td width="15%">上傳圖片</td>
            <td width="85%">
                <input type="file" name="images" >
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" value="submit">
            </td>
        </tr>
    </table>
</form>

</body>
</html>