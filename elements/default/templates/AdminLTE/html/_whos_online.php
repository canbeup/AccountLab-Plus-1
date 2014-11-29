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
<div class="box box-primary" style="position: relative;">
                                <div class="box-header" style="cursor: move;">
                                    <i class="ion ion-person-stalker"></i>
        <form name='form2' id='form2' action="admin.php" method="post">
                                    <h3 class="box-title">Who's Online?</h3>
                                    <div class="box-tools pull-right" style="padding-top:12px; padding-right:5px;">
          <b><?php echo $BL->props->lang['Show_activity']; ?></b>			
          <select name="sec" class="search" onchange="javascript:this.form.submit();">
          <option value="300"   <?php if($Sec==300)echo "selected=\"selected\""; ?>   >5 <?php echo $BL->props->lang['minutes']; ?></option>
          <option value="600"   <?php if($Sec==600)echo "selected=\"selected\""; ?>   >10 <?php echo $BL->props->lang['minutes']; ?></option>
          <option value="900"   <?php if($Sec==900)echo "selected=\"selected\""; ?>   >15 <?php echo $BL->props->lang['minutes']; ?></option>
          <option value="1800"  <?php if($Sec==1800)echo "selected=\"selected\""; ?>  >30 <?php echo $BL->props->lang['minutes']; ?></option>
          <option value="3600"  <?php if($Sec==3600)echo "selected=\"selected\""; ?>  >1 <?php echo $BL->props->lang['hour']; ?></option>
          <option value="10800" <?php if($Sec==10800)echo "selected=\"selected\""; ?> >3 <?php echo $BL->props->lang['hours']; ?></option>
          <option value="21600" <?php if($Sec==21600)echo "selected=\"selected\""; ?> >6 <?php echo $BL->props->lang['hours']; ?></option>
          <option value="43200" <?php if($Sec==43200)echo "selected=\"selected\""; ?> >12 <?php echo $BL->props->lang['hours']; ?></option>
          <option value="84800" <?php if($Sec==84800)echo "selected=\"selected\""; ?> >24 <?php echo $BL->props->lang['hours']; ?></option>
          </select>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">
<table id="example1" class="table table-bordered table-striped dataTable" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
											<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 204px;" aria-label="Rendering engine: activate to sort column ascending"><?php echo $BL->props->lang['user']; ?></th>
											<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 295px;" aria-label="Browser: activate to sort column ascending"><?php echo $BL->props->lang['Entry_time']; ?></th>
											<th class="sorting_desc" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 263px;" aria-sort="descending" aria-label="Platform(s): activate to sort column ascending"><?php echo $BL->props->lang['last_click_time']; ?></th>
											<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 175px;" aria-label="Engine version: activate to sort column ascending"><?php echo $BL->props->lang['visiting']; ?></th>
											<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 125px;" aria-label="CSS grade: activate to sort column ascending"><?php echo $BL->props->lang['IP']; ?></th>
											<th class="sorting" role="columnheader" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 125px;" aria-label="CSS grade: activate to sort column ascending"><?php echo $BL->props->lang['in_basket']; ?></th>
											</tr>
                                        </thead>
                                    <tbody role="alert" aria-live="polite" aria-relevant="all"></tbody>
        <?php foreach ($Whoisonline as $data) { ?>
<?php $i++; ?>
<div class="<?php ($i%2 ? 'odd':'even') ?>">                                                <td class=""><?php echo $data['user_name']; ?></td>
                                                <td class=" "><?php echo date('m/d/y H:i:s', strtotime($data['entry_time'])) ?></td>
                                                <td class=" sorting_1"><?php echo date('H:i:s', strtotime($data['log_time'])) ?></td>
                                                <td class=" "><?php echo $data['visiting_page']; ?></td>
                                                <td class=" "><?php echo $data['user_ip']; ?></td>
                                                <td class=" "><?php echo $data['items_in_basket']; ?></td>
                                            </tr>
         <?php } ?>
		 </table>         
      </form> 
                                </div><!-- /.box-body -->
                            </div>