<body> 
教科を入力してください。  
<form action="subject_read.php" method="post">           
<!-- <input type="text" name="subject"> -->
<select name="subject" id="">
            <option value=""></option>
            <option value="算数">算数</option>
            <option value="国語">国語</option>
            <option value="理科">理科</option>
            <option value="社会">社会</option>
        </select>
<input type="submit" value="検索">
</form>
<tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>
 
</body>

<table>
    <?php
        $dbn = "mysql:dbname=gsacf_l05_04;host=localhost;charset=utf8mb4";
        $username = 'root';
        $password = '';

        try {
        $pdo = new PDO($dbn, $username, $password);
        } catch (PDOException $e) {
        echo json_encode(["db error" => "{$e->getMessage()}"]);
        exit(); }

        $pdo = new PDO($dbn, $username, $password);
        $sql = $pdo -> prepare ('SELECT * FROM subject_table where subject =?');
        $sql -> execute([$_REQUEST['subject']]);

        if ($sql==false) {
            $error = $_sql->errorInfo();
            exit('sqlError:'.$error[2]);
        } else {
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            $output = "";
            foreach ($result as $row) {
                $output .= "<tr>";
                $output .= "<td><img src='img/{$row['id']}.png'></td>" ;         
                $output .= "<td>{$row["unit"]}</td>";
                $output .= "</tr>";
            } 
        }
        // foreach ($sql as $row) {
        //     echo '<tr>';
        //     echo '<td>', $row['unit'],'</td>';
        //     echo '</tr>';
        // }
    ?>
      <tbody>
        <?= $output ?>
      </tbody>
</table>