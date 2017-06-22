<?php
    session_start();
    require_once "db/setup.php";
    include 'db/database.php';
    require_once 'db/connection.php';

    $result = mysql_query('select * from `groceries`');
    while ($row = mysql_fetch_array($result))
    {
        $id = $row['groc_id'];
        $name = $row['groc_name'];
        $price = $row['groc_price'];
        $cat = $row['groc_category'];
        echo "<script>
                    var newRowContent = '<tr id=\"".$id."\">'+
                        '<td class=\"id_t\" name=\"".$id."\">".$id."</td>'+
                        '<td class=\"name_of_groc\" contenteditable data-idn=\"".$name."\">".$name."</td>'+
                        '<td class=\"other cat_ego\" contenteditable data-idc=\"".$name."\">".$cat."</td>'+
                        '<td class=\"other pri_ce\" contenteditable data-idp=\"".$name."\">".$price."</td>'+
                        '<td class=\"delete\">'+
                            '<button id=\"".$id."\" name=\"".$name."\" type=\"submit\" class=\"close de_let\" aria-label=\"Close\">'+
                                '<span aria-hidden=\"true\">&times;</span>'+
                            '</button>'+
                        '</td>'+
                    '</tr>';
                    
                    $(newRowContent).prependTo(\"tbody\");
              </script>";
    }
?>