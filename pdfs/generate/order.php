<?php
ob_start();
class DbConnect {

    public $con;

	function __construct() {
	    define ("DB_HOST", "localhost");
        define ("DB_USER", "nrnacxch_nrnausr");
        define ("DB_PASSWORD", "?3P70&flpo(e");
        define ("DB_DATABASE", "nrnacxch_nrnadb_live");
        define ("DB_PREFIX", "");
	}

	function __destruct() {
		mysqli_close($this->con);
	}

	public function connect() {
		$this->con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);
		return $this->con;
	}

}
 $db = new DbConnect ();
$conn = $db->connect ();
mysqli_set_charset($conn, "utf8");
if(isset($_GET['cnt'])){
	$pid = $_GET['cnt'];
}
	$sql = "select * from nrna_members WHERE txn_id='".$pid."'";
	$result=mysqli_query($conn,$sql);
	$rows =mysqli_fetch_array($result,MYSQLI_ASSOC);

	$tit = $rows['member_name'];
        $lname = $rows['member_lastname'];
        $email = $rows['email'];
        $amount = $rows['paid_amount'];
         $txn = $rows['txn_id'];
        $phone = $rows['phone'];
        $liketovote = $rows['like_to_vote'];
        $img ='';
        $id = $rows['member_id'];
if($liketovote=='Yes'){ $paid = '£ 10.00'; $like_to_v = 'Voter';  }else{ $paid = '£ 05.00'; $like_to_v = 'Non-voter'; }

      $trsql = "select * from orders WHERE tnx_id='".$txn."' ORDER BY id DESC LIMIT 1";
	$tr_result=mysqli_query($conn,$trsql);
	$tr_rows =mysqli_fetch_array($tr_result,MYSQLI_ASSOC);
        $payment_date = date('d M, Y', strtotime($tr_rows['payment_date']));
        $order_id = $tr_rows['order_id'];

        $sql2 = "select * from nrna_members WHERE created_by='".$id."'";
	$result2 =mysqli_query($conn,$sql2);
$posts[] = $tit; 
$paidfor = $tit;
     while($row = mysqli_fetch_array($result2)) {
    $posts[] = $row['member_name'];
   $paidfor .= $row['member_name'].', ';
}
$quantity = count($posts);


//============================================================+
// File name   : example_007.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 007 for TCPDF class
//               Two independent columns with WriteHTMLCell()
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Two independent columns with WriteHTMLCell()
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle($tit);
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
if($img !='' ){
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
}

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'N', 10);

// add a page
$pdf->AddPage();


// create columns content
$txt = "<h1>Thank You For Your Order</h1>";
$txt .= "<p>Your  Payment has been received and is now being processed. Your order details are shown below for your reference:</p>";
if($img!=''){
$txt .= '<div class="test"><br /><img src="'.$img.'" alt="test alt attribute" width="1000" height="auto" border="0" /></div>';
}
$txt .='<div class="table-order">';
$txt .='<table border="0" cellpadding="0" cellspacing="0" width="100%"  style="background-color:#557da1;color:#ffffff;">
                                        <tbody>
<tr >
                                            <td  style="display:block; vertical-align:middle; height:100px">
                                            	<h1 style="color:#ffffff; font-size:30px; font-weight:300;margin:0;text-align:center; height:100px">Thank you for <span class="il">your</span>
<span class="il">order</span></h1></td> </tr> </tbody></table>';


$txt .='<table cellspacing="0" cellpadding="6" style="width:100%;border:1px solid #eee" border="1">
	<thead>
		<tr style="background-color:#557cb2;color:#ffffff;">
