<?php
/* DF_2: oper/f_dt1.php
group operations table row calendar
c: 25.05.2006
m: 09.10.2017 */

echo "<select class='sel sel_h0' id='d1' name='d1' style='$inpS0; width:30px;' onchange='cal_tocoo(); fill_tdsDates();'></select>";
Date_MonthsList( "<select class='sel sel_h0' id='m1' name='m1' style='$inpS0; width:80px;' onchange='cal_dayslist(); fill_tdsDates();'>" );
Date_YearsList( "<select class='sel sel_h0' id='y1' name='y1' style='$inpS0; width:60px;' onchange='cal_dayslist(); fill_tdsDates();'>" );
?>
