<?php
/*
 * @package		Joomla! Volunteers
 * @copyright   Copyright (C) 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

$this->loadHelper('params');
$this->loadHelper('format');
$this->loadHelper('message');
$this->loadHelper('select');

// Get the Itemid
$itemId = FOFInput::getInt('Itemid',0,$this->input);
if($itemId != 0) {
	$actionURL = 'index.php?option=com_volunteers&view=reports&Itemid='.$itemId;
} else {
	$actionURL = 'index.php';
}
?>

<div class="row-fluid">
	<h1><?php echo JText::_('COM_VOLUNTEERS_PAGETITLE_REPORTS') ?></h1>
</div>

<?php if(!empty($this->items)) foreach($this->items as $i=>$item): ?>
<hr>
<div class="row-fluid report">
	<div class="span2 volunteer-image">
		<a href="<?php echo JRoute::_('index.php?option=com_volunteers&view=volunteer&id='.$item->volunteer_id)?>">
			<?php echo VolunteersHelperFormat::image($item->volunteer_image, 'large'); ?>
		</a>
	</div>
	<div class="span10">
		<?php if($item->created_by == JFactory::getUser()->id):?>
		<a class="btn btn-small pull-right" href="<?php echo JRoute::_('index.php?option=com_volunteers&view=report&task=edit&id='.$item->volunteers_report_id.'&group='.$item->group_id)?>">
			<span class="icon-edit"></span>  <?php echo JText::_('COM_VOLUNTEERS_EDIT') ?>
		</a>
		<?php endif;?>
		<h2 class="report-title">
			<a href="<?php echo JRoute::_('index.php?option=com_volunteers&view=report&id='.$item->volunteers_report_id)?>">
				<?php echo($item->title);?>
			</a>
		</h2>
		<p class="muted"
			<?php echo JText::_('COM_VOLUNTEERS_BY') ?> <a href="<?php echo JRoute::_('index.php?option=com_volunteers&view=volunteer&id='.$item->volunteer_id)?>"><?php echo($item->volunteer_firstname)?> <?php echo($item->volunteer_lastname)?></a>
			<?php echo JText::_('COM_VOLUNTEERS_ON') ?> <?php echo VolunteersHelperFormat::date($item->created_on,'Y-m-d H:i'); ?>
			<?php echo JText::_('COM_VOLUNTEERS_IN') ?> <a href="<?php echo JRoute::_('index.php?option=com_volunteers&view=group&id='.$item->group_id)?>"><?php echo($item->group_title)?></a>
		</p>
		<p><?php echo JHtml::_('string.truncate', strip_tags(trim($item->description)), 300); ?></p>
		<a href="<?php echo JRoute::_('index.php?option=com_volunteers&view=report&id='.$item->volunteers_report_id)?>" class="btn">
			<?php echo JText::_('COM_VOLUNTEERS_READ_MORE') ?> <?php echo($item->title);?>
		</a>
	</div>
</div>
<?php endforeach; ?>

<div class="row-fluid">
	<div class="pagination">
		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
</div>

<form id="volunteers-pagination" name="volunteerspagination" action="<?php echo JRoute::_($actionURL); ?>" method="post">
	<input type="hidden" name="option" value="com_volunteers" />
	<input type="hidden" name="view" value="reports" />
	<input type="hidden" name="title" value="<?php echo $filter_title; ?>" id="title-filter" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists->order ?>" id="filter_order"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists->order_Dir ?>" id="filter_order_Dir" />
	<input type="hidden" name="<?php echo JFactory::getSession()->getFormToken();?>" value="1" id="token" />
</form>