<?php require (__DIR__ . "/db.php"); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
	<script language="JavaScript" type="text/javascript" src="administrator/jTPS/jquery.js"></script>
    <script language="JavaScript" type="text/javascript" src="administrator/jTPS/jTPS.js"></script>
	<link rel="stylesheet" type="text/css" href="administrator/jTPS/jTPS.css">

        <script>
$(document).ready(function () {
	$('#demoTable').jTPS( {perPages:[5,12,15,50,'ALL'],scrollStep:1,scrollDelay:30,clickCallback:function () {    
	// target table selector
    var table = '#demoTable';
	// store pagination + sort in cookie
	document.cookie = 'jTPS=sortasc:' + $(table + ' .sortableHeader').index($(table + ' .sortAsc')) + ',' + 'sortdesc:' + $(table + ' .sortableHeader').index($(table + ' .sortDesc')) + ',' +'page:' + $(table + ' .pageSelector').index($(table + ' .hilightPageSelector')) + ';';
	}
    });
	// reinstate sort and pagination if cookie exists
	var cookies = document.cookie.split(';');
	for (var ci = 0, cie = cookies.length; ci < cie; ci++) {
		var cookie = cookies[ci].split('=');
		if (cookie[0] == 'jTPS') {
			var commands = cookie[1].split(',');
			for (var cm = 0, cme = commands.length; cm < cme; cm++) {
				var command = commands[cm].split(':');
				if (command[0] == 'sortasc' && parseInt(command[1]) >= 0) {
					} else if (command[0] == 'sortdesc' && parseInt(command[1]) >= 0) {
						$('#demoTable .sortableHeader:eq(' + parseInt(command[1]) + ')').click().click();
						} else if (command[0] == 'page' && parseInt(command[1]) >= 0) {
							$('#demoTable .pageSelector:eq(' + parseInt(command[1]) + ')').click();
						}
					}
				}
			}
			// bind mouseover for each tbody row and change cell (td) hover style
			$('#demoTable tbody tr:not(.stubCell)').bind('mouseover mouseout',
			function (e) {
			// hilight the row
			e.type == 'mouseover' ? $(this).children('td').addClass('hilightRow') : $(this).children('td').removeClass('hilightRow');
                                }
                        );

                });


        </script>
        <style>
                body {
                        font-family: Tahoma;
                        font-size: 9pt;
                }
                #demoTable thead th {
                        white-space: nowrap;
                        overflow-x:hidden;
                        padding: 3px;
                }
                #demoTable tbody td {
                        padding: 3px;
                }
        </style>

<meta charset="UTF-8"></head>

<body>
	<div id="container">
	<?php
		$id = $_GET['id'];
		($pname = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM art_details WHERE art_id='$id'")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));
		$pnamea = mysqli_fetch_array($pname);
	?>
						  <center><h5><?php echo $pnamea['art_name']; ?> Bidding Log</h5></center>
                           <div id="bodycon">
                          <table id="demoTable" style="border: 1px solid #ccc;" cellspacing="0" width="700">
        <thead>
                <?php echo '<tr>';
                        echo '<th sort="index" align="center">Bidder</th>';
                        echo '<th sort="date" align="center">Date of Bid Placed</th>';
                        echo '<th sort="description" align="center">Amount</th>';
                        
                echo'</tr>'; ?>
        </thead>
        <tbody>
        	<?php 
				$prodid = $_GET['id'];
				($query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM bidreport LEFT JOIN customer ON customer.customer_id = bidreport.customer_id LEFT JOIN art_details ON art_details.art_id = bidreport.art_id WHERE art_details.art_id = '$prodid'")) || die(mysqli_error($GLOBALS["___mysqli_ston"]));
				while ($prod = mysqli_fetch_array($query)){
					echo 
					"<tr>
                        <td align='center'>".$prod['customer_lastName'].", ".$prod['customer_firstName']."</td>
                        <td align='center'>".$prod['biddatetime']."</td>
                        <td align='center'>Rs. ".$prod['bidamount']."</td>
					</tr>";
				}
			?>

        </tbody>
        <tfoot class="nav">
                <tr>
                        <td colspan=7>
                                <div class="pagination"></div>
                                <div class="paginationTitle">Page</div>
                                <div class="selectPerPage"></div>
                                <div class="status"></div>
                        </td>
                </tr>
        </tfoot>
</table>

		
	</div> <!-- container -->
</body>
</html>