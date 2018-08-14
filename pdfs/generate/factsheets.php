<?php set_time_limit(0);
ob_start();
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
mysqli_set_charset($conn, "utf8");
if(isset($_GET['new'])){
	$pid = $_GET['new'];
	}
$sql = "select * from factsheets WHERE id='".$pid."'";
$result=mysqli_query($conn,$sql);
$rows =mysqli_fetch_array($result,MYSQLI_ASSOC);
	$tit = $rows['fact_name'];
	$content = $rows['main_desc'];
	$img = $rows['faeatured_image'];
	$short_desc = $rows['short_desc'];
    $references = $rows['references'];
$sql_fact = "select * from factsheet_sections WHERE fact_id='".$pid."' ORDER BY id ASC";
$result_fact=mysqli_query($conn,$sql_fact);
$cnt = mysqli_num_rows($result_fact);
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
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

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
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

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
$txt = "<h2>$tit</h2>";
$txt .= "<strong>$short_desc</strong>";
if($img !=''){ 

	$txt .= '<br><br>
	
<table>
  <tr>
    <td style="border:none;" width="20%"></td>
    <td style="border:none;" width="60%"><img src="'.$img.'" align="center" width="600" height="auto" border="0"/></td>
    <td style="border:none;" width="20%"></td>
  </tr> 
</table>';

	

}
$txt .= $content;
//$txt .='<div class="factsheet-list-title" style="">';	
while ($row_fact = $result_fact->fetch_assoc()) {
$txt .= "<h4>".$row_fact['sub_title']."</h4>";
	   $txt .= $row_fact['fact_desc'];

}
$txt .= "<h4>REFERENCES</h4>";
	   $txt .= $references;
$txt .="<p>Published Date: ".date('d M Y',strtotime($rows['fact_date']))."</p>";
$txt .="<p>Updated Date: ".date('d M Y',strtotime($rows['mod_date']))."</p>";
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

$tblCss = '<style> table{ marging-bottom:30px; width:100% !important; } td{ border: 1px solid #000; border-bottom:none;padding:35px; }th{ font-weight:bold;} td h6{     font-size: 18px !important; } h4{ margin-bottom:0px !important;} </style>';

//$tblCss = '<style> table{ marging-bottom:30px; }td{ border: 1px solid #000; border-bottom:none;padding:3px; }th{ font-weight:bold;} h2{ font-size:22px; } h4{ font-size:18px; }h4 span{ font-size:16px; } </style>';
// get current vertical position
$y = $pdf->getY();

// set color for background
$pdf->SetFillColor(255, 255, 255);

// set color for text
$pdf->SetTextColor(0, 0, 0);
$pdf->setCellHeightRatio(1.5);
$pattern = "/<p[^>]*>&nbsp;<\\/p[^>]*>/";
 $txt = preg_replace($pattern, '', $txt); 
$pattern = "/<h4[^>]*><\\/h4[^>]*>/";
 $txt = preg_replace($pattern, '', $txt); 
$pdf->setImageScale(1);

//write the first column
$pdf->writeHTMLCell(180, '', '', $y,  $tblCss.$txt, 0, 0, 0, true, 'J', true);

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------
//echo $tblCss.$txt;
//Close and output PDF document
//echo $tblCss.$txt;
$pdf->Output("$tit.pdf", 'I');

//============================================================+
// END OF FILE
//============================================================+