<th scope="col" style="text-align:left;border:1px solid #eee;padding:12px">S No</th>
			<th scope="col" style="text-align:left;border:1px solid #eee;padding:12px">Name</th>
			<th scope="col" style="text-align:left;border:1px solid #eee;padding:12px">Vote / Non Vote</th>
			<th scope="col" style="text-align:left;border:1px solid #eee;padding:12px">Price</th>
		</tr>
	</thead>
	<tbody><tr >
			<td  style="text-align:left;border:1px solid #eee;color:#737373;padding:12px; background-color:#557cb2;color:#ffffff;">1</td>
			<td  style="text-align:left;vertical-align:middle;border:1px solid #eee;color:#000;padding:12px; background-color:#87a2b9;">'.$tit.' '.$lname.'</td>
			<td  style="text-align:left;vertical-align:middle;border:1px solid #eee; color:#000;padding:12px; background-color:#87a2b9;"><span class="m_-8591188318343801758amount">'.$like_to_v.'</span></td>
<td  style="text-align:left;vertical-align:middle;border:1px solid #eee; color:#000;padding:12px; background-color:#87a2b9;"><span class="m_-8591188318343801758amount">'.$paid.'</span></td>
		</tr>';
$sql2 = "select * from nrna_members WHERE created_by='".$id."'";
	$result2 =mysqli_query($conn,$sql2);
$number = 2;
while($row = mysqli_fetch_array($result2)) {
if($row['like_to_vote']=='Yes'){ $paidamt = '£ 10.00'; $like_to_vs = 'Voter'; }else{ $paidamt = '£ 05.00'; $like_to_vs = 'Non-voter'; }
if($number%2==0){ $color = '#6d80a3';}else{ $color = '#7e9bb8';}


$txt .='<tr style="" >
			<td  style="text-align:left;border:1px solid #eee;padding:12px;background-color:#557cb2;color:#ffffff;">'.$number.'
</td>
			<td  style="text-align:left;vertical-align:middle;border:1px solid #eee;color:#000;padding:12px; background-color:'.$color.'">'.$row['member_name'].'</td>
			<td  style="text-align:left;vertical-align:middle;border:1px solid #eee; color:#000;padding:12px; background-color:'.$color.'"><span class="m_-8591188318343801758amount">'.$like_to_vs.'</span></td>
<td  style="text-align:left;vertical-align:middle;border:1px solid #eee; color:#000;padding:12px; background-color:'.$color.'"><span class="m_-8591188318343801758amount">'.$paidamt.'</span></td>
		</tr>';
$number++; }
$txt .='</tbody>
	<tfoot><tr><th scope="row" colspan="3" style="text-align:right;border:1px solid #eee;border-top-width:4px;padding:12px">Grand Total:</th>
					<td style="text-align:left;border:1px solid #eee;border-top-width:4px;padding:12px"><span class="m_-8591188318343801758amount">£'.$amount.'</span></td>
				</tr></tfoot>
</table>';
$txt .='<h2 style="color:#557da1;display:block;font-size:18px;font-weight:bold;line-height:130%;margin:16px 0 8px;text-align:left">Customer details</h2>';
$txt .='<p style="margin:0 0 16px"><strong>Email:</strong> <a href="mailto:$email" target="_blank">'.$email.'</a></p>';
$txt .='<p style="margin:0 0 16px"><strong>Phone:</strong> <a href="tel:$phone" target="_blank">'.$phone.'</a></p>';

$txt .='<table border="0" cellpadding="10" cellspacing="0" width="100%">
                                                    <tbody>
<tr><td><p>Note: Our admin will get in touch with you to confirm your registration with NRNA – UK. Please click on the activation link that has been sent to you and your family members email id. Members under the age 16 will get automated user id and password to your email id.</p></td></tr><tr>
                                                        <td colspan="2" valign="middle" style="text-align:center">
                                                        	<p>NRNA – <a href="http://nrna.co.uk/" target="_blank"> www.nrna.co.uk</a></p>
                                                        </td>
                                                    </tr>
                                                </tbody></table>';

$txt .='</div>';



$tblCss = '';

// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// get current vertical position
$y = $pdf->getY();

// set color for background
$pdf->SetFillColor(255, 255, 255);

// set color for text
$pdf->SetTextColor(0, 0, 0);

// write the first column
$pdf->writeHTMLCell(180, '', '', $y, $tblCss.$txt, 0, 0, 0, true, 'J', true);




// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
//echo $tblCss.$txt;
$pdf->Output("$tit.pdf", 'I');

//============================================================+
// END OF FILE
//============================================================+
