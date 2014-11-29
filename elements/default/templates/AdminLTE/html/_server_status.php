<?php

/*
 * Copyright © 2005-2009 Cosmopoly Europe EOOD (http://netenberg.com).
 * All Rights Reserved.
 *
 * This Cosmopoly Europe EOOD work (including software, documents, or
 * other related items) is being provided by the copyright holder under
 * the following license. By obtaining, using and/or copying this work,
 * you (the licensee) agree that you have read, understood, and will
 * comply with the following terms and conditions:
 *
 * Permission to use, copy, modify, and distribute this software and its
 * documentation, with or without modification, for any purpose and
 * without fee or royalty is hereby granted, provided that you include
 * the following on ALL copies of the software and documentation or
 * portions thereof, including modifications, that you make:
 *
 * 1. The full text of this NOTICE in a location viewable to users of the
 * redistributed or derivative work.
 *
 * 2. A short notice of the following form (hypertext is preferred, text
 * is permitted) should be used within the body of any redistributed or
 * derivative code: "Copyright © 2005-2009 Cosmopoly Europe EOOD
 * (http://netenberg.com). All Rights Reserved."
 *
 * 3. Notice of any changes or modifications to the W3C files, including
 * the date changes were made. (We recommend you provide URIs to the
 * location from which the code is derived.)
 *
 * THIS SOFTWARE AND DOCUMENTATION IS PROVIDED "AS IS," AND COPYRIGHT
 * HOLDERS MAKE NO REPRESENTATIONS OR WARRANTIES, EXPRESS OR IMPLIED,
 * INCLUDING BUT NOT LIMITED TO, WARRANTIES OF MERCHANTABILITY OR FITNESS
 * FOR ANY PARTICULAR PURPOSE OR THAT THE USE OF THE SOFTWARE OR
 * DOCUMENTATION WILL NOT INFRINGE ANY THIRD PARTY PATENTS, COPYRIGHTS,
 * TRADEMARKS OR OTHER RIGHTS.
 * COPYRIGHT HOLDERS WILL NOT BE LIABLE FOR ANY DIRECT, INDIRECT, SPECIAL
 * OR CONSEQUENTIAL DAMAGES ARISING OUT OF ANY USE OF THE SOFTWARE OR
 * DOCUMENTATION.
 *
 * The name and trademarks of copyright holders may NOT be used in
 * advertising or publicity pertaining to the software without specific,
 * written prior permission. Title to copyright in this software and any
 * associated documentation will at all times remain with copyright
 * holders.
 */

?>

<script language="JavaScript" type="text/javascript">
    function updateServers()
    {
    <?php foreach ($Servers as $Server){ ?>
        <?php if($Server['httpd_port_yn']==1){ ?>
        url = 'info.php?server_ip=<?php echo $Server['server_ip']; ?>&port=<?php echo $Server['httpd_port']; ?>&ss=true';
        a<?php echo $Server['server_id']; ?>_1 = new ajax();
        a<?php echo $Server['server_id']; ?>_1.makeRequest(url,'img<?php echo $Server['server_id']; ?>_1',1);
        <?php } ?>
        <?php if($Server['smtp_port_yn']==1){ ?>
        url = 'info.php?server_ip=<?php echo $Server['server_ip']; ?>&port=<?php echo $Server['smtp_port']; ?>&ss=true';
        a<?php echo $Server['server_id']; ?>_2  = new ajax();
        a<?php echo $Server['server_id']; ?>_2.makeRequest(url,'img<?php echo $Server['server_id']; ?>_2',1);
        <?php } ?>
        <?php if($Server['ftp_port_yn']==1){ ?>
        url = 'info.php?server_ip=<?php echo $Server['server_ip']; ?>&port=<?php echo $Server['ftp_port']; ?>&ss=true';
        a<?php echo $Server['server_id']; ?>_3  = new ajax();
        a<?php echo $Server['server_id']; ?>_3.makeRequest(url,'img<?php echo $Server['server_id']; ?>_3',1);
        <?php } ?>
        <?php if($Server['pop3_port_yn']==1){ ?>
        url = 'info.php?server_ip=<?php echo $Server['server_ip']; ?>&port=<?php echo $Server['pop3_port']; ?>&ss=true';
        a<?php echo $Server['server_id']; ?>_4  = new ajax();
        a<?php echo $Server['server_id']; ?>_4.makeRequest(url,'img<?php echo $Server['server_id']; ?>_4',1);
        <?php } ?>
        <?php if($Server['mysql_port_yn']==1){ ?>
        url = 'info.php?server_ip=<?php echo $Server['server_ip']; ?>&port=<?php echo $Server['mysql_port']; ?>&ss=true';
        a<?php echo $Server['server_id']; ?>_5  = new ajax();
        a<?php echo $Server['server_id']; ?>_5.makeRequest(url,'img<?php echo $Server['server_id']; ?>_5',1);
        <?php } ?>
    <?php } ?>
    }
    </script>
