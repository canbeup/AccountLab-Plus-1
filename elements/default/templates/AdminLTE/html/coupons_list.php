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

<?php 
$page_name = $BL->props->lang['~coupons'];
$page_parent = "Extras";
include_once $BL->props->get_page("templates/AdminLTE/html/header.php"); ?>


				<div class="row">
                        <div class="col-md-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1">Coupons</a></li>
                                    <li><a href="admin.php?cmd_prev=coupons&cmd=add_coupon">Add Coupon</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
<?php if (!count($coupons)) { ?>
				<tr>
					<td class="text_grey" colspan="5">
                    	<div align='center'>
                    	<?php echo $BL->props->lang['No_coupons']; ?> <a href="admin.php?cmd=add_coupon" class="add_link"><br /><?php echo $BL->props->lang['Add_coupon']; ?></a>
                    	</div>
					</td>
				</tr>
		        <?php } else { ?>		
<div class="box-body no-padding">
                                    <table class="table table-striped">
                                        <tbody><tr>
                                            <th><?php echo $BL->props->lang['Nu']; ?></th>
                                            <th><?php echo $BL->props->lang['Name']; ?></th>
                                            <th><?php echo $BL->props->lang['discount']; ?></th>
                                            <th style="width: 20%">Edit / Delete</th>
                                        </tr>								
                    <?php foreach($coupons as $temp) { ?>
					
                                        <tr>
                                            <td>&nbsp;&nbsp;<?php echo $temp['coupon_id']; ?></td>
                                            <td><?php echo $temp['coupon_name']; ?></td>
                                            <td><?php echo $temp['coupon_discount']; ?>%</td>
											<td>
											<?php if($BL->getCmd("edit_coupon")){ ?>   
											<a href='<?php echo $PHP_SELF; ?>?cmd=edit_coupon&coupon_id=<?php echo $temp['coupon_id']; ?>'><i class="fa fa-pencil-square-o" style="color:#000;"></i></a>
											&nbsp;
											<?php } ?>
											<?php if($BL->getCmd("del_coupon")){ ?>   
											<a href="javascript:if(confirm('<?php echo $BL->props->lang['Do_you_want_to_delete_this_coupon']; ?>'))document.location='<?php echo $PHP_SELF; ?>?cmd=del_coupon&coupon_id=<?php echo $temp['coupon_id']; ?>'"><i class="fa fa-remove" style="color:#ff0000;"></i></a>
											&nbsp;
											<?php } ?>
											</td>
                                        </tr>
										<?php } ?>
										<?php } ?>
                                    </tbody></table>
                                </div>
				
                                    </div><!-- /.tab-pane -->
                                </div><!-- /.tab-content -->
                            </div><!-- nav-tabs-custom -->
                        </div><!-- /.col -->
<strong>Note:</strong> Add enable/disable to settings for coupons
						</div>
<?php include_once $BL->props->get_page("templates/AdminLTE/html/footer.php"); ?>
