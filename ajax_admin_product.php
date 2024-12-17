<?php
session_start();
include("connect.php");
$uid = $_SESSION['users_id'];
$select = "SELECT tbl_product.*, tbl_vender.vuser_name
FROM tbl_product
INNER JOIN tbl_vender ON tbl_product.vid = tbl_vender.vid;";
$result = mysqli_query($connect, $select);
$i = 0;

if ($result) {
    $output = "<h1>Product information</h1>
                <div class='tbl-header'>
                    <table class='tbl' cellpadding='0' cellspacing='0' border='0'>
                        <thead>
                            <tr>
                                <th style='width:3%'>#</th>
                                <th style='width:8%'>Product Id</th>
                                <th style='width:8%'>Vender Name</th>
                                <th style='width:8%'>Serial No</th>
                                <th style='width:10%'>Product Name</th>
                                <th style='width:14%'>Product Image</th>
                                <th style='width:8%'>Category</th>
                                <th style='width:5%'>Quantity</th>
                                <th style='width:5%'>Price</th>
                                <th style='width:5%'>Action</th>
                            </tr>
                        </thead>
                        </table>
                    </div>
                    <div class='tbl-content'>
                    <table class='tbl' cellpadding='0' cellspacing='0' border='0'>
                    <tbody>"; // Start of tbody

    while ($uresult = mysqli_fetch_assoc($result)) {
        $pid = $uresult['product_id'];
        $vname = $uresult['vuser_name'];
        $sno = $uresult['s_no'];
        $pname = $uresult['p_name'];
        $image= $uresult['p_image'];
        $cate = $uresult['category'];
        $que = $uresult['p_quantity'];
        $price = $uresult['p_price'];
        $i++;

        $output .= "<tr>
                        <td style='width:3%'>$i</td>
                        <td style='width:8%'>$pid</td>
                        <td style='width:8%'>$vname</td>
                        <td style='width:8%'>$sno</td>
                        <td style='width:10%'>$pname</td>
                        <td style='width:14%'><img src='$image' height='70px' width='70px' class='img' id='ig'></td>
                        <td style='width:8%'>$cate</td>
                        <td style='width:5%'>$que</td>
                        <td style='width:5%'>$price</td>
                        <td style='width:5%'><button id='btndelete' data-pid='$pid'><i class='ri-delete-bin-6-fill'></i></button></td>
                    </tr>";
    }

    $output .= "</tbody></table></div>"; // End of tbody, table, and div
    echo $output; // Output the constructed table
} else {
    echo "Query failed."; // Handle case where the query failed
}
