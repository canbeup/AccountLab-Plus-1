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

    $name   = "cashu";
    $cashu  = array (
        array ("Merchant ID"    , "cu_merchant_id"),
        array ("Currency"       , "cu_currency", "USD", "CSH"),
        array ("Encryption Key" , "cu_enkey"),
        array ("Active"         , "active", "No", "Yes"),
        array ("Title"          , "title"),
        array ("Submit label"   , "submit_label")
    );
    $send_method    = "POST";
    $pay            = new cashu($demo_mode);
    /*
    * Class to do all cashu
    * cashu Version 1.0
    */
    class cashu
    {
        /*
        * Constructor
        */
        function cashu($demo_mode= 0)
        {
            $this->demo_mode  = $demo_mode;
            $this->pay_url    = "https://www.cashu.com/cgi-bin/pcashu.cgi";
        }
        /*
        * Function to send variables
        */
        function sendVariables($path_url, $pp_vals)
        {
            $this->cu_merchant_id         = $pp_vals['cu_merchant_id'];
            $this->_POST1                 = array ();
            $this->_POST1['item_number']  = time().rand(0, 1000);
            if (isset ($_POST['force_inv_no']))
            {
                $this->_POST1['item_number'] = $_POST['force_inv_no'];
            }
            $this->_POST1['merchant_id']  = $this->cu_merchant_id;
            $this->_POST1['session_id']   = session_id();
            $this->_POST1['amount']       = number_format($_POST['gross_amount'],2);
            // $token will have the MD5 digest value of the string.
            $str                          = strtolower($this->cu_merchant_id.":".number_format($_POST['gross_amount'],2).":".$pp_vals['cu_currency'].":".$pp_vals['cu_enkey']);
            $token                        = md5($str);
            $this->_POST1['token']        = $token;
            $this->_POST1['display_text'] = $_POST['desc']."-".$this->_POST1['item_number'];
            $this->_POST1['currency']     = $pp_vals['cu_currency'];
            $this->_POST1['language']     = "en";
            $this->_POST1['txt1']         = $_POST['desc']."-".$this->_POST1['item_number'];
            $this->_POST1['txt2']         = $this->_POST1['item_number'];
            $this->_POST1['txt3']         = "CASHU";
            //switch demo mode
            if ($this->demo_mode)
            {
                $this->_POST1['test_mode']= "1";
            }
        }
        /*
        * IPN=Internet Payment Notifier
        */
        function ipn(& $BL)
        {
            $this->item_number    = $_POST['txt2'];
            $this->transaction_id = $_POST['txt2'];
            $this->payment_status ="OK";
            if ($_POST['txt3'] == "CASHU" && !empty ($this->item_number) && !empty ($this->transaction_id))
            {
                $BL->invoices->processTransaction($this->item_number, $this->transaction_id);
                return true;
            }
            return false;
        }
    }
?>
