<?php
include 'includes/connect.php';

if($_SESSION['customer_sid']==session_id())
{
    if(isset($_GET['invoice_no'])){

        function fetch_data(){
            global $con;
            $output='';

            $select="SELECT * FROM tbl_cart INNER JOIN tbl_items ON tbl_cart.item_id=tbl_items.item_id 
            ";
            $run=mysqli_query($con, $select) or die(mysqli_error($con));

            while($row=mysqli_fetch_assoc($run)){
                $output .='
                <tr>
                <td>'.$row["item_name"].'</td>
                <td>'.$row["qty_item"].'</td>
                <td>'.$row["price_item"].'</td>
                </tr>
                ';
            }


            return $output;
        }


        $invoice_no=$_SESSION['invoice_no'];

        

        //echo $_SESSION['invoice_no'];
        $sql="INSERT into tbl_sales(item_id,invoice_no,qty_item,price_item,user_name,sale_date, sale_time) 
          SELECT item_id,invoice_no,qty_item,price_item,user_name, date_added,time_added FROM tbl_cart";

        //exporting to pdf
        require_once("tcpdf/tcpdf.php");
        //define ('PDF_PAGE_FORMAT', 'A6');
        $obj_pdf=new TCPDF('P', PDF_UNIT, 'A6', true, 'UTF-8', false);
        $obj_pdf->SetCreator(PDF_CREATOR);
        $obj_pdf->SetTitle("Invoice");
        $obj_pdf->SetHeaderData('','',PDF_HEADER_TITLE, PDF_HEADER_STRING);
        $obj_pdf->SetHeaderFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
        $obj_pdf->SetHeaderFont(Array(PDF_FONT_NAME_DATA,'',PDF_FONT_SIZE_DATA));
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $obj_pdf->SetMargins('4','2');
        $obj_pdf->SetPrintHeader(false);
        $obj_pdf->SetPrintFooter(false);
        $obj_pdf->setAutoPageBreak(TRUE, 10);
        $obj_pdf->SetFont('Helvetica','', 5);
        $obj_pdf->AddPage();

        $select="SELECT * FROM tbl_cart INNER JOIN tbl_items ON tbl_cart.item_id=tbl_items.item_id 
                        ";
        $run=mysqli_query($con, $select) or die(mysqli_error($con));
        $row=mysqli_fetch_assoc($run);
        $output .=''.$row["invoice_no"].'';

        $content='';
        $content.='
            
            <table class="responsive-table">
            <tr>
            <h4 class="left-align">Invoice:'." ".''.$invoice_no.'</h4>
            <br>
            <br>
           
            <th><b>Item Name</b></th>
            <th><b>Qty</b></th>
            <th id="p"><b>Price</b></th>
            </tr>  
            <br>
            
            <style>
            #p{
            padding-right: 20px !important;
            }
</style>
            ';

        $content.= fetch_data();
        $content.='</table>';

        function total_price(){
            global $con;
            $run = "SELECT SUM(price_item) FROM tbl_cart";
            $row = mysqli_query($con, $run);
            $num_rows = mysqli_fetch_array($row);
            //var_dump($num_rows);
            json_encode($num_rows);
            $total=$num_rows["SUM(price_item)"];
            return $total;
        }

        $price.='
    
            <table class="responsive-table">
            <tr>
            <br>
            <th></th>
            <th><b>Total</b></th>
            <th>'.total_price().'</th>
            </tr>  
            <br>
            ';

        $price.='</table>';
        ?>
        <style>
            #p{
                padding-left: -600px;
            }
        </style>
<?php

        $obj_pdf->writeHTML($content);
        $obj_pdf->writeHTML($price);
        ob_end_clean();
        $obj_pdf->Output(mt_rand(1,100000).".pdf","I");
    }


}
else
{
    if($_SESSION['admin_sid']==session_id())
    {
        header("location:admin-page.php");
    }
    else{
        header("location:login.php");
    }
}
?>