<div class="box box-primary" style="position: relative;">
                                <div class="box-header" style="cursor: move;">
                                    <i class="ion ion-person-stalker"></i>
    <form name='form1' id='form1' action="<?php echo $PHP_SELF; ?>" method="post"> 
                                    <h3 class="box-title">Server Status</h3>
                                    <div class="box-tools pull-right" style="padding-top:12px; padding-right:5px;">
<input type="checkbox" class="search" name="refr" value='1' <?php if($conf['s_status_refresh']>0)echo "checked=\"checked\""; ?> />
            <?php echo $BL->props->lang['update_every']; ?>&nbsp;
            <input type='text' class='search' name='s_status_refresh' value='<?php echo $conf['s_status_refresh']; ?>' size='5'>&nbsp;<?php echo $BL->props->lang['seconds']; ?>
            <input type='hidden' name='cmd' value='<?php echo $cmd; ?>' />
            <input type='hidden' name='change_refresh_rate' value='1' />
            <input type='submit' class='search1' name='update' value='<?php echo $BL->props->lang['Update']; ?>' />
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">
<table id="example1" class="table table-bordered table-striped dataTable" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
											<th class="sorting_desc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 204px;" aria-label="Rendering engine: activate to sort column ascending"><?php echo $BL->props->lang['server']; ?></th>
											<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 295px;" aria-label="Browser: activate to sort column ascending">HTTPD</th>
											<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 263px;" aria-sort="descending" aria-label="Platform(s): activate to sort column ascending">SMTP</th>
											<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 175px;" aria-label="Engine version: activate to sort column ascending">FTP</th>
											<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 125px;" aria-label="CSS grade: activate to sort column ascending">POP3</th>
											<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 125px;" aria-label="CSS grade: activate to sort column ascending">MYSQL</th>
											</tr>
                                        </thead>
        <?php foreach ($Servers as $Server) { ?>
<?php $i++; ?>
<div class="<?php ($i%2 ? 'odd':'even') ?>">    
                                                <td class=" sorting 1"><?php echo $Server['server_name']; ?></td>
                                                <td class=" "><span id="img<?php echo $Server['server_id']; ?>_1" name="img<?php echo $Server['server_id']; ?>_1">---</span></td>
                                                <td class=" "><span id="img<?php echo $Server['server_id']; ?>_2" name="img<?php echo $Server['server_id']; ?>_2">---</span></td>
                                                <td class=" "><span id="img<?php echo $Server['server_id']; ?>_3" name="img<?php echo $Server['server_id']; ?>_3">---</span></td>
                                                <td class=" "><span id="img<?php echo $Server['server_id']; ?>_4" name="img<?php echo $Server['server_id']; ?>_4">---</span></td>
                                                <td class=" "><span id="img<?php echo $Server['server_id']; ?>_5" name="img<?php echo $Server['server_id']; ?>_5">---</span></td>
</div>
         <?php } ?>       
      </table>
      <script language="javascript">updateServers();</script>
        <?php if($conf['s_status_refresh']>0){ ?>
        <meta http-equiv="refresh" content="<?php echo $conf['s_status_refresh']; ?>;URL=admin.php?cmd_prev=<?php echo isset($BL->REQUEST['cmd_prev'])?urlencode($BL->REQUEST['cmd_prev']):'' ?>&cmd=main">
        <?php } ?>  