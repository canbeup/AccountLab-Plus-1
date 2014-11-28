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

    $name           = "Moneybookers";
    $moneybookers   = array (
        array ("Email"      , "pay_to_email"),
        array ("Currency"   , "mb_currency"),
        array ("Active"     , "active", "No", "Yes"),
        array ("Title"      , "title"),
        array ("Submit label", "submit_label")
    );
    $send_method    = "POST";
    $pay            = new moneybookers($demo_mode);
    /*
    * Class to do all moneybookers
    * moneybookers Version 1.0
    */
    class moneybookers
    {
        /*
        * Constructor
        */
        function moneybookers($demo_mode)
        {
            $this->demo_mode = $demo_mode;
            $this->pay_url   = "https://www.moneybookers.com/app/payment.pl";
        }
        /*
        * Function to send variables
        */
        function sendVariables($path_url, $pp_vals)
        {
            $this->_POST1 = array ();
            $this->_POST1['item_number']= time().rand(0, 1000);
            if (isset ($_POST['force_inv_no']))
            {
                $this->_POST1['item_number'] = $_POST['force_inv_no'];
            }

            $this->_POST1['pay_to_email']     = $pp_vals['pay_to_email'];
            $this->_POST1['transaction_id']   = $this->_POST1['item_number'];
            $this->_POST1['cancel_url']       = $path_url."/NOK.php";
            $this->_POST1['return_url']       = $path_url."/OK.php";
            $this->_POST1['status_url']       = $path_url."/ipn.php";
            $this->_POST1['language']         = "EN";
            $this->_POST1['merchant_fields']  = "transaction_id, item_number,gateway";
            $this->_POST1['amount']           = number_format($_POST['gross_amount'],2);
            $this->_POST1['currency']         = $pp_vals['mb_currency'];
            $this->_POST1['detail1_description']= $this->_POST1['item_number'];
            $this->_POST1['detail1_text']     = $_POST['friendly_desc'];
            if(empty($this->_POST1['detail1_text']))
            {
                $this->_POST1['detail1_text'] = $_POST['desc'];
            }

            $array_name                   = array ();
            $array_name                   = explode(' ', $_POST['name'], 2);
            $this->_POST1['firstname']    = $array_name[0];
            $this->_POST1['lastname']     = $array_name[1];
            $this->_POST1['address']      = $_POST['address'];
            $this->_POST1['city']         = $_POST['city'];
            $this->_POST1['state']        = $_POST['state'];
            $this->_POST1['postal_code']  = $_POST['zip'];
            $this->_POST1['country']      = $_POST['country'];
            $this->_POST1['gateway']      = "moneybookers";
        }
        /*
        * IPN=Internet Payment Notifier
        */
        function ipn(& $BL)
        {
            $this->item_number    = $_POST['item_number'];
            $this->transaction_id = $_POST['mb_transaction_id'];
            $this->payment_status = $_POST['Status'];
            if ($_POST['gateway'] == "moneybookers" && !empty ($this->item_number) && !empty ($this->transaction_id) && $this->payment_status >= 0)
            {
                if ($this->payment_status != 2)
                {
                    $_POST['skip_auto_creation']= 1;
                }
                $BL->invoices->processTransaction($this->item_number, $this->transaction_id);
                return true;
            }
            return false;
        }
    }
?>
