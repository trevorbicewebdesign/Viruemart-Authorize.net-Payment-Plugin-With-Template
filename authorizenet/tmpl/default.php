<?php

/**
 *
 * Authorize.net payment plugin
 *
 * @author Trevor Bice
 * @package VirtueMart
 * @subpackage payment
 * Copyright (C) 2004-2015 Virtuemart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
 *
 * http://virtuemart.net
 */
defined ('_JEXEC') or die();
 
$customerData 			= $viewData['customerData'];
$vmpid 				= $viewData['vmpid'];
//$this->_selected_method 	= $vmpid;

$cctype 			= $viewData['cctype'];
$cc_name 			= $viewData['cc_name'];
$cc_number		= $viewData['cc_number'];
$cc_cvv 			= $viewData['cc_cvv'];
$cc_expire_month 	= $viewData['cc_expire_month'];
$cc_expire_year 	= $viewData['cc_expire_year'];


JHTML::_('behavior.tooltip');
JHTML::script('vmcreditcard.js', 'components/com_virtuemart/assets/js/', false);
VmConfig::loadJLang('com_virtuemart', true);
vmJsApi::jCreditCard();

?>

<br />
<span class="vmpayment_cardinfo"><?php echo vmText::_('VMPAYMENT_AUTHORIZENET_COMPLETE_FORM'); ?>
<table border="0" cellspacing="0" cellpadding="2" width="100%">
	<tr valign="top">
		<td width="60%"><label for="cc_number_<?php echo $vmpid ; ?>"><?php echo vmText::_('VMPAYMENT_AUTHORIZENET_CCNUM'); ?></label>
			<script type="text/javascript">
			//<![CDATA[  
			  function checkAuthorizeNet(id, el)
			   {
				ccError=razCCerror(id);
				CheckCreditCardNumber(el.value, id);
				if (!ccError) {
				el.value='';}
			   }
			//]]> 
			</script>
			<input type="text" class="inputbox" id="cc_number_<?php echo $vmpid ; ?>" name="cc_number_<?php echo $vmpid ; ?>" value="<?php echo $cc_number; ?>"    autocomplete="off"   onchange="javascript:checkAuthorizeNet(<?php echo $vmpid ; ?>, this);"  />
			<div id="cc_cardnumber_errormsg_<?php echo $vmpid ; ?>"></div></td>
		<td  style="text-align:right;"><label for="cc_type"><?php echo vmText::_('VMPAYMENT_AUTHORIZENET_EXDATE'); ?></label><br/>
		<script type="text/javascript">
		//<![CDATA[  
			  function changeDate(id, el)
			   {
				var month = document.getElementById('cc_expire_month_'+id); if(!CreditCardisExpiryDate(month.value,el.value, id))
				 {el.value='';
				 month.value='';}
			   }
			//]]> 
		</script>
			<table border="0" cellspacing="0" style="float:right;">
				<tr>
					<td><?php echo shopfunctions::listMonths('cc_expire_month_' . $vmpid, $cc_expire_month); ?></td>
					<td>/</td>
					<td><?php echo shopfunctions::listYears('cc_expire_year_' . $vmpid, $cc_expire_year, null, null, "onchange=\"var month = document.getElementById('cc_expire_month_'".$vmpid."); if(!CreditCardisExpiryDate(month.value,this.value, '".$vmpid."')){this.value='';month.value='';}\" "); ?></td>
				</tr>
			</table>
			<div id="cc_expiredate_errormsg_<?php echo $vmpid ; ?>"></div></td>
		
	</tr>
	<tr>
		<td colspan="2">
		<table border="0" cellspacing="0" width="100%">
				<tr>
					
					<td><label for="creditcardtype"><?php echo vmText::_('VMPAYMENT_AUTHORIZENET_CCTYPE'); ?></label><?php echo $viewData['creditCardList']; ?></td>
					<td  style="text-align:right;"><?php echo vmText::_('VMPAYMENT_AUTHORIZENET_ACCEPTED_CARDS'); ?><br />
					<?php foreach($viewData['creditCards'] as $index=>$card) : ?><img src="<?php echo JURI::root() . 'plugins/vmpayment/authorizenet/authorizenet/assets/images/card_'.strtolower($card).".png"; ?>" height="20"/><?php endforeach;?>
						</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr valign="top">
		<td colspan="2">
			<label for="cc_cvv"><?php echo vmText::_('VMPAYMENT_AUTHORIZENET_CVV2'); ?></label>
			<table border="0" cellspacing="0" width="100%">
				<tr>
					<td>
					
					<input type="text" class="inputbox" id="cc_cvv_<?php echo $vmpid ; ?>" name="cc_cvv_<?php echo $vmpid ; ?>" maxlength="4" size="5" value="<?php echo $cc_cvv; ?>" autocomplete="off" /></td>
					
					
					<td><img src="<?php echo JURI::root() . 'plugins/vmpayment/authorizenet/authorizenet/assets/images/mini_cvv2.gif'; ?>" /><span class="hasTip" title="<?php echo vmText::_('VMPAYMENT_AUTHORIZENET_WHATISCVV'); ?>::<?php echo vmText::sprintf("VMPAYMENT_AUTHORIZENET_WHATISCVV_TOOLTIP", $cvv_images); ?> ">
					<?php echo vmText::_('VMPAYMENT_AUTHORIZENET_WHATISCVV'); ?>
			</span></td>
					<td align="right" style="text-align:right;"><?php echo vmText::_('VMPAYMENT_AUTHORIZENET_NOTIFICATION_TEXT'); ?></td>
				</tr>
			</table>
		
		</td>
	</tr>
</table>
</span>