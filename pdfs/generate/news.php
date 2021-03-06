<?php
set_time_limit(0);
$base="http://travelhealthpro.org.uk";
class DbConnect {
    
    public $con;
    
	function __construct() {
	    define ("DB_HOST", "localhost");
        define ("DB_USER", "capita96_thpfina");
        define ("DB_PASSWORD", "z)+fb}h(7@5m{e@(k");
        define ("DB_DATABASE", "capita96_thpyii_final");
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
mysqli_set_charset($conn,"utf8");
if(isset($_GET['new'])){
	$pid = $_GET['new'];
	}
$sql = "select * from news WHERE id='".$pid."'";
$result=mysqli_query($conn,$sql);
$rows =mysqli_fetch_array($result,MYSQLI_ASSOC);
	$tit = $rows['nw_title'];
	$content = $rows['nw_content'];
	$img = $rows['featured_image'];
	$short_desc = $rows['short_content'];
$ref = $rows['ref_content'];
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
if($img!=''){
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
$txt = "<h1>$tit</h1>";
$txt .= "<strong>$short_desc</strong>";
if($img!=''){
$txt .= '<div class="test"><br /><img src="'.$img.'" alt="test alt attribute" width="1000" height="auto" border="0" /></div>';
}
$txt .= $content;
//$output = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $input);


// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// get current vertical position
$y = $pdf->getY();

// set color for background
$pdf->SetFillColor(255, 255, 255);

// set color for text
$pdf->SetTextColor(0, 0, 0);

// write the first column
$pdf->writeHTMLCell(180, '', '', $y, $txt, 0, 0, 0, true, 'J', true);



// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output("$tit.pdf", 'I');

//============================================================+
// END OF FILE
//============================================================+